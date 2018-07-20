<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailable;
use App\User;
use App\times;
use App\Mail\MailTrap;
use Mail;
use App\Product;
use Excel;
use App\Exports\ExcelExports;
use App\Profiles;
use App\positions;
use App\Http\Controller\ActionController;
use App\profiles_positions;

class ProfileController extends Controller
{
    public function profile($user_id){
    	
    	$check = Profiles::join('users','users.user_id','=','profiles.user_id')
    		->where('profiles.user_id', $user_id)->first();
    	if($check == null){
    		$newProfile = new Profiles();
    		$newProfile->user_id = $user_id;
    		$newProfile->first_name = " ";
    		$newProfile->last_name = " ";
    		$newProfile->date_of_birth = date('Y-m-d',strtotime(now()));
    		$newProfile->gender = " ";
    		$newProfile->position = " ";
    		$newProfile->home_address = " ";
    		$newProfile->phone_number = " ";
    		$newProfile->save();
    		//return view('profile.profile',compact('newProfile'));
    	}

    	if($user_id == Auth::User()->user_id){
    		$profile = Profiles::join('users','users.user_id','=','profiles.user_id')
    		->where('profiles.user_id', $user_id)->first();
    	}else if(Auth::User()->isAdmin == 1){
    		$profile = Profiles::join('users','users.user_id','=','profiles.user_id')
    		->where('profiles.user_id', $user_id)->first();
    	}else{
    		$user_id = Auth::User()->user_id;
    		$profile = Profiles::join('users','users.user_id','=','profiles.user_id')
    		->where('profiles.user_id', $user_id)->first();
    	}

        $positions = profiles_positions::where('user_id',$user_id)
        ->select('position_name')
        ->join('positions','positions.position_id','=','profiles_positions.position_id')
        ->get();

        $pro = Profiles::where('user_id',Auth::user()->user_id)->first();

        $pos = profiles_positions::where('user_id',Auth::user()->user_id)
        ->select('position_name')
        ->join('positions','positions.position_id','=','profiles_positions.position_id')
        ->get();

    	return view('profile.profile',compact('profile','positions','pro','pos'));
    }

    public function editProfile($user_id){
        $positions = positions::select('position_id','position_name')->get();
        $array = "";
        foreach ($positions as $position) {
            $array .= $position->position_name . ", ";
        }
        
       

    	if($user_id == Auth::User()->user_id ){
           
    		  $profile = Profiles::join('users','users.user_id','=','profiles.user_id')
            ->where('profiles.user_id', $user_id)->first();
    	}else if(Auth::User()->isAdmin == 1){
            $profile = Profiles::join('users','users.user_id','=','profiles.user_id')
            ->where('profiles.user_id', $user_id)->first();
        }else{
    		$user_id = Auth::User()->user_id;
    		$profile = Profiles::join('users','users.user_id','=','profiles.user_id')
            ->where('profiles.user_id', $user_id)->first();

    	}
        
    	 $user_positions = \DB::table('profiles_positions')
        ->where('user_id',$user_id)
        ->select('profiles_positions.position_id')
        ->join('positions','positions.position_id','=','profiles_positions.position_id')
        ->get();

    	return view('profile.editProfile',compact('profile','positions','user_positions'));
    }

    public function updateProfile(Request $request, $user_id){
        $input = $request->all();
        $positions = $input['position'];

    	$profile = new Profiles();
    	$user = new User();
    	$profile = $this->validate($request, [
    		'first_name'=>'required',
    		'last_name'=>'required',
    		'date_of_birth'=>'required',
    		'gender'=>'required',
    		//'position'=>'required',
    		'home_address'=>'required',
    		'phone_number'=>'required',
    	]);

    	$user = $this->validate($request,[
    		'email'=>'required',
    	]);

        $profileBefore = Profiles::join('users','users.user_id','=','profiles.user_id')
            ->where('profiles.user_id', $user_id)->first();

    	profiles::where('user_id',$user_id)->update([
    		'first_name'=>$profile['first_name'],
    		'last_name'=>$profile['last_name'],
    		'date_of_birth'=>$profile['date_of_birth'],
    		'gender'=>$profile['gender'],
    		//'position'=>$profile['position'],
    		'home_address'=>$profile['home_address'],
    		'phone_number'=>$profile['phone_number'],
    	]);
        profiles_positions::where('user_id',$user_id)->delete();
        foreach ($positions as $position) {
                
                $new = new profiles_positions();
                $new->user_id = $user_id;
                $new->position_id = $position;
                $new->save();
        }
    	User::where('user_id',$user_id)->update([
    		'email'=>$user['email'],
    	]);
    	
    	if($request->hasFile('img')){
    		$request->file('img')->move('img',$user_id . ".jpg");
    	} 
    	
        
        $profileAfter = Profiles::join('users','users.user_id','=','profiles.user_id')
            ->where('profiles.user_id', $user_id)->first();

        if($profileBefore->first_name != $profileAfter->first_name ||
            $profileBefore->last_name != $profileAfter->last_name ||
            $profileBefore->date_of_birth != $profileAfter->date_of_birth ||
            $profileBefore->position != $profileAfter->position ||
            $profileBefore->gender != $profileAfter->gender ||
            $profileBefore->home_address != $profileAfter->home_address ||
            $profileBefore->phone_number != $profileAfter->phone_number)
        {

            app('App\http\Controllers\ActionController')
            ->updateProfileLog($profileBefore,$profileAfter,$user_id);
            return redirect('/home')->with('success', 'New support profile has been updated!!');
        }else{
            return redirect('/home')->with('success', 'You do not change anything!!');
        }
    }

    public function deleteProfile($user_id){
        $profileBefore = Profiles::where('user_id',$user_id)->first();

        $profile = Profiles::where('user_id', $user_id)->delete();
        

        app('App\http\Controllers\ActionController')->deleteProfileLog($profileBefore,$user_id);
    }

    public function them(){
    	$position = new profiles_positions();
        $position->user_id = 10;
        $position->position_id = 4;
        $position->save();
    	echo "hi";
    }
}