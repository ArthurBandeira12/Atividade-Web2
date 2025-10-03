<h1>Editar Funcionário</h1>

<form action="{{ route('funcionarios.update', $funcionario) }}" method="POST">
    @csrf
    @method('PUT')
    Nome: <input type="text" name="nome" value="{{ $funcionario->nome }}"><br>
    Email: <input type="email" name="email" value="{{ $funcionario->email }}"><br>
    Dependentes: <input type="number" name="dependentes" value="{{ $funcionario->dependentes }}"><br>
    Salário: <input type="number" name="salario" step="0.01" value="{{ $funcionario->salario }}"><br>
    Cargo: <input type="text" name="cargo" value="{{ $funcionario->cargo }}"><br>
    Data de Admissão: <input type="date" name="data_admissao" value="{{ $funcionario->data_admissao }}"><br>
    <button type="submit">Atualizar</button>
</form>