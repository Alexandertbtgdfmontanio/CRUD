@extends('layouts.admin')
@section('contenido')
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Producto {{ $producto->nombre }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('producto.update', $producto->id_producto) }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                @method('PUT')
                    <div class="card-body">
                        <label for="id_categoria">Categoría</label>
                        <select class="form-control" name="id_categoria" id="id_categoria">
                            @foreach($categorias as $categoria)
                    
                                <option value="{{ $categoria->id_categoria }}" {{ $categoria->id_categoria == $producto->id_categoria ? 'selected' : '' }}>{{ $categoria->categoria }}</option>
                            @endforeach
                        </select>

                        <div class="form-group">
                            <label for="codigo">Código</label>
                            <input type="text" class="form-control" name="codigo" id="codigo" value="{{ $producto->codigo }}" placeholder="Ingresa el código del producto">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $producto->nombre }}" placeholder="Ingresa el nombre del producto">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{ $producto->descripcion }}" placeholder="Ingresa la descripción del producto">
                        </div>
                        <div class="form-group">
                            <label for="stock">stock</label>
                            <input type="number" class="form-control" name="stock" id="stock" value="{{ $producto->stock }}" placeholder="Ingresa la stock del producto">
                        </div>
                        <div class="col-md-6 col-12">
                        <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control" name="imagen" id="imagen">
                                @if (($producto->imagen)!="")
                                <img src="http://localhost/puntoventaalexander/public/imagenes/productos/{{$producto->imagen}}" alt="{{$producto->nombre}}" height="100" width="100px" class="img-thumbnail">
                          @endif
                            </div>
                        </div>
                        

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