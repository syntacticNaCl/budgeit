@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel-heading">Budget</div>
                <div class="panel-body">
                    <button class="btn btn-default" data-toggle="modal" data-target="#addBudgetModal">+ Create Budget
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addBudgetModal"
         tabindex="-1" role="dialog"
         aria-labelledby="addBudgetModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="addBudgetModalLabel">Add Budget</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'budget.store']) !!}

                    <div class="form-group">
                        {!! Form::label('name','Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <select name="category" id="category">
                            @if (0 < count($budgets))
                                @foreach($budgets as $budget)
                                <option value=""></option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        {!! Form::label('amount','Amount') !!}
                        {!! Form::text('amount', null, ['class' => 'form-control']) !!}
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