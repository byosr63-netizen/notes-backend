<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Note;
use Illuminate\Support\Facades\Hash;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('123456')
        ]);

        Note::create([
            'title' => 'Première note',
            'content' => 'Contenu exemple',
            'priority' => 'haute',
            'user_id' => $user->id
        ]);

        Note::create([
            'title' => 'Deuxième note',
            'content' => 'Autre contenu',
            'priority' => 'moyenne',
            'user_id' => $user->id
        ]);
    }
}