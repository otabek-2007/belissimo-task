<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id',
        'name_uz',
        'name_ru',
        'parent_id',
        'has_subcategory',
        'is_pizza',
        'photo',
        'link',
        'position',
        'created_at',
        'updated_at',
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }


    use HasFactory;
}
