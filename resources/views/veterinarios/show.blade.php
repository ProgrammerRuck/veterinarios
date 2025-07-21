@extends('adminlte::page')

@section('title', 'Detalles del Veterinario')

@section('content_header')
    <h1>Detalles del Veterinario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $veterinario->nombre }}</p>
            <p><strong>Correo:</strong> {{ $veterinario->correo }}</p>
            <p><strong>Teléfono:</strong> {{ $veterinario->telefono ?? 'No especificado' }}</p>
            <p><strong>Dirección:</strong> {{ $veterinario->direccion ?? 'No especificado' }}</p>
            <p><strong>Coordenadas:</strong> {{ $veterinario->latitud ? "($veterinario->latitud, $veterinario->longitud)" : 'No especificadas' }}</p>
            <p><strong>Especialidades:</strong> {{ $veterinario->especialidades->pluck('nombre')->join(', ') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('veterinarios.edit', $veterinario) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('veterinarios.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@stop