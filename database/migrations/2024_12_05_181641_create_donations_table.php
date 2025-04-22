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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            $table->foreignId('bloodbank_id')->constrained('bloodbanks')->onDelete('cascade');
            $table->string('blood_type')->nullable();
            $table->integer('quantity');
            $table->enum('donation_type', ['Plasma', 'Whole Blood', 'Platelets'])->nullable();
            $table->string('donation_date');
            $table->enum('status', ['Pending', 'Accepted', 'Rejected'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
