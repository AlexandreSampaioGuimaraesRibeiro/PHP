<?php

namespace Database\Seeders;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Membro;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $livros = [
            ['titulo' => 'Dom Casmurro', 'autor' => 'Machado de Assis', 'isbn' => '978-85-359-0277-5', 'editora' => 'Companhia das Letras', 'ano_publicacao' => 1899, 'genero' => 'Romance', 'quantidade_total' => 3],
            ['titulo' => 'O Cortiço', 'autor' => 'Aluísio Azevedo', 'isbn' => '978-85-209-2400-5', 'editora' => 'Ática', 'ano_publicacao' => 1890, 'genero' => 'Romance', 'quantidade_total' => 2],
            ['titulo' => 'Grande Sertão: Veredas', 'autor' => 'João Guimarães Rosa', 'isbn' => '978-85-209-1776-2', 'editora' => 'Nova Fronteira', 'ano_publicacao' => 1956, 'genero' => 'Romance', 'quantidade_total' => 2],
            ['titulo' => 'Capitães da Areia', 'autor' => 'Jorge Amado', 'isbn' => '978-85-100-0112-0', 'editora' => 'Companhia das Letras', 'ano_publicacao' => 1937, 'genero' => 'Romance', 'quantidade_total' => 4],
            ['titulo' => 'Clean Code', 'autor' => 'Robert C. Martin', 'isbn' => '978-0-13-235088-4', 'editora' => 'Prentice Hall', 'ano_publicacao' => 2008, 'genero' => 'Tecnologia', 'quantidade_total' => 2],
            ['titulo' => 'O Guia do Mochileiro das Galaxias', 'autor' => 'Douglas Adams', 'isbn' => '978-85-333-0279-1', 'editora' => 'Arqueiro', 'ano_publicacao' => 1979, 'genero' => 'Ficcao Cientifica', 'quantidade_total' => 3],
        ];

        foreach ($livros as $l) {
            $l['quantidade_disponivel'] = $l['quantidade_total'];
            Livro::create($l);
        }

        $membros = [
            ['nome' => 'Ana Paula Silva', 'email' => 'ana.paula@email.com', 'cpf' => '123.456.789-00', 'telefone' => '(11) 99111-1111', 'status' => 'ativo'],
            ['nome' => 'Bruno Costa Santos', 'email' => 'bruno.costa@email.com', 'cpf' => '234.567.890-11', 'telefone' => '(11) 99222-2222', 'status' => 'ativo'],
            ['nome' => 'Carla Fernandez Lima', 'email' => 'carla.fl@email.com', 'cpf' => '345.678.901-22', 'telefone' => '(11) 99333-3333', 'status' => 'ativo'],
            ['nome' => 'Diego Oliveira', 'email' => 'diego.o@email.com', 'cpf' => '456.789.012-33', 'telefone' => '(11) 99444-4444', 'status' => 'suspenso'],
        ];

        foreach ($membros as $m) {
            Membro::create($m);
        }

        $livro1  = Livro::first();
        $membro1 = Membro::first();

        Emprestimo::create([
            'livro_id'               => $livro1->id,
            'membro_id'              => $membro1->id,
            'data_emprestimo'        => Carbon::today()->subDays(5),
            'data_prevista_devolucao'=> Carbon::today()->addDays(9),
            'status'                 => 'ativo',
            'multa'                  => 0,
        ]);

        $livro1->decrement('quantidade_disponivel');
    }
}
