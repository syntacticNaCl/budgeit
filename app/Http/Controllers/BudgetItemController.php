<?php

namespace Budgeit\Http\Controllers;

use Budgeit\User;
use Budgeit\BudgetItem;
use Budgeit\BudgetGroup;
use Budgeit\Http\Requests\BudgetItemRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BudgetItemController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function getItems()
    {
        $budgetGroup = BudgetGroup::find(2);

        return response()->json([
            'budgetItems' => $budgetGroup->budgetItems
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Budgeit\Http\Requests\BudgetItemRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetItemRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $budgetGroup = BudgetGroup::find(2);
        $item = new BudgetItem();

        $item->name = $request->input('name');
        $item->amount = $request->input('amount');
        if (!empty($request->input['note'])) {
            $item->note = $request->input('note');
        }
        $item->date = $request->input('date');
        $item->type = $request->input('type');
        $item->interest = $request->input('interest');

        $item->user()->associate($user);

        $item->save();
        $budgetGroup->budgetItems()->attach(1);

        return redirect('budget');

    }
}
