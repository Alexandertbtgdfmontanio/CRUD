<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductoFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $productos = DB::table('producto as p')
            ->join('categoria as c', 'p.id_categoria', '=', 'c.id_categoria')
            ->select('p.id_producto', 'p.codigo', 'p.nombre', 'p.stock', 'p.descripcion', 'p.imagen', 'p.estado')
            ->where(function ($query) use ($texto) {
                $query->where('p.nombre', 'LIKE', '%' . $texto . '%')
                    ->orWhere('p.codigo', 'LIKE', '%' . $texto . '%');
            })
            //->where('p.estado', '=', 'Activo') // Filtrar por estado activo
            ->orderBy('id_producto', 'desc')
            ->paginate(7);

        return view('almacen.producto.index', compact('productos', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categoria::all();
        return view("almacen.producto.create", compact( 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoFormRequest $request)
    {
         // Crear un nuevo objeto Producto con los datos del formulario
         $producto = new Producto();
         $producto->id_categoria = $request->id_categoria;
         $producto->codigo = $request->codigo;
         $producto->nombre = $request->nombre;
         $producto->descripcion = $request->descripcion;
         $producto->stock = $request->stock;
         $producto->imagen = $request->imagen;
         $producto->estado = 'Activo';
        // Validar los datos del formulario
        if($request->hasFile("imagen")){
            $imagen = $request->file("imagen");
            $nombreimagen =Str::slug($request->nombre).".".$imagen->guessExtension();
            $ruta=public_path("/imagenes/productos/");
            copy($imagen->getRealPath(),$ruta.$nombreimagen);

            $producto->imagen = $nombreimagen;
        }

            $producto->save();
        

        // Redireccionar a la página de índice de productos con un mensaje de éxito
        return Redirect::to('almacen/producto');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all(); // Suponiendo que tienes un modelo Categoria para obtener todas las categorías
        return view('almacen.producto.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
    
        // Actualizar los datos del producto
        $producto->id_categoria = $request->id_categoria;
         $producto->codigo = $request->codigo;
         $producto->nombre = $request->nombre;
         $producto->descripcion = $request->descripcion;
         $producto->stock = $request->stock;
        // Validar los datos del formulario
        if($request->hasFile("imagen")){
            $imagen = $request->file("imagen");
            $nombreimagen =Str::slug($request->nombre).".".$imagen->guessExtension();
            $ruta=public_path("/imagenes/productos/");
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
            $producto->imagen = $nombreimagen;
        }

            $producto->save();
        
        return Redirect::to('almacen/producto');

    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el producto por su ID
        $producto = Producto::findOrFail($id);
        $producto->estado = 'Inactivo';
        $producto->save();
        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente');
    }
}