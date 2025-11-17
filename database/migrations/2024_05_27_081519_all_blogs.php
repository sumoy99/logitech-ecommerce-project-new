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
        Schema::create('all_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('blog_title', 250)->nullable();
            $table->string('blog_category', 250)->nullable();
            $table->string('blog_description')->nullable();
            $table->string('blog_date', 250)->nullable();
            $table->string('blog_thumbnail', 250)->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_blogs');
    }
};
