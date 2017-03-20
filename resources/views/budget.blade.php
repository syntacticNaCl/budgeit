@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel-heading">Budget
                    <button class="btn btn-default pull-right" data-toggle="modal" data-target="#addBudgetGroupModal">+ Create Budget Group
                    </button>
                </div>
                <budget></budget>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addBudgetGroupModal"
         tabindex="-1" role="dialog"
         aria-labelledby="addBudgetGroupModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="addBudgetGroupModalLabel">Add Item</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/budget_groups']) !!}

                    <div class="form-group">
                        {!! Form::label('name','Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="modal-footer">
                        {!! Form::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
                        {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="addBudgetItemModal"
         tabindex="-1" role="dialog"
         aria-labelledby="addBudgetItemLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="addBudgetItemLabel">Add Group</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/budget_items']) !!}

                    <div class="form-group">
                        {!! Form::label('name','Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('amount','Amount') !!}
                        {!! Form::number('amount', 'amount', ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('note','Note') !!}
                        {!! Form::text('note', null, ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('date','Date') !!}
                        {!! Form::date('date', null, ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('type','Type') !!}
                        {!! Form::select('type', [
                            'cash' => 'Cash',
                            'check' => 'Check',
                            'debit' => 'Debit',
                            'credit' => 'Credit',
                        ], 'cash', ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('interest','Interest') !!}
                        {!! Form::number('interest', 'interest', ['class' => 'form-control']) !!}
                    </div>

                    <div class="modal-footer">
                        {!! Form::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
                        {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
