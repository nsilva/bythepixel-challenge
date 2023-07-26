<?php

namespace App\Http\Controllers\Actions\Weather;

use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class GetWeatherByUserId
{
    public function handle(int $userId): array
    {
        $expire = Carbon::now()->addMinutes(15);

        return Cache::remember("user:weather:{$userId}", $expire, function() use ($userId){
            $weather = Weather::where('user_id', $userId)
                ->first();
            return (!empty($weather)) ? $weather->toArray() : [];
        });
    }
}
