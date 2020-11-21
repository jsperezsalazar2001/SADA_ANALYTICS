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
            var container_vector_2 = document.getElementById("vector_2");
            // Clear previous contents of the container
            while (container_matrix.hasChildNodes()) {
                container_matrix.removeChild(container_matrix.lastChild);
            }
            while (container_vector.hasChildNodes()) {
                container_vector.removeChild(container_vector.lastChild);
            }
            while (container_vector_2.hasChildNodes()) {
                container_vector_2.removeChild(container_vector_2.lastChild);
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

                    container_vector_2.appendChild(document.createTextNode(""));
                    // Create an <input> element for vector B, set its type and name attributes
                    var vector_2 = document.createElement("input");
                    vector_2.type = "number";
                    vector_2.name = "z" + i ;
                    vector_2.style = "width : 110px;";
                    vector_2.step = "any";
                    vector_2.required = true;
                    container_vector_2.appendChild(vector_2);
                }
                document.getElementById("matrix_a").style.display = 'block';
                document.getElementById("vector_b").style.display = 'block'; 
                document.getElementById("vector_c").style.display = 'block'; 
                document.getElementById("solve").style.display = 'block';
            }
        }
    </script>
</head>
<div class="container">
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{route('hermite_method')}}" class="form">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Dimension</label>
                        <input type="number" id="dimension" min="2" class="form-control" placeholder="Matrix dimension" name="n" step="any" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <a id="filldetails" onclick="addFields()" class="btn btn-outline-primary btn-block">Create arrays</a> 
                    </div>
                    <div class="form-group col-md-3">
                        <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">Solve</button> 
                    </div>
                </div>
                <div id="matrix_a" class="text-align metodo"> X </div>
                <div id="matrix" class="text-align"> </div>
                

                <div id="vector_b" class="text-align metodo"> F(x) </div>
                <div id="vector" class="text-align"> </div>

                <div id="vector_c" class="text-align metodo"> F'(x) </div>
                <div id="vector_2" class="text-align"> </div>
            </form>
        </div>
    </div>
    @if ($data["check"] == "true")
        <div class="card">
            <div class="card-header">
                <h1>Initial Data</h1>
                <b>X = [
                @foreach ($data["arrx"] as $x)
                    @if($loop->last)
                        {{$x}}
                    @else
                        {{$x}},
                    @endif
                @endforeach
                ]<br>
                Y = [
                @foreach ($data["arry"] as $y)
                    @if($loop->last)
                        {{$y}}
                    @else
                        {{$y}},
                    @endif
                @endforeach
                ]<br>
                Z = [
                @foreach ($data["arrz"] as $z)
                    @if($loop->last)
                        {{$z}}
                    @else
                        {{$z}},
                    @endif
                @endforeach
                ]</b><br>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="form-group col-md-6" style="margin-right: 1%">
                        <h1>Lagrange Coefficient</h1>
                        \tag*{hi} x+y^{2x}
                        <table class="table table-striped text-center table-BusquedasIncrementales">
                            <thead>
                                <tr>
                                    <th>Coefficient</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < $data["dimension"]; $i++)
                                    <tr>
                                        <th><em>h{{$i}} = </em> {{ $data["coefficient"][$i] }}</th>
                                    </tr>
                                @endfor
                                @for ($i = $data["dimension"]; $i < count($data["coefficient"]); $i++)
                                    <tr>
                                        <th><em>ĥ{{$i-$data["dimension"]}} = </em> {{ $data["coefficient"][$i] }}</th>
                                    </tr>
                                @endfor




                            </tbody>
                        </table>
                    </div></br>
                    <div class="form-group col-md-6">
                        <h1>Lagrange Polynomial</h1>
                        <div>
                            <b><em>p(x) = </em>{{$data["polynomial"]}}</b>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
@endsection