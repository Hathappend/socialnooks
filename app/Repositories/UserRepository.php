<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function update(int $userId, array $user): bool
    {
        $find = User::find($userId);
        return $find->update($user);
    }

}
