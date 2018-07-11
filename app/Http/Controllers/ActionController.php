<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\UserController;
use Illuminate\Http\Request;
use App\times_log;
use App\users_log;
use App\profiles_log;
class ActionController extends Controller
{
    public function updateTimeLog($timesBefore, $timesAfter, $time_id){
    	$action = new times_log();
    	$action->user_id = Auth::User()->id;
    	$action->time_id = $time_id;
    	$action->action_type = 1;
    	$action->before_action = $timesBefore->start . " -> " . $timesBefore->finish;
    	$action->after_action = $timesAfter->start . " -> " . $timesAfter->finish;
    	$action->save();
    	
    }


    public function deleteTimelog($timesBefore, $time_id){
    	$action = new times_log();
    	$action->user_id = Auth::User()->id;
    	$action->time_id = $time_id;
    	$action->action_type = 0;
    	$action->before_action = $timesBefore->start . " -> " . $timesBefore->finish;
    	$action->after_action = "Times has been deleted";
    	$action->save();
    }

    public function updateUserLog($userBefore, $userAfter, $userUpdate_id){
    	$action = new users_log();
    	$action->user_id = Auth::User()->id;
    	$action->userUpdate_id = $userUpdate_id;
    	$action->action_type = 1;
    	$action->before_action = $userBefore->name . " " .  $userBefore->email . " " . $userBefore->isAdmin;
    	$action->after_action = $userAfter->name . " " .  $userAfter->email . " " . $userAfter->isAdmin;
    	$action->save();
    }

    public function deleteUserLog($userBefore, $userUpdate_id){
    	$action = new users_log();
    	$action->user_id = Auth::User()->id;
    	$action->userUpdate_id = $userUpdate_id;
    	$action->action_type = 0;
    	$action->before_action = $userBefore->name . " " .  $userBefore->email . " " . $userBefore->isAdmin;
    	$action->after_action = "user has been deleted!";
    	$action->save();
    }

    public function updateProfileLog($profileBefore, $profileAfter,$userUpdate_id){

    	$action = new profiles_log();
    	$action->user_id = Auth::User()->id;
    	$action->profileUpdate_id = $userUpdate_id;
    	$action->action_type = 1;
    	$action->before_action = $profileBefore->first_name . " " .  
    							 $profileBefore->last_name . " " . 
    							 $profileBefore->date_of_birth. " " .
    							 $profileBefore->position. " " .
    							 $profileBefore->gender. " " .
    							 $profileBefore->home_address. " " .
    							 $profileBefore->email. " " .
    							 $profileBefore->phone_number;
    	$action->after_action = $profileAfter->first_name . " " .  
    							 $profileAfter->last_name . " " . 
    							 $profileAfter->date_of_birth. " " .
    							 $profileAfter->position. " " .
    							 $profileAfter->gender. " " .
    							 $profileAfter->home_address. " " .
    							 $profileAfter->email. " " .
    							 $profileAfter->phone_number;
    	$action->save();
    }

    public function deleteProfileLog($profileBefore, $profileUpdate_id){
    	$action = new profiles_log();
    	$action->user_id = Auth::User()->id;
    	$action->profileUpdate_id = $profileUpdate_id;
    	$action->action_type = 0;

    	$action->before_action = $profileBefore->first_name . " " .  
    							 $profileBefore->last_name . " " . 
    							 $profileBefore->date_of_birth. " " .
    							 $profileBefore->position. " " .
    							 $profileBefore->gender. " " .
    							 $profileBefore->home_address. " " .
    							 $profileBefore->email. " " .
    							 $profileBefore->phone_number;

    	$action->after_action = "profile has been deleted";
    	$action->save();
    }
}
