<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('employer_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type'); // new_application, contact_request
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->index(['student_id']);
            $table->index(['employer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
