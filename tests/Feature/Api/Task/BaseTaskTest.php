<?php

namespace Tests\Feature\Api\Task;

use App\Models\Task;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class BaseTaskTest extends TestCase
{
    public User $user;
    public Task $task;
    public Todo $todo;


    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function setUp_data()
    {
        $this->user = User::factory()->create([
        ]);

        \Auth::login($this->user);

    }
}
