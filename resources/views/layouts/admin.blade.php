@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/panel-admin.css') }}">
@endpush

@section('content')
<div class="admin-layout">
    
    {{-- Sidebar fija --}}
    @include('admin.components.sidebar')

    {{-- Contenido principal dinámico --}}
    <main class="admin-content">
        @yield('admin-content')
    </main>

</div>
@endsection
