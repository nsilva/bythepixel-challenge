<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Actions\User\ListUsersAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListUsersAction $action)
    {
        return response()->json($action->handle());
    }
}
