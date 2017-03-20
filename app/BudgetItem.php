<?php

namespace Budgeit;

use Illuminate\Database\Eloquent\Model;

class BudgetItem extends Model
{
    protected $fillable = [
        'name', 'amount', 'type', 'date', 'interest', 'order'
    ];

    public function user() {
        return $this->belongsTo('Budgeit\User');
    }

    public function budgetGroups() {
        return $this->belongsToMany('Budgeit\BudgetGroup', 'budget_group_budget_item', 'budget_group_id', 'budget_item_id');
    }
}
