<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermTaxonomy extends Model
{
    use HasFactory;

    protected $fillable = [
        'taxonomy',
        'description',
        'parent',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'term_relationships', 'termable_id', 'term_taxonomy_id')
            ->withTimestamps();
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}
