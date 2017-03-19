<?php

namespace Budgeit\Http\Controllers;

use Budgeit\BudgetGroup;
use Budgeit\BudgetItem;
use Budgeit\User;
use Budgeit\Category;
use Budgeit\Http\Requests\BudgetGroupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BudgetGroupController extends Controller
{

    protected $redirectTo = '/budget';

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('budget');
    }

    public function getBudgetGroups() {
        $user = Auth::user();

        return response()->json(
            [
                'budgetGroups'   => $user->budgetGroups
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Budgeit\Http\Requests\BudgetGroupRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetGroupRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $group = new BudgetGroup();

        $lastOrder = DB::table('budget_groups')->where('user_id', Auth::user()->id)->max('order');

        $group->name = $request->input('name');

        if(!empty($request->input['note'])){
            $group->note = $request->input['note'];
        }

        $group->order = $lastOrder + 1;

        $group->user()->associate($user);
        $group->save();


        return redirect('budget');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Budgeit\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Budgeit\Http\Requests\BudgetGroupRequest $request
     * @param  \Budgeit\BudgetGroup $budgetGroup
     * @return \Illuminate\Http\Response
     */
    public function update(BudgetGroupRequest $request, BudgetGroup $budgetGroup)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $order = $request->input('order');

        $budgetGroup = BudgetGroup::find($id);

        $budgetGroup->name = $name;
        $budgetGroup->order = $order;
        $budgetGroup->save();

        return response()->json([
            'status' => 'success'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $budgetGroup = BudgetGroup::find($id);
        $budgetGroup->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
