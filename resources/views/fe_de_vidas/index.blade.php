@extends('layouts.app')

@section('title', content: 'Fe de Vidas')

@section('content_header')
    <h1 class="text-center">Administración de Fe de Vidas</h1>
@stop

@section('content')

@include('fragment.messages')

<div class="card">
    <div class="card-header bg-primary ">
        <div class="float-end">
            <a href="{{ route('home') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
        </div>
    </div>
    @can('view-user')
        <div class="card-body">

            {{ $dataTable->table() }}

        </div>
    @endcan
</div>


@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>




</script>


@endpush
