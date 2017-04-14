<?php

use Budgeit\BudgetGroup;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('budget', function() {
    $user = Auth::user();

    $incomeTotal = $user->items()->where('type', 'income')->sum('amount');
    $expenseTotal = $user->items()->where('type', 'expense')->sum('amount');
    $amountRemaining = (int) $incomeTotal - (int) $expenseTotal;

    return view('budget.index', compact('incomeTotal', 'expenseTotal', 'amountRemaining'));
})->middleware('auth');

Route::resource('budget_groups', 'BudgetGroupController', [
    'except' => [
        'create', 'edit'
    ]
]);

Route::get('/budget_groups/{id}/items', function($id){
    $group = BudgetGroup::find($id); 
    
    return response()->json([
        'items' => $group->items()->orderBy('order')->get()
    ]);
});

Route::resource('budget_items', 'BudgetItemController', [
    'except' => [
        'create', 'edit'
    ]
]);

Route::get('/overview', function(){
    $user = Auth::user();

    $incomeTotal = $user->items()->where('type', 'income')->sum('amount');
    $expenseTotal = $user->items()->where('type', 'expense')->sum('amount');
    $amountRemaining = (int) $incomeTotal - (int) $expenseTotal;
    $debtTotal = $user->items()->where('type', 'debt')->sum('amount');

    return view('overview.index', compact('incomeTotal', 'expenseTotal', 'amountRemaining', 'debtTotal'));
})->middleware('auth');

Route::get('/budget_overview', function(){
    $user = Auth::user();

    $incomeTotal = $user->items()->where('type', 'income')->sum('amount');
    $expenseTotal = $user->items()->where('type', 'expense')->sum('amount');
    $amountRemaining = (int) $incomeTotal - (int) $expenseTotal;
    $debtTotal = $user->items()->where('type', 'debt')->sum('amount');

    return response(compact('incomeTotal', 'expenseTotal', 'amountRemaining', 'debtTotal'));

})->middleware('auth');
