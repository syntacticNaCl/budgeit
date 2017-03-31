<?php

namespace Budgeit;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'currency_symbol', 'currency_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groups() 
    {
        return $this->hasMany('Budgeit\BudgetGroup');
    }

    public function items() 
    {
        return $this->hasMany('Budgeit\BudgetItem');
    }
}
