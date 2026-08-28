<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Membro extends Model
{
    use HasFactory;

    protected $table = 'membros';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cpf',
        'data_nascimento',
        'endereco',
        'status',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function emprestimos(): HasMany
    {
        return $this->hasMany(Emprestimo::class, 'membro_id');
    }

    public function emprestimosAtivos(): HasMany
    {
        return $this->hasMany(Emprestimo::class, 'membro_id')
            ->whereIn('status', ['ativo', 'atrasado']);
    }
}
