@extends('layouts.app')

@section('content')
<div id="tasks-container" class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Task List</h1>
    <form id="filter-form" class="space-y-4 mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div class="flex flex-col">
                <label for="priority" class="text-sm font-medium text-gray-700 mb-1">Priority:</label>
                <select name="priority" id="priority" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All</option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
            <div class="flex flex-col">
                <label for="status" class="text-sm font-medium text-gray-700 mb-1">Status:</label>
                <select name="status" id="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All</option>
                    <option value="to-do">To do</option>
                    <option value="in progress">In progress</option>
                    <option value="done">Done</option>
                </select>
            </div>
            <div class="flex flex-col">
                <label for="start_date" class="text-sm font-medium text-gray-700 mb-1">Start Date:</label>
                <input type="date" name="start_date" id="start_date" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="flex flex-col">
                <label for="end_date" class="text-sm font-medium text-gray-700 mb-1">End Date:</label>
                <input type="date" name="end_date" id="end_date" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>
        <div class="flex justify-center mt-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Filter
            </button>
        </div>
    </form>
    <div id="tasks-list" class="space-y-4">
    </div>
    <button id="new-task-btn" class="mt-6 px-6 py-3 inline-block bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
        Add New Task
    </button>
</div>

<script>
    window.authToken = @json(session('token'));
</script>

@include('tasks.task-popup')
@endsection

@push('scripts')
<script src="{{ asset('js/tasks.js') }}"></script>
@endpush
