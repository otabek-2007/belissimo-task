<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'name_uz',
        'name_ru',
        'description_uz',
        'description_ru',
        'price_small',
        'price_medium',
        'price_big',
        'photo',
        'category_id',
        'in_stock',
        'is_pizza',
        'code',
        'package_code',
        'vat_percent',
        'position',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    use HasFactory;
}
