<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'slot_id'            => Slot::factory(),
            'user_id'            => User::factory()->student(),
            'group_id'           => Str::uuid()->toString(),
            'status'             => 'pending_partner',
            'expires_at'         => now()->addDay(),
            'proof_message_id'   => null,
            'proof_url'          => null,
            'proof_received_at'  => null,
            'voucher_id'         => null,
        ];
    }
}
