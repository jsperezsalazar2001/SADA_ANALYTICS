@extends('layouts.master')

@section("title", $data["title"])

@section('content')
<head>
    <script type='text/javascript'>
        function addFields(){
            var number = document.getElementById("dimension").value;
            var container_matrix = document.getElementById("matrix");
            var container_vector = document.getElementById("vector");
            while (container_matrix.hasChildNodes()) {
                container_matrix.removeChild(container_matrix.lastChild);
            }
            while (container_vector.hasChildNodes()) {
                container_vector.removeChild(container_vector.lastChild);
            }
            if (number>1) {
                for (i=0;i<number;i++) {
                    for (j=0;j<number;j++){
                        container_matrix.appendChild(document.createTextNode(""));
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
                    container_vector.appendChild(document.createTextNode(""));

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
<div class="container" align="center">
    @include('layouts.message')
    <div class="row justify-content-center sizeMatrix">
        <div class="col-md-6">
            <form method="POST" action="{{route('doolitle_method')}}" class="form">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Dimension</label>
                        <input type="number" id="dimension" min="2" class="form-control" placeholder="Matrix dimension" name="n" step="any" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <a id="filldetails" onclick="addFields()" class="btn btn-outline-primary btn-block">Create Matrix</a> 
                    </div>
                    <div class="form-group col-md-12">
                        <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">Solve</button> 
                    </div>
                </div>
                <div id="matrix_a" class="text-align metodo"> A Matrix </div>
                <div id="matrix" class="text-align"> </div>
                
                <div id="separador" class="text-align metodo"> {{ __('gaussian_method.separator') }}</div>
                <div id="vector_b" class="text-align metodo"> Vector b </div>
                <div id="vector" class="text-align"> </div>
            </form>
        </div>
    </div>
    @if ($data["solution"] == "true")
        <div class="card">
            <div class="card-header">
                <h1>Solution</h1>
            <br>
            </div>
            <div class="card-body">
                <div>
                    @for ($i = 0; $i < count($data["stepL"]); $i++)
                        <b><em>Step {{$i}}</em></b>

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
    @endif
</div>
@endsection