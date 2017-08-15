<?php

namespace app\Http\Controllers\frontend;

use View;
use app\Models\Bulletin;
use app\Models\BulletinType;

class BulletinController extends Controller
{
	public function __construct()
	{
		$data = array(
			'page' 		=> 'Bulletins',
			'latest_eq' => Bulletin::where('bt_id', '=', '1')->latest('created_at')->limit('5')->get(),
			'latest_wb' => Bulletin::where('bt_id', '=', '3')->latest('created_at')->limit('5')->get(),
			'latest_tc' => Bulletin::where('bt_id', '=', '7')->latest('created_at')->limit('5')->get()
		);
		View::share('data', $data);
	}

	public function index()
	{
		$bt_type 		= BulletinType::with('bulletin_count')->get();
		return view('frontend.bulletins.bulletins', compact('bt_type'));
	}

	public function view($id)
	{
		$bt_type 		= BulletinType::where('bt_id', '=', $id)->first();
		$bulletins 		= Bulletin::where('bt_id', '=', $id)->latest('created_at')->Paginate(15);
		return view('frontend.bulletins.view', compact('bulletins', 'bt_type'));
	}
}