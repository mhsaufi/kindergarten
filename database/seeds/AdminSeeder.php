<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@mailsac.com',
            'fullname' => 'Administrator',
            'password' => Hash::make('12345678'),
        ]);
    }
}
