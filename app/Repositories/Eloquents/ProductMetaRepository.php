<?php

namespace App\Repositories\Eloquents;

use App\Models\ProductMeta;
use App\Repositories\BaseRepository;

class ProductMetaRepository extends BaseRepository
{
    public function model()
    {
        return new ProductMeta();
    }
}
