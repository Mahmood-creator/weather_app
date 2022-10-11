<?php

namespace Tests\Feature\Api\Task;

use App\Models\Task;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class DeleteTaskTest extends BaseTaskTest
{
    public function setUp_data()
    {
        parent::setUp_data();

        $this->todo = Todo::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->postJson('/api/v1/task', [
            'todo_id' => $this->todo->id,
            'title' => Str::random(10),
            'description' => Str::random(10),
        ]);

        $this->task = Task::find($response->json('data')['id']);
    }

    public function test_delete_task()
    {
        $this->setUp_data();

        $response = $this->deleteJson('/api/v1/task/'.$this->task->id);

        $response->assertStatus(200);

        $this->user->forceDelete();
    }
}
