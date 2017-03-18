@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel-heading">Budget
                    <button class="btn btn-default pull-right" data-toggle="modal" data-target="#addBudgetGroupModal">+ Create Budget
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
                        id="addBudgetGroupModalLabel">Add Group</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/budget_group']) !!}

                    <div class="form-group">
                        {!! Form::label('name','Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('note','Note') !!}
                        {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
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
