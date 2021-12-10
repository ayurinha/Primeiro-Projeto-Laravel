<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteControlador extends Controller
{
    private $clientes = [
        ['id'=>1, 'nome'=>'José'],
        ['id'=>2, 'nome'=>'Geraldo'],
        ['id'=>3, 'nome'=>'Andreia'],
        ['id'=>4, 'nome'=>'Bilinha'],
        ['id'=>5, 'nome'=>'Renan'],
        ['id'=>6, 'nome'=>'Carolina'],
        ['id'=>7, 'nome'=>'Leandro']
    ];

    public function __construct()
    {
        $clientes = session('clientes');
        if(!isset($clientes))
            session(['clientes' => $this->clientes]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //acessar determinada rota e fazer uma lista com tudo
    public function index()
    {
        $clientes = session('clientes');
        return view('clientes.index', compact(['clientes']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //pra criar alguma coisa
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //para salvar uma nova coisa, direcionar o post do usuário para o store
    public function store(Request $request)
    {
        $clientes = session('clientes');
        //pegando o final do array clientes na parte dos ids e setando o proximo id como id++
        $id = end($clientes)['id']+1;
        $nome = $request->nome;
        $dados = ["id"=>$id, "nome"=>$nome];
        $clientes[] = $dados;
        //salvando o array que esta sendo alterado
        session(['clientes'=>$clientes]);

        return redirect()->route('clientes.index');
        //nao é a melhor solução
        //$clientes = $this->clientes;
        //return view('clientes.index', compact(['clientes']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //ver alguma informação
    public function show($id)
    {
        //recuperando todos os clientes
        $clientes = session('clientes');
        $index = $this->getIndex($id, $clientes);
        $cliente = $clientes[ $index ];
        return view('clientes.info', compact(['cliente']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //editar alguma informação
    public function edit($id)
    {
        $clientes = session('clientes');
        $index = $this->getIndex($id, $clientes);
        $cliente = $clientes[ $index ];
        return view('clientes.edit', compact(['cliente']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //salva uma nova alteração feita no edit
    public function update(Request $request, $id)
    {
        //recuperando dados do cliente
        $clientes = session('clientes');
        $index = $this->getIndex($id, $clientes);
        //colocando o nome pegado no edit
        $clientes[ $index]['nome'] = $request->nome;
        //salvando o array que esta sendo alterado
        session(['clientes'=>$clientes]);

        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //apagar alguma coisa da base de dados
    public function destroy($id)
    {
        //recuperando dados do cliente
        $clientes = session('clientes');
        //pegando a coluna de id do nosso array
        $index = $this->getIndex($id, $clientes);
        //apagando o elemento, passa o array, o que voce quer apagar e quantos voce quer apagar a partir dele
        array_splice($clientes, $index, 1);
        //setando o novo array de clientes
        session(['clientes'=>$clientes]);

        return redirect()->route('clientes.index');
    }

    private function getIndex($id, $clientes){
        $ids = array_column($clientes, 'id');
        $index = array_search($id, $ids);
        return $index;
    }
}
