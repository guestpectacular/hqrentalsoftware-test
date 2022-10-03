<?php

namespace App\Helpers\ValueObjects;

use App\Models\Product;
use Money\Currency;

class Price
{
    public readonly int     $original;
    public readonly int     $final;
    public readonly ?string $discount_percentage;
    public readonly string  $currency;

    public function __construct(private readonly Product $product, string $currency = 'EUR')
    {
        // I know this is unnecessary
        // I'm adding this library to help team gide switching currencies in the future...
        $this->currency = (new Currency($currency))->getCode();

        // Direct product discount
        $currentDiscount = (int) $this->product->discounts()->sum('percentage');

        // Categories discount, since we're given the flexibility to not only be attached to one...
        $currentDiscount += (int) $product->categories()
                                          ->withSum('discounts', 'percentage')
                                          ->get()
                                          ->sum('discounts_sum_percentage')
        ;

        // This could be written as
        // $currentDiscount = (int) $this->product->category->sum('percentage');
        // If instead support multiple categories X product using BelongsToMany I've used only
        // A single BelongsTo relationship, but I want to ve more versatile on this test

        $this->original            = $this->product->originalPrice;
        $this->discount_percentage = ($currentDiscount > 0) ? "{$currentDiscount}%" : null;
        $this->final               = ($currentDiscount > 0) ? ($this->original - (($currentDiscount / 100) * $this->original)) : $this->original;

    }
}