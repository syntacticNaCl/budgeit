<?php

namespace Tests\Browser;

use Budgeit\User;
use Budgeit\BudgetGroup;
use Budgeit\BudgetItem;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BudgetTest extends DuskTestCase
{

    use DatabaseMigrations;

    /** @test */
    public function budget_group_modal_displays()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/budget')
                    ->press('Create Budget Group')
                    ->waitFor('#addBudgetGroupModal')
                    ->assertSee('Add Item');
        });
    }

    /** @test */
    public function user_can_add_budget_group()
    {
        
        $user = factory(User::class)->create();

        $this->browse(function($browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/budget')
                    ->press('Create Budget Group')
                    ->waitFor('#addBudgetGroupModal')
                    ->type('name', 'Test Group')
                    ->select('type', 'income')
                    ->press('Add')
                    ->waitFor('.budget-group')
                    ->assertSee('Test Group');
        });
    }

    /** @test */
    public function user_can_add_budget_item()
    {
        $user = factory(User::class)->create();
        $budget = factory(BudgetGroup::class)->create();

        $this->browse(function($browser) use ($user){
            $browser->loginAs($user)
                    ->visit('/budget')
                    ->press('Create Budget Group')
                    ->waitFor('#addBudgetGroupModal')
                    ->type('name', 'Test Group')
                    ->select('type', 'income')
                    ->press('Add')
                    ->waitFor('.budget-group')
                    ->press('Add Item')
                    ->waitFor('.budget-item')
                    ->assertSee('Label');
        });
    }

}