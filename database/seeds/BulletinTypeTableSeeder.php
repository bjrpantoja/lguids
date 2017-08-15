<?php

use app\Models\BulletinType;
use Illuminate\Database\Seeder;

class BulletinTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('h_bulletin_types')->delete();

        BulletinType::create([
        		'bt_name' 	=> 'Earthquake Information'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'Volcano Update'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'Weather Bulletin'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'Severe Weather Bulletin'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'Tropical Cyclone Update'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'Rainfall Warning'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'Weather Advisory'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'Thunderstorm Advisory'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'General Flood Advisory'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'Flood Advisory'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'Tsunami'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'System Announcement'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'Twitter Feed'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'System Test'
        	]);
        BulletinType::create([
        		'bt_name' 	=> '24-Hour Weather Forecast'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'Regional Weather Forecast for NCR-PRSD'
        	]);
        BulletinType::create([
        		'bt_name' 	=> 'From NCR-PRSD'
        	]);
        BulletinType::create([
                'bt_name'   => 'Starbooks Advisory'
            ]);
    }
}
