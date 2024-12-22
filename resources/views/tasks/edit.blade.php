@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit task</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
            <input
                type="text"
                name="name"
                value="{{ $task->name }}"
                required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
            <textarea
                name="description"
                rows="4"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $task->description }}</textarea>
        </div>

        <div>
            <label for="priority" class="block text-sm font-medium text-gray-700">Priority:</label>
            <select
                name="priority"
                required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
            <select
                name="status"
                required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="to-do" {{ $task->status == 'to-do' ? 'selected' : '' }}>To do</option>
                <option value="in progress" {{ $task->status == 'in progress' ? 'selected' : '' }}>In progress</option>
                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>

        <div>
            <label for="due_date" class="block text-sm font-medium text-gray-700">Due date:</label>
            <input
                type="date"
                name="due_date"
                value="{{ $task->due_date }}"
                required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="flex justify-end">
            <button
                type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Save changes
            </button>
        </div>
    </form>
</div>
@endsection
