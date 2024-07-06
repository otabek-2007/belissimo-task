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
    ];
    public function bonusItems()
    {
        return $this->hasMany(BonusItem::class, 'bonus_id', 'id');
    }

}
