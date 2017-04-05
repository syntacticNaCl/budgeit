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

        $incomeBudget = factory(Budgeit\BudgetGroup::class)->create([
            'name' => 'Income',
            'type' => 'income',
            'order' => 0,
            'user_id' => 1
        ]);

        $expenseBudget = factory(Budgeit\BudgetGroup::class)->create([
            'name' => 'Expense',
            'type' => 'expense',
            'order' => 1,
            'user_id' => 1
        ]);

        $debtBudget = factory(Budgeit\BudgetGroup::class)->create([
            'name' => 'Debt',
            'type' => 'debt',
            'order' => 2,
            'user_id' => 1
        ]);
        
        /* TODO: these will be added later as a template the user can import into a new budget. */

        // DB::table('budget_groups')->insert([
        //     [
        //         'name' => 'Income',
        //         'user_id' => 1,
        //         'order' => 0,
        //         'type' => 'income'
        //     ],
        //     [
        //         'name' => 'Giving',
        //         'user_id' => 1,
        //         'order' => 1,
        //         'type' => 'expense'
        //     ],
        //     [
        //         'name' => 'Savings',
        //         'user_id' => 1,
        //         'order' => 2,
        //         'type' => 'expense'
        //     ],
        //     [
        //         'name' => 'Transportation',
        //         'user_id' => 1,
        //         'order' => 3,
        //         'type' => 'expense'
        //     ],
        //     [
        //         'name' => 'School',
        //         'user_id' => 1,
        //         'order' => 4,
        //         'type' => 'expense'
        //     ],
        //     [
        //         'name' => 'Food',
        //         'user_id' => 1,
        //         'order' => 5,
        //         'type' => 'expense'
        //     ],
        //     [
        //         'name' => 'Lifestyle',
        //         'user_id' => 1,
        //         'order' => 6,
        //         'type' => 'expense'
        //     ],
        //     [
        //         'name' => 'Insurance & Tax',
        //         'user_id' => 1,
        //         'order' => 7,
        //         'type' => 'expense'

        //     ],
        //     [
        //         'name' => 'Debt',
        //         'user_id' => 1,
        //         'order' => 8,
        //         'type' => 'expense'
        //     ]
        // ]);
    }
}
