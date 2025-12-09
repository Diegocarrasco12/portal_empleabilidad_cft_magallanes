@extends('layouts.admin')

@section('admin-content')
<div class="admin-container">

    <h1 class="mb-3">Validación de ofertas</h1>

    {{-- Filtros por estado --}}
    <div class="card mb-3">
        <div class="card-body d-flex gap-2 flex-wrap">
            @php
                $tabs = [
                    'pending'     => 'Pendientes',
                    'approved'    => 'Aprobadas',
                    'rejected'    => 'Rechazadas',
                    'resubmitted' => 'Reenviadas',
                    'all'         => 'Todas',
                ];
            @endphp

            @foreach($tabs as $key => $label)
                @php
                    $isActive = $estadoFiltro === $key;
                @endphp
                <a href="{{ route('admin.ofertas.index', ['estado' => $key]) }}"
                   class="btn btn-sm {{ $isActive ? 'btn-primary' : 'btn-light' }}">
                    {{ $label }}
                    @if(in_array($key, ['pending','approved','rejected','resubmitted']))
                        <span class="badge bg-secondary">
                            {{ $stats[$key] ?? 0 }}
                        </span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>

    {{-- Tabla de ofertas --}}
    <div class="card">
        <div class="card-body">
            @if($ofertas->isEmpty())
                <p>No hay ofertas para el filtro seleccionado.</p>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Oferta</th>
                                <th>Empresa</th>
                                <th>Ciudad</th>
                                <th>Fecha creación</th>
                                <th>Estado</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ofertas as $oferta)
                                <tr>
                                    <td>
                                        <strong>{{ $oferta->titulo }}</strong><br>
                                        <small>{{ $oferta->area->nombre ?? 'Sin área' }}</small>
                                    </td>
                                    <td>{{ $oferta->empresa->razon_social ?? 'Empresa sin nombre' }}</td>
                                    <td>{{ $oferta->ciudad ?? '-' }}</td>
                                    <td>{{ optional($oferta->fecha_publicacion)->format('d-m-Y') }}</td>
                                    <td>
                                        @php
                                            $estado = $oferta->estado_nombre;
                                            $label  = [
                                                'Pendiente'     => 'Pendiente',
                                                'Aprobada'      => 'Aprobada',
                                                'Rechazada'     => 'Rechazada',
                                                'Reenviada'     => 'Reenviada',
                                            ][$estado] ?? 'Pendiente';

                                            $class = match($estado) {
                                                'Aprobada'    => 'badge bg-success',
                                                'Rechazada'    => 'badge bg-danger',
                                                'Reenviada' => 'badge bg-warning text-dark',
                                                default       => 'badge bg-secondary',
                                            };
                                        @endphp
                                        <span class="{{ $class }}">{{ $label }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.ofertas.show', $oferta->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Ver detalle
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Paginación --}}
                <div class="mt-3">
                    {{ $ofertas->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
