@extends('layouts.master')

@section("title", $data["title"])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('incremental_search_method') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Secant</label>
                            <input type="number" class="form-control" placeholder="Ingrese la X inicial" name="x_inicial" step="any" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Delta</label>
                            <input type="number" class="form-control" placeholder="Ingrese el delta" name="delta" step="any" min="0" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Limite de Iteraciones</label>
                            <input type="number" class="form-control" placeholder="Ingrese la cantidad maxima de iteraciones" name="iteraciones" min="1" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Funcion</label>
                            <input type="text" class="form-control" placeholder="Ingrese la funcion" name="funcion" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-outline-success btn-block">Calcular</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    @if ($data["validar"] == "true")
        <div class="card">
            <div class="card-header">
                <h1>Datos Inciales</h1>
                <p>X_Inicial: {{ $data["x_inicial"] }}</p>
                <p>Delta: {{ $data["delta"] }}</p>
                <p>Limite de Iteraciones: {{ $data["iteraciones"] }}</p>
                <p>Funcion: {{ $data["funcion"] }}</p>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <table class="table table-striped text-center table-BusquedasIncrementales">
                        <thead>
                            <tr>
                                <th>a</th>
                                <th>b</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data["json"] as $iteracion)
                                <tr>
                                    <th>{{ $iteracion[0] }}</th>
                                    <th>{{ $iteracion[1] }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection