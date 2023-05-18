<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function findById(int $id): ?User
    {
        return $this->createQueryBuilder()->find($id);
    }
}
