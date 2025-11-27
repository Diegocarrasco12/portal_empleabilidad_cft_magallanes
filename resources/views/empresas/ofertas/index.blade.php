@extends('layouts.app')

@section('content')
<h1>Mis Ofertas</h1>

@if ($ofertas->isEmpty())
    <p>No tienes ofertas creadas aún.</p>
@else
    <ul>
        @foreach ($ofertas as $oferta)
            <li>{{ $oferta->titulo }} - Estado: {{ $oferta->estado }}</li>
        @endforeach
    </ul>
@endif

@endsection
