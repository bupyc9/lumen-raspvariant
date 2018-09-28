<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStopPoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('stop_points', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('external_id');
            $table->string('name');
            $table->index(['external_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('stop_points');
    }
}
