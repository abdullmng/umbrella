<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function tasks()
    {
        $tasks = Task::orderBy('id', 'DESC')->paginate();
        return view('users.tasks', ['tasks' => $tasks]);
    }

    public function task($task_id)
    {
        $task = Task::find($task_id);
        return view('users.task', ['task' => $task]);
    }
}
