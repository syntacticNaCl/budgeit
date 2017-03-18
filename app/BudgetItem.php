<?php

namespace Budgeit;

use Illuminate\Database\Eloquent\Model;

class BudgetItem extends Model
{
    protected $fillable = [
        'name', 'amount', 'type', 'date', 'interest', 'order'
    ];

    public function budgetGroup() {
        return $this->belongsTo('Budgeit\BudgetGroup');
    }
}
