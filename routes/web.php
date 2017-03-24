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
    return view('budget');
})->middleware('auth');

Route::get('/budget_groups', 'BudgetGroupController@getBudgetGroups');
Route::resource('budget_groups', 'BudgetGroupController', [
    'except' => [
        'create', 'edit', 'index'
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
        'create', 'edit', 'index'
    ]
]);
