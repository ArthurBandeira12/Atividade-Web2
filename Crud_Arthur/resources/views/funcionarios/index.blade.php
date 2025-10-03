<h1>Lista de Funcionários</h1>
<a href="{{ route('funcionarios.create') }}">Novo Funcionário</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Dependentes</th>
        <th>Salário</th>
        <th>Cargo</th>
        <th>Data Admissão</th>
    </tr>
    @foreach($funcionarios as $funcionario)
    <tr>
        <td>{{ $funcionario->id }}</td>
        <td>{{ $funcionario->nome }}</td>
        <td>{{ $funcionario->email }}</td>
        <td>{{ $funcionario->dependentes}}</td>
        <td>{{ $funcionario->salario }}</td>
        <td>{{ $funcionario->cargo }}</td>
        <td>{{ $funcionario->data_admissao }}</td>
        <td>
            <a href="{{ route('funcionarios.show', $funcionario) }}">Ver</a>
            <a href="{{ route('funcionarios.edit', $funcionario) }}">Editar</a>
            <form action="{{ route('funcionarios.destroy', $funcionario) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button  onclick="return confirm ('Deseja excluir esse funcionario?')" type="submit">Excluir</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>