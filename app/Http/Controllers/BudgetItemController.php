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

    public function getItems($id)
    {
        $budgetGroup = BudgetGroup::find($id);

        return response()->json([
            'budgetItems' => $budgetGroup->items()->orderBy('order')->get()
        ]);
    }

    public function update(BudgetItem $budgetItem, BudgetItemRequest $request)
    {
        $budgetItem->name = $request->input('name');
        $budgetItem->amount = $request->input('amount');
        $budgetItem->type = $request->input('type');
        $budgetItem->order = $request->input('order');
        $budgetItem->status = $request->input('status');

        $budgetItem->save();

        return response('success');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Budgeit\Http\Requests\BudgetItemRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetItemRequest $request)
    {
        $user = Auth::user();
        $groupId = $request->input('groupId');

        $budgetGroup = BudgetGroup::find($groupId);

        $order = 0;
        
        if (0 !== count($budgetGroup->items)) {
            $order = $budgetGroup->items()->max('order');
            $order = $order + 1;
        }

        $item = new BudgetItem();

        $item->name = $request->input('name');
        $item->amount = $request->input('amount');
        $item->type = $request->input('type');
        $item->order = $order;
        $item->note = $request->input('note');
        $item->date = $request->input('date');
        $item->interest = $request->input('interest');
        $item->status = 'unallocated';
        
        $item->user()->associate($user);

        $item->save();

        $item->groups()->attach($groupId);

        return response()->json([
            'id' => $item->id
        ]);
    }

    /**
     * Destroy item.
     *
     * @param int $id
     * @return Response 
     */
    public function destroy(BudgetItem $budgetItem)
    {

        $budgetItem->delete();

        return response('success');

    }
}
