<?php

namespace App\Http\Controllers;

use App\Models\Karting;
use Illuminate\Http\Request;
use App\Http\Requests\KartingRequest;

class KartingController extends Controller
{
    public function index(Request $request)
{
    $query = Karting::query();

    // Solo filtrar si realmente hay texto
    if ($request->filled('search')) {
        $query->where('nombre', 'like', '%' . $request->search . '%');
    }

    $kartings = $query->get();

    return view('kartings.index', compact('kartings'));
}


    public function create()
    {
        return view('kartings.create');
    }

    public function store(KartingRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('kartings', 'public');
            $data['imagen'] = $path;
        }

        Karting::create($data);

        return redirect()->route('kartings.index')->with('success', 'Karting creado correctamente.');
    }

    public function edit(Karting $karting)
    {
        return view('kartings.edit', compact('karting'));
    }

    public function update(KartingRequest $request, Karting $karting)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('kartings', 'public');
            $data['imagen'] = $path;
        }

        $karting->update($data);

        return redirect()->route('kartings.index')->with('success', 'Karting actualizado correctamente.');
    }

    public function destroy(Karting $karting)
    {
        $karting->delete();
        return redirect()->route('kartings.index')->with('success', 'Karting eliminado correctamente.');
    }

    
}