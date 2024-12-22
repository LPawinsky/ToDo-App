@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add new task</h1>

    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
            <input type="text" id="name" name="name" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
            <textarea id="description" name="description" rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>
        <div>
            <label for="priority" class="block text-sm font-medium text-gray-700">Priority:</label>
            <select id="priority" name="priority" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
            <select id="status" name="status" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="to-do">To do</option>
                <option value="in progress">In progress</option>
                <option value="done">Done</option>
            </select>
        </div>
        <div>
            <label for="due_date" class="block text-sm font-medium text-gray-700">Due date:</label>
            <input type="date" id="due_date" name="due_date" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <button type="submit"
                class="w-full px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Create task
            </button>
        </div>
    </form>
</div>
@endsection
