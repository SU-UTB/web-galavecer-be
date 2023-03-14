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
        Schema::table('faculties', function (Blueprint $table) {

            $table->renameColumn('faculty_name', 'name');
            $table->renameColumn('faculty_abbrev', 'abbrev');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faculties', function (Blueprint $table) {
            $table->renameColumn('name', 'faculty_name');
            $table->renameColumn('abbrev', 'faculty_abbrev');
        });
    }
};