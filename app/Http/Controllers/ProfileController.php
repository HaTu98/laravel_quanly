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

class ProfileController extends Controller
{
    public function profile(){

    	$profile = Profiles::join('users','users.id','=','profiles.user_id')
    	->where('profiles.user_id', Auth::User()->id)->first();
    	if($profile == null){
    		$newProfile = new Profiles();
    		$newProfile->user_id = Auth::User()->id;
    		$newProfile->first_name = " ";
    		$newProfile->last_name = " ";
    		$newProfile->date_of_birth = null;
    		$newProfile->gender = " ";
    		$newProfile->position = " ";
    		$newProfile->home_address = " ";
    		$newProfile->phone_number = " ";
    		$newProfile->save();
    		return view('profile.profile',compact('newProfile'));
    	}
    	return view('profile.profile',compact('profile'));
    }

    public function editProfile(){
    	$profile = Profiles::join('users','users.id','=','profiles.user_id')
    	->where('profiles.user_id', Auth::User()->id)->first();
    	
    	
    	return view('profile.editProfile',compact('profile'));
    }

    public function updateProfile(Request $request){

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

    	profiles::where('user_id',Auth::User()->id)->update([
    		'first_name'=>$profile['first_name'],
    		'last_name'=>$profile['last_name'],
    		'date_of_birth'=>$profile['date_of_birth'],
    		'gender'=>$profile['gender'],
    		'position'=>$profile['position'],
    		'home_address'=>$profile['home_address'],
    		'phone_number'=>$profile['phone_number'],
    	]);

    	User::where('id',Auth::User()->id)->update([
    		'email'=>$user['email'],
    	]);

    	return redirect('/profile');
    }
    public  function upimg(Request $request){

    	if($request->hasFile('img')){
 
    		$request->file('img')->move('img','10.jpg');
    	
    		
    	} 
    	else{
    		echo "ko";
    		dd("ko");
    	}
    	return redirect('/profile');
    }

    public function them(){
    	$profile = new profiles();
    	$profile->user_id = 35;
    	$profile->last_name = 'Admin';
    	$profile->first_name = 'Admin';
    	$profile->date_of_birth = '1998-02-03';
    	$profile->position = 'admin admin';
    	$profile->gender = 'male';
    	$profile->home_address = 'ha noi';
    	$profile->phone_number = '0985007275';
    	$profile->save();
    	echo "hello";
    }
}
