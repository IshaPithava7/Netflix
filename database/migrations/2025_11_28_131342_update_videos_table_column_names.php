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
        Schema::table('videos', function (Blueprint $table) {
            $table->renameColumn('title_poster', 'mini_poster');
            $table->renameColumn('file_path', 'trailer');
            $table->renameColumn('video_url', 'origin_movie');
            $table->dropColumn('tmdb_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->renameColumn('mini_poster', 'title_poster');
            $table->renameColumn('trailer', 'file_path');
            $table->renameColumn('origin_movie', 'video_url');
            $table->unsignedBigInteger('tmdb_id')->nullable();
        });
    }
};
