<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;
    protected $Estoque;
    protected $fillable = [ 'nome','preco','descricao','quantidade','categoria','fornecedor'];
}
