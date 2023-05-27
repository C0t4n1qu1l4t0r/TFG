<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return $categorias;
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('new-categoria',compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Categoria::create($request->all());

        return redirect()->route('index')
            ->with('success','Categoria created successfully.');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('edit-categoria', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());

        return redirect()->route('index')
            ->with('success', 'Categoria updated successfully.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('index')
            ->with('success','Categoria deleted successfully');
    }
}
