@extends('layouts.master')

@section("title", $data["title"])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('secant_method') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>{{ __('secant.label.f_function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('secant.input.f_function') }}" name="f_function" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('secant.label.x1') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('secant.input.x1') }}" name="x1" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('secant.label.x2') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('secant.input.x2') }}" name="x2" step="any" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('secant.label.tolerance') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('secant.input.tolerance') }}" name="tolerance" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('secant.label.iterations') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('secant.input.iterations') }}" name="iterations" step="1" min="1" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-outline-success btn-block">{{ __('secant.calculate') }}</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection