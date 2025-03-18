<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $autores = [
            'Machado de Assis',
            'Carlos Drummond de Andrade',
            'Clarice Lispector',
            'Graciliano Ramos',
            'Jorge Amado',
            'Monteiro Lobato',
            'Manuel Bandeira',
            'Cecília Meireles',
            'Ariano Suassuna',
            'Érico Veríssimo',
            'João Guimarães Rosa',
            'Rubem Braga',
            'Adélia Prado',
            'Fernando Sabino',
            'Lygia Fagundes Telles',
        ];

        foreach ($autores as $autor) {
            DB::table('Autor')->updateOrInsert(
                ['Nome' => $autor],
                [
                    'Nome' => $autor,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
