<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'bonus_id',
        'name_ru',
        'position_id'
    ];

    public function bonus()
    {
        return $this->belongsTo(Bonus::class, 'bonus_id');
    }

}