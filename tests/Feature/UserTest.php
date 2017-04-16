<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Budgeit\User;
use Budgeit\BudgetGroup;

class UserTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->groups = $this->user->groups;


    }

    /** @test */
    public function a_new_user_has_default_budgeit_groups()
    {
        
        $this->assertTrue($this->groups->count() > 0);

        $this->assertTrue($this->groups->count() === 9);

        $groupNames = $this->groups->pluck('name')->toArray();

        $this->assertTrue(in_array('Income', $groupNames));
    }

    /** @test */
    public function a_new_user_has_currency_defaults()
    {

        $this->assertTrue($this->user->currency_name === 'USD');
        $this->assertTrue($this->user->currency_symbol === '$');
    }
    
}
