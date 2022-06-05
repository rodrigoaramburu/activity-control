<?php

namespace App\Models;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivitySession extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'begin',
        'end',
        'activity_id'
    ];


    protected $casts = [
        'begin' => 'datetime',
        'end' => 'datetime',
    ];

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function duration(): int
    {
        return $this->end->diffInMinutes($this->begin);
    }

    public function value()
    {
        return $this->duration() / 60  * $this->activity->valuePerHour;
    }

}
