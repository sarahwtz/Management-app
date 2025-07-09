<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LogAcessoMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return 'welcome. Seja bem-vindo.';
});
*/

Route::get('/','PrincipalController@principal')->name('site.index')->middleware('log.acesso');
Route::get('/sobre-nos','SobreNosController@sobreNos')->name('site.sobrenos');
Route::get('/contato', 'ContactController@contato')->name('site.contato');
Route::post('/contato', 'ContactController@salvar')->name('site.contato');
Route::get('/login/{erro?}', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@autenticar')->name('site.login');




Route::middleware('autenticacao:padrao')->prefix('/app')->group(function(){

Route::get('/home', 'HomeController@index')->name('app.home');

Route::get('/sair', 'LoginController@sair')->name('app.sair');


//Route::get('/cliente','ClienteController@index')->name('app.cliente');

Route::get('/fornecedor','FornecedorController@index')->name('app.fornecedor');
Route::post('/fornecedor/listar','FornecedorController@listar')->name('app.fornecedor.listar');
Route::get('/fornecedor/listar','FornecedorController@listar')->name('app.fornecedor.listar');
Route::get('/fornecedor/adicionar','FornecedorController@adicionar')->name('app.fornecedor.adicionar');
Route::post('/fornecedor/adicionar','FornecedorController@adicionar')->name('app.fornecedor.adicionar');
Route::get('/fornecedor/editar/{id}/{msg?}', 'FornecedorController@editar')->name('app.fornecedor.editar');
Route::get('/fornecedor/excluir/{id}', 'FornecedorController@excluir')->name('app.fornecedor.excluir');


//Produtos
Route::resource('produto', 'ProdutoController');

//Produtos detalhes
Route::resource('produto-detalhe', 'ProdutoDetalheController');

Route::resource('cliente', 'ClienteController');
Route::resource('pedido', 'PedidoController');
//Route::resource('pedido-produto', 'PedidoProdutoController');
Route::get('pedido-produto/create/{pedido}', 'PedidoProdutoController@create')->name('pedido-produto.create');
Route::post('pedido-produto/store/{pedido}', 'PedidoProdutoController@store')->name('pedido-produto.store');

});

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('teste');


/*Route::get('rota2', function(){
    return redirect()->route('site.rota1'); 
})->name('site.rota2');


//o primeiro parametro eh a rota de origem:
//ao acessar rota 2, quero ser redirecionada pra rota 1

//Route::redirect('/rota2','/rota1');*/

Route::fallback(function(){
    echo 'A rota acessada nao existe. <a href="'.route('site.index').'"> Clique aqui</a> para ir para a página original';
});







//nome, categoria, assunto, mensagem

/*Route::get('/contato/{nome}/{categoria}/{assunto}/{mensagem}', function(string $nome, string $categoria, string $assunto, string $mensagem){
    echo "estamos aqui: $nome - $categoria - $assunto - $mensagem";
}); AQUI OS PARAMETROS SAO OBRIGATORIOS*/

/*Route::get('/contato/{nome}/{categoria}/{assunto}/{mensagem?}', function(string $nome, string $categoria, string $assunto, string $mensagem = 'mensagem nao informada'){
    echo "estamos aqui: $nome - $categoria - $assunto - $mensagem";
});*///AQUI qnd nao tem um parametro bota ? mas so funciona da direita pra esquerda

/*Route: get('/contato?/{nome?}/{categoria?}/{assunto?}/{mensagem?}', 
function(
    string $nome = 'desconhecido', 
    string $categoria = 'informacao', 
    string $assunto = 'contato', 
    string $mensagem = 'mensagem nao informada'
    ){

    echo "estamos aqui: $nome - $categoria - $assunto - $mensagem;"

});//aqui se eu deletar do browser um por um da direita pra esquerda
//ele vai dando a msg diferente */



/*Route::get('/contato/{nome}/{categoria_id}',
 function(
    string $nome = 'desconhecido', 
    int $categoria_id = 1 // 1-'informacao'
) {
    echo "estamos aqui: $nome - $categoria_id";
}

)->where('categoria_id', '[0-9]+')->where('nome', '[A-Za-z]+');*/


