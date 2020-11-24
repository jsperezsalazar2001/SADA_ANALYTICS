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
            if (number>1) {
                for (i=0;i<number;i++) {
                    for (j=0;j<number;j++){
                        // Append a node with a random text
                        container_matrix.appendChild(document.createTextNode(""));
                        // Create an <input> element for matrix A, set its type and name attributes
                        var input = document.createElement("input");
                        input.type = "number";
                        input.name = "matrix" + i + j;
                        input.style = "width : 110px;";
                        input.step = "any";
                        input.required = true;
                        container_matrix.appendChild(input);
                    }
                    container_matrix.appendChild(document.createElement("br"));
                    container_matrix.appendChild(document.createElement("br"));
                    // Append a node with a random text
                    container_vector.appendChild(document.createTextNode(""));
                    // Create an <input> element for vector B, set its type and name attributes
                    var vector = document.createElement("input");
                    vector.type = "number";
                    vector.name = "vector" + i ;
                    vector.style = "width : 110px;";
                    vector.step = "any";
                    vector.required = true;
                    container_vector.appendChild(vector);
                    container_vector.appendChild(document.createElement("br"));
                    container_vector.appendChild(document.createElement("br"));
                }
                document.getElementById("matrix_a").style.display = 'block';
                document.getElementById("vector_b").style.display = 'block'; 
                document.getElementById("solve").style.display = 'block';
                document.getElementById("save").style.display = 'block';
            }
        }
    </script>
