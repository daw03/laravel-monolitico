@extends('layouts.public')
@section('content')
    <div class="container-fluid h-100">
        <div class="row w-100">
            <div class="col">
                <div id="demo" class="carousel slide" data-bs-rie="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="1" class="active"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="2" class="active"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://static.change.org/brand-pages/hero%20images/hero-impact.jpg" alt="Los Angeles" class="d-block" style="width: 100%">
                            <div class="carousel-caption">
                                <h3>La mayor plataforma del mundo</h3>
                                <p>485.044.407 personas que pasan a la acción</p>
                                <div class="text-center mt-5"><a type="button" class="btn btn-danger center-block" href="{{route('peticiones.create')}}">Inicia una peticion</a> </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://static.change.org/brand-pages/hero%20images/hero-impact.jpg" alt="Los Angeles" class="d-block" style="width: 100%">
                            <div class="carousel-caption">
                                <h3>La mayor plataforma del mundo</h3>
                                <p>485.044.407 personas que pasan a la acción</p>
                                <div class="text-center mt-5"><a type="button" class="btn btn-danger center-block" href="{{route('peticiones.create')}}">Inicia una peticion</a> </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://static.change.org/brand-pages/hero%20images/hero-impact.jpg" alt="Los Angeles" class="d-block" style="width: 100%">
                            <div class="carousel-caption">
                                <h3>La mayor plataforma del mundo</h3>
                                <p>485.044.407 personas que pasan a la acción</p>
                                <div class="text-center mt-5"><a type="button" class="btn btn-danger center-block" href="{{route('peticiones.create')}}">Inicia una peticion</a> </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
