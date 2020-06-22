<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//para ver lista de rotas dispinoveis no laravel, usar no teminal = php artisan route:list

//rota para search
route::any('produtos/search','ProcuctsController@search')->name('produtos.search'); 

route::resource('produtos','ProcuctsController')->middleware(['auth', 'check.is.admin']);
//resource resume todas as chamadas de http
//---> ->Middleware('auth') para autenticar, sem ele, qualquer um acessa sem login

// route::delete('/produtos/{idProduto}','ProductsController@destroy')->name('produtos.destroy');
// //deletar um novo produto

// route::put('/produtos/{idProduto}','ProductsController@update')->name('produtos.update');
// //update em um novo produto

// route::get('/produtos','ProductsController@new')->name('produtos.new');
// //cadastrando um novo produto

// route::get('/produtos/{idProduto}/edit','ProductsController@edit')->name('produtos.edit');
// //editando um produto

// route::get('/produtos/create','ProductsController@create')->name('produtos.create');
// //criando um produto

// route::get('/produtos/{idProduto}','ProductsController@show')->name('produtos.show');
// //chamada na controller com ID

// route::get('/produtos','ProductsController@index')->name('produtos.index');
// //chamada na controler comum


//--------------------------------------------------------------------------
route::get('/login', function()
{
    return redirect('produtos.index');
});


// route::middleware([])->group( function(){

//     route::prefix('admin')->group( function (){

//         route::namespace('Admin')->group( function(){

//             route::name('admin.')->group( function(){

                // route::get('/paginas', function(){
                //     return 'pagina1';
                // }); 
                
                // route::get('/financeiro', function()
                // {
                //     return 'pagina2';
                // }); 
                
                // route::get('/rodape', function()
                // {
                //     return 'pagina3';
                // }); 
            
//                 route::get('/', 'TesteController@teste')->name('home');
//             });            
//             // para criar partição com referencia ao Admin no controller, usar no terminal ->  php artisan make:controller Admin\TesteController         
//         });//criando nameespace para nao precisar usar o admin antes do testecontroller       
//     });
// });
//grupo de rotas e prefixo

//--------------------------------------------------------------------------

route::group(
    [
        'middleware' => [],
        'prefix'     => 'admin',
        'namespace'  => 'Admin',
        'name'       => 'admin.',
    ], function(){

        route::get('/paginas', function(){
            return 'pagina1';
        }); 
        
        route::get('/financeiro', function()
        {
            return 'pagina2';
        }); 
        
        route::get('/rodape', function()
        {
            return 'pagina3';
        });         
        
        route::get('/', 'TesteController@teste')->name('home');
    }
);//usando todos os grupode middleware, prefix, namespace e name tudo em um so lugar

//--------------------------------------------------------------------------

//--------------------------------------------------------------------------
route::get('/nome-url2', function()
{
    return redirect()->route('url.name');
}); 

route::get('/nometeste-url', function()
{
    return "testeurl";
})->name('url.name'); 
//renomear rotas sem ter que mudar em outros lugares


//--------------------------------------------------------------------------
route::redirect('/redirecionar2','/paramsvazio');
//redirecionar reduzido

route::get('/redirecionar', function()
{
    return redirect('/paramsvazio');
});//redirecionar para a rota que eu quero

//--------------------------------------------------------------------------


route::get('/paramsvazio/{teste?}', function($teste2 = 'Vazio')
{
    return "testando params get : {$teste2}";
});//passar parametro caso exista, caso nao, passar valor padrao


route::get('/params/{teste}/params2', function($teste2){
    return "testando params get : {$teste2}";
});// quando exister outro prefixo apos, temque passar o nome igual da variavel ao do prefixo

route::get('/params/{teste}', function($teste2){
  return "testando params get : {$teste2}";
});//aqui ele pega o valor de parametro que o usuario digita apos o /params/????

Route::match(['get','post'], '/match', function () {
    return 'MATCH';
});

Route::any('/any', function () {
    return 'ANY';
});

Route::get('/', function () {
    return view('welcome');
});



//--------------------------------------------------------------------------

Route::get('/teste1', function () {
    return view('welcome');

});
route::view('view','/welcome');
//redirecionar reduzido


//--------------------------------------------------------------------------

Auth::routes();


