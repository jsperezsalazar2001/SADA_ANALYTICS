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
                }
                //document.getElementById("separador").style.display = 'block';
                document.getElementById("matrix_a").style.display = 'block';
                document.getElementById("vector_b").style.display = 'block'; 
                document.getElementById("solve").style.display = 'block';
                document.getElementById("save").style.display = 'block';
            }
        }
    </script>
</head>
<div class="container" align="center">
    <h2> {{ __('factorization_l_u_method.title') }} </h2>
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-6" style="float: left;">
            <p>
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-info-circle"></i> {{ __('factorization_l_u_method.help') }}</a>
            </p>
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <strong>{{ __('factorization_l_u_method.help_list.example') }}</strong>
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

                    <li>{{ __('factorization_l_u_method.help_list.dimension') }}</li>
                    <li>{{ __('factorization_l_u_method.help_list.fill') }}</li>
                    <li>{{ __('factorization_l_u_method.help_list.determinant') }}</li>
                </div>
            </div>
            <br>
            <form method="POST" action="{{route('factorization_l_u_values')}}" class="form">
                @csrf
                @if($data["storage"] == "true")
                    <div class="text-align">
                        {{ __('factorization_l_u_method.label.matrix_a') }} = <br>
                        @for($i = 0; $i < count($data["information"][0][0]); $i++)
                            @for($j = 0; $j < count($data["information"][0][0]); $j++)
                            <input type="number" step="any" name="matrix{{$i}}{{$j}}" style="width: 110px" placeholder="{{$data['information'][0][$i][$j]}}" value="{{$data['information'][0][$i][$j]}}">    
                            @endfor <br><br>
                        @endfor
                        {{ __('factorization_l_u_method.label.vector_b') }} = <br>
                        @for($i = 0; $i < count($data["information"][0][0]); $i++)
                            <input type="number" step="any" name="vector{{$i}}" style="width: 110px" placeholder="{{$data['information'][1][$i]}}" value="{{$data['information'][1][$i]}}"> 
                        @endfor <br><br>
                        <div class="form-group col-md-12">
                            <input type="number" id="dimension" min="2" class="form-control" placeholder="{{$data['information'][2]}}" value="{{$data['information'][2]}}" name="n" step="any" required hidden="true" />
                        </div>
                        <div class="form-group col-md-12">
                            <label> {{ __('factorization_l_u_method.label.method_type') }} </label>
                            <select name="method_type" class="form-control">
                                <option value="LUS">{{ __('factorization_l_u_method.input.factorization_l_u_simple_method') }}</option> 
                                <option value="LUP">{{ __('factorization_l_u_method.input.factorization_l_u_partial_method') }}</option>
                            </select>
                        </div>
                        <div class="custom-control custom-checkbox col-md-12">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline"> {{ __('factorization_l_u_method.save') }}</label>
                        </div><br><br>
                        <button type="submit" class="btn btn-outline-success btn-block">{{ __('factorization_l_u_method.solve') }}</button>
                        <a class="btn btn-outline-primary btn-block" href="{{ route('factorization_l_u') }}">Try with another matrix</a>
                    </div>
                @else
                    <div class="form-row col-12" align="center">
                        <div class="form-group col-md-6">
                            <label>{{ __('factorization_l_u_method.dimension') }}</label>
                            <input type="number" id="dimension" min="2" class="form-control" placeholder="{{ __('factorization_l_u_method.matrix_dimension') }}" name="n" step="any" required />
                        </div>
                            <!-- este div es el que pone feo la vista --> 
                        <div class="form-group col-md-6">
                            <label> {{ __('factorization_l_u_method.label.method_type') }} </label>
                            <select name="method_type" class="form-control">
                                <option value="LUS">{{ __('factorization_l_u_method.input.factorization_l_u_simple_method') }}</option> 
                                <option value="LUP">{{ __('factorization_l_u_method.input.factorization_l_u_partial_method') }}</option>
                            </select>
                        </div>
                    </div><br/>
                    <div class="form-row col-12">
                        <div class="form-group col-6">
                            <a id="filldetails" onclick="addFields()" class="btn btn-outline-primary btn-block">{{ __('factorization_l_u_method.create_matrix') }}</a> 
                        </div>
                        <div class="custom-control custom-checkbox col-md-12" style="display: none" id="save">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">{{ __('factorization_l_u_method.save') }}</label>
                        </div><br><br>
                        <div class="form-group col-6">
                            <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">{{ __('factorization_l_u_method.solve') }}</button> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div id="matrix_a" class="text-align metodo"> {{ __('factorization_l_u_method.label.matrix_a') }} </div>
                            <div id="matrix" class="text-align"> </div>
                        </div>
                    </div>
                    <div id="separador" class="text-align metodo"> {{ __('factorization_l_u_method.separator') }}</div>
                    <div class="row">
                        <div class="col">
                            <div id="vector_b" class="text-align metodo"> {{ __('factorization_l_u_method.label.vector_b') }} </div>
                            <div id="vector" class="text-align"> </div>
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
                        <a class="btn btn-outline-primary" href="{{ route('storage_factorization_l_u_method',['storage'=> $j,'method' => 1]) }}">Use Storage {{$j}}</a> <br><br>
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
    @if ($data["solution"] == "true" and !empty($data["table"]))
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h1>Solution</h1>
                <br>
                </div>
                <div class="card-body">
                    <div>
                        @for ($i = 0; $i < count($data["table_l"]); $i++)
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

                            $$L = \begin{pmatrix}
                            @for ($j = 0; $j < count($data["table_l"][$i]); $j++)
                                
                                @for ($v = 0; $v < count($data["table_l"][$i][$j]); $v++)
                                    @if($v == count($data["table_l"][$i][$j])-1)
                                        {{ $data["table_l"][$i][$j][$v]}} \\
                                    @else
                                        {{ $data["table_l"][$i][$j][$v]}} &
                                    @endif
                                @endfor
                                
                            @endfor
                            \end{pmatrix}$$

                            $$U = \begin{pmatrix}
                            @for ($j = 0; $j < count($data["table_u"][$i]); $j++)
                                
                                @for ($v = 0; $v < count($data["table_u"][$i][$j]); $v++)
                                    @if($v == count($data["table_u"][$i][$j])-1)
                                        {{ $data["table_u"][$i][$j][$v]}} \\
                                    @else
                                        {{ $data["table_u"][$i][$j][$v]}} &
                                    @endif
                                @endfor
                                
                            @endfor
                            \end{pmatrix}$$ 

                            @if($data["method_type"] == "LUP") 
                                $$P = \begin{pmatrix}
                                @for ($j = 0; $j < count($data["table_p"][$i]); $j++)
                                    
                                    @for ($v = 0; $v < count($data["table_p"][$i][$j]); $v++)
                                        @if($v == count($data["table_p"][$i][$j])-1)
                                            {{ $data["table_p"][$i][$j][$v]}} \\
                                        @else
                                            {{ $data["table_p"][$i][$j][$v]}} &
                                        @endif
                                    @endfor
                                    
                                @endfor
                                \end{pmatrix}$$
                            @endif
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
            
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection