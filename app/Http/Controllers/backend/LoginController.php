<?php

namespace app\Http\Controllers\backend;

use Auth;
use Session;

use app\Models\User;
use app\Models\UserLog;

use app\Http\Requests\UserLogin;

class LoginController extends Controller
{
	public function index()
	{
		$error_message = '';
		if(Session::has('error_message')) {
			$error_message = Session::get('error_message');
			Session::put('error_message', '');
		}
		return view('backend.login.login', compact('error_message'));
	}

	public function login(UserLogin $request)
	{
		$userdata = array(
				'u_username' 	=> $request->get('username'),
				'password' 		=> $request->get('password'),
				'is_active' 	=> 1
			);

		if(Auth::attempt($userdata, true)) {
			$user 					= new UserLog;
			$user->u_id 			= Auth::id();
			$user->ul_logs 			= $request->getClientIp();
			$user->ul_login_time 	= date('Y-m-d H:i:s');
			$user->save();
			return redirect('backdoor/profile');
		}
		return redirect('backdoor')->with('error_message', 'Invalid username or password.');
	}

	public function logout()
	{
		Session::flush();
		Auth::logout();
		return redirect('backdoor');
	}
}