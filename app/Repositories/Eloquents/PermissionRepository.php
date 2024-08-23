<?php

namespace App\Repositories\Eloquents;

use App\Models\Permission;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository
{
    public function model()
    {
        return new Permission();
    }


}