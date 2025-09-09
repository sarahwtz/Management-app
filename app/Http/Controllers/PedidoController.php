<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Cliente;
use App\PedidoProduto;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pedidos = Pedido::with('cliente')->paginate(10);
        return view('app.pedido.index', [
            'pedidos' => $pedidos, 
            'request' => $request->all()
        ]);

      
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('app.pedido.create', ['clientes' => $clientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [

            'cliente_id' => 'exists:clientes,id'
        ];

        $feedback = [
            'cliente_id.exists' => 'O cliente informado nao existe'
        ];

        $request->validate($regras, $feedback);

        $pedido = new Pedido();
        $pedido->cliente_id = $request->get('cliente_id');
        $pedido->save();

        return redirect()->route('pedido.index');
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
     * @param  int  $id
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
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedido.index');
    }




    public function consulta(Request $request)
    {
        $consulta = PedidoProduto::from('pedidos_produtos')
            ->join('pedidos', 'pedidos_produtos.pedido_id', '=', 'pedidos.id')
            ->join('clientes', 'pedidos.cliente_id', '=', 'clientes.id')
            ->join('produtos', 'pedidos_produtos.produto_id', '=', 'produtos.id')
            ->join('fornecedores', 'produtos.fornecedor_id', '=', 'fornecedores.id')
            ->select(
                'pedidos.id as pedido_id',
                'clientes.nome as cliente',
                'produtos.nome as produto',
                'fornecedores.nome as fornecedor',
                'pedidos_produtos.quantidade',
                'pedidos_produtos.created_at as data_inclusao'
            );
    
        // filtro por ID do pedido
        if ($request->filled('pedido_id')) {
            $consulta->where('pedidos.id', $request->pedido_id);
        }
    
        // filtro por cliente
        if ($request->filled('cliente')) {
            $consulta->where('clientes.nome', 'like', '%'.$request->cliente.'%');
        }
    
        // filtro por fornecedor
        if ($request->filled('fornecedor')) {
            $consulta->where('fornecedores.nome', 'like', '%'.$request->fornecedor.'%');
        }
    
        // filtro por produto
        if ($request->filled('produto')) {
            $consulta->where('produtos.nome', 'like', '%'.$request->produto.'%');
        }
    
        // obtém somente as linhas que correspondem aos filtros
        $resultados = $consulta->get();
    
        // retorna a view especificando a variável explicitamente
        return view('app.pedido.consulta', ['resultados' => $resultados]);
    }
    



public function listar(Request $request)
{
    $query = Pedido::with(['cliente', 'itens.fornecedor']);

    if ($request->filled('pedido_id')) {
        $query->where('id', $request->pedido_id);
    }

    if ($request->filled('cliente')) {
        $query->whereHas('cliente', function($q) use ($request) {
            $q->where('nome', 'like', "%{$request->cliente}%");
        });
    }

    if ($request->filled('produto')) {
        $query->whereHas('itens', function($q) use ($request) {
            $q->where('nome', 'like', "%{$request->produto}%");
        });
    }

    if ($request->filled('fornecedor')) {
        $query->whereHas('itens.fornecedor', function($q) use ($request) {
            $q->where('nome', 'like', "%{$request->fornecedor}%");
        });
    }

    if ($request->filled('quantidade')) {
        $query->whereHas('itens', function($q) use ($request) {
            $q->where('quantidade', $request->quantidade);
        });
    }

    if ($request->filled('data_inclusao')) {
        $query->whereDate('created_at', $request->data_inclusao);
    }

    $pedidos = $query->paginate(10)->appends($request->all());

    return view('app.pedido.listar', compact('pedidos', 'request'));
}



}
