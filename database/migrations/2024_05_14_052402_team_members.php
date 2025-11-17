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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->nullable();
            $table->string('designation', 250)->nullable();
            $table->string('description', 250)->nullable();
            $table->string('social_icon_url', 250)->nullable();
            $table->string('skill_title', 250)->nullable();
            $table->string('skill_subtitle', 250)->nullable();
            $table->string('skill_name_level', 250)->nullable();
            $table->string('image', 250)->nullable();
            $table->string('senior_team_member', 250)->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
