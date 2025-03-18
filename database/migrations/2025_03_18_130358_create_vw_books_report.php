<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE OR REPLACE VIEW vw_books_report AS
                                SELECT GROUP_CONCAT(DISTINCT A3.Nome SEPARATOR ', ')      AS autores,
                                       l.Titulo                                           AS titulo,
                                       l.Editora                                          AS editora,
                                       l.AnoPublicacao                                    AS ano_publicacao,
                                       l.Edicao                                           AS edicao,
                                       l.Valor                                            AS valor,
                                       GROUP_CONCAT(DISTINCT A2.Descricao SEPARATOR ', ') AS assuntos,
                                       ROW_NUMBER() OVER ()                               AS id
                                FROM Livro l
                                         INNER JOIN Livro_Autor la ON l.Codl = la.Livro_Codl
                                         INNER JOIN Autor A3 ON la.Autor_CodAu = A3.CodAu
                                         INNER JOIN Livro_Assunto A ON l.Codl = A.Livro_Codl
                                         INNER JOIN Assunto A2 ON A.Assunto_codAs = A2.codAs
                                GROUP BY l.Codl, l.Titulo, l.Editora, l.AnoPublicacao, l.Edicao, l.Valor
                                ORDER BY l.Titulo;
                                ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vw_books_report");

    }
};
