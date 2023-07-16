<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'amount' => 'required'
        ]);

        $details = $request->except('_token', 'image');
        $path = $request->file('image')->store('public/uploads');
        $image = Storage::url($path);
        $details["image"] = $image;
        $details['day'] = date('Y-m-d');

        Task::create($details);
        return back()->with("success","Task added");
    }

    public function delete($task_id)
    {
        Task::destroy($task_id);
        return back()->with('success','task deleted');
    }
}
