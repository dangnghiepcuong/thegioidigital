<?php

namespace App\Models;

use App\Enums\TableEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class UserMeta extends Model
{
    use HasFactory;

    protected $table = TableEnum::USER_META;

    protected $fillable = [
        'key',
        'value',
    ];

    public function user(): Relation
    {
        return $this->belongsTo(User::class);
    }
}
