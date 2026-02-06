<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->string('verification_code', 6)->nullable()->after('token');
            $table->timestamp('code_expires_at')->nullable()->after('created_at');
        });
    }

    public function down()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->dropColumn(['verification_code', 'code_expires_at']);
        });
    }
};
