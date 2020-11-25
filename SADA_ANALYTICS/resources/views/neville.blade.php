@extends('layouts.master')

@section("title", $data["title"])

@section('content')
<head>
    <script type='text/javascript'>
        function addFields(){
            // Number of inputs to create
            var number = document.getElementById("dimension").value;
            // Container <div> where dynamic content will be placed
            var container_matrix = document.getElementById("matrix");
            var container_vector = document.getElementById("vector");
            // Clear previous contents of the container
            while (container_matrix.hasChildNodes()) {
                container_matrix.removeChild(container_matrix.lastChild);
            }
            while (container_vector.hasChildNodes()) {
                container_vector.removeChild(container_vector.lastChild);
            }
            if (number > 10){
                number = 10;
            }
            if (number <= 1){
                number = 2;
            }
            if (number>1) {
                for (i=0;i<number;i++) {
                    // Append a node with a random text
                        container_matrix.appendChild(document.createTextNode(""));
                        // Create an <input> element for matrix A, set its type and name attributes
                        var input = document.createElement("input");
                        input.type = "number";
                        input.name = "x" + i;
                        input.style = "width : 110px;";
                        input.step = "any";
                        input.required = true;
                        container_matrix.appendChild(input);
                    // Append a node with a random text
                    container_vector.appendChild(document.createTextNode(""));
                    // Create an <input> element for vector B, set its type and name attributes
                    var vector = document.createElement("input");
                    vector.type = "number";
                    vector.name = "y" + i ;
                    vector.style = "width : 110px;";
                    vector.step = "any";
                    vector.required = true;
                    container_vector.appendChild(vector);
                }
                document.getElementById("matrix_a").style.display = 'block';
                document.getElementById("vector_b").style.display = 'block'; 
                document.getElementById("solve").style.display = 'block';
                document.getElementById("save").style.display = 'block'; 
            }
        }
    </script>
</head>
<div class="container" align="center">
    <h2>{{ __('neville.title') }}</h2>
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-6">
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
            <form method="POST" action="{{route('neville_method')}}" class="form">
            @csrf
                @if($data["storage"] == "true")
                    <div class="text-align">
                        \[x = \] <br>
                        @for($i = 0; $i < count($data["information"][0]); $i++)
                            <input type="number" step="any" name="x{{$i}}" style="width: 110px" placeholder="{{$data['information'][0][$i]}}" value="{{$data['information'][0][$i]}}"> 
                        @endfor <br><br>
                        \[f(x) = \]<br>
                        @for($i = 0; $i < count($data["information"][1]); $i++)
                            <input type="number" step="any" name="y{{$i}}" style="width: 110px" placeholder="{{$data['information'][1][$i]}}" value="{{$data['information'][1][$i]}}"> 
                        @endfor <br><br>
                        <div class="form-group col-md-12">
                            <input type="number" id="dimension" min="2" class="form-control" placeholder="{{$data['information'][2]}}" value="{{$data['information'][2]}}" name="n" step="any" required hidden="true" />
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>\[{{__('neville.x_to_interpolate')}}\]</label>
                                <input type="number" id="x_inter" min="2" class="form-control" placeholder="{{__('neville.x_to_interpolate_2')}}" name="x_inter" step="any" required />
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox col-md-12">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">Save arrays after calculating</label>
                        </div><br><br>
                        <button type="submit" class="btn btn-outline-success btn-block">Solve</button>
                        <a class="btn btn-outline-primary btn-block" href="{{ route('neville') }}">Try with another arrays</a>
                    </div>
                @else
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>\[ {{__('neville.dimension')}}\]</label>
                        <input type="number" id="dimension" min="2" class="form-control" placeholder="Dimension" name="n" step="any" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <a id="filldetails" onclick="addFields()" class="btn btn-outline-primary btn-block">{{__('neville.create_arrays')}}</a> 
                    </div>
                    <div class="form-group col-md-12">
                        <label>\[{{__('neville.x_to_interpolate')}}\]</label>
                        <input type="number" id="x_inter" min="2" class="form-control" placeholder="{{__('neville.x_to_interpolate_2')}}" name="x_inter" step="any" required />
                    </div>
                    <div class="custom-control custom-checkbox col-md-12" style="display: none" id="save">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">Save arrays after calculating</label>
                    </div><br><br>
                    <div class="form-group col-md-12">
                        <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">{{__('neville.solve')}}</button> 
                    </div>
                </div>
                <div id="matrix_a" class="text-align metodo"> \[ x = \] </div>
                <div id="matrix" class="text-align"> </div>
                

                <div id="vector_b" class="text-align metodo"> \[ y = \] </div>
                <div id="vector" class="text-align"> </div>
                @endif
            </form>
        </div>
        @if ($data["checkMem"] == "true" and $data["mem"][2][0] != 0)
            <div class="col-md-6" style="float: right;">
                @if (count($data["mem"][2]) > 1)
                    <h4>Array Saved</h4>
                @endif 
                @for($j = 1; $j < count($data["mem"][2]); $j++)
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('storage_neville',['storage'=> $j,'method' => 2]) }}">Use Storage {{$j}}</a> <br><br>
                    $$x = \begin{bmatrix}
                    @for($z = 0; $z < count($data["mem"][2][$j][0]); $z++)
                            
                        @if($z != count($data["mem"][2][$j][0])-1)
                            {{$data["mem"][2][$j][0][$z]}} &
                        @else 
                            {{$data["mem"][2][$j][0][$z]}}
                        @endif
                    @endfor
                    \end{bmatrix}$$ 
                    $$y = \begin{bmatrix}
                    @for($z = 0; $z < count($data["mem"][2][$j][1]); $z++)
                            
                        @if($z != count($data["mem"][2][$j][1])-1)
                            {{$data["mem"][2][$j][1][$z]}} &
                        @else 
                            {{$data["mem"][2][$j][1][$z]}}
                        @endif
                    @endfor
                    \end{bmatrix}$$ <br>
                @endfor
            </div>
        @endif
    </div><br>
    @if ($data["check"] == "true")
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{__('neville.initial_data')}}</h2>
                    <b>\[X = [
                    @foreach ($data["arrx"] as $x)
                        @if($loop->last)
                            {{$x}}
                        @else
                            {{$x}},
                        @endif
                    @endforeach
                    ]\]
                    \[Y = [
                    @foreach ($data["arry"] as $y)
                        @if($loop->last)
                            {{$y}}
                        @else
                            {{$y}},
                        @endif
                    @endforeach
                    ]\]
                </div>
                <div class="card-body">

                @if ($data["error"][0] == false)
                    <h2>Result</h2>
                    \[  {{__('neville.interpolated')}} \space y = {{$data["interpolated_y"][0]}} \\ \]
                @else
                    <p>Error: {{ $data["error"][0] }}</p> 
                @endif
                </div>
            </div>
        </div> 
    </div> 
    @endif
</div>
@endsection