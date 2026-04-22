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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('sum');
            $table->timestamps();
            $table->boolean('isIncome');
            $table->timestamp('publish_date')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->index('user_id', 'transaction_user_idx');
            $table->foreign('user_id', 'transaction_user_fk')->on('users')->references('id');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
