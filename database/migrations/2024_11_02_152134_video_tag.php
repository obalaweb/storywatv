<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('video_tag', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('video_id')->constrained()->onDelete('cascade'); // Foreign key to videos
            $table->foreignId('tag_id')->constrained()->onDelete('cascade'); // Foreign key to tags
            $table->timestamps(); // Timestamps for created_at and updated_at
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_tag');
    }
};
