<?php

namespace App\Console\Commands;

use App\Jobs\WeatherJob;
use App\Models\User;
use Illuminate\Console\Command;

class WeatherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refreshed the weather data for all users';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('refreshing weather data...');

        $users = User::all();

        $delay = 0;
        $users->each(function ($user) use (&$delay) {
            if ($user->latitude && $user->longitude) {
                WeatherJob::dispatch($user)->delay($delay);
                $delay += 5;
            }
        });
    }
}
