<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Budgeit\User;
use Budgeit\BudgetGroup;
use Budgeit\BudgetItem;

class BudgetTest extends TestCase
{

    use DatabaseMigrations;

    protected $user;

    protected $group;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->group = factory(BudgetGroup::class)->create([
            'name' => 'Test Group',
            'order' => 9, // this should be in the 9th position after the 8 defaults are created
            'user_id' => $this->user->id
        ]);

    }

    /** @test */
    public function can_create_budget_group()
    {
        
        $groupNames = $this->user->groups->pluck('name')->toArray();

        $this->assertTrue(in_array('Test Group', $groupNames));
    }


    /** @test */
    public function can_create_budget_item()
    {
        
        $item = factory(BudgetItem::class)->create([
            'name' => 'Test Item',
            'user_id' => $this->user->id
        ]);

        $item->groups()->attach($this->group->id);

        $itemNames = $this->group->items()->pluck('name')->toArray();

        $this->assertTrue($this->group->items()->count() > 0);

        $this->assertTrue(in_array('Test Item', $itemNames));


    }


}
