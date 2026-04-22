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
        Schema::table('transactions', function (Blueprint $table) {
            
            $table->unsignedBigInteger('category_id')->nullable()->after('sum');
            $table->index('category_id', 'transaction_category_idx');
            $table->foreign('category_id', 'transaction_category_fk')->on('categories')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }
};
