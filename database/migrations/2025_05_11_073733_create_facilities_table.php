<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['classroom', 'smartclass', 'reading_room']);
            $table->text('description')->nullable();
            $table->json('academic_days')->nullable();
            $table->string('academic_hours')->nullable();
            $table->string('collaborative_hours')->nullable();
            $table->json('images')->nullable();
            $table->boolean('is_active')->default(true); // Tambahkan kolom is_active
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
