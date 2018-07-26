<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailable;
use Illuminate\Http\Request;
use App\User;
use App\times;
use App\Mail\MailTrap;
use Mail;
use App\Product;
use Excel;
use App\Exports\ExcelExports;
use App\http\Controllers\ActionController;

class UserController extends Controller
{
     public function users()
    {   
    	$users = User::where('deleted',0)->Paginate(7);
        return view('user.users',compact('users'));
    }

    public function usersHasDeleted(){
        $users = User::where('deleted',1)->Paginate(7);
        return view('user.usersHasDeleted',compact('users'));
    }

    public function destroy($user_id)
    {
        $user = User::find($user_id);

        if($user->deleted == 0){
            User::where('user_id',$user->user_id)->update([
                'deleted' => 1,
            ]);
        
            app('App\http\Controllers\ProfileController')->deleteProfile($user_id);
            $userAfter = User::find($user_id);
            if($userAfter->deleted == 1){                  
                app('App\http\Controllers\ActionController')->deleteUserLog($user,$user_id);
                return redirect('/home')->with('success', 'user has been deleted!!');
            }else{
                return redirect('/home')->with('success', 'You do not change anything!!');
            }
        }else{
            User::where('user_id',$user->user_id)->update([
                'deleted' => 0,
            ]);
        
            app('App\http\Controllers\ProfileController')->deleteProfile($user_id);
            $userAfter = User::find($user_id);
            if($userAfter->deleted == 0){                  
                app('App\http\Controllers\ActionController')->restoreUserLog($userAfter,$user_id);
                return redirect('/home')->with('success', 'user has been Restore!!');
            }else{
                return redirect('/home')->with('success', 'You do not change anything!!');
            }
        }
        //return back();
        // return redirect('/home')->with('success', 'user has been deleted!!');
    }

    public function edit($user_id)
    {
        $user = User::get()->where('user_id',$user_id)->first();
        return view('user.edit', compact('user', 'user_id'));
    }

    public function update(Request $request, $user_id)
    {   
        $user = new User();
        $data = $this->validate($request, [
            'name'=>'required',
            'email'=> 'required',
            'isAdmin'=> 'required'
        ]);
        $data['user_id'] = $user_id;
        $userBefore = User::where('user_id', $user_id)->first();
        
        $this->updateUser($data);

        $userAfter = User::where('user_id',$user_id)->first();

        if($userBefore->start != $userAfter->start || $userBefore->finish != $userAfter->finish ||
            $userBefore->isAdmin != $userAfter->isAdmin){
            app('App\http\Controllers\ActionController')->updateUserLog($userBefore,$userAfter,$id);

            return redirect('/home')->with('success', 'New support user has been updated!!');
        } else{
            return redirect('/home')->with('success', 'You do not change anything!!');
        }
        
    }
   
    public function updateUser($data)
    {   
        $user_id = $data['user_id'];
        User::where('user_id',$user_id)->update([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'isAdmin'=>$data['isAdmin'],
        ]);
        
        return $data;
    }

    public function start(){
    	$times = \DB::table('times')
    		->join('users','users.user_id','=','times.user_id')
    		->where('times.user_id',Auth::user()->user_id)
    		->whereYear('date',date('Y',strtotime(now())))
    		->whereMonth('date',date('m',strtotime(now())))
    		->orderBy('date','desc')
    		->Paginate(7);

    	$first = times::where('user_id',Auth::user()->user_id)->where('date',date('Y-m-d',strtotime(now())))->first();
    	$leave = 0;
   		if($first == null) {
   			$status = 0;
   			return view('user.start',compact("times","status"));
   		}
    	$status = $first->status;
    	if($status == 2 && date('Y-m-d',strtotime(now())) == $first->date)
    		return redirect('/home')->with('success',"hom nay, ban da checkout roi");
    	else
    		return view('user.start',compact("times","status"));
    }


