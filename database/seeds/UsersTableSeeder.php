<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Malcolm',
            'last_name' => 'Reynolds',
            'email' => 'mal@serenity.com',
            'currency_symbol' => '$',
            'currency_name' => 'USD',
            'password' => bcrypt('password')
        ]);
    }
}