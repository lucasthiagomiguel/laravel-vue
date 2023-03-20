<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $login = $request->all();
        $token = auth('api')->attempt($login);
        if($token) { //usuário autenticado com sucesso
            return response()->json(['token' => $token]);

        } else { //erro de usuário ou senha
            return response()->json(['erro' => 'failed data!'], 403);
        }          
        return 'teste';
    }

    public function logout(){
        auth('api')->logout();
        return response()->json(['msg' => 'logout done successfully']);
    }

    public function refresh(){
        $tokne = auth('api')->refresh();
        return response()->json($tokne);
    }

    public function me(){
        return response()->json(auth()->user());
    }

}
