@extends('layouts.master')

@section("title", $data["title"])

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('incremental_search_method') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('incremental.label.x_0') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('incremental.input.x_0') }}" name="x_0" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('incremental.label.delta') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('incremental.input.delta') }}" name="delta" step="any" min="0" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{ __('incremental.label.iterations') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('incremental.input.iterations') }}" name="iterations" min="1" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('incremental.label.function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('incremental.input.function') }}" name="function" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-outline-success btn-block">{{ __('incremental.label.calculate') }}</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    @if ($data["check"] == "true")
        <div class="card">
            <div class="card-header">
                <h1>{{ __('incremental.label.initialData') }}</h1>
                <b>{{ __('incremental.label.x_0') }}:</b> {{ $data["x_0"] }}<br>
                <b>{{ __('incremental.label.delta') }}:</b> {{ $data["delta"] }}<br>
                <b>{{ __('incremental.label.iterations') }}:</b> {{ $data["iterations"] }}<br>
                <b>{{ __('incremental.label.function') }}:</b> {{ $data["function"] }}<br>
            </div>
            <div class="card-body">
                <h1 class="text-align">{{ __('incremental.label.root') }}</h1>
                <div class="row justify-content-center">
                    <table class="table table-striped text-center table-BusquedasIncrementales">
                        <thead>
                            <tr>
                                <th>a</th>
                                <th>b</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data["json"] as $iteration)
                                <tr>
                                    <th>{{ $iteration[0] }}</th>
                                    <th>{{ $iteration[1] }}</th>
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