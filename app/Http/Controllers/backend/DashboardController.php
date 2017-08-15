<?php

namespace app\Http\Controllers\backend;

use View;
use Input;
use app\Models\User;
use app\Models\SmsLog;
use app\Models\Contact;
use app\Models\Bulletin;
use app\Models\BulletinType;
use app\Models\BulletinRecipient;

class DashboardController extends Controller
{
	public function __construct()
	{
		$data = array(
			'page' 		=> 'Dashboard',
		);
		View::share('data', $data);
	}

	public function index()
	{
		$date 				= Input::get('date');
		$years 				= array_combine(range(date("Y"), 2012), range(date("Y"), 2012));
		$bulletins_sent 	= BulletinRecipient::where('blr_status', '=', 'SENT')->count();
		$contacts 			= Contact::where('is_active', '=', '1')->count();
		$admins 			= User::where('is_active', '=', '1')->where('is_admin', '=', '1')->count();
		$bt_type 			= BulletinType::lists('bt_name')->toArray();
		$bt_type 			= json_encode($bt_type);
		$bulletin_stats 	= Bulletin::select(\DB::raw('*, COUNT(*) as bl_stats'))->where('bl_type', '=', 'Manual')->whereYear('created_at', '=', $date == null ? date('Y') : $date)->groupBy('bt_id')->get();
		return view('backend.dashboard.dashboard', compact('bulletins_sent', 'contacts', 'admins', 'years', 'bt_type', 'bulletin_stats', 'date'));
	}

	public function line_chart_data()
	{
		for ($i=1; $i<13; $i++) {
			$chart_data[] = array(
					'Year' 		=> date('F', mktime(0, 0, 0, $i, 10)),
					'Sent' 		=> BulletinRecipient::where('blr_status', '=', 'SENT')->whereYear('created_at', '=', Input::get('year'))->whereMonth('created_at', '=', $i)->count(),
					'Failed'  	=> BulletinRecipient::where('blr_status', '=', 'FAILED')->whereYear('created_at', '=', Input::get('year'))->whereMonth('created_at', '=', $i)->count(),
					'Received' 	=> SmsLog::where('sl_status', '=', 'RECEIVED')->whereYear('created_at', '=', Input::get('year'))->whereMonth('created_at', '=', $i)->count()
				);
		}
		return json_encode($chart_data);
	}

	public function bar_chart_data()
	{
		$bt_type 	= BulletinType::where('is_active', '=', '1')->get();
		for ($i=1; $i<13; $i++) {
			$chart_data[] = array(
				'Year' 			=> date('F', mktime(0, 0, 0, $i, 10)),
			);
		}
		for ($i=0; $i<12; $i++) {
			foreach($bt_type as $bt) {
				$chart_data[$i][$bt->bt_name] = Bulletin::where('bt_id', '=', $bt->bt_id)->where('bl_type', '=', 'Auto')->whereYear('created_at', '=', Input::get('year'))->whereMonth('created_at', '=', $i)->count();
			}
		}
		return json_encode($chart_data);
	}

	public function pie_chart_data()
	{
		$bl_stats 	= Bulletin::select(\DB::raw('*, COUNT(*) as bl_stats'))->where('bl_type', '=', 'Manual')->whereYear('created_at', '=', Input::get('year'))->groupBy('bt_id')->get();
		foreach($bl_stats as $stat) {
			$pie_data[] = array(
				'label' => $stat->bulletin_type->bt_name,
				'value' => $stat->bl_stats
			);
		}
		return json_encode($pie_data);
	}
}