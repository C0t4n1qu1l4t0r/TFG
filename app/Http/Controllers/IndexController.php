<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $authenticated = Auth::check();

        $categoriaController = new CategoriaController();
        $tipoController = new TipoController();
        $platoController = new PlatoController();

        $categorias = $categoriaController->index();
        $tipos = $tipoController->index();
        $platos = $platoController->index();

        return view('index', compact('categorias', 'tipos', 'platos','authenticated'));
    }
}
