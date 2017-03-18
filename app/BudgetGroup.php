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
        return $this->hasMany('Budgeit\BudgetItem');
    }

}
