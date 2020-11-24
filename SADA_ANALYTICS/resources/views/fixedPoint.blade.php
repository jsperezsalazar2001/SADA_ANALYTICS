@extends('layouts.master')

@section("title", $data["title"])  

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h2>{{$data["title"]}}</h2>
            <p>
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-info-circle"></i> {{ __('fixed_point.help') }}</a>
            </p>
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <li>{{ __('fixed_point.help1') }}</li>
                    <li>{{ __('fixed_point.help2') }}</li>
                    <li>{{ __('fixed_point.help3') }}</li>
                    <li>{{ __('fixed_point.help4') }}</li>
                </div>
            </div>
            <form method="POST" action="{{ route('fixed_point_method') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>\[{{ __('fixed_point.label.f_function') }}\]</label>
                            <input type="text" class="form-control" placeholder="{{ __('fixed_point.input.f_function') }}" value="{{ empty($data['f_function']) ? '' : $data['f_function'] }}" name="f_function" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>\[{{ __('fixed_point.label.g_function') }}\]</label>
                            <input type="text" class="form-control" placeholder="{{ __('fixed_point.input.g_function') }}" value="{{ empty($data['g_function']) ? '' : $data['g_function'] }}" name="g_function" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>\[{{ __('fixed_point.label.initial_x') }}\]</label>
                            <input type="number" class="form-control" placeholder="{{ __('fixed_point.input.initial_x') }}" value="{{ empty($data['initial_x']) ? '' : $data['initial_x'] }}" name="initial_x" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>\[{{ __('fixed_point.label.tolerance') }}\]</label>
                            <input type="number" class="form-control" placeholder="{{ __('fixed_point.input.tolerance') }}" value="{{ empty($data['tolerance']) ? '' : $data['tolerance'] }}" name="tolerance" min="0" step="any" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>\[{{ __('fixed_point.label.iterations') }}\]</label>
                            <input type="number" class="form-control" placeholder="{{ __('fixed_point.input.iterations') }}" value="{{ empty($data['iterations']) ? '' : $data['iterations'] }}" name="iterations" step="1" min="1"  max="200" required />
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
                    <h2>{{ __('fixed_point.initial_data') }}</h2>
                    \[{{ __('fixed_point.label.f_function') }} = {{ $data['f_function'] }}\]
                    \[{{ __('fixed_point.label.g_function') }} = {{ $data['g_function'] }}\]
                    \[{{ __('fixed_point.label.initial_x') }} = {{ $data['initial_x'] }}\]
                    \[{{ __('fixed_point.label.tolerance') }} = {{ $data['tolerance'] }}\]
                    \[{{ __('fixed_point.label.iterations') }} = {{ $data['iterations'] }}\]
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <table class="table table-striped text-center table-BusquedasIncrementales">
                            <thead>
                                <tr>
                                    <th>\[{{ __('fixed_point.table.iteration') }}\]</th>
                                    <th>\[{{ __('fixed_point.table.xi') }}\]</th>
                                    <th>\[{{ __('fixed_point.table.g_xi') }}\]</th>
                                    <th>\[{{ __('fixed_point.table.f_xi') }}\]</th>
                                    <th>\[{{ __('fixed_point.table.error') }}\]</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data["table"] as $iteration)
                                    <tr>
                                        <th>\[{{ $iteration[0] }}\]</th>
                                        <th>\[{{ $iteration[1] }}\]</th>
                                        <th>\[{{ $iteration[2] }}\]</th>
                                        <th>\[{{ $iteration[3] }}\]</th>
                                        <th>\[{{ $iteration[4] }}\]</th>
                                    </tr>
                                    @if ($loop->last)
                                        @if ($data['aprox'] != false)
                                        <tr>
                                            <th colspan="5">{{ __('fixed_point.root') }}\[{{ $data['aprox'] }}\]</th>
                                        </tr>
                                        @else
                                        <tr>
                                            <th colspan="5">{{ __('fixed_point.no_root') }}</th>
                                        </tr>
                                        @endif
                                    @endif
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