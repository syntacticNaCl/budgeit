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
        return $this->belongsTo(User::class);
    }

    public function items() 
    {
        return $this->belongsToMany(BudgetItem::class);
    }

    public function getLastOrder($userId = null)
    {

        if ($userId === null) {
            $userId = Auth::user()->id;
        }

        return DB::table('budget_groups')->where('user_id', $userId)->max('order');
    }

}
