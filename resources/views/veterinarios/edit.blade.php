@extends('adminlte::page')

@section('title', 'Editar Veterinario')

@section('content_header')
    <h1>Editar Veterinario</h1>
@stop

@section('content')
    <form action="{{ route('veterinarios.update', $veterinario) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $veterinario->nombre) }}">
                    @error('nombre') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo', $veterinario->correo) }}">
                    @error('correo') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $veterinario->telefono) }}">
                    @error('telefono') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion', $veterinario->direccion) }}">
                    @error('direccion') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="latitud">Latitud</label>
                    <input type="number" step="any" name="latitud" class="form-control @error('latitud') is-invalid @enderror" value="{{ old('latitud', $veterinario->latitud) }}">
                    @error('latitud') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="longitud">Longitud</label>
                    <input type="number" step="any" name="longitud" class="form-control @error('longitud') is-invalid @enderror" value="{{ old('longitud', $veterinario->longitud) }}">
                    @error('longitud') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="especialidades">Especialidades (selecciona una o más)</label>
                    <select name="especialidades[]" id="especialidades" class="form-control select2 @error('especialidades') is-invalid @enderror" multiple>
                        @foreach ($especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}" {{ $veterinario->especialidades->contains($especialidad->id) ? 'selected' : '' }}>{{ $especialidad->nombre }}</option>
                        @endforeach
                    </select>
                    @error('especialidades') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('veterinarios.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#especialidades').select2({
                placeholder: 'Selecciona una o más especialidades',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@stop