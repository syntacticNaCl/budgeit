<?php

use Illuminate\Database\Seeder;

class BudgetGroupsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('budget_groups')->insert([
            [
                'name' => 'Income',
                'user_id' => 1,
                'order' => 0
            ],
            [
                'name' => 'Giving',
                'user_id' => 1,
                'order' => 1
            ],
            [
                'name' => 'Savings',
                'user_id' => 1,
                'order' => 2
            ],
            [
                'name' => 'Transportation',
                'user_id' => 1,
                'order' => 3
            ],
            [
                'name' => 'School',
                'user_id' => 1,
                'order' => 4
            ],
            [
                'name' => 'Food',
                'user_id' => 1,
                'order' => 5
            ],
            [
                'name' => 'Lifestyle',
                'user_id' => 1,
                'order' => 6
            ],
            [
                'name' => 'Insurance & Tax',
                'user_id' => 1,
                'order' => 7
            ],
            [
                'name' => 'Debt',
                'user_id' => 1,
                'order' => 8
            ]
        ]);
    }
}
