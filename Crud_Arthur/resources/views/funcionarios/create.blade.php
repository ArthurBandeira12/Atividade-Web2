<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Funcionario</title>
</head>
<body>
    <h1>Adicionar Funcionario</h1>
    <form action="{{route('funcionarios.store')}}" method="POST">
        @csrf
    <div>
        <label for="nome">Nome do Funcionario:</label>
        <input type="text" id="nome" name="nome" required>
    </div>    

    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div>
        <label for="dependentes">Quantidade de Depdendentes:</label>
        <input type="number" name="dependentes" id="dependentes" required>
    </div>

    <div>
        <label for="salario">Salário:</label>
        <input type="number" name="salario" id="salario" required>
    </div>

    <div>
        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" id="cargo" required>
    </div>

    <div>
        <label for="data_admissao">Data de Adimissão:</label>
        <input type="date" name="data_admissao" id="data_admissao" required>
    </div>

    <button type="submit">Salvar</button>
    </form>


</body>
</html>