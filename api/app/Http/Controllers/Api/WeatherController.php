<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Actions\Weather\GetWeatherByUserId;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Display weather by user id.
     */
    public function getByUserId(Request $request, User $user, GetWeatherByUserId $action)
    {
        return response()->json($action->handle($user->id));
    }
}
