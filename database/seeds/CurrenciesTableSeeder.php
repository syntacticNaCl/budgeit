<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert(
            [
                'name' => 'dollar',
                'short_name' => 'usd',
                'country_code' => 'US',
                'country_name' => 'United States',
            ]
        );
    }
}
