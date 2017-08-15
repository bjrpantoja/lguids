<?php

namespace app\Http\Controllers\backend;

use View;
use Input;

use app\Models\Group;
use app\Http\Requests\GroupValidation;

class GroupController extends Controller
{
	public function __construct()
	{
		$data = array(
			'page' 		=> 'Groups',
		);
		View::share('data', $data);
	}

	public function index()
	{
		$search 	= '';
		$option 	= 'View';
		$groups 	= Group::with('contact_groups')->latest('g_id')->Paginate(25);
		return view('backend.groups.groups', compact('search', 'groups', 'option'));
	}

	public function search()
	{
		$search 	= Input::get('search');
		$option 	= 'Search';
		$groups 	= Group::where('g_name', 'like', "%$search%")
							 ->latest('g_id')->Paginate(25);
		return view('backend.groups.groups', compact('search', 'groups', 'option'));
	}

	public function add()
	{
		$id 		= 0;
		$group 		= '';
		$option 	= 'Add';
		return view('backend.groups.form', compact('option', 'id', 'group'));
	}

	public function edit($id)
	{
		$option 	= 'Edit';
		$group 		= Group::find($id);
		return view('backend.groups.form', compact('option', 'id', 'group'));
	}

	public function view($id)
	{
		$option 	= 'View';
		$group 		= Group::find($id);
		return view('backend.groups.form', compact('option', 'id', 'group'));
	}

	public function save(GroupValidation $request)
	{
		if($request->get('id') == 0) {
			$group = Group::create($request->all());
			return redirect('backdoor/groups')->with('success', 'New group successfully added.');
		}
		else {
			$group = Group::find($request->get('id'));
			$group->update($request->all());
			return redirect('backdoor/groups')->with('update', 'Group successfully updated.');
		}
	}
}