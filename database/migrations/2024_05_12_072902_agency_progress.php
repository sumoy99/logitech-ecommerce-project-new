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
        Schema::create('agency_progress', function (Blueprint $table) {
            $table->id();
            $table->string('agency_progress_title', 250)->nullable();
            $table->string('total-agency_progress', 250)->nullable();
            $table->string('agency_progress_icon', 250)->nullable();
            $table->string('status', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency_progress');
    }
};
