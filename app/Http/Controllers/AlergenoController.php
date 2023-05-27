<?php

namespace App\Http\Controllers;

use App\Models\Alergeno;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AlergenoController extends Controller
{
    public function index()
    {
        $alergenos = Alergeno::all();
        return $alergenos;
    }

    public static function getFilename($id)
    {
        $alergeno = Alergeno::find($id);

        if ($alergeno) {
            return $alergeno->image;
        }

        return null;
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('new',compact($categorias));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        Alergeno::create($validatedData);

        return redirect('index')->with('success', 'Alergeno creado correctamente');
    }

    public function edit($id)
    {
        $alergeno = Alergeno::find($id);
        return view('edit', compact('alergeno'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $alergeno = Alergeno::find($id);
        $alergeno->name = $request->get('name');

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public/images');
            $alergeno->image = $image;
        }

        $alergeno->save();

        return redirect('index')->with('success', 'Alergeno actualizado correctamente');
    }

    public function destroy($id)
    {
        $alergeno = Alergeno::find($id);
        $alergeno->delete();

        return redirect('index')->with('success', 'Alergeno eliminado correctamente');
    }
}