    public function finish(){ 
    	$status = 0;
    	$first = times::where('user_id',Auth::user()->user_id)
    		->where('times.user_id',Auth::user()->user_id)
    		->whereYear('date',date('Y',strtotime(now())))
    		->whereMonth('date',date('m',strtotime(now())))
    		->orderBy('date','desc')
    		->first();
    	if($first != null){
    		$status = $first->status;
    	}
    	

    	if($status == 1 && date('Y-m-d',strtotime(now())) == date('Y-m-d',strtotime($first->start))){
    		return view('user.finish',compact("times"));
    	}
    	
    	date_default_timezone_set("Asia/Ho_Chi_Minh");
    	$now = time();
    	$start = date("H:i:s",$now);
    	$date = date('Y-m-d', $now);
    	//dd($start, $date);
    	$time_id = times::where('user_id',Auth::user()->user_id)
    		->whereYear('date',date('Y',strtotime(now())))
    		->whereMonth('date',date('m',strtotime(now())))
    		->orderBy('date','desc')
    		->first();

    	$time = new times();
    	$time->user_id = Auth::user()->user_id;
    	$time->start = $start;
    	$time->finish = 0;
    	$time->time_per_day = 0;
    	if($time_id != null)
    		$time->all_time = $time_id->all_time;
    	else 
    		$time->all_time = 0;
    	$time->date = $date;
    	$time->status = 1;
    	$time->save();

    	$times = \DB::table('times')
    		->join('users','users.user_id','=','times.user_id')
    		->where('times.user_id',Auth::user()->user_id)
    		->whereYear('date',date('Y',strtotime(now())))
    		->whereMonth('date',date('m',strtotime(now())))
    		->orderBy('date','desc')
    		->Paginate(7);

    	return view('user.finish',compact("times"));
    }

    public function checkout(){
    	date_default_timezone_set("Asia/Ho_Chi_Minh");
    	$now = time();
    	$finish = date("H:i:s",$now);
    	$time_id = times::where('user_id',Auth::user()->user_id)->orderBy('date','desc')->first();
    	$today = ($now - strtotime($time_id->start))/3600;
    	if($time_id->status == 1){
    		$status = 2;
    		times::where('time_id',$time_id->time_id)->update([
    			'finish'=>$finish,
    			'time_per_day' => $today,
    			'all_time'=>$time_id->all_time + $today,
    			'status' => $status,
    	]);
    	}else {
    		//
    	}
    	
    	$times =  \DB::table('times')
    		->join('users','users.user_id','=','times.user_id')
    		->where('times.user_id',Auth::user()->user_id)
    		->whereYear('date',date('Y',strtotime(now())))
    		->whereMonth('date',date('m',strtotime(now())))
    		->orderBy('date','desc')
    		->Paginate(7);

    	return view('user.form',compact("times"));
    }

    public function  form(Request $request){
         $date = $request->select;
         if($date == null) 
            $date = date('Y-m',strtotime(now()));
       

        $months = \DB::table('times')
        ->select(\DB::raw("date_format(date, '%Y-%m') as month"))
        ->where('times.user_id',Auth::user()->user_id)
        ->groupBy('month')
        ->orderBy('date','desc')
        ->get();
    	$times = \DB::table('times')
            ->join('users','users.user_id','=','times.user_id')
            ->where('times.user_id',Auth::user()->user_id)
            ->whereYear('date',date('Y',strtotime( $date )))
            ->whereMonth('date',date('m',strtotime($date)))
            ->orderBy('date','desc')
            ->Paginate(7);
        $timess = \DB::table('times')
            ->join('users','users.user_id','=','times.user_id')
            ->where('times.user_id',Auth::user()->user_id)
            ->whereYear('date',date('Y',strtotime($date)))
            ->whereMonth('date',date('m',strtotime($date)))
            ->get();
        $allTime = 0;
        $timeLeave = 0;
        foreach ($timess as $time) {
            $allTime += $time->time_per_day;
            if($time->time_per_day < 8){
                $timeLeave += 8 - $time->time_per_day;
            }
        }
        

    	return view('user.form',compact("times","user_id","allTime","timeLeave","months","date"));
    }

    public function history($user_id,Request $request){

         $date = $request->select;
         if($date == null) 
            $date = date('Y-m',strtotime(now()));
       

        $months = \DB::table('times')
        ->select(\DB::raw("date_format(date, '%Y-%m') as month"))
        ->where('times.user_id',$user_id)
        ->groupBy('month')
        ->orderBy('date','desc')
        ->get();

    	$times = \DB::table('times')
    		->join('users','users.user_id','=','times.user_id')
    		->where('times.user_id',$user_id)
            ->whereYear('date',date('Y',strtotime($date)))
            ->whereMonth('date',date('m',strtotime($date)))
    		->orderBy('date','desc')
    		->Paginate(7);
        $timess = \DB::table('times')
            ->join('users','users.user_id','=','times.user_id')
            ->where('times.user_id',$user_id)
            ->whereYear('date',date('Y',strtotime($date)))
            ->whereMonth('date',date('m',strtotime($date)))
            ->get();
        $allTime = 0;
        $timeLeave = 0;
        foreach ($timess as $time) {
            $allTime += $time->time_per_day;
            if($time->time_per_day < 8){
                $timeLeave += 8 - $time->time_per_day;
            }
        }
    	return view('user.editHistory',compact("times","user_id","allTime","timeLeave","months","date"));
    }

