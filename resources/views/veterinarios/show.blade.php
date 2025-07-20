@extends('adminlte::page')

@section('title', 'Detalles del Veterinario')

@section('content_header')
    <h1>Detalles del Veterinario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $veterinario->nombre }}</p>
            <p><strong>Email:</strong> {{ $veterinario->email }}</p>
            <p><strong>Teléfono:</strong> {{ $veterinario->telefono ?? 'No especificado' }}</p>
            <p><strong>Dirección:</strong> {{ $veterinario->direccion ?? 'No especificado' }}</p>
            <p><strong>Especialidad:</strong> {{ $veterinario->especialidad }}</p>
            <p><strong>Latitud:</strong> {{ $veterinario->latitud ?? 'No especificado' }}</p>
            <p><strong>Longitud:</strong> {{ $veterinario->longitud ?? 'No especificado' }}</p>
            <p><strong>Descripción:</strong> {{ $veterinario->descripcion ?? 'No especificado' }}</p>
            <a href="{{ route('veterinarios.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
@stop