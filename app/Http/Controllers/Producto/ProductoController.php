<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::latest()->get();

        return Inertia::render('Producto/Index', [
            'productos' => $productos,
        ]);
    }

    public function create()
    {
        return Inertia::render('Producto/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:productos,codigo',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
        ]);

        Producto::create([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('producto.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Producto $producto)
    {
        return Inertia::render('Producto/Edit', [
            'producto' => $producto,
        ]);
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:productos,codigo,' . $producto->id,
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
        ]);

        $producto->update([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function exportarPdf(){
        $productos = Producto::all();

        $pdf = Pdf::loadView('pdf.producto', compact('productos'));

        return $pdf->stream('producto.pdf');

    }
}