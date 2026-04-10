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
        // Add 'pending' to the status enum
        DB::statement("ALTER TABLE users MODIFY COLUMN status ENUM('pending', 'active', 'inactive') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enum
        DB::statement("ALTER TABLE users MODIFY COLUMN status ENUM('active', 'inactive') DEFAULT 'active'");
    }
};
