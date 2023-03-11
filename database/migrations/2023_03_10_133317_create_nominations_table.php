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
            $table->enum('faculty', ['Fakulta technologická', 'Fakulta managementu a ekonomiky', 'Fakulta multimediálních komunikací', 'Fakulta aplikované informatiky', 'Fakulta humanitních studií', 'Fakulta logistiky a krizového řízení']);
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
