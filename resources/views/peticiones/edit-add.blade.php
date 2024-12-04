@extends('layouts.public')

@section('content')
    <div class="container-fluid mt-4">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col">
                <form method="post" action="{{route('peticiones.store')}}" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    <div class="col-md-8">
                        <label for="validationServer01" class="form-label">Titulo</label>
                        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" id="validationServer01">
                        @error('titulo')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <label for="validationServer01" class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" id="validationServer01"></textarea>
                        @error('descripcion')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <label for="validationServer01" class="form-label">Destinatario</label>
                        <textarea name="destinatario" class="form-control @error('destinatario') is-invalid @enderror" id="validationServer01" required></textarea>
                        @error('destinatario')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-8">
                        <label for="category">Categoría</label>
                        <select name="category" class="form-control" id="category">
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Sube una imagen</label>
                        <input name="file" type="file" class="form-control @error('file') is-invalid @enderror" aria-describedby="" placeholder="" aria-required="true">
                        @error('file')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <input value="Enviar petición nueva" type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
