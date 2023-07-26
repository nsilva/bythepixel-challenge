<?php

namespace App\Http\Controllers\Actions\User;

use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class ListUsersAction
{
    public function handle(): Collection
    {
        $expire = Carbon::now()->addMinutes(15);

        //return Cache::remember('users:all', $expire, function() {
            return User::query()
                ->select(['users.id', 'name', 'temp'])
                ->leftJoin('weather', 'users.id', '=', 'weather.user_id')
                ->get();
        //});
    }
}
