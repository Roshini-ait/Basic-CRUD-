<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Student $student)
    {
        return $user->isAdmin() || $user->isUser();
    }

    public function manage(User $user)
    {
        return $user->isAdmin();
    }

}
