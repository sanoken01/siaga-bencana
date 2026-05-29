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
        // Note: this requires doctrine/dbal to change column nullability in some environments.
        Schema::table('donations', function (Blueprint $table) {
            $table->unsignedBigInteger('report_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->unsignedBigInteger('report_id')->nullable(false)->change();
        });
    }
};
