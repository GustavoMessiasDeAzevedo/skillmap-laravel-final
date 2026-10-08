<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();

        return response()->json($usuarios, 200);
    }

    public function mySkill(Request $request)
    {
        return response()->json($request->user()->load('habilidades'), 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuário cadastrado com sucesso',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 201);
    }

    public function completeRegister(Request $request)
    {
        $request->validate([
            'localizacao' => 'required|string|max:255',
            'habilidades' => 'nullable|array',
            'habilidades.*' => 'exists:habilidades,id',
        ]);

        $user = $request->user();

        $user->update([
            'localizacao' => $request->localizacao,
        ]);

        if ($request->has('habilidades')) {
            $user->habilidades()->sync($request->habilidades);
        }

        return response()->json([
            'message' => 'Perfil atualizado com sucesso',
            'user' => $user->load('habilidades'),
        ], 200);
    }
}
