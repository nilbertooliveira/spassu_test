<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assuntos = [
            'Romance',
            'Ficção Científica',
            'Fantasia',
            'Suspense/Thriller',
            'Mistério',
            'Biografia',
            'História',
            'Psicologia',
            'Autoajuda',
            'Negócios',
            'Culinária',
            'Infantil/Juvenil',
            'Poesia',
            'Quadrinhos',
            'Aventura',
        ];

        foreach ($assuntos as $assunto) {
            DB::table('Assunto')->updateOrInsert(
                ['Descricao' => $assunto],
                [
                    'Descricao' => $assunto,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );
        }
    }
}
