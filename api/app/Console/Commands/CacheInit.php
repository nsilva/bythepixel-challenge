<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CacheInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $users = User::query()
            ->select(['name'])
            ->get();

        $cacheKey = "users:{$city}:{$country}";
        Cache::put($cacheKey, $weatherData, now()->addMinutes(30));
    }
}
