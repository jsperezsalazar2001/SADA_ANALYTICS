@extends('layouts.master')

@section("title", $data["title"])  

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('fixed_point_method') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('fixed_point.label.f_function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('fixed_point.input.f_function') }}" value="{{ empty($data['f_function']) ? '' : $data['f_function'] }}" name="f_function" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('fixed_point.label.g_function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('fixed_point.input.g_function') }}" value="{{ empty($data['g_function']) ? '' : $data['g_function'] }}" name="g_function" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('fixed_point.label.initial_x') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('fixed_point.input.initial_x') }}" value="{{ empty($data['initial_x']) ? '' : $data['initial_x'] }}" name="initial_x" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('fixed_point.label.tolerance') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('fixed_point.input.tolerance') }}" value="{{ empty($data['tolerance']) ? '' : $data['tolerance'] }}" name="tolerance" step="any" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('fixed_point.label.iterations') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('fixed_point.input.iterations') }}" value="{{ empty($data['iterations']) ? '' : $data['iterations'] }}" name="iterations" step="1" min="1" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-outline-success btn-block">{{ __('fixed_point.calculate') }}</button>
                        </div>
                    </div>
            </form>
        </div>
        @if (!empty($data["table"]))
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('fixed_point.initial_data') }}</h1>
                    <b>{{ __('fixed_point.label.f_function') }}:</b> {{ $data['f_function'] }}<br>
                    <b>{{ __('fixed_point.label.g_function') }}:</b> {{ $data['g_function'] }}<br>
                    <b>{{ __('fixed_point.label.initial_x') }}:</b> {{ $data['initial_x'] }}<br>
                    <b>{{ __('fixed_point.label.tolerance') }}:</b> {{ $data['tolerance'] }}<br>
                    <b>{{ __('fixed_point.label.iterations') }}:</b> {{ $data['iterations'] }}<br>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <table class="table table-striped text-center table-BusquedasIncrementales">
                            <thead>
                                <tr>
                                    <th>{{ __('fixed_point.table.iteration') }}</th>
                                    <th>{{ __('fixed_point.table.xi') }}</th>
                                    <th>{{ __('fixed_point.table.g_xi') }}</th>
                                    <th>{{ __('fixed_point.table.f_xi') }}</th>
                                    <th>{{ __('fixed_point.table.error') }}</th>
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
                                    </tr>
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