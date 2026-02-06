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
        Schema::create('hiring_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('employer_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained('requests')->onDelete('cascade');
            $table->string('employer_name');
            $table->string('employer_email');
            $table->string('employer_phone')->nullable();
            $table->text('message');
            $table->string('service_title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiring_requests');
    }
};
