<?php

namespace app\Http\Controllers\frontend;

use DB;
use View;
use Input;

use Carbon\Carbon;
use app\Models\Data;
use app\Models\Sensor;
use app\Models\Bulletin;

use app\Http\Requests\DateFilter;

class StationController extends Controller
{
	public function __construct()
	{
		$data = array(
			'page' 		=> 'Stations',
			'latest_eq' => Bulletin::where('bt_id', '=', '1')->where('created_at', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 DAY)'))->orderBy('created_at', 'DESC')->limit('5')->get(),
			'latest_wb' => Bulletin::where('bt_id', '=', '3')->where('created_at', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 DAY)'))->orderBy('created_at', 'DESC')->limit('5')->get(),
			'latest_tc' => Bulletin::where('bt_id', '=', '7')->where('created_at', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 DAY)'))->orderBy('created_at', 'DESC')->limit('5')->get()
		);
		View::share('data', $data);
	}

	public function index()
	{
		$arg 		= Sensor::where('ss_type', '=', '1')->get();
		$aws 		= Sensor::where('ss_type', '=', '2')->get();
		$wlms 		= Sensor::where('ss_type', '=', '3')->get();
		$wlmsr 		= Sensor::where('ss_type', '=', '4')->get();
		return view('frontend.stations.stations', compact('arg', 'aws', 'wlms', 'wlmsr'));
	}

	public function arg($id)
	{
		$date_to 		= Input::get('date_to');
		$date_from 		= Input::get('date_from');

		if(Input::get('date_from') == null && Input::get('date_to') == null) {
			$arg_data 	= Data::select('d_date_time_read', 'd_rain_value')->where('ss_id', '=', $id)->orderBy('d_date_time_read', 'DESC')->Paginate(30);
		}
		else {
			$arg_data 	= Data::select('d_date_time_read', 'd_rain_value')->where('ss_id', '=', $id)->whereBetween('d_date_time_read', [Carbon::parse(Input::get('date_from'))->format('Y-m-d'), Carbon::parse(Input::get('date_to'))->format('Y-m-d')])->orderBy('d_date_time_read', 'DESC')->Paginate(30);
		}

		$arg 			= Sensor::where('ss_id', '=', $id)->first();
		$arg_latest		= Data::select(DB::raw('MAX(d_date_time_read) as date_time, d_rain_value'))->where('ss_id', '=', $id)->first();
		return view('frontend.stations.arg', compact('arg', 'arg_latest', 'arg_data', 'id', 'date_from', 'date_to'));
	}

	public function wlms($id)
	{
		$date_to 		= Input::get('date_to');
		$date_from 		= Input::get('date_from');

		if(Input::get('date_from') == null && Input::get('date_to') == null) {
			$wlms_data 	= Data::select('d_date_time_read', 'd_waterlevel')->where('ss_id', '=', $id)->orderBy('d_date_time_read', 'DESC')->Paginate(30);
		}
		else {
			$wlms_data 	= Data::select('d_date_time_read', 'd_waterlevel')->where('ss_id', '=', $id)->whereBetween('d_date_time_read', [Carbon::parse(Input::get('date_from'))->format('Y-m-d'), Carbon::parse(Input::get('date_to'))->format('Y-m-d')])->orderBy('d_date_time_read', 'DESC')->Paginate(30);
		}

		$wlms 			= Sensor::where('ss_id', '=', $id)->first();
		$wlms_latest 	= Data::select(DB::raw('MAX(d_date_time_read) as date_time, d_waterlevel'))->where('ss_id', '=', $id)->first();
		return view('frontend.stations.wlms', compact('wlms', 'wlms_latest', 'wlms_data', 'id', 'date_from', 'date_to'));
	}

	public function chart_data($id)
	{
		$chart_data = Data::select('d_date_time_read', 'd_rain_value', 'd_waterlevel')->where('ss_id', '=', $id)->orderBy('d_id', 'DESC')->limit('48')->get();
		return json_encode($chart_data);
	}
}