<?php

namespace Budgeit;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'name', 'status', 'amount', 'type'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categories() {
        return $this->hasMany(Category::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}
