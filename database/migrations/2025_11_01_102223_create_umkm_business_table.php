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
        Schema::create('umkm_business', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('umkm_owners')->cascadeOnDelete();
            $table->string('name');
            $table->string('category')->default('lainnya');
            $table->string('other_category')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_business');
    }
};
