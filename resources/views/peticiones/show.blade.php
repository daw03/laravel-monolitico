@extends('layouts.public')
@section('content')
    <div class="container mt-5">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <h2>Detalle de una petición</h2>

        <div class="row">
            <div class="col-md-3">
                <!-- Imagen -->
                <img class="card-img-top img-responsive" src="{{asset('/peticiones/'.$peticion->files()->first()->name)}}" style="height: 18em; border-radius: 5px">
            </div>
            <div class="col-md-9">

                <table class="table">
                    <tr>
                        <th>ID:</th>
                        <td>{{$peticion->id}}</td>
                    </tr>
                    <tr>
                        <th>Título:</th>
                        <td>{{$peticion->titulo}}</td>
                    </tr>
                    <tr>
                        <th>Descripción:</th>
                        <td>{{$peticion->descripcion}}</td>
                    </tr>
                    <tr>
                        <th>Firmantes:</th>
                        <td>{{$peticion->firmantes}}</td>
                    </tr>
                    <tr>
                        <th>Estado:</th>
                        <td>{{$peticion->estado}}</td>
                    </tr>
                    <tr>
                        <th>Destinatario:</th>
                        <td>{{$peticion->destinatario}}</td>
                    </tr>
                    <tr>
                        <th>Categoría ID:</th>
                        <td>{{$peticion->categoria_id}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <a href="{{route('peticiones.firmar',$peticion->id)}}" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('firma-id').submit();">Firmar peticion</a>
        <form id="firma-id" action="{{route('peticiones.firmar',$peticion->id)}}" method="POST" style="display: none">
            @csrf
        </form>
    </div>
@endsection
