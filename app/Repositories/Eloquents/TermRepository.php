<?php

namespace App\Repositories\Eloquents;

use App\Models\Term;
use App\Repositories\BaseRepository;

class TermRepository extends BaseRepository
{
    public function model()
    {
        return new Term();
    }
}
