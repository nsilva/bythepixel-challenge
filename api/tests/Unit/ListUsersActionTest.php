<?php

namespace Tests\Unit;

use App\Http\Controllers\Actions\User\ListUsersAction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUsersActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_action_returns_all_users(): void
    {
        $users = User::factory(5)->create();
        $action = new ListUsersAction();

        $actionUsers = $action->handle();

        $this->assertEquals($users->pluck('name')->all(), $actionUsers->pluck('name')->all());
    }
}
