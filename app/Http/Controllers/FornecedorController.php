<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index() {
        /*$fornecedores = [
            0=>[
                'nome' => 'Fornecedor 1', 
                'status' => 'N',
                'cnpj' => '0',
                'ddd' => '11',//sao paulo (SP)
                'telefone' => '000-000',
            ],
            1 => [
                'nome' => 'Fornecedor 2',
                'status' => 'N',
                'cnpj' => null,
                'ddd' => '85', //fortaleza (CE)
                'telefone' => '000-000',

            ],
            2 => [
                'nome' => 'Fornecedor 3',
                'status' => 'N',
                'cnpj' => null,
                'ddd' => '32',// juiz de fora (MG)
                'telefone' => '000-000',

            ],


        ]; */
        

    

       // return view('app.fornecedor.index', compact('fornecedores'));
       return view('app.fornecedor');

 }
}
