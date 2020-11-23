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
            }
        }
    </script>
</head>
<div class="container col-10" align="center">
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-12">
            <p>
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-info-circle"></i> {{ __('vandermonde_method.help') }}</a>
            </p>
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <strong>{{ __('vandermonde_method.help_list.example') }}</strong>
                    <br>
                    $$\begin{bmatrix}
                    x_{1} & x_{2} & x_{3} & x_{4} \\
                    y_{1} & y_{2} & y_{3} & y_{4} \\
                    \end{bmatrix}$$
                    <li>{{ __('vandermonde_method.help_list.dimension') }}</li>
                    <li>{{ __('vandermonde_method.help_list.fill') }}</li>
                </div>
            </div>
            <br>
            <form method="POST" action="{{route('vandermonde_method')}}" class="form">
                @csrf
                <div class="form-row">
                    <div class="col-3"></div>
                    <div class="form-group col-6">
                        <label>{{ __('vandermonde_method.dimension') }}</label>
                        <input type="number" id="dimension" min="2" class="form-control" placeholder="{{ __('vandermonde_method.vector_dimension') }}" name="n" step="any" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3"></div>
                    <div class="form-group col-3">
                        <a id="filldetails" onclick="addFields()" class="btn btn-outline-primary btn-block">{{ __('vandermonde_method.create_arrays') }}</a> 
                    </div>
                    <div class="form-group col-3">
                        <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">{{ __('vandermonde_method.solve') }}</button> 
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div id="matrix_a" class="text-align metodo"> {{ __('vandermonde_method.x') }} </div>
                        <div id="matrix" class="text-align"> </div>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col">
                        <div id="vector_b" class="text-align metodo"> {{ __('vandermonde_method.y') }} </div>
                        <div id="vector" class="text-align"> </div>
                    </div>
                </div>
            </form>
        </div>
    </div><br/>
    @if ($data["solution"] == "true")
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('vandermonde_method.card_header') }}</h1>
                </div>
                <div class="card-body" align="center">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <b><em>{{ __('vandermonde_method.v_matrix') }}</em></b>
                            $$\begin{pmatrix}
                            @for ($i = 0; $i < count($data["v_matrix"]); $i++)
                                    
                                @for ($v = 0; $v < count($data["v_matrix"][$i]); $v++)
                                    @if($v == count($data["v_matrix"][$i])-1)
                                        {{ $data["v_matrix"][$i][$v]}} \\
                                    @else
                                        {{ $data["v_matrix"][$i][$v]}} &
                                    @endif
                                @endfor
                                
                            @endfor
                            \end{pmatrix}$$
                            <br/>
                            <b><em>{{ __('vandermonde_method.coef_polynomial') }}</em></b>
                            <div class="col-6">
                                <table class="table table-striped" align="center">
                                    <tbody>
                                        @for ($v = 0; $v < count($data["coef"]); $v++)
                                        <tr>
                                            <th>{{ ($v + 1) }}</th>
                                            @if($v == count($data["coef"])-1)
                                            <th>{{ $data["coef"][$v] }}</th>   
                                            @else
                                            <th>{{ $data["coef"][$v] }}</th>
                                            @endif
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                            <b><em>{{ __('vandermonde_method.polynomial') }}</em></b>
                            \[ {{ $data["polynomial"] }} \]
                        </div></br>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection