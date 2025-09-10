<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;
use App\Produto;

class FornecedorController extends Controller
{
    public function index() {
        
       return view('app.fornecedor.index');
    }

    public function listar(Request $request){

        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%'.$request->input('nome').'%')
        ->where('site', 'like', '%'.$request->input('site').'%')
        ->where('uf', 'like', '%'.$request->input('uf').'%')
        ->where('email', 'like', '%'.$request->input('email').'%')
        ->paginate(5);

        return view('app.fornecedor.listar',['fornecedores'=> $fornecedores, 'request' => $request->all()]);

       
        
    }

    public function consulta(Request $request){

        $produtos = Produto::with(['fornecedor'])
        ->where('nome', 'like', '%'.$request->input('nome').'%')
        ->where('descricao', 'like', '%'.$request->input('descricao').'%')
        ->where('peso', 'like', '%'.$request->input('peso').'%')
        ->where('fornecedor_id', 'like', '%'.$request->input('fornecedor_id').'%')
        ->paginate(5);

        return view('app.produto.consulta', [
            'produtos' => $produtos,
            'request' => $request->all()
        ]);
    }


    public function adicionar(Request $request){

        $msg = '';

        //inclusao
        if ($request->input('_token') != '' && $request->input('id') == '') {

            //validacao
            $regras= [
                'nome' => 'required| min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'

            ];

            $feedback =[
                'required' => ' O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no minimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no maximo 3 caracteres',
                'uf.min' => 'O campo UF deve ter no minimo 2 caracteres',
                'uf.max' => 'O campo UF deve ter no maximo 2 caracteres',
                'email.email' => 'O campo e-mail nao foi preenchido corretamente',
            ];

            $request->validate($regras, $feedback);

           $fornecedor = new Fornecedor();
           $fornecedor->create($request->all());

           //redirect

           //dados view
           $msg = 'Cadastro realizado com sucesso';
        }

        //edicao
        if ($request->input('_token') != '' && $request->input('id') != '') {
             // Regras de validação
             $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];
        
            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'uf.min' => 'O campo UF deve ter no mínimo 2 caracteres',
                'uf.max' => 'O campo UF deve ter no máximo 2 caracteres',
                'email.email' => 'O campo e-mail não foi preenchido corretamente',
            ];
        
            $request->validate($regras, $feedback);
          

            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update) {
                $msg = 'Update realizado com sucesso';
            } else {
                $msg =  'Erro ao tentar atualizar o registro';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);

        }

      
        return view('app.fornecedor.adicionar',['msg' => $msg]);

    }

    public function editar($id, $msg = ''){
        
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id) {
       // echo 'Remover o registro de ID'.$id;
       Fornecedor::find($id)->delete();
       //Fornecedor::find($id)->forceDelete();

       return redirect()->route('app.fornecedor.listar');
    }

}





