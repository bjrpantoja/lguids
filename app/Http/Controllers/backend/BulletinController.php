<?php

namespace app\Http\Controllers\backend;

use DB;
use View;
use Input;

use app\Models\Group;
use app\Models\Contact;
use app\Models\Setting;
use app\Models\Bulletin;
use app\Models\BulletinType;
use app\Models\ContactGroup;
use app\Helpers\CreateMessage;
use app\Http\Requests\BulletinValidation;

class BulletinController extends Controller
{
	public function __construct()
	{
		$data = array(
			'page' 		=> 'Bulletins',
		);
		View::share('data', $data);
	}

	public function index()
	{
		$search 	= '';
		$option 	= 'View';
		$bulletins 	= Bulletin::where('bl_type', '=', 'Manual')->latest('bl_id')->Paginate(25);
		return view('backend.bulletins.bulletins', compact('search', 'bulletins', 'option'));
	}

	public function search()
	{
		$search 	= Input::get('search');
		$option 	= 'Search';
		$bulletins 	= Bulletin::where('bl_type', '=', 'Manual')
								->whereHas('bulletin_type', function($q) use ($search) {
									$q->where('bt_name', 'like', "%$search%");
								})->latest('bl_id')->Paginate(25);
		return view('backend.bulletins.bulletins', compact('search', 'bulletins', 'option'));
	}

	public function add()
	{
		$id 		= 0;
		$bulletin 	= '';
		$option 	= 'Add';
		$type 		= BulletinType::lists('bt_name', 'bt_id')->toArray();
		$recipients = Contact::select('c_id', DB::raw('concat(c_fname, " ", c_lname) as full_name'))->where('is_active', '=', '1')->lists('full_name', 'c_id')->toArray();
		return view('backend.bulletins.form', compact('option', 'id', 'bulletin', 'recipients', 'type'));
	}

	public function edit($id)
	{
		$option 	= 'Edit';
		$bulletin 	= Bulletin::find($id);
		return view('backend.bulletins.form', compact('option', 'id', 'bulletin'));
	}

	public function view($id)
	{
		$option 	= 'View';
		$bulletin 	= Bulletin::find($id);
		return view('backend.bulletins.view', compact('option', 'id', 'bulletin'));
	}

	public function save(BulletinValidation $request)
	{
		$bulletin 				= new Bulletin;
		$bulletin->bt_id 		= $request->get('bt_id');
		$bulletin->bl_message 	= $request->get('bl_message');
		$bulletin->bl_type 		= 'Manual';
		$bulletin->save();

		$sms_message 		= "[".BulletinType::select('bt_name')->where('bt_id', '=', $request->get('bt_id'))->pluck('bt_name')."]\r\n\r\n";
		$sms_message 		.= $request->get('bl_message')."\r\n\r\n";
		$sms_message 		.= Setting::pluck('st_footer');

		if($request->get('send_mode') == 0) { /*Individual*/
			$sms_numbers 	= Contact::select('c_number', 'c_id')->whereIn('c_id', $request->get('recipients'))->get();
			foreach($sms_numbers as $number) {
				$msg 	= new CreateMessage;
				$msg->send_message($number->c_number, $sms_message, $bulletin->bl_type, $bulletin->bl_id, $number->c_id);
			}
			return redirect('backdoor/bulletins')->with('success', 'Message is now sending to '.count($sms_numbers).' recipient(s).');
		}
		elseif($request->get('send_mode') == 1) { /*Group*/
			$contact_groups = ContactGroup::whereIn('g_id', $request->get('recipients'))->get();
			foreach($contact_groups as $cg) {
				foreach($cg->contacts as $contact) {
					$msg 	= new CreateMessage;
					$msg->send_message($contact->c_number, $sms_message, $bulletin->bl_type, $bulletin->bl_id, $contact->c_id);
				}
			}
			return redirect('backdoor/bulletins')->with('success', 'Message is now sending to '.count($contact_groups).' recipient(s).');
		}
		elseif($request->get('send_mode') == 2) {
			$sms_numbers 	= Contact::select('c_number', 'c_id')->where('is_active', '=', '1')->whereHas('groups', function($q) { $q->where('is_active', '=', '1'); })->get();
			foreach($sms_numbers as $number) {
				$msg 	= new CreateMessage;
				$msg->send_message($number->c_number, $sms_message, $bulletin->bl_type, $bulletin->bl_id, $number->c_id);
			}
			return redirect('backdoor/bulletins')->with('success', 'Message is now sending to all recipients.');
		}
	}

	public function send()
	{
		$data = array(
				'send_mode' 	=> Input::get('send_mode'),
				'individual' 	=> Contact::select('c_id', DB::raw('concat(c_fname, " ", c_lname) as full_name'))->where('is_active', '=', '1')->lists('full_name', 'c_id')->toArray(),
				'group' 		=> Group::where('is_active', '=', '1')->lists('g_name', 'g_id')->toArray(),
			);
		return json_encode($data);
	}
}