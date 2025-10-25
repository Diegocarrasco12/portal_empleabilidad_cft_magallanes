@extends('layouts.app')

@section('content')
    <section class="container admin-dashboard">

        {{-- KPIs superiores --}}
        <div class="kpi-grid">
            <article class="kpi-card">
                <div class="kpi-icon">🏛️</div>
                <div class="kpi-numbers">
                    <h3>42</h3>
                    <p>Empresas</p>
                </div>
            </article>

            <article class="kpi-card">
                <div class="kpi-icon">📦</div>
                <div class="kpi-numbers">
                    <h3>128</h3>
                    <p>Ofertas</p>
                </div>
            </article>

            <article class="kpi-card">
                <div class="kpi-icon">👤</div>
                <div class="kpi-numbers">
                    <h3>856</h3>
                    <p>Postulaciones</p>
                </div>
            </article>

            <article class="kpi-card">
                <div class="kpi-icon">📈</div>
                <div class="kpi-numbers">
                    <h3>72%</h3>
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
                            @for ($i = 0; $i < 6; $i++)
                                <tr>
                                    <td>Magallanes Logística SPA</td>
                                    <td>magonlogistica@ejemplo.cl</td>
                                    <td><span class="badge badge-success">Activo</span></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                    <a href="#" class="panel-link">Ver todas</a>
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
                            @for ($i = 0; $i < 6; $i++)
                                <tr>
                                    <td>Jorge González R.</td>
                                    <td><a href="mailto:jorge@ejemplo.cl">jorge@ejemplo.cl</a></td>
                                    <td>12</td>
                                    <td>Téc. Enfermería</td>
                                    <td><span class="badge badge-success">Activo</span></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                    <a href="#" class="panel-link">Ver todos</a>
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
                    <img src="{{ asset('img/otros/Fuentes-de-tráfico.jpg') }}" alt="Gráfico líneas" />
                </div>
            </article>

            <article class="panel">
                <header class="panel-header">
                    <h4>Postulaciones por área</h4>
                </header>
                <div class="panel-body chart-placeholder">
                    <img src="{{ asset('img/otros/grf3.png') }}" alt="Gráfico torta" />
                </div>
            </article>

            <article class="panel">
                <header class="panel-header">
                    <h4>Carreras con más postulaciones</h4>
                </header>
                <div class="panel-body chart-placeholder">
                    <img src="{{ asset('img/otros/grf.png') }}" alt="Gráfico barras" />
                </div>
            </article>
        </div>


    </section>
@endsection
