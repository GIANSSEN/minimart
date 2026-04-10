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
            // Check if status exists, if not, create it
            if (!Schema::hasColumn('users', 'status')) {
                $table->string('status', 50)->default('pending');
            }
            
            // Check if approval_status exists, if not, create it
            if (!Schema::hasColumn('users', 'approval_status')) {
                $table->string('approval_status', 50)->default('pending');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // We usually don't drop existing core status columns unless strictly needed.
            if (Schema::hasColumn('users', 'status') && Schema::hasColumn('users', 'approval_status')) {
                // $table->dropColumn(['status', 'approval_status']);
            }
        });
    }
};
