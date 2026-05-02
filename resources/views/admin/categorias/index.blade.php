@extends('layouts.admin')

@push('styles')
<style>
    .modal .input-group .input-group-text {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush

@section('content')
<div class="page-heading">
    <div class="d-flex justify-content-between align-items-center">
        <h3>Categorías</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoriaModal">
            <i class="bi bi-plus-circle"></i> Nueva categoría
        </button>
    </div>
</div>

<section class="section">
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">Listado de categorías registradas</h4>
    </div>

    <div class="card-body">

        {{-- BUSCADOR --}}
        <form method="GET" action="{{ route('admin.categorias.index') }}" class="mb-3">
            <div class="row g-2 align-items-end">
                <div class="col-12 col-md-8">
                    <label class="form-label mb-1">Buscar categoría</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control"
                               value="{{ $search ?? '' }}"
                               placeholder="Escribe el nombre de la categoría">
                    </div>
                </div>
                <div class="col-12 col-md-4 d-flex gap-2">
                    <button class="btn btn-primary w-100">Buscar</button>
                    <a href="{{ route('admin.categorias.index') }}" class="btn btn-light-secondary w-100">Limpiar</a>
                </div>
            </div>
        </form>

        @if (!empty($search))
            <div class="alert alert-info py-2 mb-3">
                Se encontraron {{ $categorias->total() }} resultado(s) para "{{ $search }}"
            </div>
        @endif

        {{-- TABLA --}}
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th style="width: 80px;">#</th>
                        <th>Nombre</th>
                        <th style="width: 180px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categorias as $categoria)
                    <tr>
                        <td>{{ $categorias->firstItem() + $loop->index }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>
                            <button class="btn btn-sm btn-success"
                                data-bs-toggle="modal"
                                data-bs-target="#editCategoriaModal-{{ $categoria->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <button class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteCategoriaModal-{{ $categoria->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            No hay categorías registradas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN --}}
        @if ($categorias->count())
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mt-3">
            <small class="text-muted">
                Mostrando {{ $categorias->firstItem() }} a {{ $categorias->lastItem() }}
                de {{ $categorias->total() }} registros
            </small>
            <div>
                {{ $categorias->links('vendor.pagination.bootstrap-5-no-summary') }}
            </div>
        </div>
        @endif

    </div>
</div>
</section>

{{-- MODAL CREAR --}}
<div class="modal fade" id="createCategoriaModal">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.categorias.store') }}" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5>Crear categoría</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre (*)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-tag"></i></span>
                        <input type="text" name="nombre"
                            class="form-control @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre') }}" required>
                    </div>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- MODALES EDITAR Y ELIMINAR --}}
@foreach($categorias as $categoria)

{{-- EDITAR --}}
<div class="modal fade" id="editCategoriaModal-{{ $categoria->id }}">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.categorias.update', $categoria->id) }}" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header bg-success text-white">
                <h5>Editar categoría</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre (*)</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-success">Actualizar</button>
            </div>
        </form>
    </div>
</div>

{{-- ELIMINAR --}}
<div class="modal fade" id="deleteCategoriaModal-{{ $categoria->id }}">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('admin.categorias.destroy', $categoria->id) }}" class="modal-content">
            @csrf
            @method('DELETE')

            <div class="modal-header bg-danger text-white">
                <h5>Eliminar categoría</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p class="mb-0">
                    ¿Está seguro de eliminar la categoría <strong>{{ $categoria->nombre }}</strong>?
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-danger">Eliminar</button>
            </div>
        </form>
    </div>
</div>

@endforeach
@endsection