<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emprestimo extends Model
{
    use HasFactory;

    protected $table = 'emprestimos';

    protected $fillable = [
        'livro_id',
        'membro_id',
        'data_emprestimo',
        'data_prevista_devolucao',
        'data_devolucao',
        'status',
        'multa',
        'observacoes',
    ];

    protected $casts = [
        'data_emprestimo'          => 'date',
        'data_prevista_devolucao'  => 'date',
        'data_devolucao'           => 'date',
        'multa'                    => 'decimal:2',
    ];

    public function livro(): BelongsTo
    {
        return $this->belongsTo(Livro::class, 'livro_id');
    }

    public function membro(): BelongsTo
    {
        return $this->belongsTo(Membro::class, 'membro_id');
    }

    public function isAtrasado(): bool
    {
        return $this->status !== 'devolvido'
            && Carbon::today()->gt($this->data_prevista_devolucao);
    }

    public function calcularMulta(float $valorDiario = 1.00): float
    {
        if ($this->status === 'devolvido' || ! $this->isAtrasado()) {
            return 0.0;
        }

        $diasAtraso = Carbon::today()->diffInDays($this->data_prevista_devolucao);
        return round($diasAtraso * $valorDiario, 2);
    }
}
