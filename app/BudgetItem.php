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

    /**
     * Scope a query to only include unallocated items.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnallocated($query) {
        return $query->expense()->where('status', 'unallocated');
    }

    /**
     * Scope a query to only include allocated items.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAllocated($query) {
        return $query->expense()->where('status', 'allocated');
    }

    /**
     * Scope a query to only include paid items.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePaid($query) {
        return $query->expense()->where('status', 'paid');
    }

    /**
     * Scope a query to only include expenses.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExpense($query) {
        return $query->where('type', 'expense');
    }

    /**
     * Scope a query to only include income.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIncome($query) {
        return $query->where('type', 'income');
    }
}