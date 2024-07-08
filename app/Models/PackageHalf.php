<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageHalf extends Model
{
    use HasFactory;

    protected $table = 'package_half';

    protected $fillable = [
        'left_product_id',
        'right_product_id',
        'quantity',
        'name_uz_one',
        'name_uz_two',
        'price',
    ];

    public function leftProduct()
    {
        return $this->belongsTo(Product::class, 'left_product_id');
    }

    public function rightProduct()
    {
        return $this->belongsTo(Product::class, 'right_product_id');
    }
}
