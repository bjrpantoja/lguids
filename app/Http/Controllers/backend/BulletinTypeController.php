<?php

namespace app\Http\Controllers\backend;

use View;
use Input;

use app\Models\BulletinType;
use app\Http\Requests\BulletinTypeValidation;

class BulletinTypeController extends Controller
{
	public function __construct()
	{
		$data = array(
			'page' 		=> 'Bulletin Type',
		);
		View::share('data', $data);
	}

	public function index()
	{
		$search 	= '';
		$option 	= 'View';
		$types 		= BulletinType::latest('bt_id')->Paginate(25);
		return view('backend.types.types', compact('search', 'types', 'option'));
	}

	public function search()
	{
		$search 	= Input::get('search');
		$option 	= 'Search';
		$types 		= BulletinType::where('bt_name', 'like', "%$search%")
							 		->latest('bt_id')->Paginate(25);
		return view('backend.types.types', compact('search', 'types', 'option'));
	}

	public function add()
	{
		$id 		= 0;
		$type 		= '';
		$option 	= 'Add';
		return view('backend.types.form', compact('option', 'id', 'type'));
	}

	public function edit($id)
	{
		$option 	= 'Edit';
		$type 		= BulletinType::find($id);
		return view('backend.types.form', compact('option', 'id', 'type'));
	}

	public function view($id)
	{
		$option 	= 'View';
		$type 		= BulletinType::find($id);
		return view('backend.types.form', compact('option', 'id', 'type'));
	}

	public function save(BulletinTypeValidation $request)
	{
		if($request->get('id') == 0) {
			$type = BulletinType::create($request->all());
			return redirect('backdoor/bulletins/type')->with('success', 'New Bulletin Type successfully added.');
		}
		else {
			$type = BulletinType::find($request->get('id'));
			$type->update($request->all());
			return redirect('backdoor/bulletins/type')->with('update', 'Bulletin Type successfully updated.');
		}
	}
}