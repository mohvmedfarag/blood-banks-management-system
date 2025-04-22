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
        Schema::create('blood_samples', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bloodbank_id')->constrained('bloodbanks')->onDelete('cascade');
            $table->enum('blood-sample', ['A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_samples');
    }
};
