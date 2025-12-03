<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function update(UpdatePasswordRequest $request)
    {
        $users = Auth::user();
    
        // Verificar si la contraseña actual es correcta
          $users->update($request->all());
          return back()->with('success', 'Contraseña actualizada exitosamente.');
    
        }
    
        public function index()
        {
            $usuarios = User::with('roles')->get();
            $roles = Role::all(); // Obtener todos los roles
            $users = User::all();
            return view('users.index', compact('users'));
        }
        
        public function index2()
        {
            $usuarios = User::with('roles')->get();
            $roles = Role::all(); // Obtener todos los roles
            return view('listausuario.index', compact('usuarios', 'roles'));
        }

    public function showChangePasswordForm()
    {
        return view('user.change_password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'motivo' => 'required|string|max:255',
            'fecha_egreso' => 'required|date',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->apellido = $request->input('apellido');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->status = $request->input('status');
        $user->motivo = $request->input('motivo');
        $user->fecha_egreso = $request->input('fecha_egreso');
        $user->save();

        return redirect()->route('usuarios.index');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();

        return redirect()->back()->with('success', 'Estado del usuario actualizado.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
            'motivo' => 'nullable|string',
            'fecha_egreso' => 'nullable|date',
        ]);

        $usuario = User::findOrFail($id);
        $usuario->status = $request->status;
        $usuario->motivo = $request->motivo;
        $usuario->fecha_egreso = $request->fecha_egreso;
        $usuario->save();

        return redirect()->route('users.index')->with('success', 'Estado del usuario actualizado correctamente.');
    }

    

    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if ($user->protected) {
                throw new \Exception('No puedes eliminar al superadministrador.');
            }

            $user->delete();
            return response()->json(['success' => 'Usuario eliminado correctamente.'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }

    public function listUsersWithRoles()
    {
        $usuarios = User::with('roles')->get();
        return view('listausuario.index', compact('usuarios'));
    }

    

    public function editRole($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::all();
        return view('listausuario.role', compact('usuario', 'roles'));
    }

    public function updateRole(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $role = Role::where('name', $request->role)->first();

        if ($role) {
            $usuario->syncRoles([$role->name]);
            return redirect()->route('listausuario.index')->with('success', 'Rol de usuario actualizado correctamente.');
        }

        return redirect()->route('listausuario.index')->with('error', 'El rol seleccionado no es válido.');
    }


}
