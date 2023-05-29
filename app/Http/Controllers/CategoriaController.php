<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

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
        $authenticated = Auth::check();
        return view('categorias/new',compact('categorias','authenticated'));
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
        $categorias = Categoria::all();
        $authenticated = Auth::check();
        return view('categorias/edit', compact('categoria','categorias','authenticated'));
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

    public function delete($id){
        $categoria = Categoria::findOrFail($id);
        $categorias = Categoria::all();
        $authenticated = Auth::check();
        return view('categorias/delete', compact('categoria','categorias','authenticated'));
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('index')
            ->with('success','Categoria deleted successfully');
    }
}
