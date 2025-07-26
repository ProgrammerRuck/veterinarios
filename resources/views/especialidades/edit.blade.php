@extends('adminlte::page')

   @section('title', 'Editar Especialidad')

   @section('content_header')
       <h1>Editar Especialidad</h1>
   @stop

   @section('content')
       <form action="{{ route('especialidades.update', $especialidade) }}" method="POST">
           @csrf
           @method('PUT')
           <div class="card">
               <div class="card-body">
                   <div class="form-group">
                       <label for="nombre">Nombre de la Especialidad</label>
                       <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $especialidade->nombre) }}">
                       @error('nombre') <span class="invalid-feedback">{{ $message }}</span> @enderror
                   </div>
               </div>
               <div class="card-footer">
                   <button type="submit" class="btn btn-primary">Actualizar</button>
                   <a href="{{ route('especialidades.index') }}" class="btn btn-secondary">Cancelar</a>
               </div>
           </div>
       </form>
   @stop