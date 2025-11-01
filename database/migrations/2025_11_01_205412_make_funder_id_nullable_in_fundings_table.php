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
        Schema::table('fundings', function (Blueprint $table) {
            // Drop existing foreign key constraint
            $table->dropForeign(['funder_id']);
            // Make funder_id nullable
            $table->unsignedBigInteger('funder_id')->nullable()->change();
            // Re-add foreign key constraint with nullable
            $table->foreign('funder_id')->references('id')->on('funders')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fundings', function (Blueprint $table) {
            // Drop foreign key
            $table->dropForeign(['funder_id']);
            // Make funder_id required again (but we can't easily enforce non-null in down migration)
            $table->unsignedBigInteger('funder_id')->nullable(false)->change();
            // Re-add foreign key
            $table->foreign('funder_id')->references('id')->on('funders')->cascadeOnDelete();
        });
    }
};
