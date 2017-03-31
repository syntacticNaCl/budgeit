<?php

namespace Budgeit;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'name', 'status', 'amount', 'type'
    ];

    public function user() {
        return $this->belongsTo('Budgeit\User');
    }

    public function categories() {
        return $this->hasMany('Budgeit\Category');
    }

    public function category() {
        return $this->belongsTo('Budgeit\Category');
    }

    public function currency() {
        return $this->belongsTo('Budgeit\Currency');
    }
}
