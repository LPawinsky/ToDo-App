<div id="task-popup" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50 hidden">
    <div class="bg-white rounded-lg p-8 max-w-lg w-full">
        <h2 id="task-popup-title" class="text-xl font-bold mb-4"></h2>
        <form id="task-form" method="POST" action="">
            @csrf
            <input type="hidden" name="_method" id="task-method" value="POST">
            <div class="mb-4">
                <label for="task-name" class="block text-sm font-medium text-gray-700">Task Name</label>
                <input type="text" id="task-name" name="name" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
            </div>
            <div class="mb-4">
                <label for="task-description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="task-description" name="description" class="mt-1 block w-full border border-gray-300 rounded-md p-2"></textarea>
            </div>
            <div class="mb-4">
                <label for="task-priority" class="block text-sm font-medium text-gray-700">Priority</label>
                <select id="task-priority" name="priority" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="task-status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="task-status" name="status" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    <option value="to-do">To Do</option>
                    <option value="in progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="task-due-date" class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="date" id="task-due-date" name="due_date" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
            </div>
            <div class="flex justify-end mt-4">
                <button id="close-task-popup-btn" type="button" class="px-4 py-2 bg-gray-400 text-white rounded-lg mr-2" onclick="closePopup()">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg" id="task-submit-btn">Save Task</button>
            </div>
        </form>
    </div>
</div>
