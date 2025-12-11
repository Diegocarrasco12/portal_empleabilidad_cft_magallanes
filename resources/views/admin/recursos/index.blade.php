@extends('layouts.admin')

@section('admin-content')

<div class="admin-container">

    <div class="panel-header">
        <h2 class="title">Recursos de Empleabilidad</h2>

        <a href="{{ route('admin.recursos.create') }}" class="btn-primary">
            + Crear nuevo recurso
        </a>
    </div>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th style="width: 160px;">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($recursos as $recurso)
                    <tr>
                        <td>{{ $recurso->titulo }}</td>

                        <td>
                            @if($recurso->estado == 1)
                                <span class="badge badge-success">Publicado</span>
                            @else
                                <span class="badge badge-warning">Borrador</span>
                            @endif
                        </td>

                        <td>{{ $recurso->creado_en ? $recurso->creado_en->format('d/m/Y') : '-' }}</td>

                        <td>
                            <a href="{{ route('admin.recursos.edit', $recurso->id) }}" class="btn-sm btn-secondary">
                                Editar
                            </a>

                            <form action="{{ route('admin.recursos.destroy', $recurso->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-sm btn-danger"
                                        onclick="return confirm('¿Eliminar este recurso?')">
                                    Eliminar
                                </button>
                            </form>

                            <form action="{{ route('admin.recursos.toggle', $recurso->id) }}"
                                  method="POST"
                                  style="display:inline-block;">
                                @csrf

                                <button type="submit" class="btn-sm btn-primary">
                                    {{ $recurso->estado ? 'Ocultar' : 'Publicar' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding:20px;">
                            No hay recursos creados aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection
