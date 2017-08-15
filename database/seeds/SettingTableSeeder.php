<?php

use Illuminate\Database\Seeder;

use app\Models\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('h_settings')->delete();

        Setting::create([
        		'st_name' 		=> 'Local Government Unit Information Dissemination System (LGUIDS)',
        		'st_alias' 		=> 'LGUIDS',
        		'st_footer' 	=> '-SENT via LGUIDS',
        		'st_about' 		=> '',
        		'st_globe' 		=> '',
        		'st_smart' 		=> '',
        		'st_facebook' 	=> '',
        		'st_twitter' 	=> '',
        		'st_google' 	=> '',
        		'st_address' 	=> 'http://handa.region4a.dost.gov.ph/',
        	]);
    }
}