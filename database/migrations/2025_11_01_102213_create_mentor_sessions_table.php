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
        Schema::create('mentor_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('umkm_owner');
            $table->foreignId('mentor_id')->constrained('mentors')->cascadeOnDelete();
            $table->string('topic');
            $table->dateTime('scheduled_at');
            $table->integer('duration_minutes');
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->text('feedback')->nullable();
            $table->integer('rating')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_sessions');
    }
};
