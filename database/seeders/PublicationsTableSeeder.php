<?php

namespace Database\Seeders;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Database\Seeder;

class PublicationsTableSeeder extends Seeder
{
    public function run()
    {
        $professor = User::where('user_type', 'professor')->first();
        
        Publication::create([
            'titre_pub' => 'Première Publication',
            'year' => '2023-01-01',
            'image' => 'default.jpg',
            'description' => 'Description de la première publication',
            'user_id' => $professor->id
        ]);
        
        Publication::create([
            'titre_pub' => 'Deuxième Publication',
            'year' => '2023-06-15',
            'image' => 'default.jpg',
            'description' => 'Description de la deuxième publication',
            'user_id' => $professor->id
        ]);
    }
}