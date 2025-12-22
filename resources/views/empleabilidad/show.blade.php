@extends('layouts.app')

@section('title', $recurso->titulo)

@section('content')
<section class="cft-blog cft-blog--detalle">
  <div class="container">
    <nav class="mb-3">
      <a href="{{ route('empleabilidad.index') }}" class="small text-muted">
        ← Volver a Recursos
      </a>
    </nav>

    <h1 class="fw-bold mb-3">{{ $recurso->titulo }}</h1>

    @if ($recurso->imagen)
      <div class="ratio ratio-16x9 mb-4 cft-blog-media">
        <img src="{{ asset($recurso->imagen) }}" alt="{{ $recurso->titulo }}">
      </div>
    @endif

    <article class="prose">
      {!! nl2br(e($recurso->contenido)) !!}
    </article>
  </div>
</section>
@endsection
