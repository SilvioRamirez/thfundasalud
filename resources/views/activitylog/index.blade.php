@extends('layouts.app')

@section('title', 'Log de Actividades')

@section('content_header')
    <h1 class="text-center">Logs del Sistema</h1>
@stop

@section('content')

@include('fragment.messages')

<div class="card">
    @can('view-user')
        <div class="card-body">

            {{ $dataTable->table() }}

        </div>
    @endcan
</div>


@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
