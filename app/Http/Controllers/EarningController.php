<?php

namespace App\Http\Controllers;

use App\Models\Earning;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EarningController extends Controller
{
    public function earn(Request $request)
    {
        $task_id = $request->task_id;
        $user_id = auth()->id();
        $user = auth()->user();

        $task = Task::find($task_id);
        $today = date('Y-m-d');
        $check = Earning::where('user_id', $user_id)->where('task_id', $task_id)->where('day', $today)->exists();
        $total_earners = Earning::where('task_id', $task_id)->where('day', $today)->count();

        if ($check)
        {
            return back()->withErrors(['error' => 'You have already earned from this task']);
        }

        if ($task->day != $today)
        {
            return back()->withErrors(['error' => 'This task is expired']);
        }

        if ($task->user_limit && $total_earners >= $task->user_limit)
        {
            return back()->withErrors(['error' => 'The earning threshhold for this task is exceeded']);   
        }

        if ($task->social_media && !in_array($task->social_media, $user->approved_socials))
        {
            return back()->withErrors(['error' => 'You are not eligible for this task']);
        }

        Earning::create([
            'user_id' => $user_id,
            'task_id' => $task_id,
            'amount' => $task->amount,
            'type' => 'task_commission',
            'day' => $today
        ]);

        return back()->with('success', 'You successfully earned '.$task->amount.' points');
    }

    public function topEarners()
    {
        $earners = Earning::select('user_id', DB::raw('SUM(amount) as amt'))
        ->where('type', 'referral_commission')
        ->groupBy('user_id')
        ->orderBy('amt')
        ->limit(50)
        ->get();
        return view('users.top_earners', ['earners' => $earners]);
    }
}
