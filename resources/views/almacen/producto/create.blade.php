@extends('layouts.admin')
@section('contenido')
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nuevo Producto</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('producto.store') }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_categoria">Categoría</label>
                        <select class="form-control" name="id_categoria" id="id_categoria">
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}">{{ $categoria->categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Ingresa el código del producto">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre del producto">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingresa la descripción del producto">
                    </div>
                    <div class="form-group">
                        <label for="existencia">Stock</label>
                        <input type="number" class="form-control" name="stock" id="existencia" placeholder="Ingresa la existencia del producto">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" class="form-control" id="imagen" name="imagen">
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                        <button onclick="window.location.href='http://localhost/puntoventaalexander/public/almacen/producto'" type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
                        
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.row -->
@endsection
