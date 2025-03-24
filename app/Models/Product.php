<?php

namespace App\Models;

use App\Enums\ModelMetaKey;
use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'parent_id',
        'type',
        'status',
        'slug',
        'description',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('notInProcess', function (Builder $builder) {
            $builder->where('status', '!=', ProductStatusEnum::IN_PROCESS);
        });
    }

    public function children()
    {
        return $this->hasMany(Product::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }

    public function productMeta()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function productMetaByKey($key)
    {
        if ($key) {
            return $this->productMeta->firstWhere('key', $key);
        }

        return null;
    }

    public function productMetaInCardView()
    {
        return $this->hasMany(ProductMeta::class)->whereIn(
            'key',
            array_merge(ModelMetaKey::inProductCardView(), ModelMetaKey::inPriorTaxonomies())
        );
    }

    public function productMetaInCardViewByKey($key)
    {
        return $this->productMetaInCardView
            ->firstWhere('key', $key);
    }

    public function termTaxonomies()
    {
        return $this->belongsToMany(TermTaxonomy::class, 'term_relationships', 'termable_id', 'term_taxonomy_id')
            ->withTimestamps();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
