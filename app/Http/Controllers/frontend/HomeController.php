<?php

namespace app\Http\Controllers\frontend;

use DB;
use View;

use app\Models\Setting;
use app\Models\Bulletin;

class HomeController extends Controller
{
	public function __construct()
	{
		$data = array(
			'page' 		=> 'Home',
			'latest_eq' => Bulletin::where('bt_id', '=', '1')->where('created_at', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 DAY)'))->orderBy('created_at', 'DESC')->limit('5')->get(),
			'latest_wb' => Bulletin::where('bt_id', '=', '3')->where('created_at', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 DAY)'))->orderBy('created_at', 'DESC')->limit('5')->get(),
			'latest_tc' => Bulletin::where('bt_id', '=', '7')->where('created_at', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 DAY)'))->orderBy('created_at', 'DESC')->limit('5')->get()
		);
		View::share('data', $data);
	}

	public function index()
	{
		$ip 			= Setting::pluck('st_address');
		return view('frontend.home.home', compact('ip'));
	}
}