<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailable;
use Illuminate\Http\Request;
use App\Http\UserController;
use App\Profiles;
use App\timeLog;
use App\users_log;
use App\profilesLog;
use App\profilesPositions;

class ActionController extends Controller
{
    public function updateTimeLog($timesBefore, $timesAfter, $time_id)
    {
        $action = new timeLog();
        $action->user_id = Auth::User()->user_id;
        $action->time_id = $time_id;
        $action->action_type = 1;
        $action->before_action = $timesBefore->start . " -> " . $timesBefore->finish;
        $action->after_action = $timesAfter->start . " -> " . $timesAfter->finish;
        $action->save();
    }


    public function deleteTimelog($timesBefore, $time_id)
    {
        $action = new timeLog();
        $action->user_id = Auth::User()->user_id;
        $action->time_id = $time_id;
        $action->action_type = 0;
        $action->before_action = $timesBefore->start . " -> " . $timesBefore->finish;
        $action->after_action = "Times has been deleted";
        $action->save();
    }

    public function insertTimeLog($timesAfter, $time_id)
    {
        $action = new timeLog();
        $action->user_id = Auth::User()->user_id;
        $action->time_id = $time_id;
        $action->action_type = 2;
        $action->before_action = "not inserted";
        $action->after_action = $timesAfter->start . " -> " . $timesAfter->finish . "  " . $timesAfter->date;
        $action->save();
    }

    public function updateUserLog($userBefore, $userAfter, $user_update_id)
    {
        $action = new users_log();
        $action->user_id = Auth::User()->user_id;
        $action->user_update_id = $user_update_id;
        $action->action_type = 1;
        $action->before_action = $userBefore->name . " " . $userBefore->email . " " . $userBefore->isAdmin;
        $action->after_action = $userAfter->name . " " . $userAfter->email . " " . $userAfter->isAdmin;
        $action->save();
    }

    public function deleteUserLog($userBefore, $user_update_id)
    {
        $action = new users_log();
        $action->user_id = Auth::User()->user_id;
        $action->user_update_id = $user_update_id;
        $action->action_type = 0;
        $action->before_action = $userBefore->name . " " . $userBefore->email . " " . $userBefore->isAdmin;
        $action->after_action = "user has been deleted!";
        $action->save();
    }

    public function restoreUserLog($userAfter, $user_update_id)
    {
        $action = new users_log();
        $action->user_id = Auth::User()->user_id;
        $action->user_update_id = $user_update_id;
        $action->action_type = 2;
        $action->before_action = "user has been deleted!";
        $action->after_action = $userAfter->name . " " . $userAfter->email . " " . $userAfter->isAdmin;
        $action->save();
    }

    public function updateProfileLog($profileBefore, $profileAfter, $user_update_id)
    {
        $action = new profilesLog();
        $action->user_id = Auth::User()->user_id;
        $action->user_update_id = $user_update_id;
        $action->action_type = 1;
        $action->before_action = $profileBefore->first_name . " " .
            $profileBefore->last_name . " " .
            $profileBefore->date_of_birth . " " .
            $profileBefore->position . " " .
            $profileBefore->gender . " " .
            $profileBefore->home_address . " " .
            $profileBefore->email . " " .
            $profileBefore->phone_number;
        $action->after_action = $profileAfter->first_name . " " .
            $profileAfter->last_name . " " .
            $profileAfter->date_of_birth . " " .
            $profileAfter->position . " " .
            $profileAfter->gender . " " .
            $profileAfter->home_address . " " .
            $profileAfter->email . " " .
            $profileAfter->phone_number;
        $action->save();
    }

    public function deleteProfileLog($profileBefore, $user_update_id)
    {
        $action = new profilesLog();
        $action->user_id = Auth::User()->user_id;
        $action->user_update_id = $user_update_id;
        $action->action_type = 0;

        $action->before_action = $profileBefore->first_name . " " .
            $profileBefore->last_name . " " .
            $profileBefore->date_of_birth . " " .
            $profileBefore->position . " " .
            $profileBefore->gender . " " .
            $profileBefore->home_address . " " .
            $profileBefore->email . " " .
            $profileBefore->phone_number;

        $action->after_action = "profile has been deleted";
        $action->save();
    }

    public function restoreProfileLog($profileAfter, $user_update_id)
    {
        $action = new profilesLog();
        $action->user_id = Auth::User()->user_id;
        $action->user_update_id = $user_update_id;
        $action->action_type = 2;
        $action->before_action = "profile has been deleted";

        $action->after_action = $profileAfter->first_name . " " .
            $profileAfter->last_name . " " .
            $profileAfter->date_of_birth . " " .
            $profileAfter->position . " " .
            $profileAfter->gender . " " .
            $profileAfter->home_address . " " .
            $profileAfter->email . " " .
            $profileAfter->phone_number;

        $action->save();
    }

    public function actionUser()
    {

        $users_log = \DB::table('users_log')
            ->select(
                'users.name',
                'users1.name as name_update',
                'users_log.action_type',
                'users_log.before_action',
                'users_log.after_action',
                'users_log.created_at'
            )
            ->join('users', 'users_log.user_id', '=', 'users.user_id')
            ->join('users as users1', 'users_log.user_update_id', '=', 'users1.user_id')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('action.userLog', compact('users_log'));
    }

    public function actionTime()
    {
        $times_log = \DB::table('timeLog')
            ->select(
                'users.name',
                'users1.name as name_update',
                'timeLog.action_type',
                'timeLog.before_action',
                'timeLog.after_action',
                'timeLog.created_at'
            )
            ->join('users', 'users.user_id', '=', 'timeLog.user_id')
            ->join('times', 'times.time_id', '=', 'timeLog.time_id')
            ->join('users as users1', 'times.user_id', '=', 'users1.user_id')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('action.timeLog', compact('times_log'));
    }

    public function actionProfile()
    {
        $profiles_log = \DB::table('profilesLog')
            ->select(
                "users.name",
                "users1.name as name_update",
                "profilesLog.action_type",
                "profilesLog.before_action",
                "profilesLog.after_action",
                "profilesLog.created_at"
            )
            ->join('users as users', 'profilesLog.user_id', '=', 'users.user_id')
            ->join('users as users1', 'profilesLog.user_update_id', '=', 'users1.user_id')
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        return view('action.profileLog', compact('profiles_log'));
    }

    public function templates()
    {
        return view('layouts.templates');
    }
}
