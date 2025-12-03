<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

class ListausuarioController extends Controller
{
    // Método para mostrar el perfil
    public function index()
    {
        $usuarios = User::all();
        return view('listausuario.index', compact('usuarios'));
    }

    // Método para almacenar un nuevo usuario
    public function store(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => ($request->password),
        ]);
        return redirect()->route('listausuario.index')->with('success', 'Usuario creado correctamente.');
    }

    // Método para mostrar el formulario de edición
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('listausuario.edit', compact('usuario'));
    }

    // Método para actualizar un usuario
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
        ]);

        $usuario->update($data);

        return redirect()->route('listausuario.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Método para eliminar un usuario
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('listausuario.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
