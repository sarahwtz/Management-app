<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;

class ContactController extends Controller
{
    public function contato(Request $request) {
        $motivo_contatos = [
            '1' => 'Dúvida',
            '2' => 'Elogio',
            '3' => 'Reclamação',
        ];

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
        $request->validate([
            'name'=>'required|min:3|max:40',
            'telefone'=> 'required',
            'email' => 'required',
            'mensagem' => 'required |max:2000'
        ]);
        //SiteContato::create($request->all());
        }
}
