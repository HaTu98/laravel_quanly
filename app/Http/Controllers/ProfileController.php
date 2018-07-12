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
use App\Http\Controller\ActionController;

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
    		$profile = Profiles::join('users','users.user_id','=','profiles.user_user_id')
    		->where('profiles.user_id', $user_id)->first();
    	}else if(Auth::User()->isAdmin == 1){
    		$profile = Profiles::join('users','users.user_id','=','profiles.user_id')
    		->where('profiles.user_id', $user_id)->first();
    	}else{
    		$user_id = Auth::User()->user_id;
    		$profile = Profiles::join('users','users.user_id','=','profiles.user_id')
    		->where('profiles.user_id', $user_id)->first();
    	}

    	return view('profile.profile',compact('profile'));
    }

    public function editProfile($user_id){
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
    	   	
    	return view('profile.editProfile',compact('profile'));
    }

    public function updateProfile(Request $request, $user_id){


    	$profile = new Profiles();
    	$user = new User();
    	$profile = $this->validate($request, [
    		'first_name'=>'required',
    		'last_name'=>'required',
    		'date_of_birth'=>'required',
    		'gender'=>'required',
    		'position'=>'required',
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
    		'position'=>$profile['position'],
    		'home_address'=>$profile['home_address'],
    		'phone_number'=>$profile['phone_number'],
    	]);

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

    // public function them(){
    // 	$profile = new profiles();
    // 	$profile->user_id = 35;
    // 	$profile->last_name = 'Admin';
    // 	$profile->first_name = 'Admin';
    // 	$profile->date_of_birth = '1998-02-03';
    // 	$profile->position = 'admin admin';
    // 	$profile->gender = 'male';
    // 	$profile->home_address = 'ha noi';
    // 	$profile->phone_number = '0985007275';
    // 	$profile->save();
    // 	echo "hello";
    // }
}
