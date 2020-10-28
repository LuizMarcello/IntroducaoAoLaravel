<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
/* use Illuminate\Support\Facades\Auth as FacadesAuth; */ 

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function entrar(Request $req)
    {
        $dados = $req->all();
        if(Auth::attempt(['email'=>$dados['email'],'password'=>$dados['senha']]))
        {
            //Estará logado, usando o helper de rotas 'route':
            return redirect()->route('admin.cursos');
        }

        /* Usando o helper de rotas 'route', se o login não der certo */
        return redirect()->route('login.index');
    }
}


