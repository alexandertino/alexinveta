<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Proyecto;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ProyectoController extends Controller
{
    public function index()
    {
        // Traemos proyectos con la relación cliente para poder mostrar el nombre
        $proyectos = Proyecto::with('cliente')->latest()->get();

        return Inertia::render('Proyecto/Index', [
            'proyectos' => $proyectos,
        ]);
    }

    public function create()
    {
        // Para crear un proyecto, necesitamos la lista de clientes para elegir
        $clientes = Cliente::orderBy('nombres')->get();

        return Inertia::render('Proyecto/Create', [
            'clientes' => $clientes,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cliente_id' => 'required|exists:clientes,id',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        Proyecto::create([
            'nombre' => $request->nombre,
            'cliente_id' => $request->cliente_id,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        return redirect()->route('proyecto.index')->with('success', 'Proyecto creado correctamente.');
    }

    public function edit(Proyecto $proyecto)
    {
        $clientes = Cliente::orderBy('nombres')->get();

        return Inertia::render('Proyecto/Edit', [
            'proyecto' => $proyecto,
            'clientes' => $clientes,
        ]);
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cliente_id' => 'required|exists:clientes,id',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $proyecto->update([
            'nombre' => $request->nombre,
            'cliente_id' => $request->cliente_id,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        return redirect()->route('proyecto.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();

        return redirect()->route('proyecto.index')->with('success', 'Proyecto eliminado correctamente.');
    }

    public function exportarPdf(){
        $proyectos = Proyecto::all();

        $pdf = Pdf::loadView('pdf.proyecto', compact('proyectos'));

        return $pdf->stream('proyecto.pdf');

    }
}