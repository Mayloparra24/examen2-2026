<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'idCategoria' => ['required', 'integer', 'exists:categorias,idCategoria'],
            'unidadMedida' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:255'],
            'ubicacion' => ['required', 'string', 'max:255'],
        ]);

        $material = Material::create($validated);

        return response()->json([
            'material' => $material->load('categoria'),
        ], 201);
    }
}
