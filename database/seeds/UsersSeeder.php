<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'veysel',
            'email' =>'veyselakpinar13@gmail.com',
            'password' => bcrypt(123456),
            'yetki'=>1,
            'onay'=>1
        ]);
    }
}
