<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipoController extends Controller
{
    public function index()
    {
        $tipos = Tipo::all();
        return $tipos;
    }

    public function create()
    {
        $categorias = Categoria::all();
        $authenticated = Auth::check();
        return view('tipos/new',compact('categorias','authenticated'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'categoria_id' => 'required'
        ]);

        Tipo::create($request->all());
        return redirect()->route('index')->with('success','Tipo created successfully.');
    }

    public function edit($id)
    {
        $tipo = Tipo::findOrFail($id);
        $categorias = Categoria::all();
        $authenticated = Auth::check();
        return view('tipos/edit', compact('tipo','categorias','authenticated'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'categoria_id' => 'required'
        ]);

        $tipo = Tipo::findOrFail($id);
        $tipo->update($request->all());
        return redirect()->route('index')->with('success', 'Tipo updated successfully.');
    }

    public function delete($id){
        $tipo = Tipo::findOrFail($id);
        $categorias = Categoria::all();
        $authenticated = Auth::check();

        return view('tipos/delete', compact('tipo','categorias','authenticated'));
    }

    public function destroy($id)
    {
        $tipo = Tipo::findOrFail($id);
        $tipo->delete();

        return redirect()->route('index')->with('success','Tipo deleted successfully');
    }
}
