<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionarios extends Model
{
    protected $fillable = ['nome', 'email',  'dependentes', 'salario', 'data_admissao', 'cargo'];
}
