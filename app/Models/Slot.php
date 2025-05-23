<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'coach_id',
        'date',
        'start_time',
        'capacity',
        'spots_left',
        'category',
        'price',
    ];

    /**
     * El coach al que pertenece este slot.
     */
    public function coach(): BelongsTo
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    /**
     * Las reservas de este slot.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
