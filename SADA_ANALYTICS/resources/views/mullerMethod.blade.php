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
                            <label>{{ __('muller.label.x_0') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('muller.input.x_0') }}" name="x_0" step="any" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ __('muller.label.x_1') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('muller.input.x_1') }}" name="x_1" step="any" min="0" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ __('muller.label.x_2') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('muller.input.x_2') }}" name="x_2" step="any" min="0"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>{{ __('muller.label.iterations') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('muller.input.iterations') }}" name="iterations" min="1" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ __('muller.label.function') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('muller.input.function') }}" name="function" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ __('muller.label.tolerance') }}</label>
                            <input type="number" class="form-control" placeholder="{{ __('muller.input.tolerance') }}" name="tolerance" required step="any"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-outline-success btn-block">{{ __('muller.label.calculate') }}</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    @if ($data["check"] == "true")
        <div class="card">
            <div class="card-header">
                <h1>{{ __('muller.label.initialData') }}</h1>
                <b>{{ __('muller.label.x_0') }}:</b> {{ $data["x_0"] }}<br>
                <b>{{ __('muller.label.x_1') }}:</b> {{ $data["x_1"] }}<br>
                <b>{{ __('muller.label.x_2') }}:</b> {{ $data["x_2"] }}<br>
                <b>{{ __('muller.label.iterations') }}:</b> {{ $data["iterations"] }}<br>
                <b>{{ __('muller.label.function') }}:</b> {{ $data["function"] }}<br>
                <b>{{ __('muller.label.tolerance') }}:</b> {{ $data["tolerance"] }}
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <table class="table table-striped text-center table-BusquedasIncrementales">
                        <thead>
                            <tr>
                                <th>{{ __('muller.label.iteration') }}</th>
                                <th>{{ __('muller.label.x_m') }}</th>
                                <th>{{ __('muller.label.fm') }}</th>
                                <th>{{ __('muller.label.error') }}</th>
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
                                @if ($loop->last)
                                    <tr>
                                        <th colspan="4">{{ __('muller.root') }}{{ $iteration[1] }}</th>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection