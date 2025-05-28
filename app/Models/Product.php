<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'category_id',
        'name',
        'description',
        'cost_price',
        'price',
        'barcode',
        'stock_quantity',
        'brand',
        'image',
        'discount',
        'discount_start',
        'discount_end',
        'rating',
        'reviews_count',
        'expiration_date',
        'weight',
        'dimensions',
        'aisle',
        'section',
        'floor',
    ];
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function ingredients()
{
    return $this->belongsToMany(Ingredient::class, 'ingredient_product');
}
// In Product model
public function isDiscountActive()
{
    return $this->discount > 0
        && $this->discount_start !== null
        && $this->discount_end !== null
        && $this->discount_start <= now()
        && $this->discount_end >= now();
}

}
