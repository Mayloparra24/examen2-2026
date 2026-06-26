<?php

namespace Tests\Feature;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MaterialControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function dadoUnMaterialQueNoExiste_insertarMaterial_funcionaCorrectamente(): void
    {
        $categoria = Categoria::create(['nombre' => 'Papelería']);

        $payload = [
            'idCategoria' => $categoria->idCategoria,
            'unidadMedida' => 'Resma',
            'descripcion' => 'Papel bond tamaño carta',
            'ubicacion' => 'Bodega A',
        ];

        $response = $this->postJson('/api/materiales', $payload);

        $response->assertStatus(201)
            ->assertJsonPath('material.descripcion', $payload['descripcion'])
            ->assertJsonPath('material.categoria.idCategoria', $categoria->idCategoria);

        $this->assertDatabaseHas('materiales', [
            'unidadMedida' => $payload['unidadMedida'],
            'descripcion' => $payload['descripcion'],
            'ubicacion' => $payload['ubicacion'],
            'idCategoria' => $categoria->idCategoria,
        ]);
    }
}
