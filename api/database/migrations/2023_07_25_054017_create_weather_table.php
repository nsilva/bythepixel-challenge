<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('main')->nullable();
            $table->string('description')->nullable();
            $table->float('temp')->nullable();
            $table->float('feels_like')->nullable();
            $table->float('temp_max')->nullable();
            $table->float('temp_min')->nullable();
            $table->integer('humidity')->nullable();
            $table->float('wind_speed')->nullable();
            $table->integer('wind_degree')->nullable();
            $table->integer('clouds')->nullable();
            $table->integer('rain')->nullable(); // mm
            $table->integer('snow')->nullable(); // mm
            $table->string('country')->nullable(); // mm
            $table->string('city')->nullable(); // mm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather');
    }
};
