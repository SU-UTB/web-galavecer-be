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
        Schema::create('nominations', function (Blueprint $table) {
            $table->id();
            $table->string('recommendator_first_name');
            $table->string('recommendator_last_name');
            $table->string('recommendator_email');
            $table->foreignId('faculty_id')->references('id')->on('faculties');
            $table->string('nominee_first_name');
            $table->string('nominee_last_name');
            $table->string('achievements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominations');
    }
};
