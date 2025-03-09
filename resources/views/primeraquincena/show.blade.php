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
                    Product Information
                </div>
                <div class="float-end">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $product->name }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Description:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $product->description }}
                        </div>
                    </div>
        
            </div>
        </div>
    </div>    
</div>
    
@endsection