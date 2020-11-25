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
            if (number>10) {
                number=10;
            }
            if (number < 2){
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
                    container_vector_x.appendChild(document.createElement("br"));
                    container_vector_x.appendChild(document.createElement("br"));
                }
                //document.getElementById("separador").style.display = 'block';
                //document.getElementById("separador_x").style.display = 'block';
                document.getElementById("matrix_a").style.display = 'block';
                document.getElementById("vector_b").style.display = 'block'; 
                document.getElementById("vector_x").style.display = 'block'; 
                document.getElementById("solve").style.display = 'block';
                //document.getElementById("additional_values_i").style.display = 'block';
                document.getElementById("additional_values").style.display = 'block';
                //document.getElementById("w").style.display = 'block';
                document.getElementById("save").style.display = 'block';
            }
        }
        function selectChange(){
            var method_type = document.getElementById("method_type").value;
            if (method_type == "SOR") {
                document.getElementById("additional_values_w").style.display = 'block';
            }else{
                document.getElementById("additional_values_w").style.display = 'none';
            }
        }
        function selectChange2(){
            var method_type = document.getElementById("method_type2").value;
            if (method_type == "SOR") {
                document.getElementById("additional_values_w2").style.display = 'block';
            }else{
                document.getElementById("additional_values_w2").style.display = 'none';
            }
        }
    </script>
</head>
<div class="container" align="center">
    <h2> {{ __('iterative_j_g_b_method.title') }} </h2>
    @include('layouts.message')
    <div class="row justify-content-center sizeMatrix">
        <div class="col-md-6" style="float: left;">
            <p>
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-info-circle"></i> {{ __('iterative_j_g_b_method.help') }}</a>
            </p>
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <strong>{{ __('iterative_j_g_b_method.help_list.example') }}</strong>
                    <br>
                    $$\begin{bmatrix}
                    n_{11} & n_{12} & n_{13} \\
                    n_{21} & n_{22} & n_{23} \\
                    n_{31} & n_{32} & n_{33} \\
                    \end{bmatrix}$$

                    $$\begin{bmatrix}
                    b_{1} \\
                    b_{2} \\
                    b_{3} 
                    \end{bmatrix}$$

                    $$\begin{bmatrix}
                    X0_{1} \\
                    X0_{2} \\
                    X0_{3} 
                    \end{bmatrix}$$
                    
                    <li>{{ __('iterative_j_g_b_method.help_list.dimension') }}</li>
                    <li>{{ __('iterative_j_g_b_method.help_list.fill') }}</li>
                    <li>{{ __('iterative_j_g_b_method.help_list.determinant') }}</li>
                </div>
            </div>
            <br>
            <form method="POST" action="{{route('iterative_j_g_b_values')}}" class="form">
                @csrf
                @if($data["storage"] == "true")
                    <div class="text-align">
                        {{ __('iterative_j_g_b_method.label.matrix_a') }} = <br>
                        @for($i = 0; $i < count($data["information"][0][0]); $i++)
                            @for($j = 0; $j < count($data["information"][0][0]); $j++)
                            <input type="number" step="any" name="matrix{{$i}}{{$j}}" style="width: 110px" placeholder="{{$data['information'][0][$i][$j]}}" value="{{$data['information'][0][$i][$j]}}">    
                            @endfor <br><br>
                        @endfor
                        <div class="row col-12">
                            <div class="col-6" >
                        {{ __('iterative_j_g_b_method.label.vector_b') }} = <br>
                        @for($i = 0; $i < count($data["information"][0][0]); $i++)
                                <input type="number" step="any" name="vector{{$i}}" style="width: 110px" placeholder="{{$data['information'][1][$i]}}" value="{{$data['information'][1][$i]}}"> <br><br>
                        @endfor <br><br>
                            </div>
                            <div class="col-6" >
                        {{ __('iterative_j_g_b_method.label.vector_x') }} = <br>
                        @for($i = 0; $i < count($data["information"][0][0]); $i++)
                            <input type="number" step="any" name="vector_x{{$i}}" style="width: 110px"> <br><br>
                        @endfor <br><br>
                            </div>
                        </div>
                        <div class="form-row col-12">
                            <div class="form-group col-6">
                                <label> {{ __('iterative_j_g_b_method.input.tolerance') }} </label>
                                <input type="number" min="0" class="form-control" placeholder="{{ __('iterative_j_g_b_method.label.tolerance') }}" name="tolerance" step="any" required />
                            </div><br/>
                            <div class="form-group col-6">
                                <label> {{ __('iterative_j_g_b_method.input.iteration') }} </label>
                                <input type="number" min="0" class="form-control" placeholder="{{ __('iterative_j_g_b_method.label.iteration') }}" name="iteration" required />
                            </div><br/>
                        </div>
                        <div class="form-row col-12 metodo" id="additional_values_w2">
                            <div class="form-group col-md-6" >
                                <label> {{ __('iterative_j_g_b_method.input.w') }} </label>
                                <input type="number" min="0" step="any" class="form-control" placeholder="{{ __('iterative_j_g_b_method.label.iteration') }}" name="w" />
                            </div><br/>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="number" id="dimension" min="2" class="form-control" placeholder="{{$data['information'][2]}}" value="{{$data['information'][2]}}" name="n" step="any" required hidden="true" />
                        </div>
                        <div class="form-group col-md-12">
                            <label> {{ __('iterative_j_g_b_method.label.method_type') }} </label>
                            <select id="method_type2" onchange="selectChange2()"  name="method_type" class="form-control">
                                <option value="J"> {{ __('iterative_j_g_b_method.input.jacobi_method') }} </option> 
                                <option value="GS">{{ __('iterative_j_g_b_method.input.gauss_seidel_method') }}</option>
                                <option value="SOR">{{ __('iterative_j_g_b_method.input.sor') }}</option>
                            </select>
                        </div>
                        <div class="custom-control custom-checkbox col-md-12">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">{{ __('iterative_j_g_b_method.save') }}</label>
                        </div><br><br>
                        <button type="submit" class="btn btn-outline-success btn-block">Solve</button>
                        <a class="btn btn-outline-primary btn-block" href="{{ route('iterative_method') }}">Try with another matrix</a>
                    </div>
                @else
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>{{ __('iterative_j_g_b_method.dimension') }}</label>
                            <input type="number" id="dimension" min="2" class="form-control" placeholder="{{ __('iterative_j_g_b_method.matrix_dimension') }}" name="n" step="any" required />
                        </div>
                            <!-- este div es el que pone feo la vista --> 
                        <div class="form-group col-md-12">
                            <label> {{ __('iterative_j_g_b_method.label.method_type') }} </label>
                            <select id="method_type" onchange="selectChange()"  name="method_type" class="form-control">
                                <option value="J"> {{ __('iterative_j_g_b_method.input.jacobi_method') }} </option> 
                                <option value="GS">{{ __('iterative_j_g_b_method.input.gauss_seidel_method') }}</option>
                                <option value="SOR">{{ __('iterative_j_g_b_method.input.sor') }}</option>
                            </select>
                        </div>
                        <div class="custom-control custom-checkbox col-md-12" style="display: none" id="save">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline"> {{ __('iterative_j_g_b_method.save') }}</label>
                        </div><br><br>
                        
                    </div>
                    <div class="form-row col-12 metodo" id="additional_values">
                        <div class="form-group col-6">
                            <label> {{ __('iterative_j_g_b_method.input.tolerance') }} </label>
                            <input type="number" min="0" class="form-control" placeholder="{{ __('iterative_j_g_b_method.label.tolerance') }}" name="tolerance" step="any" required />
                        </div><br/>
                        <div class="form-group col-6">
                            <label> {{ __('iterative_j_g_b_method.input.iteration') }} </label>
                            <input type="number" min="0" class="form-control" placeholder="{{ __('iterative_j_g_b_method.label.iteration') }}" name="iteration" required />
                        </div><br/>
                    </div>
                    <div class="form-row col-12 metodo" id="additional_values_w">
                        <div class="form-group col-md-6" >
                            <label> {{ __('iterative_j_g_b_method.input.w') }} </label>
                            <input type="number" min="0" step="any" class="form-control" placeholder="{{ __('iterative_j_g_b_method.label.iteration') }}" name="w" />
                        </div><br/>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <a id="filldetails" onclick="addFields()" class="btn btn-outline-primary btn-block">{{ __('iterative_j_g_b_method.create_matrix') }}</a> 
                        </div>
                        <div class="custom-control custom-checkbox col-md-12" style="display: none" id="save">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">{{ __('iterative_j_g_b_method.save') }}</label>
                        </div><br><br>
                        <div class="form-group col-md-12">
                            <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">{{ __('iterative_j_g_b_method.solve') }}</button> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div id="matrix_a" class="text-align metodo"> {{ __('iterative_j_g_b_method.label.matrix_a') }} </div>
                            <div id="matrix" class="text-align"></div>
                        </div>
                    </div>
                    <div id="separador" class="text-align metodo"> {{ __('iterative_j_g_b_method.separator') }}</div>
                    <div class="row col-12">
                        <div class="col-6" >
                            <div id="vector_b" class="text-align metodo"> {{ __('iterative_j_g_b_method.label.vector_b') }} </div>
                            <div id="vector" class="text-align"></div>
                        </div>
                        <div class="col-6" >
                            <div id="vector_x" class="text-align metodo"> {{ __('iterative_j_g_b_method.label.vector_x') }} </div>
                            <div id="vectorx" class="text-align"></div>
                        </div>
                    </div>
                @endif
            </form>
        </div>

        @if ($data["checkMem"] == "true" and $data["mem"][1][0] != 0)
            <div class="col-md-6" style="float: right;">
                <p>
                    @if (count($data["mem"][1]) > 1)
                        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2"><i class="fa fa-info-circle"></i> Matrices Saved</a>
                    @endif 
                </p>
                <div class="collapse multi-collapse" id="multiCollapseExample2">
                    @for($j = 1; $j < count($data["mem"][1]); $j++)
                        <a class="btn btn-outline-primary" href="{{ route('storage_iterative_method',['storage'=> $j,'method' => 1]) }}">Use Storage {{$j}}</a> <br><br>
                        $$A = \begin{bmatrix}
                        @for($z = 0; $z < count($data["mem"][1][$j][0]); $z++)
                            @for($f = 0; $f < count($data["mem"][1][$j][0][$z]); $f++)
                                @if($f != count($data["mem"][1][$j][0][$z])-1)
                                    {{$data["mem"][1][$j][0][$z][$f]}} & 
                                @else 
                                    {{$data["mem"][1][$j][0][$z][$f]}} \\
                                @endif  
                            @endfor
                        @endfor
                        \end{bmatrix}$$
                        $$b = \begin{bmatrix}
                        @for($z = 0; $z < count($data["mem"][1][$j][1]); $z++)
                            {{$data["mem"][1][$j][1][$z]}} \\
                        @endfor
                        \end{bmatrix}$$<br>
                    @endfor
                </div>
            </div>
        @endif
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
                                    <th>{{ __('iterative_j_g_b_method.table.iteration') }}</th>
                                    <th>{{ __('iterative_j_g_b_method.table.error') }}</th>
                                    <th colspan="{{$data['dimension']}}">{{ __('iterative_j_g_b_method.table.point') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data["show_table"] == "true" )
                                    @for ($i = 0; $i < count($data["json_table"]); $i++)
                                        <tr>
                                            <th>{{$data["json_table"][$i][0]}}</th>
                                            <th>{{$data["json_table"][$i][1]}}</th>
                                            @for ($j = 0; $j < count($data["json_table"][$i][2]); $j++)
                                                <th>{{$data["json_table"][$i][2][$j]}}</th>
                                            @endfor
                                        </tr>
                                        
                                    @endfor
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection