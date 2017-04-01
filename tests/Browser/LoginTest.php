<?php

namespace Tests\Browser;

use Budgeit\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    
    /** @test */
    public function login_page_loads()
    {
        
        $this->browse(function ($browser) {
            $browser->visit('/')
            ->assertSee('Login');
        });
    }
    
    /** @test */
    public function user_can_login()
    {
        
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->type('email', 'mal@serenity.com')
                    ->type('password', 'password')
                    ->press('Login')
                    ->assertPathIs('/');
        });
    }
    
}