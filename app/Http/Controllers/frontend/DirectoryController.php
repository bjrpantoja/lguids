<?php

namespace app\Http\Controllers\frontend;

use View;
use app\Models\User;
use app\Models\Bulletin;

class DirectoryController extends Controller
{
	public function __construct()
	{
		$data = array(
			'page' 		=> 'Contact Us',
			'latest_eq' => Bulletin::where('bt_id', '=', '1')->latest('created_at')->limit('5')->get(),
			'latest_wb' => Bulletin::where('bt_id', '=', '3')->latest('created_at')->limit('5')->get(),
			'latest_tc' => Bulletin::where('bt_id', '=', '7')->latest('created_at')->limit('5')->get()
		);
		View::share('data', $data);
	}

	public function index()
	{
		$users 		= User::get();
		return view('frontend.directory.directory', compact('users'));
	}
}