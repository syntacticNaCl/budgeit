<?php

namespace Tests\Browser;

use Budgeit\User;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BudgetTest extends DuskTestCase
{

    /**
     * Time to pause to wait for VueJS components to render.
     *
     * @var int
     */
    protected $pauseTime = 3000;

    /** @test */
    public function budget_group_modal_displays()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/budget')
                    ->press('Create Budget Group')
                    ->pause($this->pauseTime)
                    ->assertSee('Add Item');
        });
    }

    /** @test */
    public function user_can_add_budget_group()
    {
        $this->browse(function($browser){
            $browser->loginAs(User::find(1))
                    ->visit('/budget')
                    ->press('Create Budget Group')
                    ->pause($this->pauseTime)
                    ->type('name', 'Test Group')
                    ->select('type', 'Income')
                    ->press('Add')
                    ->pause($this->pauseTime)
                    ->assertSee('Test Group');
        });
    }

    /** @test */
    public function user_can_add_budget_item()
    {
        $this->browse(function($browser){
            $browser->loginAs(User::find(1))
                    ->visit('/budget')
                    ->pause(5000) // wait for vuejs component to load
                    ->press('Add Item')
                    ->pause($this->pauseTime)
                    ->assertSee('Label');
        });
    }

}