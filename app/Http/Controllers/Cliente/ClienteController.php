<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::latest()->get();

        return Inertia::render('Cliente/Index', [
            'clientes' => $clientes,
        ]);
    }

    public function create()
    {
        return Inertia::render('Cliente/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'pri_ape' => 'required|string|max:255',
            'seg_ape' => 'required|string|max:255',
            'docu_tip' => 'required|string|max:9',
            'docu_num' => 'required|string|max:255|unique:clientes,docu_num',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        Cliente::create([
            'nombres' => $request->nombres,
            'pri_ape' => $request->pri_ape,
            'seg_ape' => $request->seg_ape,
            'docu_tip' => $request->docu_tip,
            'docu_num' => $request->docu_num,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('cliente.index')->with('success', 'Cliente creado correctamente.');
    }

    public function edit(Cliente $cliente)
    {
        return Inertia::render('Cliente/Edit', [
            'cliente' => $cliente
        ]);
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'pri_ape' => 'required|string|max:255',
            'seg_ape' => 'required|string|max:255',
            'docu_tip' => 'required|string|max:9',
            'docu_num' => 'required|string|max:255|unique:clientes,docu_num,' . $cliente->id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        $cliente->update([
            'nombres' => $request->nombres,
            'pri_ape' => $request->pri_ape,
            'seg_ape' => $request->seg_ape,
            'docu_tip' => $request->docu_tip,
            'docu_num' => $request->docu_num,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('cliente.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('cliente.index')->with('success', 'Cliente eliminado correctamente.');
    }

    public function exportarPdf(){
        $clientes = Cliente::all();

        $pdf = Pdf::loadView('pdf.cliente', compact('clientes'));

        return $pdf->stream('clientes.pdf');

    }
}