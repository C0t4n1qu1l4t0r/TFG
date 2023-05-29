<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Turno;
use Illuminate\Support\Facades\Auth;

class TurnoController extends Controller
{
    public function index()
    {
        $turnos = Turno::all();

        return $turnos;
    }

    public function create()
    {
        $categorias = Categoria::all();
        $authenticated = Auth::check();
        return view('turnos/new',compact('categorias','authenticated'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hora' => 'required',
        ]);

        Turno::create($request->all());

        return redirect()->route('index')->with('success', 'Turno created successfully.');
    }

    public function edit($id)
    {
        $turno = Turno::findOrFail($id);
        $categorias = Categoria::all();
        $authenticated = Auth::check();
        return view('turnos/edit', compact('turno','categorias','authenticated'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hora' => 'required',
        ]);
        $turno = Turno::findOrFail($id);
        $turno->update($request->all());

        return redirect()->route('index')->with('success', 'Turno updated successfully.');
    }

    public function delete($id){
        $turno = Turno::findOrFail($id);
        $categorias = Categoria::all();
        $authenticated = Auth::check();
        return view('turnos/delete', compact('turno','categorias','authenticated'));
    }

    public function destroy($id)
    {
        $turno = Turno::findOrFail($id);

        $turno->delete();

        return redirect()->route('index')->with('success', 'Turno deleted successfully.');
    }
}
