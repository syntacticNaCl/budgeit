<?php

namespace Budgeit;

use Illuminate\Database\Eloquent\Model;

class BudgetItem extends Model
{
    protected $fillable = [ 'name', 'amount', 'type', 'date', 'interest', 'order' ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function groups() {
        return $this->belongsToMany(BudgetGroup::class);
    }
}