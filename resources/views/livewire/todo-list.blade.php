<div>
    @include('livewire.components.create-todo-box')
    @include('livewire.components.search-box')
    <div id="todos-list">
        @foreach ($todos as $todo)
            @include('livewire.components.todo-card')
        @endforeach
        <div class="my-2">
            {{ $todos->links() }}
        </div>
    </div>
</div>
