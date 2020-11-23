@extends('layouts.master')

@section("title", $data["title"])

@section('content')
<head>
    <script type='text/javascript'>
        function addFields(){
            var number = document.getElementById("dimension").value;
            var container_matrix = document.getElementById("matrix");
            var container_vector = document.getElementById("vector");
            var container_vector_2 = document.getElementById("vector_2");

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
                    container_matrix.appendChild(document.createTextNode(""));
                    var input = document.createElement("input");
                    input.type = "number";
                    input.name = "x" + i;
                    input.style = "width : 110px;";
                    input.step = "any";
                    input.required = true;
                    container_matrix.appendChild(input);
                    container_vector.appendChild(document.createTextNode(""));
                    var vector = document.createElement("input");
                    vector.type = "number";
                    vector.name = "y" + i ;
                    vector.style = "width : 110px;";
                    vector.step = "any";
                    vector.required = true;
                    container_vector.appendChild(vector);

                    container_vector_2.appendChild(document.createTextNode(""));
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
<div class="container" align="center">
    <h2>Hermite Interpolation Method</h2>
    @include('layouts.message')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <p>
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-info-circle"></i> Help</a>
            </p>
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <li>The X coordinates array must not have repeating values.</li>
                </div>
            </div><br>
            <form method="POST" action="{{route('hermite_method')}}" class="form">
                @csrf
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
                    <div class="form-group col-md-12">
                        <button id="solve" type="submit" class="btn btn-outline-success btn-block metodo">Solve</button> 
                    </div>
                </div>
                <div id="matrix_a" class="text-align metodo"> \[x = \] </div><br>
                <div id="matrix" class="text-align"> </div><br>
                

                <div id="vector_b" class="text-align metodo"> \[F(x) = \] </div><br>
                <div id="vector" class="text-align"> </div><br>

                <div id="vector_c" class="text-align metodo"> \[F'(x) = \] </div><br>
                <div id="vector_2" class="text-align"> </div><br>
            </form>
        </div>
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
                ]\]
                \[Z = [
                @foreach ($data["arrz"] as $z)
                    @if($loop->last)
                        {{$z}}
                    @else
                        {{$z}},
                    @endif
                @endforeach
                ]\]<br>
            </div>
            <div class="card-body">
                <h1>Hermite Coefficient</h1>
                @for ($i = 0; $i < $data["dimension"]; $i++)
                    \[ h{{$i}} = {{ $data["coefficient"][$i] }}\]
                @endfor
                @for ($i = $data["dimension"]; $i < count($data["coefficient"]); $i++)
                    \[ ĥ{{$i-$data["dimension"]}} = {{ $data["coefficient"][$i] }}\]
                @endfor
                <h1>Hermite Polynomial</h1>
                <em>p(x) = {{$data["polynomial"]}}</em>
            </div>
        </div>
    @endif
</div>
@endsection