<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Reserva;
use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return $reservas;
    }

    public function reservas(){

        $categorias = Categoria::all();
        $authenticated = Auth::check();

        if (Auth::user()->rol == 0){
            $reservas = Reserva::all();
        }else{
            $reservas = Reserva::where('user_id', Auth::id())->get();
        }

        return view('reservas',compact('reservas','categorias','authenticated'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $authenticated = Auth::check();
        $turnos = Turno::all();

        return view('reservar',compact('categorias','authenticated','turnos'));
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

        $reservedPersons = Reserva::where('turno_id', $turnoId)->sum('numPersonas');
        $availableSlots = 20 - $reservedPersons;

        if ($request->input('numPersonas') > $availableSlots) {
            return back()->with('error', 'El turno seleccionado está ocupado, por favor seleccione otro turno.');
        }

        $reserva = new Reserva();
        $reserva->fecha = $request->input('fecha');
        $reserva->numPersonas = $request->input('numPersonas');
        $reserva->user_id = Auth::id();
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
