@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/empresas-crear-oferta.css') }}">
@endpush


@section('content')
    @include('ofertas.form')
@endsection
