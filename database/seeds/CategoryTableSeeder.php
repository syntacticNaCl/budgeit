<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                'name' => 'Auto & Transport',
                'user_id' => 1
            ]);

        DB::table('categories')->insert(
            [
                'name' => 'Rent',
                'user_id' => 1
            ]);

        DB::table('categories')->insert(
            [
                'name' => 'Bills & Utilities',
                'user_id' => 1
            ]);
    }
}
