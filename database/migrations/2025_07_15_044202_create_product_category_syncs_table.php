<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Migrasi Category
    public function up(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->string('hub_category_id')->nullable();
        });
    }
};
