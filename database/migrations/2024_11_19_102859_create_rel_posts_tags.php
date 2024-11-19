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
        Schema::create('rel_posts_tags', function (Blueprint $table) {
            $table->foreignId('post_id')->references('id', 'tags')->on('posts');
            $table->foreignId('tag_id')->references('tag_id', 'posts')->on('tags');

            $table->primary('post_id', 'tag_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rel_posts_tags');
    }
};
