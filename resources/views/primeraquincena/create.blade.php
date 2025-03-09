@extends('layouts.app')

@section('title', content: 'Primera Quincena')

@section('content_header')
    <h1 class="text-center">Administración de Productos</h1>
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Agregar nuevo producto
                </div>
                <div class="float-end">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Atrás</a>
                </div>
            </div>
            <div class="card-body">

                {{-- {{ html()->form('PUT', '/post')->open() }}
                <div class="mb-3 row">
                    {{ html()->label('Nombre', 'name')->class('col-md-4 col-form-label text-md-end text-start') }}
                    <div class="col-md-6">
                        {{ html()->input('text', 'name', '')->class('form-control') }}
                    </div>
                </div>
                <div class="mb-3 row">
                    {{ html()->label('Descripción', 'description')->class('col-md-4 col-form-label text-md-end text-start') }}
                    <div class="col-md-6">
                        {{ html()->textarea('description', '')->class('form-control') }}
                    </div>
                </div>
                {{ html()->submit('Submit')->class('col-md-3 offset-md-5 btn btn-primary') }}
                {{ html()->form()->close() }} --}}


                <form action="{{ route('products.store') }}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start">Descripción</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Agregar producto">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection
