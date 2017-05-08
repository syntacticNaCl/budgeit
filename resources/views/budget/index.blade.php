@extends('layouts.app')

@section('content')

<budget></budget>

<div class="button-nav-wrap">
    <button class="button-nav"
    data-toggle="modal"
    data-target="#addBudgetGroupModal"
    id="add_budget_group">+</button>
</div>

<div class="modal fade" id="addBudgetGroupModal" tabindex="-1" role="dialog" aria-labelledby="addBudgetGroupModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addBudgetGroupModalLabel">Add Item</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => '/budget_groups']) !!}

                <div class="form-group">
                    {!! Form::label('name','Name') !!} {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required'] ) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('type','Type') !!} {!! Form::select('type', ['income' => 'Income', 'expense' => 'Expense', 'debt' => 'Debt'],
                    ['class' => 'form-control'], ['placeholder' => 'Select', 'required' => 'required']) !!}
                </div>

                <div class="modal-footer">
                    {!! Form::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!} {!! Form::submit('Add', ['class'
                    => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection