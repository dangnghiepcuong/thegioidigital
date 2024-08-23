<?php

namespace App\Repositories\Eloquents;

use App\Models\Permission;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return new User();
    }
}