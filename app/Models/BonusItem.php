<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'bonus_id',
        'position_id'
    ];

    public function bonus()
    {
        return $this->belongsTo(Bonus::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'position_id');
    }
}