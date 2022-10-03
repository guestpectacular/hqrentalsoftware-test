<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * App\Models\Discount
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $percentage
 * @property \Carbon\CarbonImmutable|null $valid_from
 * @property \Carbon\CarbonImmutable|null $valid_until
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereValidFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereValidUntil($value)
 * @mixin \Eloquent
 */
class Discount extends Model
{
    use HasFactory;

    // Not required at first, but It's something to consider at future
    protected $casts = [
        'valid_from'  => 'immutable_datetime',
        'valid_until' => 'immutable_datetime',
    ];

    protected $fillable = [
        'description',
        'percentage',
        'valid_from',
        'valid_until',
    ];

    /**
     * @return MorphToMany<Category>
     */
    public function categories(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'discountable');
    }

    /**
     * @return MorphToMany<Product>
     */
    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'discountable');
    }

}
