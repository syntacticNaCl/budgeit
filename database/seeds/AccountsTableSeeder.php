<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert(
            [
                'name' => 'Asset',
                'slug' => 'asset',
                'credit' => 'decrease',
                'debit' => 'increase'
            ]
        );

        DB::table('accounts')->insert(
            [
                'name' => 'Liability',
                'slug' => 'liability',
                'credit' => 'increase',
                'debit' => 'decrease'
            ]
        );

        DB::table('accounts')->insert(
            [
                'name' => 'Income',
                'slug' => 'income',
                'credit' => 'increase',
                'debit' => 'decrease'
            ]
        );

        DB::table('accounts')->insert(
            [
                'name' => 'Expense',
                'slug' => 'expense',
                'credit' => 'decrease',
                'debit' => 'increase'
            ]
        );

        DB::table('accounts')->insert(
            [
                'name' => 'Equity/Capital',
                'slug' => 'equity_capital',
                'credit' => 'increase',
                'debit' => 'decrease'
            ]
        );

    }
}
