<?php

use app\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('h_users')->delete();
        User::create([
                'u_username'    => 'lguids',
                'u_password'    => 'lguids007',
                'u_fname'       => 'DOST',
                'u_mname'       => '..',
                'u_lname'       => 'LGUIDS',
                'u_number'      => '639069741897',
                'is_updated'    => '1',
                'is_admin'      => '1',
                'is_active'     => '1',
            ]);
    }
}