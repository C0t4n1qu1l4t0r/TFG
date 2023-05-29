<?php

namespace App\Http\Controllers;

use App\Models\Alergeno;
use App\Models\Categoria;
use App\Models\Plato;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $tipos = Tipo::all();
        $alergenos = Alergeno::all();
        $authenticated = Auth::check();
        return view('platos/new',compact('categorias','authenticated','tipos','alergenos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'ingredients' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'type_id' => 'required',
            'category_id' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imagePath = public_path('images') . '/' . $imageName;

            if (!file_exists($imagePath)) {
                $imageFile->move(public_path('images'), $imageName);
                $validatedData['image'] = $imageName;
            }
        }

        $plato = Plato::create($validatedData);

        $alergenos = $request->input('alergenos');
        if ($alergenos) {
            $plato->alergenos()->sync($alergenos);
        }

        return redirect()->route('index')
            ->with('success', 'Plato created successfully.');
    }


    public function edit($id)
    {
        $alergenos = Alergeno::all();
        $tipos = Tipo::all();
        $categorias = Categoria::all();
        $authenticated = Auth::check();
        $plato = Plato::findOrFail($id);

        return view('platos/edit', compact('plato', 'alergenos','categorias','authenticated','tipos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'ingredients' => 'nullable',
            'price' => 'required|numeric',
            'type_id' => 'required',
            'category_id' => 'required',
        ]);
        $plato = Plato::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imagePath = public_path('images');
            $imageFile->move($imagePath, $imageName);
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

        return redirect()->route('index')
            ->with('success','Plato updated successfully');
    }

    public function delete($id){
        $plato = Plato::findOrFail($id);
        $categorias = Categoria::all();
        $authenticated = Auth::check();
        return view('platos/delete', compact('plato','categorias','authenticated'));
    }

    public function destroy($id)
    {
        $plato = Plato::findOrFail($id);
        $plato->delete();

        return redirect()->route('index')
            ->with('success','Plato deleted successfully');
    }
}
