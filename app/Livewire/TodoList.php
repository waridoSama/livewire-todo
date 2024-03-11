<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;
    #[Rule('required|unique:todos')]
    public $name;
    #[Rule('')]
    public $search;

    public function create()
    {
        $validated = $this->validateOnly('name');
        Todo::create($validated);
        $this->reset('name');
        session()->flash('success', 'task created');
    }

    public function delete($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        session()->flash('deleted', 'Deleted successfully!');
        $this->redirect('/');
    }
    public function checked($id)
    {
        $todo=Todo::findOrFail($id);
        $todo->completed = !$todo->completed;
        $todo->save();
    }
    public function render()
    {
        return view('livewire.todo-list', ['todos' => Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(2)]);
    }
}
