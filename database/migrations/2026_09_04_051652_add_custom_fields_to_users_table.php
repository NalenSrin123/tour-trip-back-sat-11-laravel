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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }







    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('role')->default('customer')->after('email');
        $table->string('otp')->nullable()->after('role');
        $table->timestamp('otp_expires_at')->nullable()->after('otp');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['role', 'otp', 'otp_expires_at']);
    });
}
};
