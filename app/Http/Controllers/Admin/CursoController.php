<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Curso;

class CursoController extends Controller
{
    public function index()
    {
       /*  Variavel está recebendo todos os registros da tabela */
        $registros = curso::all();
        /* Compact(): Transfere todos os registros para a view 'index' */
        return view('admin.cursos.index', compact('registros'));
    }

    public function adicionar()
    {
        return view('admin.cursos.adicionar');
    }

    public function salvar(Request $req)
    {
        /* Esta variavel está obtendo todos os campos da tabela */
        $dados = $req->all();

        if (isset($dados['publicacao'])) {
            $dados['publicacao'] = 'sim';
        } else {
            $dados['publicacao'] = 'nao';
        }

        /*  Este if() abaixo é só para tratamento do campo 'imagem': */
        if ($req->hasFile('imagem')) {
            $imagem = $req->file('imagem');
            $num = rand(1111, 9999);
            $dir = "img/cursos/";
            /*  Método laravel que verifica a extensão do arquivo de imagem */
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "imagem_" . $num . "." . $ex;
            $imagem->move($dir, $nomeImagem);
            $dados['imagem'] = $dir . "/" . $nomeImagem;
        }
        Curso::create($dados);

        /* Posteriormente encaminhando o usuário para a tela de listagem */
        return redirect()->route('admin.cursos');
    }

    public function editar($id)
    {
        $registro = Curso::find($id);
        return view('admin.cursos.editar', compact('registro'));
    }

    public function atualizar(Request $req, $id)
    {
        /* Esta variavel está obtendo todos os campos da tabela */
        $dados = $req->all();

        if (isset($dados['publicacao'])) {
            $dados['publicacao'] = 'sim';
        } else {
            $dados['publicacao'] = 'nao';
        }

        /*  Este if() abaixo é só para tratamento do campo 'imagem': */
        if ($req->hasFile('imagem')) {
            $imagem = $req->file('imagem');
            $num = rand(1111, 9999);
            $dir = "img/cursos/";
            /*  Método laravel que verifica a extensão do arquivo de imagem */
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "imagem_" . $num . "." . $ex;
            $imagem->move($dir, $nomeImagem);
            $dados['imagem'] = $dir . "/" . $nomeImagem;
        }
        Curso::find($id)->update($dados);

        /* Posteriormente encaminhando o usuário para a tela de listagem */
        return redirect()->route('admin.cursos');
    }

    public function deletar($id)
    {
        Curso::find($id)->delete();
        return redirect()->route('admin.cursos');
    }
}
