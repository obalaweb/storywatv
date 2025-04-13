<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->boolean('is_scheduled')->default(false);
            $table->dateTime('scheduled_start_time')->nullable();
            $table->dateTime('scheduled_end_time')->nullable();
            $table->integer('play_order')->nullable();
        });
    }

    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn(['is_scheduled', 'scheduled_start_time', 'scheduled_end_time', 'play_order']);
        });
    }
};
