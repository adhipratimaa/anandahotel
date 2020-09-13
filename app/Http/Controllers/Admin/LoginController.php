<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class LoginController extends Controller
{
    public function login(){
    	return view('admin.login');
    }
    public function postLogin(Request $request){
    	$this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);
    	if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
	        return redirect()->route('dashboard.index');
	    } else {
	        return back()->withInput()->withErrors(['email'=>'something is wrong!']);
	    }
    }
    public function Logout(){
    	Auth::logout();
    	Session::flush();
    	return redirect()->route('login');
    }
}
