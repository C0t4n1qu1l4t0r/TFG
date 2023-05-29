<?php

namespace App\Http\Controllers;

use App\Models\Alergeno;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $authenticated = Auth::check();
        return view('alergenos/new',compact('categorias','authenticated'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imagePath = asset('images/' . $imageName);

            if ($imageFile->move(public_path('images'), $imageName)) {
                $validatedData['image'] = $imagePath;
            }
        }

        Alergeno::create($validatedData);

        return redirect()->route('index')->with('success', 'Alergeno creado correctamente');
    }

    public function edit($id)
    {
        $alergeno = Alergeno::findOrFail($id);
        $categorias = Categoria::all();
        $authenticated = Auth::check();
        return view('alergenos/edit', compact('alergeno','categorias','authenticated'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $alergeno = Alergeno::findOrFail($id);
        $alergeno->name = $request->get('name');

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imagePath = public_path('images');
            $imageFile->move($imagePath, $imageName);
            $alergeno->image = $imageName;
        }

        $alergeno->save();

        return redirect()->route('index')->with('success', 'Alergeno actualizado correctamente');
    }

    public function delete($id){
        $alergeno = Alergeno::findOrFail($id);
        $categorias = Categoria::all();
        $authenticated = Auth::check();
        return view('alergenos/delete', compact('alergeno','categorias','authenticated'));
    }

    public function destroy($id)
    {
        $alergeno = Alergeno::findOrFail($id);
        $alergeno->delete();

        return redirect()->route('index')->with('success', 'Alergeno eliminado correctamente');
    }
}
