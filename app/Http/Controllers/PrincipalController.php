<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MotivoContato;

class PrincipalController extends Controller
{
    public function principal(){
        /*echo 'welcome. Seja bem-vindo.';*/

        $motivo_contatos = MotivoContato::all();
        
        /*[
            '1' => 'Dúvida',
            '2' => 'Elogio',
            '3' => 'Reclamação',
        ];
        */

        return view('site.principal', ['motivo_contatos' => $motivo_contatos]);
    }
    //
}
