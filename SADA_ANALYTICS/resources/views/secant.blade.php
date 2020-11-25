@extends('layouts.master')

@section("title", $data["title"])

@section('content')
<div class="container" align="center">
    <h2>{{$data["title"]}}</h2>
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-6" style="float: left;">
            <p>
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-info-circle"></i> {{ __('secant.help') }}</a>
            </p>
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <li>{{ __('secant.help1') }}</li>
                    <li>{{ __('secant.help2') }}</li>
                    <li>{{ __('secant.help3') }}</li>
                    <li>{{ __('secant.help4') }}</li>
                </div>
            </div>
            <form method="POST" action="{{ route('secant_method') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>\[{{ __('secant.label.f_function') }}\]</label>
                            @if($data["storage"] == "true")
                                <input type="text" class="form-control" placeholder="{{$data['information'][0]}}" value="{{$data['information'][0]}}" name="f_function" required />
                            @else
                                <input type="text" class="form-control" placeholder="{{ __('secant.input.f_function') }}" value="{{ empty($data['f_function']) ? '' : $data['f_function'] }}" name="f_function" required />
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>\[{{ __('secant.label.x1') }}\]</label>
                            <input type="number" class="form-control" placeholder="{{ __('secant.input.x1') }}" value="{{ empty($data['x1']) ? '' : $data['x1'] }}" name="x1" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>\[{{ __('secant.label.x2') }}\]</label>
                            <input type="number" class="form-control" placeholder="{{ __('secant.input.x2') }}" value="{{ empty($data['x2']) ? '' : $data['x2'] }}" name="x2" step="any" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>\[{{ __('secant.label.tolerance') }}\]</label>
                            <input type="number" class="form-control" placeholder="{{ __('secant.input.tolerance') }}" value="{{ empty($data['tolerance']) ? '' : $data['tolerance'] }}" name="tolerance" min="0" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>\[{{ __('secant.label.iterations') }}\]</label>
                            <input type="number" class="form-control" placeholder="{{ __('secant.input.iterations') }}" value="{{ empty($data['iterations']) ? '' : $data['iterations'] }}" name="iterations" step="1" min="1" max="200" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-outline-success btn-block">{{ __('secant.calculate') }}</button>
                        </div>
                        @if (!empty($data["f_function"]))
                        <div class="form-group col-md-6">
                            <a class="btn btn-outline-primary btn-block" href="{{ route('function_plotter_url',['function'=> urlencode(strtolower($data['f_function']))]) }} " target="_blank">Graph f(x)</a><br> 
                        </div>
                        @endif
                    </div>
                    <div class="custom-control custom-checkbox col-md-12">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">Save Function after calculating</label>
                    </div><br>
                    @if($data["storage"] == "true")
                    <a class="btn btn-outline-primary btn-block" href="{{ route('secant') }}">Try with another function</a><br>
                    @endif
            </form>
        </div>
        @if ($data["checkMem"] == "true" and $data["mem"][0][0] != 0)
            <div class="col-md-6" style="float: right;">
                <p>
                    @if (count($data["mem"][0]) > 1)
                        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2"><i class="fa fa-info-circle"></i> Functions Saved</a>
                    @endif 
                </p>
                <div class="collapse multi-collapse" id="multiCollapseExample2">
                    @for($j = 1; $j < count($data["mem"][0]); $j++)
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('storage_secant',['storage'=> $j,'method' => 0]) }}">Use Storage {{$j}}</a><br> 
                        \[{{$data["mem"][0][$j][0]}}\]
                        <br>
                    @endfor
                </div>
            </div>
        @endif
    </div>
        @if (!empty($data["table"]))
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('secant.initial_data') }}</h2>
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
                                        <th>\[{{ $iteration[0] }}\]</th>
                                        <th>\[{{ $iteration[1] }}\]</th>
                                        <th>\[{{ $iteration[2] }}\]</th>
                                        <th>\[{{ $iteration[3] }}\]</th>
                                    </tr>
                                    @if ($loop->last)
                                        @if ($data['aprox'] != false)
                                        <tr>
                                            <th colspan="4">{{ __('secant.root') }}\[{{ $data['aprox'] }}\]</th>
                                        </tr>
                                        @else
                                        <tr>
                                            <th colspan="4">{{ __('secant.no_root') }}</th>
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
@endsection