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
        Schema::table('donations', function (Blueprint $table) {
            if (!Schema::hasColumn('donations', 'email')) {
                $table->string('email')->after('donor_name')->nullable();
            }

            if (!Schema::hasColumn('donations', 'payment_method')) {
                $table->string('payment_method')->after('amount')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            if (Schema::hasColumn('donations', 'payment_method')) {
                $table->dropColumn('payment_method');
            }

            if (Schema::hasColumn('donations', 'email')) {
                $table->dropColumn('email');
            }
        });
    }
};
