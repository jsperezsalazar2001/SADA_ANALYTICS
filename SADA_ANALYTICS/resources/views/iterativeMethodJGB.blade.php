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
            var container_vector_x = document.getElementById("vectorx");
            // Clear previous contents of the container
            while (container_matrix.hasChildNodes()) {
                container_matrix.removeChild(container_matrix.lastChild);
            }
            while (container_vector.hasChildNodes()) {
                container_vector.removeChild(container_vector.lastChild);
            }
            while (container_vector_x.hasChildNodes()) {
                container_vector_x.removeChild(container_vector_x.lastChild);
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

                    //container_vector.appendChild(document.createElement("br"));
                    //container_vector.appendChild(document.createElement("br"));
                    // Append a node with a random text
                    container_vector_x.appendChild(document.createTextNode(""));
                    // Create an <input> element for vector B, set its type and name attributes
                    var vector_aux = document.createElement("input");
                    vector_aux.type = "number";
                    vector_aux.name = "vector_x" + i ;
                    vector_aux.style = "width : 110px;";
                    vector_aux.step = "any";
                    vector_aux.required = true;
                    container_vector_x.appendChild(vector_aux);
                }
                document.getElementById("separador").style.display = 'block';
                //document.getElementById("separador_x").style.display = 'block';
                document.getElementById("matrix_a").style.display = 'block';
                document.getElementById("vector_b").style.display = 'block'; 
                document.getElementById("vector_x").style.display = 'block'; 
                document.getElementById("solve").style.display = 'block';
                document.getElementById("additional_values").style.display = 'block';
            }
        }
    </script>
</head>
<div class="container col-10" align="center">
    <div class="row justify-content-center">
        <div class="col-12">
            <form method="POST" action="{{route('iterative_j_g_b_values')}}" class="form">
                @csrf
                <div class="form-row col-12" align="center">
                    <div class="form-group col-md-6">
                        <label>{{ __('iterative_j_g_b_method.dimension') }}</label>
                        <input type="number" id="dimension" min="2" class="form-control" placeholder="Matrix dimension" name="n" step="any" required />
                    </div>
                        <!-- este div es el que pone feo la vista --> 
                    <div class="form-group col-md-6">
                        <label> {{ __('iterative_j_g_b_method.label.method_type') }} </label>
                        <select name="method_type" class="form-control">
                            <option value="J"> {{ __('iterative_j_g_b_method.input.jacobi_method') }} </option> 
                            <option value="GS">{{ __('iterative_j_g_b_method.input.gauss_seidel_method') }}</option>
                        </select>
                    </div>
                </div><br/>
                <div class="form-row col-12 metodo" id="additional_values">
                    <div class="form-group col-md-6">
                        <label> {{ __('iterative_j_g_b_method.input.tolerance') }} </label>
                        <input type="number" min="0" class="form-control" placeholder="{{ __('iterative_j_g_b_method.label.tolerance') }}" name="tolerance" step="any" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label> {{ __('iterative_j_g_b_method.input.iteration') }} </label>
                        <input type="number" min="0" class="form-control" placeholder="{{ __('iterative_j_g_b_method.label.iteration') }}" name="iteration" required />
                    </div>
                </div><br/>
                <div class="form-row col-12">
                    <div class="form-group col-6">
                        <a id="filldetails" onclick="addFields()" class="btn btn-outline-primary btn-block">{{ __('iterative_j_g_b_method.create_matrix') }}</a> 
                    </div>
                    <div class="form-group col-6">
                        <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">{{ __('iterative_j_g_b_method.solve') }}</button> 
                    </div>
                </div>
                <div id="matrix_a" class="text-align metodo"> {{ __('iterative_j_g_b_method.label.matrix_a') }} </div>
                <div id="matrix" class="text-align"> </div>
                
                <div id="separador" class="text-align metodo"> {{ __('iterative_j_g_b_method.separator') }}</div>
                <div id="vector_b" class="text-align metodo"> {{ __('iterative_j_g_b_method.label.vector_b') }} </div>
                <div id="vector" class="text-align"> </div>

                <div id="vector_x" class="text-align metodo"> {{ __('iterative_j_g_b_method.label.vector_b') }} X </div>
                <div id="vectorx" class="text-align"> </div>
            </form>
        </div>
    </div><br/>
    @if ($data["solution"] == "true" )
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h1>Solution</h1>
                <br>
                </div>
                <div class="card-body">
                    <div>
                        $$T = \begin{pmatrix}
                        @for ($i = 0; $i < count($data["json_matrix"]["T"]); $i++)
                                
                            @for ($v = 0; $v < count($data["json_matrix"]["T"][$i]); $v++)
                                @if($v == count($data["json_matrix"]["T"][$i])-1)
                                    {{ $data["json_matrix"]["T"][$i][$v]}} \\
                                @else
                                    {{ $data["json_matrix"]["T"][$i][$v]}} &
                                @endif
                            @endfor
                            
                        @endfor
                        \end{pmatrix}$$
                        <br>
                        $$C = \begin{bmatrix}
                        @foreach ($data["json_matrix"]["C"] as $solution)
                            @if($loop->last)
                                {{$solution}}
                            @else
                                {{$solution}} & 
                            @endif
                        @endforeach
                        \end{bmatrix}$$

                        <br>

                        $$\textbf {Spectral radius = } {{$data["json_matrix"]["spectral_radius"]}} $$

                        <br>
                        <table class="table table-striped" align="center">
                            <thead>
                                <tr>
                                    <th>Iteration</th>
                                    <th>Error</th>
                                    <th colspan="{{$data['dimension']}}">Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < count($data["json_table"]); $i++)
                                    <tr>
                                        <th>{{$data["json_table"][$i][0]}}</th>
                                        <th>{{$data["json_table"][$i][1]}}</th>
                                        @for ($j = 0; $j < count($data["json_table"][$i][2]); $j++)
                                            <th>{{$data["json_table"][$i][2][$j]}}</th>
                                        @endfor
                                    </tr>
                                    
                                @endfor
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection