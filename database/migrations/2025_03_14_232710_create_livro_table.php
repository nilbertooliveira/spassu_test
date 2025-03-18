<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Livro', function (Blueprint $table) {
            $table->id('Codl');
            $table->string('Titulo', '40')->index();
            $table->string('Editora', '40');
            $table->integer('Edicao');
            $table->string('AnoPublicacao', '4');
            $table->float('Valor');

            $table->unique(['Titulo', 'Editora', 'Edicao', 'AnoPublicacao']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Livro');
    }
};
