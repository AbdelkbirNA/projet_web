<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Crée un professeur
        User::create([
            'name' => 'mohamed amine ',
            'email' => 'mohamedaminebaichh@gmail.com',
            'password' => bcrypt('admin'),
            'user_type' => 'professor',
            'matricule' => 'amine2003'
        ]);

        
    }
}