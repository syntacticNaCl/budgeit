<?php

namespace Budgeit\Http\Controllers;

use Budgeit\BudgetGroup;
use Budgeit\BudgetItem;
use Budgeit\Http\Requests\BudgetGroupRequest;
use Illuminate\Support\Facades\Auth;

class BudgetGroupController extends Controller
{

    protected $redirectTo = '/budget';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user()->groups()->orderBy('order')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Budgeit\Http\Requests\BudgetGroupRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetGroupRequest $request)
    {
        $user = Auth::user();
        $group = new BudgetGroup();

        $lastOrder = $group->getLastOrder();

        $group->name = request('name');

        $group->type = request('type');

        $group->order = $lastOrder + 1;

        $group->user()->associate($user);
        $group->save();


        return redirect('budget')->with('status', 'Success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Budgeit\Http\Requests\BudgetGroupRequest $request
     * @param  \Budgeit\BudgetGroup $budgetGroup
     * @return \Illuminate\Http\Response
     */
    public function update(BudgetGroup $budgetGroup, BudgetGroupRequest $request)
    {
        $budgetGroup->name = request('name');
        $budgetGroup->order = request('order');
        $budgetGroup->save();

        return response('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetGroup $budgetGroup)
    {
        $budgetGroup->delete();

        return response('success');
    }
}
