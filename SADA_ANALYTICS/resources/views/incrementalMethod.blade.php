@extends('layouts.master')

@section("title", $data["title"])

@section('content')
<div class="container" align="center">
    <h2>Incremental Search Method</h2>
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-6" style="float: left;">
            <p>
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-info-circle"></i> Help</a>
            </p>
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <li>The initial value must exist in the function.</li>
                    <li>The function must be continuous and differentiable.</li>
                    <li>Tolerance must have a positive value.</li>
                    <li>The iteration number must be positive.</li>
                    <li>On the number line x0 must be before x1.</li>
                </div>
            </div><br>
            <form method="POST" action="{{ route('incremental_search_method') }}" class="form">
                    @csrf
                    @if($data["storage"] == "true")
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>\[f(x)\]</label>
                                <input type="text" class="form-control" placeholder="{{$data['information'][0]}}" name="function" value="{{$data['information'][0]}}" />
                            </div>
                            <div class="form-group col-md-6">
                                <label>\[x0\]</label>
                                <input type="number" class="form-control" placeholder="Enter x0" name="x_0" step="any" required value="{{ empty($data['x_0']) ? '' : $data['x_0'] }}"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>$$\varDelta$$</label>
                                <input type="number" class="form-control" placeholder="Enter Delta" name="delta" step="any" min="0" required value="{{ empty($data['delta']) ? '' : $data['delta'] }}"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label>\[n\]</label>
                                <input type="number" class="form-control" placeholder="Enter Iterations" name="iterations" min="1" required value="{{ empty($data['iterations']) ? '' : $data['iterations'] }}"/>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox col-md-12">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">Save function after calculating</label>
                        </div><br>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-outline-success btn-block">{{ __('aitken.label.calculate') }}</button>
                            </div>
                        </div>
                        <br>
                        <a class="btn btn-outline-primary btn-block" href="{{ route('incremental_search') }}">Try with another function</a>
                    @else
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>\[f(x)\]</label>
                                <input type="text" class="form-control" placeholder="Enter Function" name="function" required value="{{ empty($data['function']) ? '' : $data['function'] }}"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label>\[x0\]</label>
                                <input type="number" class="form-control" placeholder="Enter x0" name="x_0" step="any" required value="{{ empty($data['x_0']) ? '' : $data['x_0'] }}"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>$$\varDelta$$</label>
                                <input type="number" class="form-control" placeholder="Enter Delta" name="delta" step="any" min="0" required value="{{ empty($data['delta']) ? '' : $data['delta'] }}"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label>\[n\]</label>
                                <input type="number" class="form-control" placeholder="Enter Iterations" name="iterations" min="1" required value="{{ empty($data['iterations']) ? '' : $data['iterations'] }}"/>
                            </div>
                            
                        </div>
                        <div class="custom-control custom-checkbox col-md-12">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">Save function after calculating</label>
                        </div><br>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-outline-success btn-block">{{ __('incremental.label.calculate') }}</button>
                            </div>
                        </div>
                    @endif
            </form>
                @if (!empty($data["function"]))
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('function_plotter_url') }}" class="form" target="_blank">
                            @csrf    
                            <input type="hidden" name="f_function" value="{{ $data['function'] }}">
                            <button type="submit" class="btn btn-info btn-block">Graph f(x)</button>
                        </form>
                    </div>
                </div>
                <br>
                @endif  
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
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('storage_incremental',['storage'=> $j,'method' => 0]) }}">Use Storage {{$j}}</a><br> 
                        \[{{$data["mem"][0][$j][0]}}\]
                        <br>
                    @endfor
                </div>
            </div>
        @endif
    </div>
    @if ($data["check"] == "true")
        <div class="card">
            <div class="card-header">
                <h2>{{ __('incremental.label.initialData') }}</h2>
                \[x0 = {{ $data["x_0"] }}\]
                $$\varDelta = {{ $data["delta"] }}$$
                \[n = {{ $data["iterations"] }}\]
                \[f(x) = {{ $data["function"] }}\]
            </div>
            <div class="card-body">
                <h4 class="text-align">{{ __('incremental.label.root') }}</h4>
                <div class="row justify-content-center">
                    <table class="table table-striped text-center table-BusquedasIncrementales">
                        <thead>
                            <tr>
                                <th>\[a \]</th>
                                <th>\[b \]</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data["json"] as $iteration)
                                <tr>
                                    <th>\[{{ $iteration[0] }}\]</th>
                                    <th>\[{{ $iteration[1] }}\]</th>
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