<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'El nom del vent',
                'author' => 'Patrick Rothfuss',
                'year' => 2007,
                'pages' => 872,
                'description' => 'Crònica de la vida de Kvothe, un heroi llegendari.',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'year' => 1949,
                'pages' => 328,
                'description' => 'Distopia sobre vigilància i totalitarisme.',
            ],
            [
                'title' => 'Cims borrascosos',
                'author' => 'Emily Brontë',
                'year' => 1847,
                'pages' => 416,
                'description' => 'Passions i obsessions a les torberes de Yorkshire.',
            ],
            [
                'title' => 'La plaça del Diamant',
                'author' => 'Mercè Rodoreda',
                'year' => 1962,
                'pages' => 272,
                'description' => 'La vida de la Natàlia (la Colometa) a la Barcelona del s. XX.',
            ],
            [
                'title' => 'El petit príncep',
                'author' => 'Antoine de Saint-Exupéry',
                'year' => 1943,
                'pages' => 96,
                'description' => 'Un viatge poètic sobre l’amistat i el sentit de la vida.',
            ],
        ];

        foreach ($books as $b) {
            Book::create($b);
        }
    }
}

