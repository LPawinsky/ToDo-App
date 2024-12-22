<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = User::findOrFail(Auth::id())->getTasksWithFilteredOptions(request()->query());
        return response()->json($tasks);
    }

    public function store(TaskRequest $request): Response
    {
        $data = $request->validated();
        $task = Task::create([Task::USER_ID => Auth::id(), ...$data]);
        $task->save();

        return response($task);
    }

    public function update(TaskRequest $request, int $id): Response
    {
        $data = $request->validated();
        $task = Task::findOrFail($id);
        $task->update($data);

        return response($task);
    }

    public function destroy(int $id): Response
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->noContent();
    }
}
