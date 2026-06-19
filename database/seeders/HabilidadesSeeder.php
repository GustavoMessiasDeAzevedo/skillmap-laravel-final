<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class HabilidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tecnologias = ['PHP', 'Laravel', 'JavaScript', 'Vue.js', 'React', 'MySQL', 'Docker', 'Tailwind CSS'];

        foreach ($tecnologias as $tech) {
            DB::table('habilidades')->insert([
                'nome' => $tech,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
