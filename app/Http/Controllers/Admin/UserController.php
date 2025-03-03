<?php

namespace App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'first_last_name' => 'required|string|max:255',
            'second_last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'status' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'first_last_name' => $request->first_last_name,
            'second_last_name' => $request->second_last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'status' => 'inactive',
        ]);

        return redirect()->route('users')->with('success', 'Usuario agregado exitosamente.');
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'first_last_name' => 'required|string|max:255',
                'second_last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
            ]);

            $user->update([
                'name' => $request->name,
                'first_last_name' => $request->first_last_name,
                'second_last_name' => $request->second_last_name,
                'email' => $request->email,
            ]);

            return redirect()->route('admins')->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admins')->with('error', 'Falló la actualización del usuario: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

  
        return redirect()->route('users')->with('success', 'El usuario ha sido desactivado.');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $users = User::where(function($q) use ($query) {
                        $q->where('name', 'LIKE', "%{$query}%")
                        ->orWhere('first_last_name', 'LIKE', "%{$query}%")
                        ->orWhere('second_last_name', 'LIKE', "%{$query}%");
                    })
                    ->get();

        if ($users->isEmpty()) {
            return response()->json(['message' => 'No se encontraron usuarios.'], 404);
        }

        return response()->json($users);
    }
}