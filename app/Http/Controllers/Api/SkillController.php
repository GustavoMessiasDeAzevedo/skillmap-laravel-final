<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Habilidade;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Habilidade::all();

        return response()->json($skills, 200);
    }
}
