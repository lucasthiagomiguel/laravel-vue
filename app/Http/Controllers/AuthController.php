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

            //401 = Unauthorized -> não autorizado
            //403 = forbidden -> proibido (login inválido)
        }          
        return 'teste';
    }

    public function logout(){

    }

    public function refresh(){

    }

    public function me(){

    }

}