</head>
<div class="container col-10" align="center">
    @include('layouts.message')
    <div class="row justify-content-center sizeMatrix">
        <div class="col-md-6" style="float: left;">
            <p>
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-info-circle"></i> {{ __('crout_method.help') }}</a>
            </p>
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <strong>{{ __('crout_method.help_list.example') }}</strong>
                    <br>
                    $$\begin{bmatrix}
                    n_{11} & n_{12} & n_{13} \\
                    n_{21} & n_{22} & n_{23} \\
                    n_{31} & n_{32} & n_{33} \\
                    \end{bmatrix}$$
                    <li>{{ __('crout_method.help_list.dimension') }}</li>
                    <li>{{ __('crout_method.help_list.fill') }}</li>
                    <li>{{ __('crout_method.help_list.determinant') }}</li>
                </div>
            </div>
            <br>
            <form method="POST" action="{{route('crout_method')}}" class="form">
                @csrf
                @if($data["storage"] == "true")
                    <div class="text-align">
                        Matrix A = <br>
                        @for($i = 0; $i < count($data["information"][0][0]); $i++)
                            @for($j = 0; $j < count($data["information"][0][0]); $j++)
                            <input type="number" step="any" name="matrix{{$i}}{{$j}}" style="width: 110px" placeholder="{{$data['information'][0][$i][$j]}}" value="{{$data['information'][0][$i][$j]}}">    
                            @endfor <br><br>
                        @endfor
                        Vector b = <br>
                        @for($i = 0; $i < count($data["information"][0][0]); $i++)
                            <input type="number" step="any" name="vector{{$i}}" style="width: 110px" placeholder="{{$data['information'][1][$i]}}" value="{{$data['information'][1][$i]}}"> 
                        @endfor <br><br>
                        <div class="form-group col-md-12">
                            <input type="number" id="dimension" min="2" class="form-control" placeholder="{{$data['information'][2]}}" value="{{$data['information'][2]}}" name="n" step="any" required hidden="true" />
                        </div>
                        <div class="custom-control custom-checkbox col-md-12">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">Save Matrix</label>
                        </div><br><br>
                        <button type="submit" class="btn btn-outline-success btn-block">Solve</button>
                        <a class="btn btn-outline-primary btn-block" href="{{ route('crout') }}">Try with another matrix</a>
                    </div>
                @else
                    <div class="form-row">
                        <div class="col-3"></div>
                        <div class="form-group col-12">
                            <label>{{ __('crout_method.dimension') }}</label>
                            <input type="number" id="dimension" min="2" class="form-control" placeholder="{{ __('crout_method.matrix_dimension') }}" name="n" step="any" required />
                        </div>
                            <!-- este div es el que pone feo la vista --> 

                    </div>
                    <div class="form-row">
                        <div class="col-3"></div>
                        <div class="form-group col-12">
                            <a id="filldetails" onclick="addFields()" class="btn btn-outline-primary btn-block">{{ __('crout_method.create_matrix') }}</a> 
                        </div>
                    </div>
                    <div class="custom-control custom-checkbox col-md-12" style="display: none" id="save">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">Save Matrix</label>
                    </div><br><br>
                    <div class="form-row">
                        <div class="col-3"></div>
                        <div class="form-group col-12">
                            <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">{{ __('crout_method.solve') }}</button> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="matrix_a" class="text-align metodo"> {{ __('crout_method.label.matrix_a') }} </div>
                            <div id="matrix" class="text-align"> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="vector_b" class="text-align metodo"> {{ __('crout_method.label.vector_b') }} </div>
                            <div id="vector" class="text-align"> </div>
                        </div>
                    </div>
                @endif
            </form>
        </div>

         @if ($data["checkMem"] == "true" and $data["mem"][1][0] != 0)
                <div class="col-md-6" style="float: right;">
                   <h3>Matrices Saved</h3> 
                    @for($j = 1; $j < count($data["mem"][1]); $j++)
                        <a class="btn btn-outline-primary" href="{{ route('storage_crout_method',['storage'=> $j,'method' => 1]) }}">Use Storage {{$j}}</a> <br><br>
                        Matrix A = <br>
                        @for($z = 0; $z < count($data["mem"][1][$j][0]); $z++)
                            [
                            @for($f = 0; $f < count($data["mem"][1][$j][0][$z]); $f++)
                                @if($f != count($data["mem"][1][$j][0][$z])-1)
                                    {{$data["mem"][1][$j][0][$z][$f]}},
                                @else 
                                    {{$data["mem"][1][$j][0][$z][$f]}}
                                @endif  
                            @endfor
                            ]
                            <br>
                        @endfor
                        <br>
                        Vector b = <br>
                        [
                        @for($z = 0; $z < count($data["mem"][1][$j][1]); $z++)
                            
                            @if($z != count($data["mem"][1][$j][1])-1)
                                {{$data["mem"][1][$j][1][$z]}},
                            @else 
                                {{$data["mem"][1][$j][1][$z]}}
                            @endif
                        @endfor
                        ]<br><br>
                    @endfor
                </div>
        @endif

    </div><br/>
    @if ($data["solution"] == "true")
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h1>Solution</h1>
                <br>
                </div>
                <div class="card-body">
                    <div>
                        @for ($i = 0; $i < count($data["stepL"]); $i++)
                            <b><em>Step {{$i}}</em></b>

                            $$A = \begin{pmatrix}
                            @for ($j = 0; $j < count($data["stepA"][$i]); $j++)
                                
                                @for ($v = 0; $v < count($data["stepA"][$i][$j]); $v++)
                                    @if($v == count($data["stepA"][$i][$j])-1)
                                        {{ $data["stepA"][$i][$j][$v]}} \\
                                    @else
                                        {{ $data["stepA"][$i][$j][$v]}} &
                                    @endif
                                @endfor
                                
                            @endfor
                            \end{pmatrix}$$

                            $$L = \begin{pmatrix}
                            @for ($j = 0; $j < count($data["stepL"][$i]); $j++)
                                
                                @for ($v = 0; $v < count($data["stepL"][$i][$j]); $v++)
                                    @if($v == count($data["stepL"][$i][$j])-1)
                                        {{ $data["stepL"][$i][$j][$v]}} \\
                                    @else
                                        {{ $data["stepL"][$i][$j][$v]}} &
                                    @endif
                                @endfor
                                
                            @endfor
                            \end{pmatrix}$$

                            $$U = \begin{pmatrix}
                            @for ($j = 0; $j < count($data["stepU"][$i]); $j++)
                                
                                @for ($v = 0; $v < count($data["stepU"][$i][$j]); $v++)
                                    @if($v == count($data["stepU"][$i][$j])-1)
                                        {{ $data["stepU"][$i][$j][$v]}} \\
                                    @else
                                        {{ $data["stepU"][$i][$j][$v]}} &
                                    @endif
                                @endfor
                                
                            @endfor
                            \end{pmatrix}$$  
                        @endfor

                        $$X = \begin{bmatrix}
                        @foreach ($data["xSolution"][0] as $solution)
                            @if($loop->last)
                                {{$solution}}
                            @else
                                {{$solution}} \\
                            @endif
                        @endforeach
                        \end{bmatrix}$$
            
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection