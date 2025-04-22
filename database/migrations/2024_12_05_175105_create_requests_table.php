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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('bloodbank_id')->constrained('bloodbanks')->onDelete('cascade');
            $table->string('blood_type')->nullable();
            $table->integer('quantity');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('request_type', ['Plasma', 'Full_blood', 'Platelets'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
