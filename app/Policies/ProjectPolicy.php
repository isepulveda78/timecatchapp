<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

      public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Project $project)
    {
        return $user->id == $project->user_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Project $project)
    {
        return $user->id == $project->user_id;
    }

    public function delete(User $user, Project $project)
    {
        return $user->id == $project->user_id;
    }

    public function restore(User $user, Project $project)
    {
        return false;
    }

    public function forceDelete(User $user, Project $project)
    {
        return false;
    }
}
