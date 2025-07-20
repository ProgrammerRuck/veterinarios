@extends('adminlte::page')

@section('title', 'Crear Veterinario')

@section('content_header')
    <h1>Crear Veterinario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('veterinarios.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" class="form-control">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" class="form-control">
                </div>
                <div class="form-group">
                    <label for="especialidad">Especialidad</label>
                    <select name="especialidad" class="form-control" required>
                        <option value="cirugía">Cirugía</option>
                        <option value="dermatología">Dermatología</option>
                        <option value="cardiología">Cardiología</option>
                        <option value="neurología">Neurología</option>
                        <option value="oncología">Oncología</option>
                        <option value="ortopedia">Ortopedia</option>
                        <option value="endocrinología">Endocrinología</option>
                        <option value="gastroenterología">Gastroenterología</option>
                        <option value="odontología">Odontología</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="latitud">Latitud</label>
                    <input type="number" step="any" name="latitud" class="form-control">
                </div>
                <div class="form-group">
                    <label for="longitud">Longitud</label>
                    <input type="number" step="any" name="longitud" class="form-control">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('veterinarios.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop