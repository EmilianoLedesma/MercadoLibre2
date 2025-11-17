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
        // Add indexes to products table for better query performance
        Schema::table('products', function (Blueprint $table) {
            $table->index('slug', 'products_slug_index');
            $table->index('is_active', 'products_is_active_index');
            $table->index('is_featured', 'products_is_featured_index');
            $table->index(['category_id', 'is_active'], 'products_category_active_index');
            $table->index(['is_active', 'created_at'], 'products_active_created_index');
        });

        // Add indexes to categories table for better query performance
        Schema::table('categories', function (Blueprint $table) {
            $table->index('slug', 'categories_slug_index');
            $table->index('is_active', 'categories_is_active_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_slug_index');
            $table->dropIndex('products_is_active_index');
            $table->dropIndex('products_is_featured_index');
            $table->dropIndex('products_category_active_index');
            $table->dropIndex('products_active_created_index');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex('categories_slug_index');
            $table->dropIndex('categories_is_active_index');
        });
    }
};
