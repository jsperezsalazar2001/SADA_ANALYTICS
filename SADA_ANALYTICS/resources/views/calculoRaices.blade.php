@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 seleccionMetodo">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Seleccione el Metodo con el que desea trabajar</label>
                        <select class="form-control" onchange="showForm(this)">
                            <option disabled selected>Seleccione una opcion</option>
                            <option value="1">Busquedas Incrementales</option>
                            <option value="2">Biseccion</option>
                            <option value="3">Punto Fijo</option>
                            <option value="4">Newton</option>
                            <option value="5">Secante</option>
                            <option value="6">Raices Multiples</option>
                            <option value="7">Regla Falsa</option>
                            <option value="8">Aitken</option>
                            <option value="9">Steffensen</option> 
                            <option value="10">Muller</option> 
                        </select>
                </div>
            </div>
        </div>
        <div class="col-6 formulario">
            <div id="BusquedasIncrementales" class="metodo">
                <form method="POST" action="{{ route('busquedasIncrementales') }}" class="form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>X inicial</label>
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
            <div id="Biseccion" class="metodo">
                Formulario Biseccion
            </div>
            <div id="PuntoFijo" class="metodo">
                Formulario Punto Fijp
            </div>
            <div id="Newton" class="metodo">
                Formulario Newton
            </div>
            <div id="Secante" class="metodo">
                Formulario Secante
            </div>
            <div id="RaicesMultiples" class="metodo">
                Formulario Raices Multiples
            </div>
            <div id="ReglaFalsa" class="metodo">
                Formulario Regla Falsa
            </div>
            <div id="Aitken" class="metodo">
                Formulario Aitken
            </div>
            <div id="Steffensen" class="metodo">
                Formulario Steffensen
            </div>
            <div id="Muller" class="metodo">
                Formulario Muller
            </div>
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
<script>
    function showForm(elem){
        if(elem.value == 1){
            document.getElementById('Biseccion').style.display = "none";
            document.getElementById('PuntoFijo').style.display = "none";
            document.getElementById('Newton').style.display = "none";
            document.getElementById('Secante').style.display = "none";
            document.getElementById('RaicesMultiples').style.display = "none";
            document.getElementById('ReglaFalsa').style.display = "none";
            document.getElementById('Aitken').style.display = "none";
            document.getElementById('Steffensen').style.display = "none";
            document.getElementById('Muller').style.display = "none";
            document.getElementById('BusquedasIncrementales').style.display = "block";
        }else if (elem.value == 2){
            document.getElementById('BusquedasIncrementales').style.display = "none";
            document.getElementById('PuntoFijo').style.display = "none";
            document.getElementById('Newton').style.display = "none";
            document.getElementById('Secante').style.display = "none";
            document.getElementById('RaicesMultiples').style.display = "none";
            document.getElementById('ReglaFalsa').style.display = "none";
            document.getElementById('Aitken').style.display = "none";
            document.getElementById('Steffensen').style.display = "none";
            document.getElementById('Muller').style.display = "none";
            document.getElementById('Biseccion').style.display = "block";
        }else if (elem.value == 3){
            document.getElementById('BusquedasIncrementales').style.display = "none";
            document.getElementById('Biseccion').style.display = "none";
            document.getElementById('Newton').style.display = "none";
            document.getElementById('Secante').style.display = "none";
            document.getElementById('RaicesMultiples').style.display = "none";
            document.getElementById('ReglaFalsa').style.display = "none";
            document.getElementById('Aitken').style.display = "none";
            document.getElementById('Steffensen').style.display = "none";
            document.getElementById('Muller').style.display = "none";
            document.getElementById('PuntoFijo').style.display = "block";
        }else if (elem.value == 4){
            document.getElementById('BusquedasIncrementales').style.display = "none";
            document.getElementById('Biseccion').style.display = "none";
            document.getElementById('PuntoFijo').style.display = "none";
            document.getElementById('Secante').style.display = "none";
            document.getElementById('RaicesMultiples').style.display = "none";
            document.getElementById('ReglaFalsa').style.display = "none";
            document.getElementById('Aitken').style.display = "none";
            document.getElementById('Steffensen').style.display = "none";
            document.getElementById('Muller').style.display = "none";
            document.getElementById('Newton').style.display = "block";
        }else if (elem.value == 5){
            document.getElementById('BusquedasIncrementales').style.display = "none";
            document.getElementById('Biseccion').style.display = "none";
            document.getElementById('PuntoFijo').style.display = "none";
            document.getElementById('Newton').style.display = "none";
            document.getElementById('RaicesMultiples').style.display = "none";
            document.getElementById('ReglaFalsa').style.display = "none";
            document.getElementById('Aitken').style.display = "none";
            document.getElementById('Steffensen').style.display = "none";
            document.getElementById('Muller').style.display = "none";
            document.getElementById('Secante').style.display = "block";
        }else if (elem.value == 6){
            document.getElementById('BusquedasIncrementales').style.display = "none";
            document.getElementById('Biseccion').style.display = "none";
            document.getElementById('PuntoFijo').style.display = "none";
            document.getElementById('Newton').style.display = "none";
            document.getElementById('Secante').style.display = "none";
            document.getElementById('ReglaFalsa').style.display = "none";
            document.getElementById('Aitken').style.display = "none";
            document.getElementById('Steffensen').style.display = "none";
            document.getElementById('Muller').style.display = "none";
            document.getElementById('RaicesMultiples').style.display = "block";
        }else if (elem.value == 7){
            document.getElementById('BusquedasIncrementales').style.display = "none";
            document.getElementById('Biseccion').style.display = "none";
            document.getElementById('PuntoFijo').style.display = "none";
            document.getElementById('Newton').style.display = "none";
            document.getElementById('Secante').style.display = "none";
            document.getElementById('RaicesMultiples').style.display = "none";
            document.getElementById('Aitken').style.display = "none";
            document.getElementById('Steffensen').style.display = "none";
            document.getElementById('Muller').style.display = "none";
            document.getElementById('ReglaFalsa').style.display = "block";
        }else if (elem.value == 8){
            document.getElementById('BusquedasIncrementales').style.display = "none";
            document.getElementById('Biseccion').style.display = "none";
            document.getElementById('PuntoFijo').style.display = "none";
            document.getElementById('Newton').style.display = "none";
            document.getElementById('Secante').style.display = "none";
            document.getElementById('RaicesMultiples').style.display = "none";
            document.getElementById('ReglaFalsa').style.display = "none";
            document.getElementById('Steffensen').style.display = "none";
            document.getElementById('Muller').style.display = "none";
            document.getElementById('Aitken').style.display = "block";
        }else if (elem.value == 9){
            document.getElementById('BusquedasIncrementales').style.display = "none";
            document.getElementById('Biseccion').style.display = "none";
            document.getElementById('PuntoFijo').style.display = "none";
            document.getElementById('Newton').style.display = "none";
            document.getElementById('Secante').style.display = "none";
            document.getElementById('RaicesMultiples').style.display = "none";
            document.getElementById('ReglaFalsa').style.display = "none";
            document.getElementById('Aitken').style.display = "none";
            document.getElementById('Muller').style.display = "none";
            document.getElementById('Steffensen').style.display = "block";
        }else if (elem.value == 10){
            document.getElementById('BusquedasIncrementales').style.display = "none";
            document.getElementById('Biseccion').style.display = "none";
            document.getElementById('PuntoFijo').style.display = "none";
            document.getElementById('Newton').style.display = "none";
            document.getElementById('Secante').style.display = "none";
            document.getElementById('RaicesMultiples').style.display = "none";
            document.getElementById('ReglaFalsa').style.display = "none";
            document.getElementById('Aitken').style.display = "none";
            document.getElementById('Steffensen').style.display = "none";
            document.getElementById('Muller').style.display = "block";
        }

    }
</script>
@endsection