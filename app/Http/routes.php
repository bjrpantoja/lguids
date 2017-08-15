<?php

// Frontend Routes

	// Home Route
	get('/', 'frontend\HomeController@index');

// 

// Backend Routes

Route::group(['middleware' => 'verify.session'], function() {

	// Login Route
	get('backdoor', 'backend\LoginController@index');
	get('login', 'backend\LoginController@login');
	post('login', 'backend\LoginController@login');

});

Route::group(['middleware' => 'auth'], function() {

	// Dashboard Route
	get('backdoor/dashboard', 'backend\DashboardController@index');
	get('backdoor/dashboard/line_chart_data', 'backend\DashboardController@line_chart_data');
	get('backdoor/dashboard/bar_chart_data', 'backend\DashboardController@bar_chart_data');
	get('backdoor/dashboard/pie_chart_data', 'backend\DashboardController@pie_chart_data');

	// Profile Route
	get('backdoor/profile', 'backend\ProfileController@index');
	get('backdoor/profile/save', 'backend\ProfileController@save');
	post('backdoor/profile/save', 'backend\ProfileController@save');
	get('logout', 'backend\LoginController@logout');

	// Groups Route
	get('backdoor/groups', 'backend\GroupController@index');
	get('backdoor/groups/add', 'backend\GroupController@add');
	get('backdoor/groups/search', 'backend\GroupController@search');
	post('backdoor/groups/search', 'backend\GroupController@search');
	get('backdoor/groups/edit/{id}', 'backend\GroupController@edit');
	get('backdoor/groups/view/{id}', 'backend\GroupController@view');
	get('backdoor/groups/save', 'backend\GroupController@save');
	post('backdoor/groups/save', 'backend\GroupController@save');

	// Contacts Route
	get('backdoor/contacts', 'backend\ContactController@index');
	get('backdoor/contacts/add', 'backend\ContactController@add');
	get('backdoor/contacts/search', 'backend\ContactController@search');
	post('backdoor/contacts/search', 'backend\ContactController@search');
	get('backdoor/contacts/edit/{id}', 'backend\ContactController@edit');
	get('backdoor/contacts/view/{id}', 'backend\ContactController@view');
	get('backdoor/contacts/save', 'backend\ContactController@save');
	post('backdoor/contacts/save', 'backend\ContactController@save');

	// Bulletin Type Route
	get('backdoor/bulletins/type', 'backend\BulletinTypeController@index');
	get('backdoor/bulletins/type/add', 'backend\BulletinTypeController@add');
	get('backdoor/bulletins/type/search', 'backend\BulletinTypeController@search');
	post('backdoor/bulletins/type/search', 'backend\BulletinTypeController@search');
	get('backdoor/bulletins/type/edit/{id}', 'backend\BulletinTypeController@edit');
	get('backdoor/bulletins/type/view/{id}', 'backend\BulletinTypeController@view');
	get('backdoor/bulletins/type/save', 'backend\BulletinTypeController@save');
	post('backdoor/bulletins/type/save', 'backend\BulletinTypeController@save');

	// Bulletins Route
	get('backdoor/bulletins', 'backend\BulletinController@index');
	get('backdoor/bulletins/add', 'backend\BulletinController@add');
	get('backdoor/bulletins/search', 'backend\BulletinController@search');
	post('backdoor/bulletins/search', 'backend\BulletinController@search');
	get('backdoor/bulletins/edit/{id}', 'backend\BulletinController@edit');
	get('backdoor/bulletins/view/{id}', 'backend\BulletinController@view');
	get('backdoor/bulletins/save', 'backend\BulletinController@save');
	post('backdoor/bulletins/save', 'backend\BulletinController@save');
	get('backdoor/bulletins/send', 'backend\BulletinController@send');

	// Inbox Route
	get('backdoor/inbox', 'backend\InboxController@index');
	get('backdoor/inbox/get_msg', 'backend\InboxController@get_msg');
	get('backdoor/inbox/delete', 'backend\InboxController@delete');
	get('backdoor/inbox/add', 'backend\InboxController@add');
	get('backdoor/inbox/send', 'backend\InboxController@send');
	post('backdoor/inbox/send', 'backend\InboxController@send');
	post('backdoor/inbox/get_last_msg', 'backend\InboxController@get_last_msg');
	post('backdoor/inbox/send_ajax', 'backend\InboxController@send_ajax');

	Route::group(['middleware' => 'auth.admin'], function() {

		// Users Route
		get('backdoor/users', 'backend\UserController@index');
		get('backdoor/users/add', 'backend\UserController@add');
		get('backdoor/users/search', 'backend\UserController@search');
		post('backdoor/users/search', 'backend\UserController@search');
		get('backdoor/users/edit/{id}', 'backend\UserController@edit');
		get('backdoor/users/save', 'backend\UserController@save');
		post('backdoor/users/save', 'backend\UserController@save');

		// Settings Route
		get('backdoor/settings', 'backend\SettingController@index');
		post('backdoor/settings/save', 'backend\SettingController@save');
		get('backdoor/settings/purge', 'backend\SettingController@purge');
		get('backdoor/settings/logs', 'backend\SettingController@logs');
		get('backdoor/settings/gsm', 'backend\SettingController@gsm');
		get('backdoor/settings/msgs', 'backend\SettingController@msgs');
	});
});


get('test', function() {
		dd("VCS testing");
});