<?php

namespace Tests\Browser;

use Budgeit\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{

    use DatabaseMigrations;
    
    /** @test */
    public function login_page_loads()
    {
        $user = factory(User::class)->create([
            'email' => 'mal@serenity.com'
        ]);
        
        $this->browse(function ($browser) {
            $browser->visit('/')
                    ->assertSee('Login');
        });
    }
    
    /** @test */
    public function user_can_login()
    {
        $user = factory(User::class)->create([
            'email' => 'mal@serenity.com'
        ]);
        
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->type('email', 'mal@serenity.com')
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/');
        });
    }
    
}