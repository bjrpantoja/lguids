<?php

namespace app\Http\Controllers\backend;

use Auth;
use View;

use app\Models\User;
use app\Http\Requests\ProfileValidation;

class ProfileController extends Controller
{
	public function __construct()
	{
		$data = array(
			'page' 		=> 'Profile',
		);
		View::share('data', $data);
	}

	public function index()
	{
		$user 	= User::find(Auth::user()->u_id);
		return view('backend.profile.profile', compact('user'));
	}

	public function save(ProfileValidation $request)
	{
		$user 	= User::find(Auth::user()->u_id);
		$user->update($request->all());
		return redirect('backdoor/profile')->with('update', 'Profile successfully updated.');
	}
}