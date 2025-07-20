@extends('adminlte::page')

@section('title', 'Lista de Veterinarios')

@section('content_header')
    <h1>Lista de Veterinarios</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('veterinarios.create') }}" class="btn btn-primary">Agregar Veterinario</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Especialidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($veterinarios as $veterinario)
                        <tr>
                            <td>{{ $veterinario->id }}</td>
                            <td>{{ $veterinario->nombre }}</td>
                            <td>{{ $veterinario->email }}</td>
                            <td>{{ $veterinario->especialidad }}</td>
                            <td>
                                <a href="{{ route('veterinarios.show', $veterinario) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('veterinarios.edit', $veterinario) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('veterinarios.destroy', $veterinario) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop