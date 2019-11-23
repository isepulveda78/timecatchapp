<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Task $task)
    {
        return $user->id == $task->user_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Task $task)
    {
        return $user->id == $task->user_id;
    }

    public function delete(User $user, Task $task)
    {
        return $user->id == $task->user_id;
    }

    public function restore(User $user, Contact $contact)
    {
        return false;
    }

    public function forceDelete(User $user, Task $task)
    {
        return false;
    }
}
