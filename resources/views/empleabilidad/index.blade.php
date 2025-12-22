@extends('layouts.app') {{-- o tu layout principal --}}

@section('title', 'Recursos de Empleabilidad')

@section('content')
<section class="cft-blog cft-blog--catalogo">
  <div class="container">
    <p class="overline text-center mb-2">Recursos de Empleabilidad</p>
    <h1 class="display-5 text-center fw-bold mb-4">Guías, consejos y tendencias</h1>

    <div class="cft-blog-grid">
      @foreach ($recursos as $r)
        <article class="cft-blog-card">
          <a href="{{ route('empleabilidad.show', $r->id) }}" class="cft-blog-media ratio ratio-16x9">
            <img src="{{ asset($r->imagen) }}" alt="{{ $r->titulo }}">
          </a>

          <h3 class="cft-blog-title mt-3 mb-2">{{ $r->titulo }}</h3>

          <p class="text-muted mb-3" style="min-height:2.6em">
            {{ $r->resumen }}
          </p>

          <a href="{{ route('empleabilidad.show', $r->id) }}" class="btn btn-cft">
            LEER MÁS
          </a>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endsection
