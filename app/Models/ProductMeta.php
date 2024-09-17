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

    public function getCurrency($currencyCode = 'VND', $decimal = 0, $decimalSeparator = ',', $thousandSeparator = '.')
    {
        $prefix = null;
        $postfix = null;

        switch (strtoupper($currencyCode)) {
            case 'VND':
                $postfix = '₫';
                break;
            case 'USD':
                $prefix = '$';
                break;
            case 'JPY':
            case 'CNY':
                $prefix = '¥';
                break;
            case 'KPW':
            case 'KRW':
                $prefix = '₩';
                break;
            case 'GBP':
                $prefix = '£';
                break;
            default:
        }
        return $prefix . number_format($this->value, $decimal, $decimalSeparator, $thousandSeparator) . $postfix;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
