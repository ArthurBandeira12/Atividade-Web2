<h1>Funcionarios:{{$funcionario->nome}}</h1>
<p>Email:{{$funcionario->email}}</p>
<p>Dependentes:{{$funcionario->dependentes}}</p>
<p>Salario:{{$funcionario->salario}}</p>
<p>Cargo:{{$funcionario->cargo}}</p>
<p>Data Admissão:{{$funcionario->data_admissao}}</p>

<a href="{{route('funcionarios.index')}}">Voltar</a>