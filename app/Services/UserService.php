<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;

class UserService
{
    public function createUser(UserDTO $userDTO): User
    {
        $user = new User();
        $user->name = $userDTO->name;
        $user->email = $userDTO->email;
        $user->password = $userDTO->password;
        $user->role = $userDTO->role;
        $user->save();

        return $user;
    }
}
