@extends('adminlte::page')

@section('title', 'Veterinarios')

@section('content_header')
    <h1>Lista de Veterinarios</h1>
@stop

@section('content')
    @if (session('exito'))
        <div class="alert alert-success">{{ session('exito') }}</div>
    @endif
    <a href="{{ route('veterinarios.create') }}" class="btn btn-primary mb-3">Agregar Veterinario</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Especialidades</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($veterinarios as $veterinario)
                <tr>
                    <td>{{ $veterinario->nombre }}</td>
                    <td>{{ $veterinario->correo }}</td>
                    <td>{{ $veterinario->especialidades->pluck('nombre')->join(', ') }}</td>
                    <td>
                        <a href="{{ route('veterinarios.show', $veterinario) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('veterinarios.edit', $veterinario) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('veterinarios.destroy', $veterinario) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop