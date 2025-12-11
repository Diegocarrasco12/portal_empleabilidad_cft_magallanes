@extends('layouts.admin')

@section('admin-content')
    <section class="container admin-dashboard">

        {{-- KPIs superiores --}}
        <div class="kpi-grid">
            {{-- Empresas --}}
            <article class="kpi-card">
                <div class="kpi-icon">🏛️</div>
                <div class="kpi-numbers">
                    <h3>{{ $totalEmpresas }}</h3>
                    <p>Empresas</p>
                </div>
            </article>

            {{-- Ofertas --}}
            <article class="kpi-card">
                <div class="kpi-icon">📦</div>
                <div class="kpi-numbers">
                    <h3>{{ $totalOfertas }}</h3>
                    <p>Ofertas</p>
                </div>
            </article>

            {{-- Postulaciones --}}
            <article class="kpi-card">
                <div class="kpi-icon">👤</div>
                <div class="kpi-numbers">
                    <h3>{{ $totalPostulaciones }}</h3>
                    <p>Postulaciones</p>
                </div>
            </article>

            {{-- Tasa Promedio --}}
            <article class="kpi-card">
                <div class="kpi-icon">📈</div>
                <div class="kpi-numbers">
                    <h3>{{ $tasaPromedio }}%</h3>
                    <p>Tasa Promedio Postulaciones</p>
                </div>
            </article>
        </div>

        {{-- Tablas resumidas --}}
        <div class="grid-2">
            <article class="panel">
                <header class="panel-header">
                    <h4>Empresas Registradas</h4>
                </header>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Empresa</th>
                                <th>Contacto</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimasEmpresas as $empresa)
                                <tr>
                                    <td>{{ $empresa->nombre_comercial }}</td>
                                    <td>{{ $empresa->correo_contacto }}</td>
                                    <td><span class="badge badge-success">Activo</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No hay empresas registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('admin.empresas.index') }}" class="panel-link">Ver todas</a>
                </div>
            </article>

            <article class="panel">
                <header class="panel-header">
                    <h4>Postulantes Registrados</h4>
                </header>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>N° Post.</th>
                                <th>Carrera</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimosPostulantes as $postulante)
                                <tr>
                                    <td>{{ $postulante->nombre }} {{ $postulante->apellido }}</td>
                                    <td><a href="mailto:{{ $postulante->email }}">{{ $postulante->email }}</a></td>
                                    <td>–</td>
                                    <td>–</td>
                                    <td><span class="badge badge-success">Activo</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No existen postulantes aún.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('admin.estudiantes.index') }}" class="panel-link">Ver todos</a>
                </div>
            </article>
        </div>

        {{-- Gráficos (estáticos con imágenes por ahora) --}}
        <div class="grid-3">
            <article class="panel">
                <header class="panel-header">
                    <h4>Total Ofertas Creadas Por Mes</h4>
                </header>
                <div class="panel-body chart-placeholder">
                    <canvas id="chartOfertas"></canvas>
                </div>
            </article>

            <article class="panel">
                <header class="panel-header">
                    <h4>Postulaciones por área</h4>
                </header>
                <div class="panel-body chart-placeholder">
                    <canvas id="chartAreas"></canvas>
                </div>
            </article>

            <article class="panel">
                <header class="panel-header">
                    <h4>Carreras con más postulaciones</h4>
                </header>
                <div class="panel-body chart-placeholder">
                    <canvas id="chartCarreras"></canvas>
                </div>
            </article>
        </div>


    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // === 1) OFERTAS POR MES ===
    const ofertasCtx = document.getElementById('chartOfertas');

    new Chart(ofertasCtx, {
        type: 'line',
        data: {
            labels: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            datasets: [{
                label: 'Ofertas creadas',
                data: @json($ofertasMesArray),
                borderColor: '#B1202C',
                backgroundColor: 'rgba(177, 32, 44, 0.2)',
                borderWidth: 3,
                tension: 0.3
            }]
        }
    });

    // === 2) POSTULACIONES POR ÁREA ===
    const areaCtx = document.getElementById('chartAreas');

    new Chart(areaCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($postPorArea)) !!},
            datasets: [{
                label: 'Postulaciones',
                data: {!! json_encode(array_values($postPorArea)) !!},
                backgroundColor: '#1B355E'
            }]
        }
    });

    // === 3) TOP CARRERAS ===
    const carreraCtx = document.getElementById('chartCarreras');

    new Chart(carreraCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($topCarreras)) !!},
            datasets: [{
                data: {!! json_encode(array_values($topCarreras)) !!},
                backgroundColor: [
                    '#B1202C',
                    '#1B355E',
                    '#5C677D',
                    '#CCCCCC',
                    '#FFCE56'
                ]
            }]
        }
    });
</script>
@endsection

