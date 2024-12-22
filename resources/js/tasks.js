const apiTasks = '/api/tasks';

document.addEventListener('DOMContentLoaded', function () {
    fetchTasks();
});
document.getElementById('close-task-popup-btn').addEventListener('click', function () {
    closePopup();
});
document.getElementById('new-task-btn').addEventListener('click', function () {
    openTaskPopup();
});
document.getElementById('task-form').addEventListener('submit', function (e) {
    saveTask(e);
});
document.getElementById('filter-form').addEventListener('submit', function (e) {
    filterTasks(e);
});

function filterTasks(e) {
    e.preventDefault();
    fetchTasks(e);
}

async function fetchTasks(e = null) {
    const tasksContainer = document.getElementById('tasks-container');
    const searchUrl = getSearchUrl(e);

    try {
        tasksContainer.classList.add('shaded');
        const response = await fetch(searchUrl, {
            headers: {
                'Authorization': 'Bearer ' + window.authToken,
                'Accept': 'application/json',
            }
        });

        if (!response.ok) {
            throw new Error('Error fetching tasks');
        }

        const tasks = await response.json();
        renderTasks(tasks);
    } catch (error) {
        console.error(error);
        alert('Failed to load tasks.');
    } finally {
        tasksContainer.classList.remove('shaded');
    }
}

function getSearchUrl(e) {
    if (e === null) {
        return apiTasks;
    }

    const form = e.target;
    const priority = form.querySelector('#priority').value;
    const status = form.querySelector('#status').value;
    const startDate = form.querySelector('#start_date').value;
    const endDate = form.querySelector('#end_date').value;

    const params = new URLSearchParams();
    if (priority) params.append('priority', priority);
    if (status) params.append('status', status);
    if (startDate) params.append('start_date', startDate);
    if (endDate) params.append('end_date', endDate);

    return `${apiTasks}?${params.toString()}`;
}

async function saveTask(e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    const form = e.target;
    const action = form.action;
    const method = form.querySelector('[name="_method"]') ? form.querySelector('[name="_method"]').value : 'POST';

    const taskData = {
        name: form.querySelector('#task-name').value,
        description: form.querySelector('#task-description').value,
        priority: form.querySelector('#task-priority').value,
        status: form.querySelector('#task-status').value,
        due_date: form.querySelector('#task-due-date').value
    };

    try {
        const response = await fetch(action, {
            method: method,
            headers: {
                'Authorization': 'Bearer ' + window.authToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(taskData)
        });

        if (!response.ok) {
            throw new Error('Failed saving task.');
        }

        alert('Saved task.');
        fetchTasks();
        closePopup();
    } catch (e) {
        console.error('Error: ', e);
        alert('Unable to save task.');
    }
}

async function deleteTask(id)
{
    try {
        const response = await fetch(`${apiTasks}/${id}`, {
            method: 'DELETE',
            headers: {
                'Authorization': 'Bearer ' + window.authToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('Failed saving task.');
        }

        alert('Deleted task.');
        fetchTasks();
    } catch (e) {
        console.error('Error: ' + e);
        alert('Unable to delete task.');
    }
}

function renderTasks(tasks) {
    const tasksList = document.getElementById('tasks-list');
    tasksList.innerHTML = '';

    if (tasks.length === 0) {
        tasksList.innerHTML = '<p class="text-gray-500">No tasks.</p>';
        return;
    }

    tasks.forEach(task => {
        const editButton = document.createElement('button');
        editButton.classList.add('px-4', 'py-2', 'bg-yellow-500', 'text-white', 'rounded', 'hover:bg-yellow-600');
        editButton.textContent = 'Edit';

        const deleteButton = document.createElement('button');
        deleteButton.classList.add('px-4', 'py-2', 'bg-red-600', 'text-white', 'rounded', 'hover:bg-red-700');
        deleteButton.textContent = 'Delete';

        editButton.onclick = function () {
            openTaskPopup(task);
        }
        deleteButton.onclick = function () {
            deleteTask(task.id);
        }

        const taskElement = document.createElement('div');
        taskElement.classList.add('p-4', 'bg-gray-100', 'rounded-lg', 'shadow');
        taskElement.innerHTML = `
            <h3 class="text-lg font-semibold text-gray-700">${task.name}</h3>
            <p class="text-sm text-gray-600">${task.description || 'No description'}</p>
            <p class="text-sm text-gray-500">Priority: ${task.priority}</p>
            <p class="text-sm text-gray-500">Status: ${task.status}</p>
            <p class="text-sm text-gray-500">Due date: ${task.due_date}</p>
            <div class="flex space-x-2 mt-4">
            </div>
        `;
        taskElement.querySelector('.flex').appendChild(editButton);
        taskElement.querySelector('.flex').appendChild(deleteButton);
        tasksList.appendChild(taskElement);
    });
}

function openTaskPopup(task = null) {
    const popup = document.getElementById('task-popup');
    const form = document.getElementById('task-form');
    const title = document.getElementById('task-popup-title');
    const nameField = document.getElementById('task-name');
    const descriptionField = document.getElementById('task-description');
    const priorityField = document.getElementById('task-priority');
    const statusField = document.getElementById('task-status');
    const dueDateField = document.getElementById('task-due-date');
    const methodField = document.getElementById('task-method');

    if (task) {
        title.textContent = 'Edit Task';
        form.action = `/api/tasks/${task.id}`;
        methodField.value = 'PUT';
        nameField.value = task.name;
        descriptionField.value = task.description;
        priorityField.value = task.priority;
        statusField.value = task.status;
        dueDateField.value = task.due_date;
    } else {
        title.textContent = 'Add Task';
        form.action = `/api/tasks`;
        methodField.value = 'POST';
        nameField.value = '';
        descriptionField.value = '';
        priorityField.value = 'low';
        statusField.value = 'to-do';
        dueDateField.value = '';
    }

    popup.classList.remove('hidden');
}

function closePopup() {
    const popup = document.getElementById('task-popup');
    popup.classList.add('hidden');
}
