<?php

use App\Models\Movie;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->string('slug')->unique()->after('title')->nullable();
        });


        Movie::withoutEvents(function () {
            Movie::chunk(100, function ($movies) {
                foreach ($movies as $movie) {
                    if (empty($movie->slug)) { // Ensure slug is empty
                        $movie->slug = str($movie->title)->slug();
                        $movie->save();
                    }
                }
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            //
        });
    }
};
