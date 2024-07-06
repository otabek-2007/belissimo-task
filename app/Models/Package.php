<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'name_uz',
        'name_ru',
        'description_uz',
        'description_ru'
    ];
    use HasFactory;
}
