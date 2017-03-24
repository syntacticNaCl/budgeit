<?php

namespace Budgeit\Http\Controllers;

use Budgeit\User;
use Budgeit\Category;
use Budgeit\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();
//        $categories = $user->categories();
        return view('transaction', ['transactions' => Transaction::all(), 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $category = Category::findOrFail(1);
        $currency = Currency::findOrFail(1);
        $transaction = new Transaction();

        $transaction->name = $request->input('name');
        $transaction->amount = $request->input('amount');
        $transaction->archived = false;
        $transaction->status = 'active';
        $transaction->type = 'spending';
        $transaction->currency_id = 1;
        $transaction->user()->associate($user);
        $transaction->category()->associate($category);
        $transaction->currency()->associate($currency);
        $transaction->save();


        return redirect('transaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Budgeit\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Budgeit\Transaction $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Budgeit\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
