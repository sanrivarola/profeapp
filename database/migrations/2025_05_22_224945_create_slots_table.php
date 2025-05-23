<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coach_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->date('date');
            $table->time('start_time');
            $table->unsignedTinyInteger('capacity')->default(1);
            $table->unsignedTinyInteger('spots_left')->default(1);
            $table->string('category')->nullable();
            $table->decimal('price', 8, 2);
            $table->timestamps();

            $table->unique(['coach_id', 'date', 'start_time']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
