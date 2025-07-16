<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Produto;
use App\PedidoProduto;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        return view('app.pedido_produto.create',['pedido'=> $pedido, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {

        $regras = [
            'produto_id' =>'exists:produtos,id',
            'quantidade' => 'required|integer|min:1'


        ];

        $feedback = [
            'produto_id.exists' => ' O produto informado nao existe',
            'quantidade.required' => 'A quantidade é obrigatória',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro',
             'quantidade.min' => 'A quantidade deve ser no mínimo 1',
        ];

        $request->validate($regras, $feedback);


    /*
    $pedidoProduto = new PedidoProduto();
    $pedidoProduto->pedido_id = $pedido->id;
    $pedidoProduto->produto_id = $request->get('produto_id');
    $pedidoProduto->quantidade = $request->get('quantidade');
    $pedidoProduto->save();
    */

    //$pedido->produtos  // os registros do relacionamento
    /*
    $pedido->produtos()->attach($request->get('produto_id'),
    ['quantidade' => $request->get('quantidade')]
    ); //objeto
      //pedido_id
      */

     $pedido->produtos()->attach([
        $request->get('produto_id') => ['quantidade' => $request->get('quantidade')]
     ]);

    return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  PedidoProduto $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Pedido $pedido, Produto $produto)
    public function destroy(PedidoProduto $pedidoProduto, $pedido_id)
    
    {
        /*
       print_r($pedido->getAttributes());
       echo'<hr>';
       print_r($produto->getAttributes());
       */

      // echo $pedido->id. ' - '.$produto->id;


       //convencional
       /*
       PedidoProduto::where([
          'pedido_id' => $pedido->id,
          'produto_id' => $produto->id
       ])->delete();
       */

       //detach (delete pelo relacionamento-belongs to many)
      // $pedido->produtos()->detach($produto->id);
       // ou $produto->produtos()->detach($produto->id);

       $pedidoProduto->delete();

       return redirect()->route('pedido-produto.create', ['pedido' => $pedido_id]);

    }
}
