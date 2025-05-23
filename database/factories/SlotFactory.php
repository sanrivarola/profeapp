<?php

namespace Database\Factories;

use App\Models\Slot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SlotFactory extends Factory
{
    protected $model = Slot::class;

    public function definition(): array
    {
        $capacity  = $this->faker->randomElement([1, 2, 3, 4]);
        $startHour = $this->faker->numberBetween(7, 21);
        $startMin  = $this->faker->randomElement([0, 30]);

        return [
            'coach_id'   => User::factory()->coach(),
            'date'       => Carbon::today()->addDays($this->faker->numberBetween(0, 14)),
            'start_time' => sprintf('%02d:%02d', $startHour, $startMin),
            'capacity'   => $capacity,
            'spots_left' => $capacity,
            'category'   => $this->faker->randomElement(['Inicial','Intermedia','Avanzada']),
            'price'      => $this->faker->randomFloat(2, 800, 1800),
        ];
    }
}
