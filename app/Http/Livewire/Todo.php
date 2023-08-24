<?php

namespace App\Http\Livewire;

use App\Models\Todo as TodoModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Todo extends Component
{
    public string $title;

    public function render(): View|Application|Factory
    {
        return view('livewire.todo', [
            'todos' => auth()->user()->todos
        ]);
    }

    public function addTodo(): void
    {
        $this->validate([
            'title' => 'required',
        ]);

        TodoModel::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'completed' => false,
        ]);

        $this->title = '';
    }

    public function deleteTodo($id): void
    {
        TodoModel::find($id)->delete();
    }

    public function toggleTodo($id): void
    {
        $todo = TodoModel::find($id);

        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function updateTodo($id, $title): void
    {
        $todo = TodoModel::find($id);
        $todo->title = $title;
        $todo->save();
    }
}
