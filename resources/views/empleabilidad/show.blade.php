@extends('layouts.app')

@section('title', $recurso['title'])

@section('content')
<section class="cft-blog cft-blog--detalle">
  <div class="container">
    <nav class="mb-3">
      <a href="{{ route('empleabilidad.index') }}" class="small text-muted">← Volver a Recursos</a>
    </nav>

    <h1 class="fw-bold mb-3">{{ $recurso['title'] }}</h1>
    <div class="ratio ratio-16x9 mb-4 cft-blog-media">
      <img src="{{ $recurso['cover'] }}" alt="{{ $recurso['title'] }}">
    </div>

    <article class="prose">
      {!! $recurso['body'] !!}
    </article>
  </div>
</section>
@endsection
