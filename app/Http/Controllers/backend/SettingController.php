<?php

namespace app\Http\Controllers\backend;

use View;
use Input;

use app\Models\Setting;

class SettingController extends Controller
{
	public function __construct()
	{
		$data = array(
			'page' 		=> 'Settings',
		);
		View::share('data', $data);
	}

	public function index()
	{
		$search 	= '';
		$option 	= 'View';
		$settings 	= Setting::find(1);
		return view('backend.settings.settings', compact('search', 'settings', 'option'));
	}

	public function save()
	{
		$settings 	= Setting::find(1);
		$settings->update(Input::all());
		return redirect('backdoor/settings')->with('update', 'Handa Settings successfully updated.');
	}

	public function purge()
	{
		$data 		= Input::get('data');
		$data_count = count(glob('/var/spool/sms/'.$data.'/*'));
		echo shell_exec('rm /var/spool/sms/'.$data.'/*');
		echo "Successfully deleted ".$data_count." message(s) in ".$data." folder";
	}

	public function logs()
	{
		$status 	= file_get_contents('/var/spool/sms/stats/status');
		echo "<pre class='no-border'>";
		echo $status;
		echo "</pre>";
	}

	public function gsm()
	{
		$command 	= "sudo /etc/init.d/sms3 restart";
		exec($command, $output, $return);
		if($return != 0) {
			return "Fail";
		}
		else {
			return "Success";
		}
	}

	public function msgs()
	{
		$data 					= array();
		$data_count 			= count(glob('/var/spool/sms/'.Input::get('data').'/*'));
		$data['id'] 			= Input::get('data');
		$data['data_count'] 	= $data_count;		
		return json_encode($data);
	}
}