@extends('adminlte::page')

@section('title', 'Especialidades')

@section('content_header')
    <h1>Lista de Especialidades</h1>
@stop

@section('content')
    @if (session('exito'))
        <div class="alert alert-success">{{ session('exito') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <a href="{{ route('especialidades.create') }}" class="btn btn-primary mb-3">Agregar Especialidad</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($especialidades as $especialidad)
                <tr>
                    <td>{{ $especialidad->nombre }}</td>
                    <td>
                        <a href="{{ route('especialidades.edit', $especialidad) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('especialidades.destroy', $especialidad) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar esta especialidad?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop