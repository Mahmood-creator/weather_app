<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository extends BaseRepository
{
    public function __construct(Todo $todo)
    {
        $this->entity = $todo;
    }

}
