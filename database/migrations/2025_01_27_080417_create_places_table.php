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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('place_unique_code', 27)->unique();
            $table->string('name', 100);
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->longText('address');
            $table->decimal('latitude', 18,15);
            $table->decimal('longitude',18,15);
            $table->string('thumbnail')->nullable();
            $table->unsignedBigInteger('start_price');
            $table->unsignedBigInteger('end_price');
            $table->string('phone_number', 14);
            $table->enum('status', ['pending', 'approved'])->default('pending');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
