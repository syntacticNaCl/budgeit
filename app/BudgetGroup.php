<?php

namespace Budgeit;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BudgetGroup extends Model
{
    protected $fillable = [
        'name', 'note', 'order'
    ];

    public function user() 
    {
        return $this->belongsTo('Budgeit\User');
    }

    public function items() 
    {
        return $this->belongsToMany('Budgeit\BudgetItem');
    }

    public function getLastOrder() 
    {
        return DB::table('budget_groups')->where('user_id', Auth::user()->id)->max('order');
    }

}
