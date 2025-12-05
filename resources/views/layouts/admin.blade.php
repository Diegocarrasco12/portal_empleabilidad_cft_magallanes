@extends('layouts.app')

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
