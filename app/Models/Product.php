<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'parent_id',
        'type',
        'status',
        'url',
        'description',
    ];

    public function children()
    {
        return $this->hasMany(Product::class, 'parent_id');
    }
    
    public function parent()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }

    public function productMeta($key = null)
    {
        if ($key) {
            return $this->hasMany(ProductMeta::class)->where('key', $key);
        }

        return $this->hasMany(ProductMeta::class);
    }

    public function termTaxonomies()
    {
        return $this->belongsToMany(TermTaxonomy::class, 'term_relationships', 'termable_id', 'term_taxonomy_id')
            ->withTimestamps();
    }
}
