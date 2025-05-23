<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Slot;
use App\Models\Booking;
use App\Models\Voucher;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    /**
     * Seed the application's database with coaches, students,
     * slots, bookings and vouchers.
     */
    public function run(): void
    {
        // 1. Usuarios: 5 coaches y 30 estudiantes
        $coaches  = User::factory()->count(5)->coach()->create();
        $students = User::factory()->count(30)->student()->create();

        // 2. Slots para cada coach (10 cada uno)
        $slots = $coaches->flatMap(fn($coach) =>
            Slot::factory()
                ->count(10)
                ->for($coach, 'coach')
                ->create()
        );

        // 3. Bookings aleatorios por slot
        foreach ($slots as $slot) {
            $n = rand(0, $slot->capacity);
            if ($n === 0) continue;

            $groupId = (string) Str::uuid();

            $students->random($n)->each(fn($student) => Booking::factory()
                ->for($slot)               // relación slot()
                ->for($student, 'student') // relación student()
                ->state([
                    'group_id'   => $groupId,
                    'status'     => $slot->capacity === 1
                                    ? 'pending_payment'
                                    : 'pending_partner',
                    'expires_at' => now()->addDay(),
                ])
                ->create()
            );

            $slot->update(['spots_left' => $slot->capacity - $n]);
        }

        // 4. Vouchers para 5 estudiantes distintos
        Voucher::factory()
            ->count(5)
            ->state(fn() => ['user_id' => $students->random()->id])
            ->create();
    }
}
