<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('linkedIn')->nullable();
            $table->string('room');
            $table->mediumText('education')->nullable();
            $table->mediumText('research')->nullable();
            $table->mediumText('courses')->nullable();
            $table->enum('role', ['dosen', 'staf']);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};
