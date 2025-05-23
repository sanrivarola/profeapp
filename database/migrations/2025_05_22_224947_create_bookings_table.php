<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slot_id')
                  ->constrained('slots')
                  ->cascadeOnDelete();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->uuid('group_id')->index();
            $table->string('status')->default('pending_partner');
            $table->timestamp('expires_at')->nullable();
            $table->string('proof_message_id')->nullable();
            $table->string('proof_url')->nullable();
            $table->timestamp('proof_received_at')->nullable();
            $table->foreignId('voucher_id')
                  ->nullable()
                  ->constrained('vouchers')
                  ->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};