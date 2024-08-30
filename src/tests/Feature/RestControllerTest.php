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
}
