<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_uz',
        'name_ru',
        'description_uz',
        'description_ru',
        'product_id'
    ];

    public function bonusItems()
    {
        return $this->hasMany(BonusItem::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
