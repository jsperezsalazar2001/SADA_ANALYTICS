@extends('layouts.master')

@section("title", $data["title"])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('steffensen_method') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>{{ __('steffensen.label.f_function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('steffensen.input.f_function') }}" name="f_function" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('steffensen.label.initial_x') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('steffensen.input.initial_x') }}" name="initial_x" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('steffensen.label.tolerance') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('steffensen.input.tolerance') }}" name="tolerance" step="any" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('steffensen.label.iterations') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('steffensen.input.iterations') }}" name="iterations" step="1" min="1" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-outline-success btn-block">{{ __('steffensen.calculate') }}</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection