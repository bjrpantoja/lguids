<?php

use app\Models\SmsTimestamp;
use Illuminate\Database\Seeder;

class SmsTimestampTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('h_sms_timestamp')->delete();
        SmsTimestamp::create(['last_msg' => strtotime(date('Y-m-d H:i:s'))]);
    }
}
