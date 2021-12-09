<?php
//passando parametros
//o laravel vai chamar a função passando o parametro 
Route::get('/ola/{nome}', function($nome){
    return "Ola, seja bem vindo,  $nome!";
});

//se o parametro nao for passado, o parâmetro da callback você tem que inicializa-lo com null 
Route::get('/seunome/{nome?}', function($nome=null){
    if(isset($nome))
        echo "Ola, seja bem vindo(a),  $nome!";
    else 
        echo "Você não digitou nenhum nome.";
});

//controlando os parametros
Route::get('/rotacomregras/{nome}/{n}', function($nome, $n){
    for($i=0;$i<$n;$i++)
        echo "Ola seja bem vindo, $nome! <br>";
})->where('nome','[A-Za-z]+')
    ->where('n', '[0-9]+');

//agrupando rotas
Route::prefix('/app')->group(function(){
    
    Route::get('/', function(){
        return view('app');
    })->name('app');
    Route::get('/user', function(){
        return view('user');
    })->name('app.user');
    Route::get('/settings', function(){
        return view('settings');
    })->name('app.settings');

});

Route::get('/produtos', function(){
    echo '<h1>Produtos</h1>';
    echo '<ol>';
    echo '<li>Cachaças</li>';
    echo '<li>Doces</li>';
    echo '<li>Diversos</li>';
    echo '</ol>';
})->name('meusprodutos');

//redirecionando rotas
Route::get('todosprodutos', function(){
    return redirect()->route('meusprodutos');
});

//////////////////////////////////////////////////
//requisição post para salvar algo novo (ex: novo cliente)
Route::post('/requisicoes', function(Request $request){
    return 'Hello POST';
});
//requisiçao para apagar algum recurso 
Route::delete('/requisicoes', function(Request $request){
    return 'Hello DELETE';
});
//requisições para salvar alguma coisa
Route::put('/requisicoes', function(Request $request){
    return 'Hello PUT';
});
Route::patch('/requisicoes', function(Request $request){
    return 'Hello PATCH';
});
//
Route::options('/requisicoes', function(Request $request){
    return 'Hello OPTIONS';
});