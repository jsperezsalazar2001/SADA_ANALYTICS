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
<div class="container matrix">
    <div class="row justify-content-center sizeMatrix">
        <div class="col-md-12">
            <form method="POST" action="{{route('factorization_l_u_values')}}" class="form">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>{{ __('factorization_l_u_method.dimension') }}</label>
                        <input type="number" id="dimension" min="2" class="form-control" placeholder="Matrix dimension" name="n" step="any" required />
                    </div>
                        <!-- este div es el que pone feo la vista --> 
                    <div class="form-group col-md-6">
                        <label> {{ __('factorization_l_u_method.label.method_type') }} </label>
                        <select name="method_type" class="form-control">
                            <option value="LUS">{{ __('factorization_l_u_method.input.factorization_l_u_simple_method') }}</option> 
                            <option value="LUP">{{ __('factorization_l_u_method.input.factorization_l_u_partial_method') }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <a id="filldetails" onclick="addFields()" class="btn btn-outline-primary btn-block">{{ __('factorization_l_u_method.create_matrix') }}</a> 
                    </div>
                    <div class="form-group col-md-6">
                        <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">{{ __('factorization_l_u_method.solve') }}</button> 
                    </div>
                </div>
                <div id="matrix_a" class="text-align metodo"> {{ __('factorization_l_u_method.label.matrix_a') }} </div>
                <div id="matrix" class="text-align"> </div>
                
                <div id="separador" class="text-align metodo"> {{ __('factorization_l_u_method.separator') }}</div>
                <div id="vector_b" class="text-align metodo"> {{ __('factorization_l_u_method.label.vector_b') }} </div>
                <div id="vector" class="text-align"> </div>
            </form>
        </div>
        $$ \int f(x) dx holi $$
        <br>
        <br>
        <br>
        <br>
        <div class="form-group col-md-6">
        $$
y = \dfrac{\displaystyle \int_{x=0}^{x=2 \pi + 10} f(x) \cdot dx}{g(x)}
$$
    </div>
    </div>
    @if ($data["solution"] == "true" and !empty($data["table"]))
        <div class="card">
            <div class="card-header">
                <h1>Solution</h1>
            <br>
            </div>
            <div class="card-body">
                <div>
                    \(
                    \begin{​​bmatrix}​​ 4.000000 & -1.000000 & 0.000000 & 3.000000 \cr
1.000000 & 15.500000 & 3.000000 & 8.000000 \cr
0.000000 & -1.300000 & -4.000000 & 1.100000 \cr
14.000000 & 5.000000 & -2.000000 & 30.000000 \end{​​bmatrix}​​
                    \)
                </div>
            </div>
        </div>
    @endif
</div>
@endsection