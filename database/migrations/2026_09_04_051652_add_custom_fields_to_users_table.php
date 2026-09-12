<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // OTP fields are created by 2026_09_04_011935_add_auth_fields_to_users_table.
        // Keep this migration so existing migration histories remain valid.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // The migration that creates the OTP fields owns their rollback.
    }
};
