<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\AttributeGroup;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_type',
        'group_id',
        'name',
        'vi_translation',
        'description',
    ];

    public function members()
    {
        return $this->hasMany(Attribute::class, 'group_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(AttributeGroup::class, 'group_id', 'id');
    }
}
