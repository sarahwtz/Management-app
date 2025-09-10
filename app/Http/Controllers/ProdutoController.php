<?php

namespace App\Http\Controllers;

use App\Item;
use App\Unidade;
use App\ProdutoDetalhe;
use App\Fornecedor;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produtos = Item::with(['itemDetalhe', 'fornecedor'])->paginate(10);

        return view('app.produto.index', [
            'produtos'=> $produtos,
            'request' => $request->all()
        ]);
    }

    /**
     * Consulta de produtos.
     */
    public function consulta(Request $request)
    {
        $fornecedores = Fornecedor::all();
        $unidades = Unidade::where('unidade', '<>', 'cm')->get();
        $produtos = collect();

        if($request->isMethod('post')) {
            $query = Item::with(['fornecedor', 'unidade', 'itemDetalhe', 'pedidos']);

            if ($request->filled('nome')) $query->where('nome','like','%'.$request->nome.'%');
            if ($request->filled('fornecedor_id')) $query->where('fornecedor_id', $request->fornecedor_id);
            if ($request->filled('descricao')) $query->where('descricao','like','%'.$request->descricao.'%');
            if ($request->filled('peso')) $query->where('peso', (float) str_replace(',', '.', $request->peso));
            if ($request->filled('unidade_id')) $query->where('unidade_id', $request->unidade_id);

            $produtos = $query->paginate(10);
        }

        return view('app.produto.consulta', [
            'fornecedores' => $fornecedores,
            'unidades' => $unidades,
            'produtos' => $produtos,
            'request' => $request->all(),
            'modo' => 'consulta'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidade::where('unidade', '<>', 'cm')->get();
        $fornecedores = Fornecedor::all();

        return view('app.produto.create', [
            'unidades' => $unidades,
            'fornecedores' => $fornecedores
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' =>'required|min:3|max:40',
            'descricao' =>'required|min:3|max:2000',
            'peso' => 'required|numeric',
            'unidade_id' =>'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'descricao.min' => 'O campo descricao deve ter no mínimo 3 caracteres',
            'descricao.max' => 'O campo descricao deve ter no máximo 2000 caracteres',
            'peso.required' => 'O campo peso deve ser preenchido',
            'peso.numeric' => 'Use ponto como separador decimal',
            'unidade_id.exists' =>'A unidade de medida informada nao existe',
            'fornecedor_id.exists' => 'O fornecedor informado nao existe'
        ];

        $request->validate($regras, $feedback);

        $data = $request->all();
        $data['peso'] = (float) str_replace(',', '.', $data['peso']);

        Item::create($data);

        return redirect()->route('produto.create')->with('msg', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $produto, Request $request)
    {
        $produto->load('unidade', 'fornecedor'); 
        $page = $request->query('page', 1); 
    
        return view('app.produto.show', [ 'produto' => $produto,'page' => $page ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $produto)
    {
        $unidades = Unidade::where('unidade', '<>', 'cm')->get();
        $fornecedores = Fornecedor::all();

        return view('app.produto.edit', [
            'produto' => $produto,
            'unidades' => $unidades,
            'fornecedores' => $fornecedores
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $produto)
    {
        $regras = [
            'nome' =>'required|min:3|max:40',
            'descricao' =>'required|min:3|max:2000',
            'peso' => 'required|numeric',
            'unidade_id' =>'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'descricao.min' => 'O campo descricao deve ter no mínimo 3 caracteres',
            'descricao.max' => 'O campo descricao deve ter no máximo 2000 caracteres',
            'peso.required' => 'O campo peso deve ser preenchido',
            'peso.numeric' => 'Use ponto como separador decimal',
            'unidade_id.exists' =>'A unidade de medida informada nao existe',
            'fornecedor_id.exists' => 'O fornecedor informado nao existe'
        ];

        $request->validate($regras, $feedback);

        $data = $request->all();
        $data['peso'] = (float) str_replace(',', '.', $data['peso']);

        $produto->update($data);

        return redirect()->route('produto.show', ['produto' => $produto->id])
                         ->with('msg', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $produto)
    {
        $produto->delete();
        return redirect()->route('produto.index');
    }

    /**
     * Listagem de produtos com filtros.
     */
    public function listar(Request $request)
    {
        $produtos = Item::query();

        if($request->filled('nome')){
            $produtos->where('nome', 'like', '%'.$request->nome.'%');
        }

        if($request->filled('descricao')){
            $produtos->where('descricao', 'like','%'.$request->descricao.'%');
        }

        if($request->filled('peso')){
            $produtos->where('peso', (float) str_replace(',', '.', $request->peso));
        }

        if($request->filled('fornecedor_id')){
            $produtos->where('fornecedor_id', $request->fornecedor_id);
        }

        if($request->filled('unidade_id')){
            $produtos->where('unidade_id', $request->unidade_id);
        }

        $produtos = $produtos->paginate(10);

        return view('app.produto.listar', [
            'produtos' => $produtos,
            'request' => $request->all(),
            'fornecedores' => Fornecedor::all(),
            'unidades' => Unidade::all()
        ]);
    }
}
