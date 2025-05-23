<?php

namespace Database\Factories;

use App\Models\Voucher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VoucherFactory extends Factory
{
    protected $model = Voucher::class;

    public function definition(): array
    {
        return [
            'user_id'    => User::factory()->student(),
            'code'       => 'BONO50-'.Str::upper(Str::random(6)),
            'percent'    => 50,
            'expires_at' => now()->addWeeks(2),
            'used_at'    => null,
        ];
    }
}
