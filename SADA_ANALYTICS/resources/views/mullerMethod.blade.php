@extends('layouts.master')

@section("title", $data["title"])

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('muller_method') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>X_0</label>
                            <input type="number" class="form-control" placeholder="Enter X_0" name="x_0" step="any" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>X_1</label>
                            <input type="number" class="form-control" placeholder="Enter X_1" name="x_1" step="any" min="0" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>X_2</label>
                            <input type="number" class="form-control" placeholder="Enter X_2" name="x_2" step="any" min="0"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Iteration Limit</label>
                            <input type="number" class="form-control" placeholder="Enter the maximum value of iterations" name="iterations" min="1" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>Funtion</label>
                            <input type="text" class="form-control" placeholder="Enter the function" name="function" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tolerance</label>
                            <input type="number" class="form-control" placeholder="Enter the tolerance" name="tolerance" required step="any"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-outline-success btn-block">Calculate</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    @if ($data["check"] == "true")
        <div class="card">
            <div class="card-header">
                <h1>Initial Data</h1>
                <b>x_0:</b> {{ $data["x_0"] }}<br>
                <b>x_1:</b> {{ $data["x_1"] }}<br>
                <b>x_2:</b> {{ $data["x_2"] }}<br>
                <b>Maximum value of iterations:</b> {{ $data["iterations"] }}<br>
                <b>Function:</b> {{ $data["function"] }}<br>
                <b>Tolerance:</b> {{ $data["tolerance"] }}
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <table class="table table-striped text-center table-BusquedasIncrementales">
                        <thead>
                            <tr>
                                <th>Iteration</th>
                                <th>Xm</th>
                                <th>f(xm)</th>
                                <th>Error</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data["json"] as $iteration)
                                <tr>
                                    <th>{{ $iteration[0] }}</th>
                                    <th>{{ $iteration[1] }}</th>
                                    <th>{{ $iteration[2] }}</th>
                                    <th>{{ $iteration[3] }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection