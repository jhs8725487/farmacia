@extends('layouts.admin')

@section('content')
<div class="page-heading">
    <div class="d-flex justify-content-between align-items-center">
        <h3>Productos</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductoModal">
            <i class="bi bi-plus-circle"></i> Nuevo producto
        </button>
    </div>
</div>

<section class="section">
<div class="card">
    <div class="card-body">

        {{-- BUSCADOR --}}
        <form method="GET" action="{{ route('admin.productos.index') }}" class="mb-3">
            <input type="text" name="search" class="form-control"
                   placeholder="Buscar producto..."
                   value="{{ $search ?? '' }}">
        </form>

        {{-- TABLA --}}
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Laboratorio</th>
                        <th>Código</th>
                        <th>Receta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($productos as $producto)
                <tr>
                    <td>{{ $productos->firstItem() + $loop->index }}</td>
                    <td>{{ $producto->nombre_comercial }}</td>
                    <td>{{ $producto->categoria->nombre }}</td>
                    <td>{{ $producto->laboratorio->nombre ?? '-' }}</td>
                    <td>{{ $producto->codigo_producto }}</td>
                    <td>
                        @if($producto->usa_receta)
                            <span class="badge bg-danger">Sí</span>
                        @else
                            <span class="badge bg-success">No</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-success">Editar</button>
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No hay productos</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN --}}
        {{ $productos->links() }}

    </div>
</div>
</section>

{{-- MODAL CREAR --}}
<div class="modal fade" id="createProductoModal">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('admin.productos.store') }}" class="modal-content">
            @csrf

            <div class="modal-header bg-primary text-white">
                <h5>Crear producto</h5>
            </div>

            <div class="modal-body row">

                <div class="col-md-6 mb-2">
                    <label>Nombre comercial</label>
                    <input type="text" name="nombre_comercial" class="form-control" required>
                </div>

                <div class="col-md-6 mb-2">
                    <label>Nombre genérico</label>
                    <input type="text" name="nombre_generico" class="form-control" required>
                </div>

                <div class="col-md-6 mb-2">
                    <label>Categoría</label>
                    <select name="categoria_id" class="form-control" required>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-2">
                    <label>Laboratorio</label>
                    <select name="laboratorio_id" class="form-control">
                        <option value="">-- Opcional --</option>
                        @foreach($laboratorios as $lab)
                            <option value="{{ $lab->id }}">{{ $lab->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-2">
                    <label>Código producto</label>
                    <input type="text" name="codigo_producto" class="form-control" required>
                </div>

                <div class="col-md-6 mb-2">
                    <label>Código barra</label>
                    <input type="text" name="codigo_barra" class="form-control">
                </div>

                <div class="col-md-4 mb-2">
                    <label>Forma farmacéutica</label>
                    <input type="text" name="forma_farmaceutica" class="form-control">
                </div>

                <div class="col-md-4 mb-2">
                    <label>Presentación</label>
                    <input type="text" name="presentacion" class="form-control">
                </div>

                <div class="col-md-4 mb-2">
                    <label>Concentración</label>
                    <input type="text" name="concentracion" class="form-control">
                </div>

                <div class="col-md-6 mb-2">
                    <label>Acción terapéutica</label>
                    <input type="text" name="accion_terapeutica" class="form-control">
                </div>

                <div class="col-md-6 mb-2">
                    <label>Unidad de medida</label>
                    <input type="text" name="unidad_medida" class="form-control">
                </div>

                <div class="col-md-6 mb-2">
                    <label>
                        <input type="checkbox" name="usa_receta"> Usa receta
                    </label>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary">Guardar</button>
            </div>

        </form>
    </div>
</div>

@endsection