@extends('layouts.master')

@section("title", $data["title"])

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('secant_method') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>{{ __('secant.label.f_function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('secant.input.f_function') }}" value="{{ empty($data['f_function']) ? '' : $data['f_function'] }}" name="f_function" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('secant.label.x1') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('secant.input.x1') }}" value="{{ empty($data['x1']) ? '' : $data['x1'] }}" name="x1"  required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('secant.label.x2') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('secant.input.x2') }}" value="{{ empty($data['x2']) ? '' : $data['x2'] }}" name="x2" step="any" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('secant.label.tolerance') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('secant.input.tolerance') }}" value="{{ empty($data['tolerance']) ? '' : $data['tolerance'] }}" name="tolerance" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('secant.label.iterations') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('secant.input.iterations') }}" value="{{ empty($data['iterations']) ? '' : $data['iterations'] }}" name="iterations" step="1" min="1" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-outline-success btn-block">{{ __('secant.calculate') }}</button>
                        </div>
                    </div>
            </form>
        </div>
        @if (!empty($data["table"]))
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('secant.initial_data') }}</h1>
                    \[{{ __('secant.label.f_function') }} = {{ $data['f_function'] }}\]
                    \[{{ __('secant.label.x1') }} = {{ $data['x1'] }}\]
                    \[{{ __('secant.label.x2') }} = {{ $data['x2'] }}\]
                    \[{{ __('secant.label.tolerance') }} = {{ $data['tolerance'] }}\]
                    \[{{ __('secant.label.iterations') }} = {{ $data['iterations'] }}\]
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <table class="table table-striped text-center table-BusquedasIncrementales">
                            <thead>
                                <tr>
                                    <th>\[{{ __('secant.table.iteration') }}\]</th>
                                    <th>\[{{ __('secant.table.xi') }}\]</th>
                                    <th>\[{{ __('secant.table.f_xi') }}\]</th>
                                    <th>\[{{ __('secant.table.error') }}\]</th>
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