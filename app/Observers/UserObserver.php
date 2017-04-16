<?php

namespace Budgeit\Observers;

use Budgeit\User;
use Budgeit\BudgetGroup;


class UserObserver {

    public function created(User $user)
    {
        $user->currency_name = 'USD';
        $user->currency_symbol = '$';
        $user->save();

        // create default budget groups

        $defaultGroups = [
            'Income' => 'income',
            'Giving' => 'expense',
            'Savings' => 'expense',
            'Transportation' => 'expense',
            'School' => 'expense',
            'Food' => 'expense',
            'Lifestyle' => 'expense',
            'Insurance & Tax' => 'expense',
            'Debt' => 'debt',
        ];

        $orderCount = 0;

        foreach ($defaultGroups as $name => $type) {
            $budgetGroup = new BudgetGroup();
            $budgetGroup->name = $name;
            $budgetGroup->order = $orderCount;
            $budgetGroup->type = $type;
            $budgetGroup->user()->associate($user);
            $budgetGroup->save();

            $orderCount++;
            
        }



    }
    
}