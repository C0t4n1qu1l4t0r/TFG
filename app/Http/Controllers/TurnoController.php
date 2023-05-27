<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;

class TurnoController extends Controller
{
    public function index()
    {
        $turnos = Turno::all();

        return view('reservar', compact('turnos'));
    }

    public function create()
    {
        return view('new');
    }

    public function store(Request $request)
    {
        $turno = Turno::create([
            'hora_inicio' => $request->input('hora_inicio'),
            'hora_fin' => $request->input('hora_fin')
        ]);

        return redirect()->route('reservar')->with('success', 'Turno created successfully.');
    }

    public function edit($id)
    {
        $turno = Turno::find($id);

        return view('edit', compact('turno'));
    }

    public function update(Request $request, $id)
    {
        $turno = Turno::find($id);

        $turno->hora_inicio = $request->input('hora_inicio');
        $turno->hora_fin = $request->input('hora_fin');

        $turno->save();

        return redirect()->route('reservar')->with('success', 'Turno updated successfully.');
    }

    public function destroy($id)
    {
        $turno = Turno::find($id);

        $turno->delete();

        return redirect()->route('reservar')->with('success', 'Turno deleted successfully.');
    }
}
