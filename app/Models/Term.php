<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $with = ['termTaxonomy'];

    public function termTaxonomy()
    {
        return $this->hasOne(TermTaxonomy::class);
    }

    public function termMeta($key)
    {
        if ($key) {
            return $this->hasMany(TermMeta::class)->where('key', $key);
        }

        return $this->hasMany(TermMeta::class);
    }
}
