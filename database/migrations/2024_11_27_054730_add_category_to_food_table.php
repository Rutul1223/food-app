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
        Schema::table('food', function (Blueprint $table) {
            Schema::table('food', function (Blueprint $table) {
                $table->string('category')->nullable()->after('price'); // Add 'category' column
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food', function (Blueprint $table) {
            Schema::table('food', function (Blueprint $table) {
                $table->dropColumn('category');
            });
        });
    }
};
