<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Query\Builder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

       // $this->call(UsersTableSeeder::class);
        $this->call(UsersSeeder::class);

    }
}
