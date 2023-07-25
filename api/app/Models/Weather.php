<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'main',
        'description',
        'temp',
        'feels_like',
        'feels_like',
        'temp_max',
        'temp_min',
        'humidity',
        'wind_speed',
        'wind_degree',
        'clouds',
        'rain',
        'snow',
        'snow',
        'country',
        'city',
    ];

    /**
     * Owner user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