    public function editTime($time_id)
    {

        $times = times::where('time_id',$time_id)->first();

        return view('user.editTime', compact('times', 'time_id'));
    }

    public function updateTime(Request $request, $time_id){
        
    	$time = new times();
        $time = $this->validate($request, [
            'start'=>'required',
            'finish'=> 'required',
        ]);
        if(strtotime($time['finish']) < strtotime($time['start'])) 
             return redirect()->back()->with('success', 'finish time must bigger than start time!!');

    	$times = times::where('time_id',$time_id)
    		->whereYear('date',date('Y',strtotime(now())))
    		->whereMonth('date',date('m',strtotime(now())))
    		->first();
        $timeBefore = times::where('time_id',$time_id)->first();

    	//dd($times['time_per_day']);
    	$time['time_per_day'] =  (strtotime($time['finish']) - strtotime($time['start']))/3600; 
    	
        times::where('time_id',$time_id)->update([
        		'start' =>$time['start'],
    			'finish'=>$time['finish'],
    			'time_per_day' => $time['time_per_day'],
    			
    			'status' => 2,
    	]);

    	

        $timeAfter =  times::where('time_id',$time_id)->first();

        if($timeBefore->start != $timeAfter->start || $timeBefore->finish != $timeAfter->finish){
            app('App\http\Controllers\ActionController')->updateTimeLog($timeBefore,$timeAfter,$time_id);
            return redirect('/home')->with('success', 'New support times has been updated!!');
        } else{
            return redirect('/home')->with('success', 'You do not change anything!!');
        }
    }



    public function deleteTime($time_id){
        $timeBefore = times::where('time_id', $time_id)->first();
        $time = times::where('time_id',$time_id)->delete();
        $this->updateAllTime($timeBefore);
        app('App\http\Controllers\ActionController')->deleteTimeLog($timeBefore,$time_id);
        return redirect('/home')->with('success', 'has been deleted!!');
    }

    public function insert($user_id){

        return view('user.insertTime', compact('user_id'));
    }

    public function insertTime(Request $request,$user_id){


        $time = new times();
        $time = $this->validate($request, [
            'start'=>'required',
            'finish'=>'required',
            'date' => 'required',
        ]);
         if(strtotime($time['finish']) < strtotime($time['start'])) 
             return redirect()->back()->with('success', 'finish time must bigger than start time!!');
        $time['time_per_day'] =  (strtotime($time['finish']) - strtotime($time['start']))/3600; 
        $time['all_time'] = $time['time_per_day'];
        //dd($time['date']);
        $check = times::where('user_id', $user_id)
        ->where('date', $time['date'])->first();
        if($check == null){
            $insert = new times();
            $insert->user_id = $user_id;
            $insert->start = $time['start'];
            $insert->finish = $time['finish'];
            $insert->date = $time['date'];
            $insert->time_per_day = $time['time_per_day'];
            $insert->all_time = $time['all_time'];
            $insert->status = 2;
           
            $insert->save();
            $this->updateAllTime($insert);

            app('App\http\Controllers\ActionController')->insertTimeLog($insert,$insert->time_id);
            return redirect('/home')->with('success', 'New times has been inserted!!');
        }else {
            return redirect('/home')->with('success','Date : ' . $time['date'] . ' already exists !!');
        }
    }

    public function print($date){
    	// $times = \DB::table('times')
    	// 	->join('users','users.user_id','=','times.user_id')
    	// 	->where('times.user_id',Auth::user()->user_id)
    	// 	->whereYear('date',date('Y',strtotime(now())))
    	// 	->whereMonth('date',date('m',strtotime(now())))
    	// 	->select('users.user_id','name','start','finish','time_per_day','all_time','date')
    	// 	->orderBy('date','desc')->get()->toArray();
        
        if($date == null) 
            $date = date('Y-m',strtotime(now()));
        $data =times::join('users','users.user_id','=','times.user_id')
            ->where('times.user_id',\Auth::user()->user_id)
            ->whereYear('date',date('Y',strtotime($date)))
            ->whereMonth('date',date('m',strtotime($date)))
            ->select('users.user_id','name','start','finish','time_per_day','date')
            ->orderBy('date','desc')->get();

    	return Excel::download(new ExcelExports($data),'export.xlsx');
    }

    public function insertAllTime(){

    }
    
    public function test(){
        return view('test');
    }

}
