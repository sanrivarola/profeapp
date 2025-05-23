<?php

namespace App\Livewire\Student\Slots;

use Livewire\Component;
use App\Models\Slot;
use Illuminate\Support\Carbon;

class Browse extends Component
{
    public array $filters = [
        'date'     => null,
        'category' => null,
    ];

    public function mount(): void
    {
        $this->filters['date'] = Carbon::today()->toDateString();
    }

    public function updatedFilters(): void
    {
        // Se vuelve a renderizar automáticamente
    }

    public function book(int $slotId): void
    {
        $this->emit('slotSelected', $slotId);
    }

    public function render()
    {
        $slots = Slot::query()
            ->when($this->filters['date'], fn($q) => $q->whereDate('date', $this->filters['date']))
            ->when($this->filters['category'], fn($q) => $q->where('category', $this->filters['category']))
            ->where('spots_left', '>', 0)
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return view('livewire.student.slots.browse', compact('slots'));
    }
}
