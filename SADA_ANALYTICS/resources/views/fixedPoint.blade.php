@extends('layouts.master')

@section("title", $data["title"])  

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('fixed_point_method') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('fixed_point.label.f_function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('fixed_point.input.f_function') }}" name="f_function" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('fixed_point.label.g_function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('fixed_point.input.g_function') }}" name="g_function" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('fixed_point.label.initial_x') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('fixed_point.input.initial_x') }}" name="initial_x" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('fixed_point.label.tolerance') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('fixed_point.input.tolerance') }}" name="tolerance" step="any" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('fixed_point.label.iterations') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('fixed_point.input.iterations') }}" name="iterations" step="1" min="1" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-outline-success btn-block">{{ __('fixed_point.calculate') }}</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection