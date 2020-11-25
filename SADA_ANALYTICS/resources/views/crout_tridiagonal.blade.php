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
            if (number <= 2){
                number = 2;
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
                document.getElementById("separador").style.display = 'block';
                document.getElementById("matrix_a").style.display = 'block';
                document.getElementById("vector_b").style.display = 'block'; 
                document.getElementById("solve").style.display = 'block';
                document.getElementById("save").style.display = 'block';
            }
        }
    </script>
</head>
<div class="container" align="center">
    <h2>{{$data["title"]}}</h2>
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <p>
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-info-circle"></i> {{ __('secant.help') }}</a>
            </p>
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <strong>{{ __('crout_tridiagonal.help_list.example') }}</strong>
                    <br>
                    $$\begin{bmatrix}
                    n_{11} & n_{12} & 0 & 0\\
                    n_{21} & n_{22} & n_{23} & 0\\
                    0 & n_{32} & n_{33} & n_{34}\\
                    0 & 0 & n_{43} & n_{44}\\
                    \end{bmatrix}$$

                    $$\begin{bmatrix}
                    b_{1} \\
                    b_{2} \\
                    b_{3} \\
                    b_{4} 
                    \end{bmatrix}$$
                    <li>{{ __('crout_tridiagonal.help_list.tridiagonal') }}</li>
                    <li>{{ __('crout_tridiagonal.help_list.dimension') }}</li>
                    <li>{{ __('crout_tridiagonal.help_list.fill') }}</li>
                    <li>{{ __('crout_tridiagonal.help_list.determinant') }}</li>
                </div>
            </div>
            <form method="POST" action="{{route('crout_tridiagonal_method')}}" class="form">
            @csrf
                @if($data["storage"] == "true")
                    <div class="text-align">
                        \[ A = \]<br>
                        @for($i = 0; $i < count($data["information"][0][0]); $i++)
                            @for($j = 0; $j < count($data["information"][0][0]); $j++)
                            <input type="number" step="any" name="matrix{{$i}}{{$j}}" style="width: 110px" placeholder="{{$data['information'][0][$i][$j]}}" value="{{$data['information'][0][$i][$j]}}">    
                            @endfor <br><br>
                        @endfor
                        <div> {{ __('gaussian_method.separator') }}</div>
                        \[ b = \]<br>
                        @for($i = 0; $i < count($data["information"][0][0]); $i++)
                            <input type="number" step="any" name="vector{{$i}}" style="width: 110px" placeholder="{{$data['information'][1][$i]}}" value="{{$data['information'][1][$i]}}"> <br><br>
                        @endfor <br><br>
                        <div class="form-group col-md-12">
                            <input type="number" id="dimension" min="2" class="form-control" placeholder="{{$data['information'][2]}}" value="{{$data['information'][2]}}" name="n" step="any" required hidden="true" />
                        </div>
                        <div class="custom-control custom-checkbox col-md-12">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">Save matrix after calculating</label>
                        </div><br><br>
                        <button type="submit" class="btn btn-outline-success btn-block">Solve</button>
                        <a class="btn btn-outline-primary btn-block" href="{{ route('crout_tridiagonal') }}">Try with another matrix</a>
                    </div>
                @else 
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>\[ Dimension \]</label>
                            <input type="number" id="dimension" min="2" class="form-control" placeholder="Matrix dimension" name="n" step="any" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <a id="filldetails" onclick="addFields()" class="btn btn-outline-primary btn-block">Create Matrix</a> 
                        </div>
                        <div class="custom-control custom-checkbox col-md-12" style="display: none" id="save">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">Save matrix after calculating</label>
                        </div><br><br>
                        <div class="form-group col-md-12">
                            <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">Solve</button> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="matrix_a" class="text-align metodo"> \[ A = \] </div>
                            <div id="matrix" class="text-align"> </div>
                        </div>
                    </div>
                    
                    <div id="separador" class="text-align metodo"> {{ __('gaussian_method.separator') }}</div>
                    <div class="row">
                        <div class="col">
                            <div id="vector_b" class="text-align metodo"> \[ b = \] </div>
                            <div id="vector" class="text-align"> </div>
                        </div>
                    </div>
                @endif
            </form>
        </div>
        @if ($data["checkMem"] == "true" and $data["mem"][1][0] != 0)
                <div class="col-md-6" style="float: right;">
                    @if (count($data["mem"][1]) > 1)
                        <h4>Matrices Saved</h4>
                    @endif
                    @for($j = 1; $j < count($data["mem"][1]); $j++)
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('storage_crout_tridiagonal',['storage'=> $j,'method' => 1]) }}">Use Storage {{$j}}</a> <br><br>
                        $$A = \begin{pmatrix}
                        @for($z = 0; $z < count($data["mem"][1][$j][0]); $z++)
                            @for($f = 0; $f < count($data["mem"][1][$j][0][$z]); $f++)
                                @if($f != count($data["mem"][1][$j][0][$z])-1)
                                    {{$data["mem"][1][$j][0][$z][$f]}} & 
                                @else 
                                    {{$data["mem"][1][$j][0][$z][$f]}} \\
                                @endif  
                            @endfor
                        @endfor
                        \end{pmatrix}$$
                        $$b = \begin{pmatrix}
                        @for($z = 0; $z < count($data["mem"][1][$j][1]); $z++)
                            {{$data["mem"][1][$j][1][$z]}} \\
                        @endfor
                        \end{pmatrix}$$<br>
                    @endfor
                </div>
            @endif
    </div><br/>
    @if ($data["solution"] != "form")
        <div class="card">
            <div class="card-header">
                <h2>{{ __('crout_tridiagonal.solution') }}</h2>
            <br>
            </div>
            <div class="card-body">
                <div>
                <b><em>{{ __('crout_tridiagonal.step') }} 0</em></b>

                        $$A = \begin{pmatrix}
                        @for ($j = 0; $j < count($data["matrixA"][0]); $j++)
                            
                            @for ($v = 0; $v < count($data["matrixA"][0][$j]); $v++)
                                @if($v == count($data["matrixA"][0][$j])-1)
                                    {{ $data["matrixA"][0][$j][$v]}} \\
                                @else
                                    {{ $data["matrixA"][0][$j][$v]}} &
                                @endif
                            @endfor
                            
                        @endfor
                        \end{pmatrix}$$

                    @for ($i = 0; $i < count($data["stepL"]); $i++)
                        <b><em>{{ __('crout_tridiagonal.step') }} {{$i+1}}</em></b>

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
                    @if($data["solution"] != "false")
                    $$X = \begin{bmatrix}
                    @foreach ($data["xSolution"]["solution"] as $solution)
                        @if($loop->last)
                            {{$solution}}
                        @else
                            {{$solution}} \\
                        @endif
                    @endforeach
                    \end{bmatrix}$$
                    @else
                        <p>Error: {{$data["error"]["error"]}}</p>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
@endsection