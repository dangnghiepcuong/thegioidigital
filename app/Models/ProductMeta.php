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
        'product_id',
    ];

    public function getCurrency($prefix = null, $decimal = 0, $postfix = '₫')
    {
        return $prefix . number_format($this->value, $decimal) . $postfix;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
