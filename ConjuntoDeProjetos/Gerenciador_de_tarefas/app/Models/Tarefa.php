<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;
    protected $table = "tarefa";
    protected $fillable = ['titulo','descricao','status','prioridade','data_de_entrega'];
}
