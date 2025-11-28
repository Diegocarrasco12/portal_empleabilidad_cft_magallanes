@extends('layouts.app')

@section('content')
<main class="container perfil-postulante">

    <h2 class="titulo">Perfil del Postulante</h2>

    <section class="perfil-card">
        <div class="foto-area">
            <img src="{{ $estudiante->foto ? asset('storage/'.$estudiante->foto) : asset('img/otros/no-user.png') }}"
                 alt="Foto estudiante">
        </div>

        <div class="info-area">
            <h3>{{ $estudiante->usuario->nombre }}</h3>

            <p><strong>Correo:</strong> {{ $estudiante->usuario->email }}</p>

            @if($estudiante->telefono)
            <p><strong>Teléfono:</strong> {{ $estudiante->telefono }}</p>
            @endif

            @if($estudiante->ciudad)
            <p><strong>Ciudad:</strong> {{ $estudiante->ciudad }}</p>
            @endif

            @if($estudiante->perfil_profesional)
            <p><strong>Perfil Profesional:</strong></p>
            <p>{{ $estudiante->perfil_profesional }}</p>
            @endif
        </div>
    </section>

    <hr>

    <section class="postulaciones-recientes">
        <h3>Postulaciones del Estudiante</h3>

        @forelse($postulaciones as $p)
            <article class="post-card">
                <h4>{{ $p->oferta->titulo }}</h4>
                <p><strong>Postulado el:</strong> {{ \Carbon\Carbon::parse($p->fecha_postulacion)->format('d-m-Y') }}</p>
            </article>
        @empty
            <p>Este postulante aún no tiene postulaciones registradas.</p>
        @endforelse
    </section>

</main>

<style>
    .perfil-postulante .titulo {
        font-size: 26px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .perfil-card {
        display: flex;
        gap: 30px;
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .foto-area img {
        width: 150px;
        height: 150px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #ddd;
    }

    .info-area h3 {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .postulaciones-recientes h3 {
        margin-top: 20px;
        margin-bottom: 15px;
        font-size: 22px;
        font-weight: bold;
    }

    .post-card {
        padding: 15px;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        margin-bottom: 10px;
        background: #fafafa;
    }
</style>

@endsection
