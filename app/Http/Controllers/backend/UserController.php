<?php

namespace app\Http\Controllers\backend;

use View;
use Input;

use app\Models\User;
use app\Http\Requests\UserValidation;

class UserController extends Controller
{
	public function __construct()
	{
		$data = array(
			'page' 		=> 'Users',
		);
		View::share('data', $data);
	}

	public function index()
	{
		$search = '';
		$option = 'View';
		$users 	= User::where('is_admin', '=', '0')->orderBy('u_lname', 'ASC')->Paginate(15);
		return view('backend.users.users', compact('search', 'users', 'option'));
	}

	public function search()
	{
		$search = Input::get('search');
		$option = 'Search';
		$users 	= User::where('is_admin', '=', '0')
					->where(function($query) use($search) {
						$query->where('u_fname', 'like', "%$search%")
							  ->orWhere('u_mname', 'like', "%$search%")
							  ->orWhere('u_lname', 'like', "%$search%");
					})->orderBy('u_lname', 'ASC')->Paginate(2);
		return view('backend.users.users', compact('search', 'users', 'option'));
	}

	public function add()
	{
		$id 	= 0;
		$user 	= '';
		$option = 'Add';
		return view('backend.users.form', compact('option', 'id', 'user'));
	}

	public function edit($id)
	{
		$option = 'Edit';
		$user 	= User::find($id);
		return view('backend.users.form', compact('option', 'id', 'user'));
	}

	public function save(UserValidation $request)
	{
		if($request->get('id') == 0) {
			$user 	= User::create($request->all());
			return redirect('backdoor/users')->with('success', 'New user successfully added.');
		}
		else {
			$user 	= User::find($request->get('id'));
			$user->update($request->all());
			return redirect('backdoor/users')->with('update', 'User successfully updated.');
		}
	}
}