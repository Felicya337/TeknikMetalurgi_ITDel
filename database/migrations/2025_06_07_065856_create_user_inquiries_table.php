<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();
            $table->enum('type', ['question', 'review'])->index();
            $table->enum('user_type', ['internal', 'masyarakat'])->nullable()->index();
            $table->text('content');
            $table->integer('rating')->nullable();
            $table->text('admin_response')->nullable();
            $table->boolean('is_responded')->default(false);
            $table->timestamp('responded_at')->nullable();
            $table->unsignedBigInteger('responded_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('responded_by')->references('id')->on('admins')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_inquiries');
    }
};
