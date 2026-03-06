<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->tinyInteger('prediction_percentage')->default(0)->comment('0-100%');
            $table->enum('disaster_status', ['Terjadi', 'Prediksi', 'Selesai'])->default('Prediksi');
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude', 'prediction_percentage', 'disaster_status']);
        });
    }
};
