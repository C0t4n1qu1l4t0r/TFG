<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();

        return $users;
    }

    public function users(){

        $categorias = Categoria::all();
        $authenticated = Auth::check();

        if (Auth::user()->rol == 0) {
            $users = User::all();
        } else {
            $users = User::where('id', Auth::id())->get();
        }

        return view('users/index',compact('users','categorias','authenticated'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $authenticated = Auth::check();

        return view('register', compact('categorias', 'authenticated'));
    }

    public function createAdmin()
    {
        $categorias = Categoria::all();
        $authenticated = Auth::check();

        return view('registerAdmin', compact('categorias', 'authenticated'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $categorias = Categoria::all();
        $authenticated = Auth::check();

        return view('users/edit', compact('user', 'categorias', 'authenticated'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->password = $request->password ?? $user->password;
        $user->save();

        return redirect()->route('users/index')->with('success', 'User updated successfully.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $categorias = Categoria::all();
        $authenticated = Auth::check();
        return view('users/delete', compact('user', 'categorias', 'authenticated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if (Auth::id() == $user->id) {
            Auth::logout();
            return redirect()->route('index')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('users/index')->with('success', 'User deleted successfully.');

        }
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        $categorias = Categoria::all();
        $authenticated = Auth::check();

        return view('login', compact('categorias', 'authenticated'));
    }

    /**
     * Handle an authentication attempt.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {

            return redirect()->route('index');
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    /**
     * Handle a registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'rol' => $validatedData['rol'] ?? 1,
            'password' => Hash::make($validatedData['password']),
        ]);

        Auth::login($user);

        return redirect()->route('index');
    }

    public function registerAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'rol' => $validatedData['rol'] ?? 0,
            'password' => Hash::make($validatedData['password']),
        ]);

        Auth::login($user);

        return redirect()->route('index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('index');
    }

}
