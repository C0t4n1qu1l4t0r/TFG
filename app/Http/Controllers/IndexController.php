<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $categoriaController = new CategoriaController();
        $tipoController = new TipoController();
        $platoController = new PlatoController();

        $categorias = $categoriaController->index();
        $tipos = $tipoController->index();
        $platos = $platoController->index();

        return view('index', compact('categorias', 'tipos', 'platos'));
    }
}
