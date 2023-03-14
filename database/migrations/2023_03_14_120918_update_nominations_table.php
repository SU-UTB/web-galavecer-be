<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('nominations', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained('categories');
            $table->renameColumn('recommendator_email', 'nominee_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nominations', function (Blueprint $table) {
            $table->dropColumn('category_id');
            $table->renameColumn('nominee_email', 'recommendator_email');
        });
    }
};