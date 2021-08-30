<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class authController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function me(){
        return response()->json(['token' => Auth::user()]);
    }

    public function register(Request $request){
        $request->validate(User::rules(), User::feedback());
        User::create([
            'name' => $request->nome,
            'email' => $request->email,
            'password' => hash::make($request->password),
            'funcao_id' => $request->funcao_id
        ]);
        return response()->json(['msg' => 'usuario cadastrado com sucesso']);
    }

    public function login(Request $request)
    {
        $token = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        return response()->json(['token' => $token]);
    }

    public function logout()
    {
        return Auth::logout();
    }

    public function refresh()
    {
        return response()->json(['token' => Auth::refresh()]);
    }
}
