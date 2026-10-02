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
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['sport', 'activity']);
            $table->unsignedBigInteger('reference_id'); // sports.id or activities.id
            $table->timestamp('registered_at');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
    }
};
