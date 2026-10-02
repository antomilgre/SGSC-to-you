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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->text('description')->nullable();

            $table->foreignId('event_type_id')
                ->constrained('event_types');

            $table->foreignId('sport_id')
                ->constrained('sports');

       

            $table->date('event_date');

            $table->time('event_time')->nullable();

            $table->string('location')->nullable();

            $table->string('status')->default('upcoming');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
