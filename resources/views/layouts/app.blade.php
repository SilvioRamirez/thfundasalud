@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
@stop

@section('content')
    
    <p>Welcome to this beautiful admin panel.</p>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop


@section('js')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('scripts')
@stop

