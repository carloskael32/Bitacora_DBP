@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
@if (Auth::user()->acceso == "no")
@php
$datos = Arr::pluck($meses,'result','mes');
@endphp
@endif
@section ('title','Reporte Bitacora')


<br>
<div class="card">
    <div class="card-header">

        <h2 class="text-center">Reporte de Bitacoras en Agencias </h2>
    </div>
    <div class="card-body">

        <!-- Tabla datos -->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-3">

                    <div class="card">
                        <div class="card-header text-center">
                            Reporte de Agencias

                        </div>

                        <div class="card-body">

                            @if (Auth::user()->acceso == "yes")

                            <!-- Generar reporte general  -->
                            <h4 class="text-center">Reporte general de Agencias</h4>

                            <!-- Alerta de consultas por mes en todas las agencias -->
                            @if(Session::has('mensajeall'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {{ Session::get('mensajeall')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif


                            <form action="{{ route('PDFAll')}}" method="GET">

                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">De: </label>
                                    <input name="mes" type="month" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder" required>
                                </div>
                                <br>


                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <input class="btn btn-success" type="submit" value="Generar Reporte">
                                </div>

                            </form>

                            <hr>
                            <br>

                            <!-- Genera reportes segun agencia y mes -->
                            @if(Session::has('mensaje'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {{ Session::get('mensaje')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <h4 class="text-center">Reportes por Mes</h4>
                            <form action="{{ route('PDFBitacorareporte')}}" method="GET">
                                <label for="exampleDataList" class="form-label">Selecciones una Agencia: </label>
                                <input name="agencia" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="buscar..." required>
                                <datalist name="agencia" id="datalistOptions">

                                    @foreach($agencias as $agencia)
                                    <option value="{{ $agencia->agencia }}">
                                        @endforeach

                                </datalist>
                                <br>

                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Mes: </label>
                                    <input name="mes" type="month" class="form-control" id="formGroupExampleInput" placeholder="Ejemplo: enero 2021" required>
                                </div>


                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <input class="btn btn-primary" type="submit" value="Generar Reporte">
                                </div>

                            </form>

                            <hr>
                            <br>


                            <!-- GENERA REPORTE CON INTERVALOS DE FECHAS-->
                            @if(Session::has('mensaje2'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {{ Session::get('mensaje2')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif




                            <h4 class="text-center">Reporte con Intervalos
                                <br>
                                de Fechas
                            </h4>
                            <form action="{{ route('PDFBitacorareporte2')}}" method="GET">
                                <label for="exampleDataList" class="form-label">Selecciones una Agencia: </label>
                                <input name="agencia" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="buscar..." required>
                                <datalist name="agencia" id="datalistOptions">

                                    @foreach($agencias as $agencia)
                                    <option value="{{ $agencia->agencia }}">
                                        @endforeach

                                </datalist>
                                <br>

                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">De: </label>
                                    <input name="date1" type="date" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder" required>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Hasta: </label>
                                    <input name="date2" type="date" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder" required>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <input class="btn btn-primary" type="submit" value="Generar Reporte">
                                </div>

                            </form>
                            @else



                            <h4 class="text-center">Reporte con Intervalos
                                <br>
                                de Fechas
                            </h4>

                            <form action="{{ route('PDFBitacorareporte2')}}" method="GET">
                                <label for="exampleDataList" class="form-label">Selecciones una Agencia: </label>
                                <input name="agencia" class="form-control" value="{{Auth::user()->agencia}}" id="exampleDataList" readonly>

                                <br>

                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">De: </label>
                                    <input name="date1" type="date" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder" required>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Hasta: </label>
                                    <input name="date2" type="date" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder" required>
                                </div>


                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <input class="btn btn-primary" type="submit" value="Generar Reporte">
                                </div>

                            </form>

                            @endif


                        </div>

                        <div class="card-footer text-muted text-center">
                            BDP-SAM
                        </div>
                    </div>
                </div>



                <div class="col-md-9">


                    @auth
                    @if (Auth::user()->acceso == "yes")
                    <h5 class="text-center">Bitacoras registradas el dia Hoy.. <b>{{ date('Y-m-d') }} </b></h5>
                    <hr>
                    <table class=" table table-light">

                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Agencia</th>
                                <th>EncargadoOP.</th>
                                <th>Temperatura</th>
                                <th>Humedad</th>
                                <th>Filtracion</th>
                                <th>UPS</th>
                                <th>Generador</th>
                                <th>Observaciones</th>
                                <th>Fecha</th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $bitacoras as $bitacora)
                            <tr>

                                <td>{{ $bitacora->id }}</td>
                                <td>{{ $bitacora->agencia }}</td>
                                <td>{{ $bitacora->encargadoOP }}</td>
                                <td>{{ $bitacora->temperatura }}</td>
                                <td>{{ $bitacora->humedad }}</td>
                                <td>{{ $bitacora->filtracion }}</td>
                                <td>{{ $bitacora->UPS }}</td>
                                <td>{{ $bitacora->generador }}</td>
                                <td>{{ $bitacora->observaciones }}</td>
                                <td>{{ $bitacora->Fecha }}</td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <div class="pagination justify-content-center">

                        {!! $bitacoras->links() !!}

                    </div>

                    @else

                    <div class="card">

                        <div class="card-body">

                            <div class="row">

                                @if (!empty($datos[1]))
                                @php

                                $a = $datos[1];
                                $dias = implode($dmes[0]);
                                $b = round(($a*100)/$dias);
                                if( $b >= 100){
                                $b=100;
                                }
                                @endphp
                                <div class="col-md-3">
                                    <div class="card border-primary mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $b; ?>%"><?php echo $b; ?>%</div>
                                        </div>
                                        <div class="text-info text-center mt-3">
                                            <h4>Enero</h4>
                                        </div>
                                        <div class="text-info text-center mt-2">

                                            <h6>Reportes enviados:</h6>
                                            <h1>{{ $a }} </h1>


                                            <form action="{{ route('reportBit')}}" method="GET">
                                                <div class="mb-3">
                                                    <input name="mes" type="hidden" class="form-control" id="formGroupExampleInput" value="1">
                                                    <input name="mes1" type="hidden" class="form-control" id="formGroupExampleInput" value="Enero">
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <input class="btn btn-success btn-sm" type="submit" value="Descargar Reporte">
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>


                                @else
                                <div class="col-md-3">
                                    <div class="card border-danger mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
                                        </div>
                                        <div class="text-danger text-center mt-3">
                                            <h4>Enero</h4>
                                        </div>
                                        <div class="text-danger text-center mt-2">
                                            <h5>No se Envio ningun reporte.!! </h5>
                                        </div>
                                    </div>
                                </div>
                                @endif


                                @if (!empty($datos[2]))
                                @php

                                $a = $datos[2];
                                $dias = implode($dmes[1]);
                                $b = round(($a*100)/$dias);

                                if( $b >= 100){
                                $b=100;
                                }
                                @endphp
                                <div class="col-md-3">
                                    <div class="card border-primary mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $b; ?>%"><?php echo $b; ?>%</div>
                                        </div>
                                        <div class="text-info text-center mt-3">
                                            <h4>Febrero</h4>
                                        </div>
                                        <div class="text-info text-center mt-2">

                                            <h6>Reportes enviados:</h6>
                                            <h1>{{ $a }} </h1>


                                            <form action="{{ route('reportBit')}}" method="GET">
                                                <div class="mb-3">
                                                    <input name="mes" type="hidden" class="form-control" id="formGroupExampleInput" value="2">
                                                    <input name="mes1" type="hidden" class="form-control" id="formGroupExampleInput" value="Febrero">
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <input class="btn btn-success btn-sm" type="submit" value="Descargar Reporte">
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>


                                @else
                                <div class="col-md-3">
                                    <div class="card border-danger mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
                                        </div>
                                        <div class="text-danger text-center mt-3">
                                            <h4>Febrero</h4>
                                        </div>
                                        <div class="text-danger text-center mt-2">
                                            <h5>No se Envio ningun reporte.!! </h5>
                                        </div>
                                    </div>
                                </div>
                                @endif


                                @if (!empty($datos[3]))
                                @php

                                $a = $datos[3];
                                $dias = implode($dmes[2]);
                                $b = round(($a*100)/$dias);

                                if( $b >= 100){
                                $b=100;
                                }
                                @endphp
                                <div class="col-md-3">
                                    <div class="card border-primary mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $b; ?>%"><?php echo $b; ?>%</div>
                                        </div>
                                        <div class="text-info text-center mt-3">
                                            <h4>Marzo</h4>
                                        </div>
                                        <div class="text-info text-center mt-2">

                                            <h6>Reportes enviados:</h6>
                                            <h1>{{ $a }} </h1>


                                            <form action="{{ route('reportBit')}}" method="GET">
                                                <div class="mb-3">
                                                    <input name="mes" type="hidden" class="form-control" id="formGroupExampleInput" value="3">
                                                    <input name="mes1" type="hidden" class="form-control" id="formGroupExampleInput" value="Marzo">
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <input class="btn btn-success btn-sm" type="submit" value="Descargar Reporte">
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>


                                @else
                                <div class="col-md-3">
                                    <div class="card border-danger mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
                                        </div>
                                        <div class="text-danger text-center mt-3">
                                            <h4>Marzo</h4>
                                        </div>
                                        <div class="text-danger text-center mt-2">
                                            <h5>No se Envio ningun reporte.!! </h5>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if (!empty($datos[4]))
                                @php

                                $a = $datos[4];
                                $dias = implode($dmes[3]);
                                $b = round(($a*100)/$dias);

                                if( $b >= 100){
                                $b=100;
                                }
                                @endphp
                                <div class="col-md-3">
                                    <div class="card border-primary mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $b; ?>%"><?php echo $b; ?>%</div>
                                        </div>
                                        <div class="text-info text-center mt-3">
                                            <h4>Abril</h4>
                                        </div>
                                        <div class="text-info text-center mt-2">

                                            <h6>Reportes enviados:</h6>
                                            <h1>{{ $a }} </h1>


                                            <form action="{{ route('reportBit')}}" method="GET">
                                                <div class="mb-3">
                                                    <input name="mes" type="hidden" class="form-control" id="formGroupExampleInput" value="4">
                                                    <input name="mes1" type="hidden" class="form-control" id="formGroupExampleInput" value="Abril">
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <input class="btn btn-success btn-sm" type="submit" value="Descargar Reporte">
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>


                                @else
                                <div class="col-md-3">
                                    <div class="card border-danger mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
                                        </div>
                                        <div class="text-danger text-center mt-3">
                                            <h4>Abril</h4>
                                        </div>
                                        <div class="text-danger text-center mt-2">
                                            <h5>No se Envio ningun reporte.!! </h5>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>
                            <br>
                            <hr>
                            <div class="row">

                                @if (!empty($datos[5]))
                                @php

                                $a = $datos[5];
                                $dias = implode($dmes[4]);
                                $b = round(($a*100)/$dias);

                                if( $b >= 100){
                                $b=100;
                                }
                                @endphp
                                <div class="col-md-3">
                                    <div class="card border-primary mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $b; ?>%"><?php echo $b; ?>%</div>
                                        </div>
                                        <div class="text-info text-center mt-3">
                                            <h4>Mayo</h4>
                                        </div>
                                        <div class="text-info text-center mt-2">

                                            <h6>Reportes enviados:</h6>
                                            <h1>{{ $a }} </h1>


                                            <form action="{{ route('reportBit')}}" method="GET">
                                                <div class="mb-3">
                                                    <input name="mes" type="hidden" class="form-control" id="formGroupExampleInput" value="5">
                                                    <input name="mes1" type="hidden" class="form-control" id="formGroupExampleInput" value="Mayo">
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <input class="btn btn-success btn-sm" type="submit" value="Descargar Reporte">
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>


                                @else
                                <div class="col-md-3">
                                    <div class="card border-danger mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
                                        </div>
                                        <div class="text-danger text-center mt-3">
                                            <h4>Mayo</h4>
                                        </div>
                                        <div class="text-danger text-center mt-2">
                                            <h5>No se Envio ningun reporte.!! </h5>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if (!empty($datos[6]))
                                @php

                                $a = $datos[6];
                                $dias = implode($dmes[5]);
                                $b = round(($a*100)/$dias);

                                if( $b >= 100){
                                $b=100;
                                }
                                @endphp
                                <div class="col-md-3">
                                    <div class="card border-primary mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $b; ?>%"><?php echo $b; ?>%</div>
                                        </div>
                                        <div class="text-info text-center mt-3">
                                            <h4>Junio</h4>
                                        </div>
                                        <div class="text-info text-center mt-2">

                                            <h6>Reportes enviados:</h6>
                                            <h1>{{ $a }} </h1>


                                            <form action="{{ route('reportBit')}}" method="GET">
                                                <div class="mb-3">
                                                    <input name="mes" type="hidden" class="form-control" id="formGroupExampleInput" value="6">
                                                    <input name="mes1" type="hidden" class="form-control" id="formGroupExampleInput" value="Junio">
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <input class="btn btn-success btn-sm" type="submit" value="Descargar Reporte">
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>


                                @else
                                <div class="col-md-3">
                                    <div class="card border-danger mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
                                        </div>
                                        <div class="text-danger text-center mt-3">
                                            <h4>Junio</h4>
                                        </div>
                                        <div class="text-danger text-center mt-2">
                                            <h5>No se Envio ningun reporte.!! </h5>
                                        </div>
                                    </div>
                                </div>
                                @endif



                                @if (!empty($datos[7]))
                                @php

                                $a = $datos[7];
                                $dias = implode($dmes[6]);
                                $b = round(($a*100)/$dias);

                                if( $b >= 100){
                                $b=100;
                                }
                                @endphp
                                <div class="col-md-3">
                                    <div class="card border-primary mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $b; ?>%"><?php echo $b; ?>%</div>
                                        </div>
                                        <div class="text-info text-center mt-3">
                                            <h4>Julio</h4>
                                        </div>
                                        <div class="text-info text-center mt-2">

                                            <h6>Reportes enviados:</h6>
                                            <h1>{{ $a }} </h1>


                                            <form action="{{ route('reportBit')}}" method="GET">
                                                <div class="mb-3">
                                                    <input name="mes" type="hidden" class="form-control" id="formGroupExampleInput" value="7">
                                                    <input name="mes1" type="hidden" class="form-control" id="formGroupExampleInput" value="Julio">
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <input class="btn btn-success btn-sm" type="submit" value="Descargar Reporte">
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>


                                @else
                                <div class="col-md-3">
                                    <div class="card border-danger mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
                                        </div>
                                        <div class="text-danger text-center mt-3">
                                            <h4>Julio</h4>
                                        </div>
                                        <div class="text-danger text-center mt-2">
                                            <h5>No se Envio ningun reporte.!! </h5>
                                        </div>
                                    </div>
                                </div>
                                @endif


                                <div class="col-md-3">

                                    @if (!empty($datos[8]))
                                    @php

                                    $a = $datos[8];
                                    $dias = implode($dmes[7]);
                                    $b = round(($a*100)/$dias);

                                    if( $b >= 100){
                                    $b=100;
                                    }
                                    @endphp
                                    <div class="card border-primary mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $b; ?>%"><?php echo $b; ?>%</div>
                                        </div>
                                        <div class="text-info text-center mt-3">
                                            <h4>Agosto</h4>
                                        </div>
                                        <div class="text-info text-center mt-2">


                                            <h6>Reportes enviados:</h6>
                                            <h1>{{ $a }}</h1>


                                            <form action="{{ route('reportBit')}}" method="GET">
                                                <div class="mb-3">
                                                    <input name="mes" type="hidden" class="form-control" id="formGroupExampleInput" value="8">
                                                    <input name="mes1" type="hidden" class="form-control" id="formGroupExampleInput" value="Agosto">
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <input class="btn btn-success btn-sm" type="submit" value="Descargar Reporte">
                                                </div>

                                            </form>


                                        </div>
                                    </div>


                                    @else
                                    <div class="card border-danger mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
                                        </div>
                                        <div class="text-danger text-center mt-3">
                                            <h4>Agosto</h4>
                                        </div>
                                        <div class="text-danger text-center mt-2">
                                            <h5>No se Envio ningun reporte.!! </h5>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                            <br>
                            <hr>

                            <div class="row">

                                <div class="col-md-3">


                                    @if (!empty($datos[9]))
                                    @php

                                    $a = $datos[9];
                                    $dias = implode($dmes[8]);
                                    $b = round(($a*100)/$dias);

                                    if( $b >= 100){
                                    $b=100;
                                    }
                                    @endphp
                                    <div class="card border-primary mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $b; ?>%"><?php echo $b; ?>%</div>
                                        </div>
                                        <div class="text-info text-center mt-3">
                                            <h4>Septiembre</h4>
                                        </div>

                                        <div class="text-info text-center mt-2">

                                            <h6>Reportes enviados:</h6>
                                            <h1>{{ $a }}</h1>


                                            <form action="{{ route('reportBit')}}" method="GET">
                                                <div class="mb-3">
                                                    <input name="mes" type="hidden" class="form-control" id="formGroupExampleInput" value="9">
                                                    <input name="mes1" type="hidden" class="form-control" id="formGroupExampleInput" value="Septiembre">
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <input class="btn btn-success btn-sm" type="submit" value="Descargar Reporte">
                                                </div>

                                            </form>



                                        </div>

                                    </div>



                                    @else
                                    <div class="card border-danger mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
                                        </div>
                                        <div class="text-danger text-center mt-3">
                                            <h4>Septiembre</h4>
                                        </div>
                                        <div class="text-danger text-center mt-2">
                                            <h5>No se Envio ningun reporte.!! </h5>
                                        </div>
                                    </div>
                                    @endif
                                </div>


                                <div class="col-md-3">
                                    @if (!empty($datos[10]))
                                    @php

                                    $a = $datos[10];
                                    $dias = implode($dmes[9]);



                                    $b = round(($a*100)/$dias);

                                    if( $b >= 100){
                                    $b=100;
                                    }
                                    @endphp
                                    <div class="card border-primary mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $b; ?>%"><?php echo $b; ?>%</div>
                                        </div>
                                        <div class="text-info text-center mt-3">
                                            <h4>Octubre</h4>
                                        </div>

                                        <div class="text-info text-center mt-2">

                                            <h6>Reportes enviados:</h6>
                                            <h1>{{ $a }}</h1>


                                            <form action="{{ route('reportBit')}}" method="GET">
                                                <div class="mb-3">
                                                    <input name="mes" type="hidden" class="form-control" id="formGroupExampleInput" value="10">
                                                    <input name="mes1" type="hidden" class="form-control" id="formGroupExampleInput" value="Octubre">
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <input class="btn btn-success btn-sm" type="submit" value="Descargar Reporte">
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    @else
                                    <div class="card border-danger mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
                                        </div>
                                        <div class="text-danger text-center mt-3">
                                            <h4>Octubre</h4>
                                        </div>
                                        <div class="text-danger text-center mt-2">
                                            <h5>No se Envio ningun reporte.!! </h5>
                                        </div>
                                    </div>
                                    @endif
                                </div>



                                <div class="col-md-3">
                                    @if (!empty($datos[11]))
                                    @php

                                    $a = $datos[11];

                                    $dias = implode($dmes[10]);
                                    $b = round(($a*100)/$dias);

                                    if( $b >= 100){
                                    $b=100;
                                    }
                                    @endphp
                                    <div class="card border-primary mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $b; ?>%"><?php echo $b; ?>%</div>
                                        </div>
                                        <div class="text-info text-center mt-3">
                                            <h4>Noviembre</h4>
                                        </div>

                                        <div class="text-info text-center mt-2">

                                            <h6>Reportes enviados:</h6>
                                            <h1>{{ $a }}</h1>


                                            <form action="{{ route('reportBit')}}" method="GET">
                                                <div class="mb-3">
                                                    <input name="mes" type="hidden" class="form-control" id="formGroupExampleInput" value="11">
                                                    <input name="mes1" type="hidden" class="form-control" id="formGroupExampleInput" value="Noviembre">
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <input class="btn btn-success btn-sm" type="submit" value="Descargar Reporte">
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    @else
                                    <div class="card border-danger mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
                                        </div>
                                        <div class="text-danger text-center mt-3">
                                            <h4>Noviembre</h4>
                                        </div>
                                        <div class="text-danger text-center mt-2">
                                            <h5>No se Envio ningun reporte.!! </h5>
                                        </div>
                                    </div>
                                    @endif



                                </div>


                                <div class="col-md-3">

                                    @if (!empty($datos[12]))
                                    @php

                                    $a = $datos[12];
                                    $dias = implode($dmes[11]);
                                    $b = round(($a*100)/$dias);

                                    if( $b >= 100){
                                    $b=100;
                                    }
                                    @endphp
                                    <div class="card border-primary mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $b; ?>%"><?php echo $b; ?>%</div>
                                        </div>
                                        <div class="text-info text-center mt-3">
                                            <h4>Diciembre</h4>
                                        </div>

                                        <div class="text-info text-center mt-2">

                                            <h6>Reportes enviados:</h6>
                                            <h1>{{ $a }}</h1>


                                            <form action="{{ route('reportBit')}}" method="GET">
                                                <div class="mb-3">
                                                    <input name="mes" type="hidden" class="form-control" id="formGroupExampleInput" value="12">
                                                    <input name="mes1" type="hidden" class="form-control" id="formGroupExampleInput" value="Diciembre">
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <input class="btn btn-success btn-sm" type="submit" value="Descargar Reporte">
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    @else
                                    <div class="card border-danger mx-sm-1 p-3">
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>
                                        </div>
                                        <div class="text-danger text-center mt-3">
                                            <h4>Diciembre</h4>
                                        </div>
                                        <div class="text-danger text-center mt-2">
                                            <h5>No se Envio ningun reporte.!! </h5>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>


                    @endif

                    @endauth

                </div>
            </div>
        </div>




    </div>
</div>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop