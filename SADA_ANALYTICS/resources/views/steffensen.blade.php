@extends('layouts.master')

@section("title", $data["title"])

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('steffensen_method') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>{{ __('steffensen.label.f_function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('steffensen.input.f_function') }}" value="{{ empty($data['f_function']) ? '' : $data['f_function'] }}" name="f_function" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('steffensen.label.initial_x') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('steffensen.input.initial_x') }}" value="{{ empty($data['initial_x']) ? '' : $data['initial_x'] }}" name="initial_x" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('steffensen.label.tolerance') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('steffensen.input.tolerance') }}" value="{{ empty($data['tolerance']) ? '' : $data['tolerance'] }}" name="tolerance" step="any" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('steffensen.label.iterations') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('steffensen.input.iterations') }}" value="{{ empty($data['iterations']) ? '' : $data['iterations'] }}" name="iterations" step="1" min="1" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-outline-success btn-block">{{ __('steffensen.calculate') }}</button>
                        </div>
                    </div>
            </form>
        </div>
        @if (!empty($data["table"]))
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('steffensen.initial_data') }}</h1>
                    <b>{{ __('steffensen.label.f_function') }}:</b> {{ $data['f_function'] }}<br>
                    <b>{{ __('steffensen.label.initial_x') }}:</b> {{ $data['initial_x'] }}<br>
                    <b>{{ __('steffensen.label.tolerance') }}:</b> {{ $data['tolerance'] }}<br>
                    <b>{{ __('steffensen.label.iterations') }}:</b> {{ $data['iterations'] }}<br>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <table class="table table-striped text-center table-BusquedasIncrementales">
                            <thead>
                                <tr>
                                    <th>{{ __('steffensen.table.iteration') }}</th>
                                    <th>{{ __('steffensen.table.xi') }}</th>
                                    <th>{{ __('steffensen.table.f_xi') }}</th>
                                    <th>{{ __('steffensen.table.xi_plus_f_xi') }}</th>
                                    <th>{{ __('steffensen.table.f_xi_plus_f_xi') }}</th>
                                    <th>{{ __('steffensen.table.error') }}</th>
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