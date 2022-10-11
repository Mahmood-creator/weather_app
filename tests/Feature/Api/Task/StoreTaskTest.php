<?php

namespace Tests\Feature\Api\Task;

use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreTaskTest extends BaseTaskTest
{
    public function setUp_data()
    {
        parent::setUp_data();
        $this->todo = Todo::factory()->create([
            'user_id' => $this->user->id,
        ]);
    }

    public function test_store_task()
    {
        $this->setUp_data();

        $response = $this->postJson('/api/v1/task', [
            'todo_id' => $this->todo->id,
            'title' => Str::random(10),
            'description' => Str::random(10),
        ]);

        $response->assertStatus(200);

        $this->user->forceDelete();
    }
}
