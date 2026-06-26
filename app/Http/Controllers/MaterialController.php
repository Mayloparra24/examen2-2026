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

    public function update(Request $request, int $codigo): JsonResponse
{
    $material = Material::findOrFail($codigo);

    $validated = $request->validate([
        'idCategoria'  => ['sometimes', 'integer', 'exists:categorias,idCategoria'],
        'unidadMedida' => ['sometimes', 'string', 'max:255'],
        'descripcion'  => ['sometimes', 'string', 'max:255'],
        'ubicacion'    => ['sometimes', 'string', 'max:255'],
    ]);

    $material->update($validated);

    return response()->json([
        'material' => $material->load('categoria'),
    ], 200);
}
public function index(): JsonResponse
{
    $materiales = Material::with('categoria')->get();

    return response()->json([
        'materiales' => $materiales,
    ], 200);
}
}
