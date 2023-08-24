<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Counter extends Component
{
    public int $count;

    public function mount(): void
    {
        $this->count = auth()->user()->count;
    }
    public function increment(): void
    {
        $this->count++;
        auth()->user()->count= $this->count;
        auth()->user()->save();
    }

    public function decrement(): void
    {
        $this->count--;
        auth()->user()->count= $this->count;
        auth()->user()->save();
    }
    public function render(): View|Application|Factory
    {
        return view('livewire.counter');
    }
}
