@extends('layouts.master')

@section("title", $data["title"])  

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('multiple_roots_method') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('multiple_roots.label.f_function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('multiple_roots.input.f_function') }}" value="{{ empty($data['f_function']) ? '' : $data['f_function'] }}" name="f_function" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('multiple_roots.label.df_function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('multiple_roots.input.df_function') }}" value="{{ empty($data['df_function']) ? '' : $data['df_function'] }}" name="df_function" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('multiple_roots.label.d2f_function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('multiple_roots.input.d2f_function') }}" value="{{ empty($data['d2f_function']) ? '' : $data['d2f_function'] }}" name="d2f_function" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('multiple_roots.label.initial_x') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('multiple_roots.input.initial_x') }}" value="{{ empty($data['initial_x']) ? '' : $data['initial_x'] }}" name="initial_x" step="any" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('multiple_roots.label.tolerance') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('multiple_roots.input.tolerance') }}" value="{{ empty($data['tolerance']) ? '' : $data['tolerance'] }}" name="tolerance" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('multiple_roots.label.iterations') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('multiple_roots.input.iterations') }}" value="{{ empty($data['iterations']) ? '' : $data['iterations'] }}" name="iterations" step="1" min="1" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-outline-success btn-block">{{ __('multiple_roots.calculate') }}</button>
                        </div>
                    </div>
            </form>
        </div>
        @if (!empty($data["table"]))
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('multiple_roots.initial_data') }}</h1>
                    <b>{{ __('multiple_roots.label.f_function') }}:</b> {{ $data['f_function'] }}<br>
                    <b>{{ __('multiple_roots.label.df_function') }}:</b> {{ $data['df_function'] }}<br>
                    <b>{{ __('multiple_roots.label.d2f_function') }}:</b> {{ $data['d2f_function'] }}<br>
                    <b>{{ __('multiple_roots.label.initial_x') }}:</b> {{ $data['initial_x'] }}<br>
                    <b>{{ __('multiple_roots.label.tolerance') }}:</b> {{ $data['tolerance'] }}<br>
                    <b>{{ __('multiple_roots.label.iterations') }}:</b> {{ $data['iterations'] }}<br>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <table class="table table-striped text-center table-BusquedasIncrementales">
                            <thead>
                                <tr>
                                    <th>{{ __('newton.table.iteration') }}</th>
                                    <th>{{ __('newton.table.xi') }}</th>
                                    <th>{{ __('newton.table.f_xi') }}</th>
                                    <th>{{ __('newton.table.error') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data["table"] as $iteration)
                                    <tr>
                                        <th>{{ $iteration[0] }}</th>
                                        <th>{{ $iteration[1] }}</th>
                                        <th>{{ $iteration[2] }}</th>
                                        <th>{{ $iteration[3] }}</th>
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