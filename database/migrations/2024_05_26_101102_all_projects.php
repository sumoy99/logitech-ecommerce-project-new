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
        Schema::create('all_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_title', 250)->nullable();
            $table->string('project_category', 250)->nullable();
            $table->string('project_description')->nullable();
            $table->string('client', 250)->nullable();
            $table->string('project_date', 250)->nullable();
            $table->string('project_thumbnail', 250)->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_projects');
    }
};
