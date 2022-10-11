<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return void
     */
    public function viewAny(User $user, Todo $todo)
    {
        return $todo->user_id == $user->id;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Todo $todo
     * @return void
     */
    public function view(User $user, Todo $todo)
    {
        return $todo->user_id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Todo $todo
     * @return Response|bool
     */
    public function update(User $user, Todo $todo)
    {
        return $todo->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Todo $todo
     * @return Response|bool
     */
    public function delete(User $user, Todo $todo)
    {
        return $todo->user_id == $user->id;
    }

}
