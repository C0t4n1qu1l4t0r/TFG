<?php

namespace App\Http\Controllers;

use App\Models\Alergeno;
use App\Models\Categoria;
use App\Models\Plato;
use Illuminate\Http\Request;

class PlatoController extends Controller
{
    public function index()
    {
        $platos = Plato::all();

        return $platos;
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('new',compact('categorias'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'ingredients' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'type_id' => 'required',
            'category_id' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }
        $plato = Plato::create($validatedData);

        $alergenos = $request->input('alergenos');
        if ($alergenos) {
            $plato->alergenos()->sync($alergenos);
        }

        return redirect()->route('index')
            ->with('success','Plato created successfully.');
    }


    public function edit(Plato $plato)
    {
        $alergenos = Alergeno::all();
        $categorias = Categoria::all();

        return view('platos.edit', compact('plato', 'alergenos','categorias'));
    }

    public function update(Request $request, Plato $plato)
    {
        $request->validate([
            'name' => 'required',
            'ingredients' => 'required',
            'price' => 'required|numeric',
            'type_id' => 'required',
            'category_id' => 'required',
        ]);

        if ($request->has('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $plato->image = $imageName;
        }

        $plato->name = $request->get('name');
        $plato->ingredients = $request->get('ingredients');
        $plato->price = $request->get('price');
        $plato->type_id = $request->get('type_id');
        $plato->category_id = $request->get('category_id');

        $plato->save();

        $alergenos = $request->input('alergenos');
        if ($alergenos) {
            $plato->alergenos()->sync($alergenos);
        }

        return redirect()->route('platos.index')
            ->with('success','Plato updated successfully');
    }

    public function destroy(Plato $plato)
    {
        $plato->delete();

        return redirect()->route('platos.index')
            ->with('success','Plato deleted successfully');
    }
}
