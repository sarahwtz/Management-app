<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

class ContactController extends Controller
{
    public function contato(Request $request) {
        $motivo_contatos = MotivoContato::all();

        //var_dump($_POST);

        /*
        echo '<pre>';
        print_r($request->all());
         echo'</pre>';
         echo $request->input('nome');
         echo'<br>';
         echo $request->input('email');
        //dd($request);
    
        */
        //dd($request->all());
        
        /*
        $contato = new SiteContato();
        $contato->name = $request->input('name');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->motivo_contato = $request->input('motivo_contato');
        $contato->mensagem = $request->input('mensagem');
        */
            
        //print_r($contato->getAttributes());
        //$contato->save();
        
        
        //dd($request->all());

       // $contato = new SiteContato();
        //$contato->fill($request->all());
       // $contato->create($request->all());
        //$contato->save();


        return view('site.contato', ['titulo' => ' Contato', 'motivo_contatos' => $motivo_contatos]);
        
    }
    public function salvar(Request $request){
        //validacao:
       $regras = [
            'name'=>'required|min:3|max:40|unique:site_contatos',
            'telefone'=> 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required |max:2000'
       ];

       $feedback = 
        [
          
            'name.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'name.max' =>'O campo nome deve ter no maximo 40 caracteres',
            'name.unique' => 'O nome informado ja está em uso',
           
          
            'email.email'=> ' O email informado nao é válido',
            'mensagem.max' =>'A mensagem deve ter no máximo 2000caracteres', 
            'required' =>'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras, $feedback);
        
        SiteContato::create($request->all());
        return redirect()->route('site.index');
        }
}
