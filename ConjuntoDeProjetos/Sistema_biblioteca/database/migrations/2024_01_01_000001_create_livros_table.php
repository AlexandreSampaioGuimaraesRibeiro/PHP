<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('autor');
            $table->string('isbn', 20)->unique();
            $table->string('editora')->nullable();
            $table->year('ano_publicacao')->nullable();
            $table->string('genero')->nullable();
            $table->integer('quantidade_total')->default(1);
            $table->integer('quantidade_disponivel')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
