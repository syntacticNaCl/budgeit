<?php

namespace Budgeit;

use Illuminate\Database\Eloquent\Model;

class BudgetGroup extends Model
{
    protected $fillable = [
        'name', 'note', 'order'
    ];

    public function user() {
        return $this->belongsTo('Budgeit\User');
    }

    public function budgetItems() {
        return $this->belongsToMany('Budgeit\BudgetItem', 'budget_group_budget_item', 'budget_item_id', 'budget_group_id');
    }

}
