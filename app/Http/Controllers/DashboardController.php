<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $authenticated = Auth::check();

        $alergenoController = new AlergenoController();
        $categoriaController = new CategoriaController();
        $platoController = new PlatoController();
        $reservaController = new ReservaController();
        $tipoController = new TipoController();
        $turnoController = new TurnoController();
        $userController = new UserController();


        $alergenos = $alergenoController->index();
        $categorias = $categoriaController->index();
        $platos = $platoController->index();
        $reservas = $reservaController->index();
        $tipos = $tipoController->index();
        $turnos = $turnoController->index();
        $users = $userController->index();

        return view('dashboard', compact('categorias', 'tipos', 'platos','authenticated','alergenos','reservas','turnos','users'));
    }
}
