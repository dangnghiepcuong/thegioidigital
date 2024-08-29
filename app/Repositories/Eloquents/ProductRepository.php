<?php

namespace App\Repositories\Eloquents;

use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return new Product();
    }
}
