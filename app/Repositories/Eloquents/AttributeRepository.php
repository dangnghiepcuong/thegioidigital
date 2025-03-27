<?php

namespace App\Repositories\Eloquents;

use App\Models\Attribute;
use App\Repositories\BaseRepository;

class AttributeRepository extends BaseRepository
{
    public function model()
    {
        return new Attribute();
    }
}
