<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'valuePerHour',
        'timePerDay'
    ];


    public function timePerDayInHour(): float
    {
        $tmp = explode(':',$this->timePerDay);
        return  intval($tmp[0]) + intval($tmp[1]) / 60;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
