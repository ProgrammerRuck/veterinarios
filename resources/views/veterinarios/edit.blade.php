@extends('adminlte::page')

@section('title', 'Editar Veterinario')

@section('content_header')
    <h1>Editar Veterinario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('veterinarios.update', $veterinario) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $veterinario->nombre }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $veterinario->email }}" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ $veterinario->telefono }}">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="{{ $veterinario->direccion }}">
                </div>
                <div class="form-group">
                    <label for="especialidad">Especialidad</label>
                    <select name="especialidad" class="form-control" required>
                        @foreach(['cirugía', 'dermatología', 'cardiología', 'neurología', 'oncología', 'ortopedia', 'endocrinología', 'gastroenterología', 'odontología'] as $esp)
                            <option value="{{ $esp }}" {{ $veterinario->especialidad == $esp ? 'selected' : '' }}>{{ $esp }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="latitud">Latitud</label>
                    <input type="number" step="any" name="latitud" class="form-control" value="{{ $veterinario->latitud }}">
                </div>
                <div class="form-group">
                    <label for="longitud">Longitud</label>
                    <input type="number" step="any" name="longitud" class="form-control" value="{{ $veterinario->longitud }}">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ $veterinario->descripcion }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('veterinarios.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop