<?php

namespace App\Repositories\Eloquents;

use App\Models\TermTaxonomy;
use App\Repositories\BaseRepository;

class TermTaxonomyRepository extends BaseRepository
{
    public function model()
    {
        return new TermTaxonomy();
    }
}
