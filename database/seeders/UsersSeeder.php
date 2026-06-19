<?php

namespace Database\Seeders;

use App\Models\Habilidade;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcos = User::create([
            'name' => 'Marcos Dev',
            'email' => 'marcos@teste.com',
            'password' => bcrypt('12345678'),
            'localizacao' => 'São Paulo - SP',
        ]);

        // 2. Criamos a Aline e guardamos na variável $aline
        $aline = User::create([
            'name' => 'Aline Recrutadora',
            'email' => 'aline@teste.com',
            'password' => bcrypt('12345678'),
            'localizacao' => 'Marília - SP',
        ]);

        // 3. Buscamos os registros das habilidades que o HabilidadesSeeder criou
        $php = Habilidade::where('nome', 'PHP')->first();
        $laravel = Habilidade::where('nome', 'Laravel')->first();
        $design = Habilidade::where('nome', 'Design UI/UX')->first();

        // 4. Fazemos a mágica do relacionamento acontecer:
        // Vinculamos o Marcos ao PHP e ao Laravel
        if ($php && $laravel) {
            $marcos->habilidades()->attach([$php->id, $laravel->id]);
        }

        // Vinculamos a Aline ao Design
        if ($design) {
            $aline->habilidades()->attach([$design->id]);
        }
    }
}
