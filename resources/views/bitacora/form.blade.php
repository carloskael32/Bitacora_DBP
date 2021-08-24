@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach

    </ul>

</div>
@endif
<br>
<div class="card">
    <div class="card-header">
        <h2><span class="text-center fa fa-home"></span>{{ $modo }} Bitacora</h2>
    </div>
    <br>
    <div class="container-fluid">
        <h5><span class="text-center fa fa-home"></span>Por Favor Registre los datos Requeridos en el Fomulario Gracias..</52>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="form-group">
                    <label for="Agencia">Agencia</label>
                    <input type="text" class="form-control" name="Agencia" value="{{ Auth::user()->agencia }}" id="Agencia" readonly>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label for="EncargadoOP">EncargadoOP</label>
                    <input type="text" class="form-control" name="EncargadoOP" value="{{ Auth::user()->name }}" id="EncargadoOP" readonly>
                </div>
            </div>
            <div class="col-md">
                @if($modo == 'Registrar')
                <div class="form-group">
                    <label for="Fecha">Fecha</label>
                    <input type="date" class="form-control" name="Fecha" value="{{ isset($bitacora->Fecha)?$bitacora->Fecha:date('Y-m-d') }}" readonly>
                </div>
                @endif
            </div>
        </div>

        <hr>
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="form-group">
                    <label for="Temperatura">Temperatura</label>
                    <input type="double" class="form-control" name="Temperatura" value="{{ isset($bitacora->Temperatura)?$bitacora->Temperatura:old('Temperatura') }}" id="Temperatura">
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label for="Humedad">Humedad</label>
                    <input type="double" class="form-control" name="Humedad" value="{{ isset($bitacora->Humedad)?$bitacora->Humedad:old('Humedad') }}" id="Humedad">
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label for="Filtracion">Filtracion</label>
                    <input type="text" class="form-control" name="Filtracion" value="{{ isset($bitacora->Filtracion)?$bitacora->Filtracion:old('Filtracion') }}" id="Filtracion">
                </div>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="form-group">
                    <label for="UPS">UPS</label>
                    <input type="text" class="form-control" name="UPS" value="{{ isset($bitacora->UPS)?$bitacora->UPS:old('UPS') }}" id="UPS">
                </div>
            </div>
            <div class="col-md">

                <div class="form-group">
                    <label for="Generador">Generador</label>
                    <input type="text" class="form-control" name="Generador" value="{{ isset($bitacora->Generador)?$bitacora->Generador:old('Generador') }}" id="Generador">
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label for="Observaciones">Observaciones</label>
                    <input type="text" class="form-control" name="Observaciones" value="{{ isset($bitacora->Observaciones)?$bitacora->Observaciones:old('Observaciones') }}" id="Observaciones">
                </div>
            </div>
        </div>

        <!-- {{ date('Y-m-d H:i:s') }}-->

        <input class="btn btn-success" type="submit" value="{{ $modo }} Datos">


        <a class="btn btn-primary" href="{{ url('bitacora/') }}">Regresar</a>
    </div>


    <div class="card-body">

    </div>
</div>