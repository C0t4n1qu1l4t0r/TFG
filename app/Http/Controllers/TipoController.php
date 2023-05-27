<?php
namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function index()
    {
        $tipos = Tipo::all();
        return $tipos;
    }

    public function create()
    {
        return view('new');
    }

    public function store(Request $request)
    {
        $tipo = Tipo::create($request->all());
        return redirect()->route('index', $tipo->id);
    }

    public function edit($id)
    {
        $tipo = Tipo::findOrFail($id);
        return view('edit', compact('tipo'));
    }

    public function update(Request $request, $id)
    {
        $tipo = Tipo::findOrFail($id);
        $tipo->update($request->all());
        return redirect()->route('index', $tipo->id);
    }

    public function destroy($id)
    {
        $tipo = Tipo::findOrFail($id);
        $tipo->delete();
        return redirect()->route('index');
    }
}
