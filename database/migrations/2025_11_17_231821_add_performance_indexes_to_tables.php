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
        Schema::table('categories', function (Blueprint $table) {
            $table->index('is_active', 'idx_categories_active');
            $table->index('slug', 'idx_categories_slug');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->index('category_id', 'idx_products_category');
            $table->index('is_active', 'idx_products_active');
            $table->index(['is_active', 'stock_quantity'], 'idx_products_active_stock');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index('status', 'idx_orders_status');
            $table->index('user_id', 'idx_orders_user');
            $table->index('created_at', 'idx_orders_created');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex('idx_categories_active');
            $table->dropIndex('idx_categories_slug');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_products_category');
            $table->dropIndex('idx_products_active');
            $table->dropIndex('idx_products_active_stock');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('idx_orders_status');
            $table->dropIndex('idx_orders_user');
            $table->dropIndex('idx_orders_created');
        });
    }
};
