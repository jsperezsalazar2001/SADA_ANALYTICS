@extends('layouts.master')

@section("title", $data["title"])  

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('false_position_method') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>{{ __('false_position.label.f_function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('false_position.input.f_function') }}" value="{{ empty($data['f_function']) ? '' : $data['f_function'] }}" name="f_function" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('false_position.label.a_value') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('false_position.input.a_value') }}" value="{{ empty($data['a_value']) ? '' : $data['a_value'] }}" name="a_value" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('false_position.label.b_value') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('false_position.input.b_value') }}" value="{{ empty($data['b_value']) ? '' : $data['b_value'] }}" name="b_value" step="any" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('false_position.label.tolerance') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('false_position.input.tolerance') }}" value="{{ empty($data['tolerance']) ? '' : $data['tolerance'] }}" name="tolerance" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('false_position.label.iterations') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('false_position.input.iterations') }}" value="{{ empty($data['iterations']) ? '' : $data['iterations'] }}" name="iterations" step="1" min="1" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-outline-success btn-block">{{ __('false_position.calculate') }}</button>
                        </div>
                    </div>
            </form>
        </div>
        @if (!empty($data["table"]))
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('false_position.initial_data') }}</h1>
                    <b>{{ __('false_position.label.f_function') }}:</b> {{ $data['f_function'] }}<br>
                    <b>{{ __('false_position.label.a_value') }}:</b> {{ $data['a_value'] }}<br>
                    <b>{{ __('false_position.label.b_value') }}:</b> {{ $data['b_value'] }}<br>
                    <b>{{ __('false_position.label.tolerance') }}:</b> {{ $data['tolerance'] }}<br>
                    <b>{{ __('false_position.label.iterations') }}:</b> {{ $data['iterations'] }}<br>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <table class="table table-striped text-center table-BusquedasIncrementales">
                            <thead>
                                <tr>
                                    <th>{{ __('false_position.table.iteration') }}</th>
                                    <th>{{ __('false_position.table.a') }}</th>
                                    <th>{{ __('false_position.table.xm') }}</th>
                                    <th>{{ __('false_position.table.b') }}</th>
                                    <th>{{ __('false_position.table.f_xm') }}</th>
                                    <th>{{ __('false_position.table.error') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data["table"] as $iteration)
                                    <tr>
                                        <th>{{ $iteration[0] }}</th>
                                        <th>{{ $iteration[1] }}</th>
                                        <th>{{ $iteration[2] }}</th>
                                        <th>{{ $iteration[3] }}</th>
                                        <th>{{ $iteration[4] }}</th>
                                        <th>{{ $iteration[5] }}</th>
                                    </tr>
                                    <!-- @if ($loop->last)
                                    <tr>
                                        <th colspan="4">{{ __('fixedPoint.root') }}{{ $iteration[1] }}</th>
                                    </tr>
                                    @endif -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif      
    </div>
</div>
@endsection