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
        dd(compact('user', 'id'));
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
    	return view('user.finish');
    }
}
