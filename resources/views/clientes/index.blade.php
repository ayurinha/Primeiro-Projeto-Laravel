<div>
    <h3>Clientes:</h3>
    <br>
    <a href="{{route('clientes.create')}}">Novo Cliente +</a>
</div>
<ol>
    @foreach ($clientes as $c)
        <li>{{ $c['nome'] }} | 
            <a href="{{route('clientes.edit', $c['id'])}}">Editar</a> |
            <a href="{{route('clientes.show', $c['id'])}}">Detalhes</a> |
            <form action="{{ route('clientes.destroy',  $c['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Apagar">
            </form>
        </li>
    @endforeach
</ol>