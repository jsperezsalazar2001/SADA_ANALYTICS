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
                document.getElementById("save").style.display = 'block';
            }
        }
    </script>
</head>
<div class="container" align="center">
    <h2>Lagrange Method</h2>
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-6" style="float: left;">
            <p>
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-info-circle"></i> Help</a>
            </p>
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <li>The X coordinates array must not have repeating values.</li>
                </div>
            </div><br>
            <form method="POST" action="{{route('lagrange_method')}}" class="form">
                @csrf
                @if($data["storage"] == "true")
                    <div class="text-align">
                        \[x = \] <br>
                        @for($i = 0; $i < count($data["information"][0]); $i++)
                            <input type="number" step="any" name="x{{$i}}" style="width: 110px" placeholder="{{$data['information'][0][$i]}}" value="{{$data['information'][0][$i]}}"> 
                        @endfor <br><br>
                        \[F(x) = \]<br>
                        @for($i = 0; $i < count($data["information"][1]); $i++)
                            <input type="number" step="any" name="y{{$i}}" style="width: 110px" placeholder="{{$data['information'][1][$i]}}" value="{{$data['information'][1][$i]}}"> 
                        @endfor <br><br>
                        <div class="form-group col-md-12">
                            <input type="number" id="dimension" min="2" class="form-control" placeholder="{{$data['information'][2]}}" value="{{$data['information'][2]}}" name="n" step="any" required hidden="true" />
                        </div>
                        <div class="custom-control custom-checkbox col-md-12">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">Save Array</label>
                        </div><br><br>
                        <button type="submit" class="btn btn-outline-success btn-block">Solve</button>
                        <a class="btn btn-outline-primary btn-block" href="{{ route('lagrange') }}">Try with another arrays</a>
                    </div>
                @else 
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Dimension</label>
                            <input type="number" id="dimension" min="2" class="form-control" placeholder="Matrix dimension" name="n" step="any" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <a id="filldetails" onclick="addFields()" class="btn btn-outline-primary btn-block">Create arrays</a> 
                        </div>
                        <div class="custom-control custom-checkbox col-md-12" style="display: none" id="save">
                            <input type="checkbox" class="custom-control-input" id="customControlInline" name="save" value="save">
                            <label class="custom-control-label" for="customControlInline">Save Array</label>
                        </div><br><br>
                        <div class="form-group col-md-12">
                            <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">Solve</button> 
                        </div>
                    </div>
                    <div id="matrix_a" class="text-align metodo"> \[x = \] </div>
                    <div id="matrix" class="text-align"> </div>
                    

                    <div id="vector_b" class="text-align metodo"> \[F(x) = \] </div>
                    <div id="vector" class="text-align"> </div>
                @endif
            </form>
        </div>
        @if ($data["checkMem"] == "true" and $data["mem"][2][0] != 1)
            <div class="col-md-6" style="float: right;">
                <h3>Array Saved</h3> 
                @for($j = 1; $j < count($data["mem"][2]); $j++)
                    <a class="btn btn-outline-primary" href="{{ route('storage_lagrange',['storage'=> $j,'method' => 2]) }}">Use Storage {{$j}}</a> <br><br>
                    Vector x = <br>
                    [
                    @for($z = 0; $z < count($data["mem"][2][$j][0]); $z++)
                            
                        @if($z != count($data["mem"][2][$j][0])-1)
                            {{$data["mem"][2][$j][0][$z]}},
                        @else 
                            {{$data["mem"][2][$j][0][$z]}}
                        @endif
                    @endfor
                    ]<br><br>
                    Vector y = <br>
                    [
                    @for($z = 0; $z < count($data["mem"][2][$j][1]); $z++)
                            
                        @if($z != count($data["mem"][2][$j][1])-1)
                            {{$data["mem"][2][$j][1][$z]}},
                        @else 
                            {{$data["mem"][2][$j][1][$z]}}
                        @endif
                    @endfor
                    ]<br><br>
                @endfor
            </div>
        @endif
    </div><br>
    @if ($data["check"] == "true")
        <div class="card">
            <div class="card-header">
                <h1>Initial Data</h1>
                <b>\[X = [
                @foreach ($data["arrx"] as $x)
                    @if($loop->last)
                        {{$x}}
                    @else
                        {{$x}},
                    @endif
                @endforeach
                ]\]
                \[Y = [
                @foreach ($data["arry"] as $y)
                    @if($loop->last)
                        {{$y}}
                    @else
                        {{$y}},
                    @endif
                @endforeach
                ]\]</b>
            </div>
            <div class="card-body">
                    <h1>Lagrange Coefficient</h1><br>
                    @foreach ($data["coefficient"] as $aux)
                        \[L{{$loop->index}} =  {{ $aux }}\]
                    @endforeach
                    </br>
                    <h1>Lagrange Polynomial</h1>
                        \[p(x) = {{$data["polynomial"]}}\]
            </div>
        </div>
    @endif
</div>
@endsection