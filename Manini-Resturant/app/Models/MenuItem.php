<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'category_id',
        'image', 'featured', 'available', 'vegetarian',
        'vegan', 'gluten_free', 'spicy_level', 'sort_order',
        'allergens', 'calories',
    ];

    protected function casts(): array
    {
        return [
            'featured'    => 'boolean',
            'available'   => 'boolean',
            'vegetarian'  => 'boolean',
            'vegan'       => 'boolean',
            'gluten_free' => 'boolean',
            'allergens'   => 'array',
            'price'       => 'decimal:2',
        ];
    }

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    public function getFormattedPriceAttribute(): string
    {
        return '$' . number_format($this->price, 2);
    }
}