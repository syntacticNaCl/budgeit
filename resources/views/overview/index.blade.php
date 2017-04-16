@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-md-offset-2 text-center">
            <h1>Overview</h1>
            <div class="panel panel-default">
                <div class="panel-body">

                    <h3>
                        Income
                    </h3>
                    <p>
                        ${{$incomeTotal}}
                    </p>

                    <h3>
                        Expenses
                    </h3>
                    <p>
                        ${{$expenseTotal}}
                    </p>

                    <h3>
                        Remaining:
                    </h3>

                    <p>
                        ${{$amountRemaining}}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 text-center">
            <h3>
                Income
            </h3>
            <h4>
                ${{$incomeTotal}}
            </h4>
        </div>
        <div class="col-sm-12 col-md-4 text-center">
            <h3>
                Expenses
            </h3>
            <h4>
                ${{$expenseTotal}}
            </h4>
        </div>
        <div class="col-sm-12 col-md-4 text-center">
            <h3>
                Debt:
            </h3>

            <h4>
                ${{$debtTotal}}
            </h4>
        </div>
    </div>
</div>
@endsection