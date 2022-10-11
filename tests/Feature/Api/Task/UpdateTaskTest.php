<?php

namespace Tests\Feature\Api\Task;

use App\Models\Task;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateTaskTest extends BaseTaskTest
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

    public function test_update_task()
    {
        $this->setUp_data();

        $response = $this->putJson('/api/v1/task/'.$this->task->id, [
            'todo_id' => $this->todo->id,
            'title' => Str::random(10),
            'description' => Str::random(10),
        ]);

        $response->assertStatus(200);

        $this->user->forceDelete();
    }
}
