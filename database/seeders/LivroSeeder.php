<?php

namespace Database\Seeders;

use App\Modules\Authors\Infrastructure\Models\Author;
use App\Modules\Books\Infrastructure\Models\Book;
use App\Modules\Subjects\Infrastructure\Models\Subject;
use Illuminate\Database\Seeder;

class LivroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $livros = [
            [
                'titulo' => 'Dom Casmurro',
                'editora' => 'Garnier',
                'edicao' => 1,
                'anoPublicacao' => 1899,
                'valor' => 39.90,
                'autores' => ['Machado de Assis', 'Eça de Queirós'],
                'assuntos' => ['Romance', 'Clássico'],
            ],
            [
                'titulo' => 'Memórias Póstumas de Brás Cubas',
                'editora' => 'Garnier',
                'edicao' => 2,
                'anoPublicacao' => 1881,
                'valor' => 34.90,
                'autores' => ['Machado de Assis'],
                'assuntos' => ['Romance'],
            ],
            [
                'titulo' => 'Grande Sertão: Veredas',
                'editora' => 'José Olympio',
                'edicao' => 1,
                'anoPublicacao' => 1956,
                'valor' => 59.90,
                'autores' => ['João Guimarães Rosa', 'Carlos Drummond de Andrade'],
                'assuntos' => ['Regionalismo', 'Filosofia'],
            ],
            [
                'titulo' => 'Vidas Secas',
                'editora' => 'Livraria José Olympio Editora',
                'edicao' => 1,
                'anoPublicacao' => 1938,
                'valor' => 44.90,
                'autores' => ['Graciliano Ramos'],
                'assuntos' => ['Regionalismo'],
            ],
            [
                'titulo' => 'Gabriela, Cravo e Canela',
                'editora' => 'Livraria Martins',
                'edicao' => 1,
                'anoPublicacao' => 1958,
                'valor' => 39.90,
                'autores' => ['Jorge Amado', 'Cecília Meireles'],
                'assuntos' => ['Romance', 'Cultura Brasileira'],
            ],
            [
                'titulo' => 'O Auto da Compadecida',
                'editora' => 'José Olympio',
                'edicao' => 1,
                'anoPublicacao' => 1955,
                'valor' => 29.90,
                'autores' => ['Ariano Suassuna'],
                'assuntos' => ['Teatro'],
            ],
            [
                'titulo' => 'A Hora da Estrela',
                'editora' => 'Rocco',
                'edicao' => 1,
                'anoPublicacao' => 1977,
                'valor' => 27.90,
                'autores' => ['Clarice Lispector'],
                'assuntos' => ['Drama'],
            ],
        ];

        foreach ($livros as $livro) {
            $book = Book::updateOrCreate(
                ['Titulo' => $livro['titulo']],
                [
                    'Editora' => $livro['editora'],
                    'Edicao' => $livro['edicao'],
                    'AnoPublicacao' => $livro['anoPublicacao'],
                    'Valor' => $livro['valor'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            $autores_ids = [];
            foreach ($livro['autores'] as $autor_nome) {
                $autor = Author::firstOrCreate(
                    ['Nome' => $autor_nome],
                    ['created_at' => now(), 'updated_at' => now()]
                );
                $autores_ids[] = $autor->getKey();
            }
            $book->authors()->syncWithoutDetaching($autores_ids);

            $assuntos_ids = [];
            foreach ($livro['assuntos'] as $assunto_desc) {
                $assunto = Subject::firstOrCreate(
                    ['Descricao' => $assunto_desc],
                    ['created_at' => now(), 'updated_at' => now()]
                );
                $assuntos_ids[] = $assunto->getKey();
            }
            $book->subjects()->syncWithoutDetaching($assuntos_ids);

        }
    }
}
