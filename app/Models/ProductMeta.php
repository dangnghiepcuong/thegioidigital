<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    use HasFactory;

    protected $table = 'product_meta';
    protected $fillable = [
        'key',
        'value',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
