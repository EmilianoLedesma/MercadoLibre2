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
        Schema::table('orders', function (Blueprint $table) {
            // Drop foreign key constraints first
            $table->dropForeign(['user_id']);
            $table->dropForeign(['address_id']);

            // Make columns nullable
            $table->foreignId('user_id')->nullable()->change();
            $table->foreignId('address_id')->nullable()->change();

            // Re-add foreign keys with nullable support
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop foreign keys
            $table->dropForeign(['user_id']);
            $table->dropForeign(['address_id']);

            // Make columns not nullable again
            $table->foreignId('user_id')->change();
            $table->foreignId('address_id')->change();

            // Re-add original foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('restrict');
        });
    }
};
