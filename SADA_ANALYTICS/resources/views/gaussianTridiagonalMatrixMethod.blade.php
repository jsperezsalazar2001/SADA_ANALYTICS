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
            var container_vectorc = document.getElementById("vectorc");
            var container_vectord = document.getElementById("vectord");
            // Clear previous contents of the container
            while (container_matrix.hasChildNodes()) {
                container_matrix.removeChild(container_matrix.lastChild);
            }
            while (container_vector.hasChildNodes()) {
                container_vector.removeChild(container_vector.lastChild);
            }
            while (container_vectorc.hasChildNodes()) {
                container_vectorc.removeChild(container_vectorc.lastChild);
            }
            while (container_vectord.hasChildNodes()) {
                container_vectord.removeChild(container_vectord.lastChild);
            }
            if (number>1) {
                for (i=0;i<number;i++) {
                    
                    if (i>0) {
                        // Append a node with a random text
                        container_matrix.appendChild(document.createTextNode(""));
                        // Create an <input> element for matrix A, set its type and name attributes
                        var input = document.createElement("input");
                        input.type = "number";
                        input.name = "a" + i;
                        input.style = "width : 110px;";
                        input.step = "any";
                        input.required = true;
                        container_matrix.appendChild(input);    


                        // Append a node with a random text
                        container_vectorc.appendChild(document.createTextNode(""));
                        // Create an <input> element for vector B, set its type and name attributes
                        var vector_c = document.createElement("input");
                        vector_c.type = "number";
                        vector_c.name = "c" + i ;
                        vector_c.style = "width : 110px;";
                        vector_c.step = "any";
                        vector_c.required = true;
                        container_vectorc.appendChild(vector_c);                    
                    }
                    

                    // Append a node with a random text
                    container_vector.appendChild(document.createTextNode(""));
                    // Create an <input> element for vector B, set its type and name attributes
                    var vector = document.createElement("input");
                    vector.type = "number";
                    vector.name = "b" + i ;
                    vector.style = "width : 110px;";
                    vector.step = "any";
                    vector.required = true;
                    container_vector.appendChild(vector);

                    

                    // Append a node with a random text
                    container_vectord.appendChild(document.createTextNode(""));
                    // Create an <input> element for vector B, set its type and name attributes
                    var vector_d = document.createElement("input");
                    vector_d.type = "number";
                    vector_d.name = "d" + i ;
                    vector_d.style = "width : 110px;";
                    vector_d.step = "any";
                    vector_d.required = true;
                    container_vectord.appendChild(vector_d);
                }
                document.getElementById("matrix_a").style.display = 'block';
                document.getElementById("vector_b").style.display = 'block';
                document.getElementById("vector_c").style.display = 'block';
                document.getElementById("vector_d").style.display = 'block';
                document.getElementById("solve").style.display = 'block';
            }
        }
    </script>
</head>
<div class="container col-10" align="center">
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-12">
            <form method="POST" action="{{route('gaussian_tridiagonal_matrix_method')}}" class="form">
                @csrf
                <div class="form-row">
                    <div class="col-3"></div>
                    <div class="form-group col-6">
                        <label>{{ __('gaussian_tridiagonal_matrix.dimension') }}</label>
                        <input type="number" id="dimension" min="2" class="form-control" placeholder="Matrix dimension" name="n" step="any" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3"></div>
                    <div class="form-group col-3">
                        <a id="filldetails" onclick="addFields()" class="btn btn-outline-primary btn-block">{{ __('gaussian_tridiagonal_matrix.create_arrays') }}</a> 
                    </div>
                    <div class="form-group col-3">
                        <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">{{ __('gaussian_tridiagonal_matrix.solve') }}</button> 
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div id="matrix_a" class="text-align metodo"> {{ __('gaussian_tridiagonal_matrix.a') }} </div>
                        <div id="matrix" class="text-align"> </div>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col">
                        <div id="vector_b" class="text-align metodo"> {{ __('gaussian_tridiagonal_matrix.b') }} </div>
                        <div id="vector" class="text-align"> </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <div id="vector_c" class="text-align metodo"> {{ __('gaussian_tridiagonal_matrix.c') }} </div>
                        <div id="vectorc" class="text-align"> </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <div id="vector_d" class="text-align metodo"> {{ __('gaussian_tridiagonal_matrix.d') }} </div>
                        <div id="vectord" class="text-align"> </div>
                    </div>
                </div>
            </form>
        </div>
    </div><br/>
    @if ($data["solution"] == "true")
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('gaussian_tridiagonal_matrix.card_header') }}</h1>
                </div>
                <div class="card-body" align="center">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <b><em>{{ __('gaussian_tridiagonal_matrix.v_matrix') }}</em></b>
                            <br>
                            @for ($i = 0; $i < count($data["table"])-1; $i++)
                                <b><em>Step {{$i}}</em></b>
                                $$A = \begin{pmatrix}
                                @for ($j = 0; $j < count($data["table"][$i]); $j++)
                                    
                                    @for ($v = 0; $v < count($data["table"][$i][$j]); $v++)
                                        @if($v == count($data["table"][$i][$j])-1)
                                            {{ $data["table"][$i][$j][$v]}} \\
                                        @else
                                            {{ $data["table"][$i][$j][$v]}} &
                                        @endif
                                    @endfor

                                @endfor
                                \end{pmatrix}$$
                            @endfor
                            
                            $$X = \begin{bmatrix}
                            @foreach ($data["table"]["x"] as $solution)
                                @if($loop->last)
                                    {{$solution}}
                                @else
                                    {{$solution}} \\
                                @endif
                            @endforeach
                            \end{bmatrix}$$
                        </div></br>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection