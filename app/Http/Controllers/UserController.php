<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;
use App\times;

class UserController extends Controller
{
     public function user()
    {   
    	$users = User::Paginate(7);
       
        return view('user.users',compact('users'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back();
        // return redirect('/home')->with('success', 'user has been deleted!!');
    }
    public function edit($id)
    {
        $user = User::get()->where('id',$id)->first();
        return view('user.edit', compact('user', 'id'));
    }

    public function update(Request $request, $id)
    {   
        $user = new User();
        $data = $this->validate($request, [
            'name'=>'required',
            'email'=> 'required',
            'isAdmin'=> 'required'
        ]);
        $data['id'] = $id;
        $this->updateUser($data);

        return redirect('/home')->with('success', 'New support user has been updated!!');
    }

    public function updateUser($data)
    {   
        $id = $data['id'];
        User::where('id',$id)->update([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'isAdmin'=>$data['isAdmin'],
        ]);
        
        return $data;
    }
    public function start(){

    	// $test = \DB::table('times')
    	// 	->join('users','users.id','=','times.id')
    	// 	->where('times.id','9')
    	// 	->get();
    	// dd($test);	
    	$times = times::where('id',Auth::user()->id)->get();

    	return view('user.start',compact("times"));
    }
    public function finish(){
    	date_default_timezone_set("Asia/Ho_Chi_Minh");
    	$now = time();
    	$start = date("H:i:s",$now);
    	$date = date('Y-m-d', $now);
    	//dd($start, $date);
    	$time_id = times::where('id',Auth::user()->id)->orderBy('date','desc')->first();
    	// times::where('id',$time['id'])->insert([
    	// 	'id'->$time['id'],
    	// 	'start'=>$start,
    	// 	'date'=>$date,
    	// ]);
    	$time = new times();
    	$time->id = Auth::user()->id;
    	$time->start = $start;
    	$time->finish = 0;
    	$time->time_per_day = 0;
    	$time->all_time = $time_id->all_time;
    	$time->date = $date;
    	$time->status = 1;
    	$time->save();
    	$times = times::where('id',Auth::user()->id)->get();
    	return view('user.finish',compact("times"));
    }

    public function checkout(){
    	date_default_timezone_set("Asia/Ho_Chi_Minh");
    	$now = time();
    	$finish = date("H:i:s",$now);
    	$time_id = times::where('id',Auth::user()->id)->orderBy('date','desc')->first();
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
    	
    	$times = times::where('id',Auth::user()->id)->get();

    	return view('user.form',compact("times"));
    }

    public function  form(){
    	$times = times::where('id',Auth::user()->id)->get();

    	return view('user.form',compact("times"));
    }
}
