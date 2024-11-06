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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('description')->nullable();
            $table->string('genre')->nullable();
            $table->date('release_date')->nullable();
            $table->integer('duration')->nullable(); // duration in minutes
            $table->decimal('price', 8, 2)->default(0.00); // price in USD or specified currency
            $table->boolean('is_available')->default(true); // availability for purchase
            $table->string('feature_image')->nullable(); // URL or path to the movie poster or cover image
            $table->string('trailer_url')->nullable(); // URL for the movie trailer
            $table->decimal('rating', 2, 1)->nullable(); // average rating (e.g., 4.5)
            $table->string('language')->nullable(); // primary language of the movie
            $table->string('country')->nullable(); // country of origin
            $table->string('director')->nullable(); // director of the movie
            $table->string('cast')->nullable(); // main cast members
            $table->integer('views')->default(0); // number of views or purchases
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
