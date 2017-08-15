<?php

namespace app\Http\Controllers\backend;

use View;
use Input;

use app\Models\Group;
use app\Models\Contact;
use app\Models\ContactGroup;
use app\Http\Requests\ContactValidation;

class ContactController extends Controller
{
	public function __construct()
	{
		$data = array(
			'page' 		=> 'Contacts',
		);
		View::share('data', $data);
	}

	public function index()
	{
		$search 	= '';
		$option 	= 'View';
		$contacts 	= Contact::latest('c_id')->Paginate(25);
		return view('backend.contacts.contacts', compact('search', 'contacts', 'option'));
	}

	public function search()
	{
		$search 	= Input::get('search');
		$option 	= 'Search';
		$contacts 	= Contact::where('c_fname', 'like', "%$search%")
							 ->orWhere('c_mname', 'like', "%$search%")
							 ->orWhere('c_lname', 'like', "%$search%")
							 ->orWhere('c_number', 'like', "%$search%")
							 ->latest('c_id')->Paginate(25);
		return view('backend.contacts.contacts', compact('search', 'contacts', 'option'));
	}

	public function add()
	{
		$id 		= 0;
		$contact 	= '';
		$option 	= 'Add';
		$groups 	= Group::where('is_active', '=', '1')->lists('g_name', 'g_id');
		return view('backend.contacts.form', compact('option', 'id', 'contact', 'groups'));
	}

	public function edit($id)
	{
		$option 	= 'Edit';
		$contact 	= Contact::find($id);
		$cg 		= ContactGroup::where('c_id', '=', $id)->lists('g_id')->toArray();
		$groups 	= Group::where('is_active', '=', '1')->lists('g_name', 'g_id');
		return view('backend.contacts.form', compact('option', 'id', 'contact', 'groups', 'cg'));
	}

	public function view($id)
	{
		$option 	= 'View';
		$contact 	= Contact::find($id);
		$cg 		= ContactGroup::where('c_id', '=', $id)->lists('g_id')->toArray();
		$groups 	= Group::where('is_active', '=', '1')->lists('g_name', 'g_id');
		return view('backend.contacts.form', compact('option', 'id', 'contact', 'groups', 'cg'));
	}

	public function save(ContactValidation $request)
	{
		if($request->get('id') == 0) {
			$contact = Contact::create($request->all());
			$request->except('groups');
			$contact->groups()->attach($request->get('groups'));
			return redirect('backdoor/contacts')->with('success', 'New contact successfully added.');
		}
		else {
			$contact = Contact::find($request->get('id'));
			$request->except('groups');
			$contact->groups()->sync($request->get('groups'), true);
			$contact->touch();
			$contact->update($request->all());
			return redirect('backdoor/contacts')->with('update', 'Contact successfully updated.');
		}
	}
}