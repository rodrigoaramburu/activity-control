<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
