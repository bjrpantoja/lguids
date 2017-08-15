<?php

namespace app\Http\Controllers\backend;

use View;
use Input;
use app\Models\SmsLog;
use app\Models\SmsTimestamp;
use app\Helpers\CreateMessage;
use app\Http\Requests\MessageValidation;

class InboxController extends Controller
{
	public function __construct()
	{
		$data = array(
			'page' 		=> 'Inbox',
		);
		View::share('data', $data);
	}

	public function index()
	{
		$option 	= 'View';
		$sms_inbox 	= SmsLog::selectRaw('*, COUNT(if(is_read = "0" AND sl_status = "RECEIVED", is_read, NULL)) as notif, MAX(sl_timestamp) as currentTS')->groupBy('sl_number')->orderBy('currentTS', 'DESC')->get();
		return view('backend.inbox.inbox', compact('option', 'sms_inbox'));
	}

	public function get_msg()
	{
		$sms_number 	= Input::get('sms_number');
		$sms_message 	= SmsLog::selectRaw('*, DATE_FORMAT(created_at, "%M %e, %Y %I:%i %p") as date_formatted')->where('sl_number', '=', $sms_number)->orderBy('created_at', 'asc')->get();
		SmsLog::where('sl_number', '=', $sms_number)->update(['is_read' => 1]);
		return json_encode($sms_message);
	}

	public function get_last_msg()
	{
		$sms_timestamp 	= SmsTimestamp::first();
		$latest_sms 	= SmsLog::latest('sl_id')->first();

		if($sms_timestamp->last_msg == $latest_sms->sl_timestamp) {
			return 'true';
		}
		else {
			SmsTimestamp::where('id', '=', '1')->update(['last_msg' => $latest_sms->sl_timestamp]);
			return 'false';
		}
	}

	public function delete()
	{
		$delete 		= SmsLog::whereIn('sl_number', Input::get('sms_numbers'))->delete();
		if($delete) {
			return 'true';
		}
		else {
			return 'false';
		}
	}

	public function add()
	{
		return view('backend.inbox.form');
	}

	public function send(MessageValidation $request)
	{
		$timestamp 				= SmsTimestamp::first();
		$new_msg 				= new SmsLog;
		$new_msg->sl_number 	= $request->get('sms_number');
		$new_msg->sl_message 	= $request->get('sms_message');
		$new_msg->sl_status 	= 'QUEUED';
		$new_msg->is_read 		= 0;
		$new_msg->sl_timestamp 	= $timestamp->last_msg;
		$new_msg->save();
		$sms 					= new CreateMessage;
		$sms->send_message($request->get('sms_number'), $request->get('sms_message'), 'Inbox', $new_msg->sl_id);
		return redirect('backdoor/inbox');
	}

	public function send_ajax()
	{
		$timestamp 				= SmsTimestamp::first();
		$new_msg 				= new SmsLog;
		$new_msg->sl_number 	= Input::get('sms_number');
		$new_msg->sl_message 	= Input::get('sms_message');
		$new_msg->sl_status 	= 'QUEUED';
		$new_msg->is_read 		= 0;
		$new_msg->sl_timestamp 	= $timestamp->last_msg;
		$new_msg->save();
		$sms 					= new CreateMessage;
		$sms->send_message(Input::get('sms_number'), Input::get('sms_message'), 'Inbox', $new_msg->sl_id);

		$data 	= array('date_formatted' => date('F d, Y H:i:A'), 'sms_message' => Input::get('sms_message'), 'sl_status' => $new_msg->sl_status);
		return json_encode($data);
	}
}