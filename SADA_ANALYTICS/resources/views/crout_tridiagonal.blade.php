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
                }
                document.getElementById("separador").style.display = 'block';
                document.getElementById("matrix_a").style.display = 'block';
                document.getElementById("vector_b").style.display = 'block'; 
                document.getElementById("solve").style.display = 'block';
            }
        }
    </script>
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{route('crout_tridiagonal_method')}}" class="form">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>{{ __('crout_tridiagonal.dimension') }}</label>
                        <input type="number" id="dimension" min="2" class="form-control" placeholder="Matrix dimension" name="n" step="any" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <a id="filldetails" onclick="addFields()" class="btn btn-outline-primary btn-block">{{ __('crout_tridiagonal.create_matrix') }}</a> 
                    </div>
                    <div class="form-group col-md-6">
                        <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">{{ __('crout_tridiagonal.solve') }}</button> 
                    </div>
                </div>
                <div id="matrix_a" class="text-align metodo"> {{ __('crout_tridiagonal.label.matrix_a') }} </div>
                <div id="matrix" class="text-align"> </div>
                
                <div id="separador" class="text-align metodo"> {{ __('crout_tridiagonal.separator') }}</div>
                <div id="vector_b" class="text-align metodo"> {{ __('crout_tridiagonal.label.vector_b') }} </div>
                <div id="vector" class="text-align"> </div>
            </form>
        </div>
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