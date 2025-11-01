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
        Schema::create('mentor_hours_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('mentors')->cascadeOnDelete();
            $table->foreignId('session_id')->constrained('mentor_sessions')->cascadeOnDelete();
            $table->integer('hours_contributed');
            $table->integer('earned_points');
            $table->float('star')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_hours_log');
    }
};
