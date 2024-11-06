<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('title')->unique(); // Unique title for the video
            $table->text('description')->nullable(); // Description of the video
            $table->string('youtube_id')->unique(); // Unique ID for the video on YouTube
            $table->string('youtube_url')->unique(); // Full URL to the video on YouTube
            $table->string('thumbnail_url')->nullable(); // URL for the video thumbnail
            $table->integer('duration')->nullable(); // Duration of the video in seconds
            $table->string('featured_image')->nullable(); // Optional field for a custom featured image
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key for the user who posted the video
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key for the video category
            $table->string('status')->default('active'); // Status of the video (e.g., active, inactive)
            $table->boolean('is_trending')->default(false); // Indicates if the video is trending
            $table->integer('trending_score')->nullable(); // Score to determine the trending quality
            $table->timestamp('trending_since')->nullable(); // Timestamp when it started trending

            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
