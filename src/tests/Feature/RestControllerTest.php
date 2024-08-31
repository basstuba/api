<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Rest;

class RestControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_index_rest(): void
    {
        $item = Rest::factory()->create();
        $response = $this->get('/api/v1/rest');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'message' => $item->message,
            'url' => $item->url
        ]);
    }

    public function test_store_rest(): void
    {
        $data = [
            'message' => 'rest',
            'url' => 'rest@example.com'
        ];
        $response = $this->post('/api/v1/rest', $data);
        $response->assertStatus(201);
        $response->assertJsonFragment($data);
        $this->assertDatabaseHas('rests', $data);
    }

    public function test_show_rest()
    {
        $item = Rest::factory()->create();
        $response = $this->get('/api/v1/rest/' . $item->id);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'message' => $item->message,
            'url' => $item->url
        ]);
    }

    public function test_update_rest()
    {
        $item = Rest::factory()->create();
        $data = [
            'message' => 'rest_update',
            'url' => 'rest_update@example.com',
        ];
        $response = $this->put('/api/v1/rest/' . $item->id, $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('rests', $data);
    }

    public function test_destroy_rest()
    {
        $item = Rest::factory()->create();
        $response = $this->delete('/api/v1/rest/' . $item->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('rests', ['id' => $item->id]);//$this->assertDeleted($item);ではエラーになる
    }
}
