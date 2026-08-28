<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livros';

    protected $fillable = [
        'titulo',
        'autor',
        'isbn',
        'editora',
        'ano_publicacao',
        'genero',
        'quantidade_total',
        'quantidade_disponivel',
    ];

    protected $casts = [
        'ano_publicacao'        => 'integer',
        'quantidade_total'      => 'integer',
        'quantidade_disponivel' => 'integer',
    ];

    public function emprestimos(): HasMany
    {
        return $this->hasMany(Emprestimo::class, 'livro_id');
    }

    public function isDisponivel(): bool
    {
        return $this->quantidade_disponivel > 0;
    }
}
