<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Laboratorio;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['categoria', 'laboratorio'])->paginate(10);
        $categorias = Categoria::all();
        $laboratorios = Laboratorio::all();

        return view('admin.productos.index', compact('productos','categorias','laboratorios'));
    }
}
