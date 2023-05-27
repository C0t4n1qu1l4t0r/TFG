<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = Reserva::all();
        return view('reservas', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $turnoId = $request->input('turno_id');

        // Check if the selected turn is available
        $reservedPersons = Reserva::where('turno_id', $turnoId)->sum('numPersonas');
        $availableSlots = 20 - $reservedPersons;

        if ($request->input('numPersonas') > $availableSlots) {
            return back()->with('error', 'El turno seleccionado está ocupado, por favor seleccione otro turno.');
        }

        // Create the reservation
        $reserva = new Reserva();
        $reserva->fecha = $request->input('fecha');
        $reserva->numPersonas = $request->input('numPersonas');
        $reserva->user_id = $request->input('user_id');
        $reserva->turno_id = $turnoId;
        $reserva->save();

        return redirect()->route('reservas')->with('success', 'La reserva se ha creado correctamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        return view('reservas', compact('reserva'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        return view('reservar', compact('reserva'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'fecha' => 'required',
            'numPersonas' => 'required|integer|min:1',
            'user_id' => 'required|exists:users,id',
            'turno_id' => 'required|exists:turnos,id',
        ]);

        $reserva->update($request->all());

        return redirect()->route('reservas')
            ->with('success','Reserva updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();

        return redirect()->route('reservas')
            ->with('success','Reserva deleted successfully');
    }
}
