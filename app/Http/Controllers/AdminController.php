<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Earning;
use App\Models\Task;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->remember))
        {
            return redirect(route('admin.dashboard'));
        }
        return back()->withErrors(['error' => 'Incorrect Login']);
    }

    public function dashboard()
    {
        $stat = [
            'users' => User::count(),
            'vendors' => User::where('role', 'vendor')->count(),
            'courses' => Course::count(),
            'coupons' => Coupon::count(),
        ];
        return view('admin.dashboard', ['stat' => $stat]);
    }

    public function charts()
    {
        $courses = Course::all();
        $total_revenue = 0;
        foreach ($courses as $course)
        {
            $total_revenue += $course->total_sales;
        }
        $coupons_used = Coupon::where('status', 'used')->count();
        $coupons_unused = Coupon::where('status', 'unused')->count();
        $total_purchases = UserCourse::count();

        return response([
            'courses' => $courses,
            'coupons' => ['unused' => $coupons_unused, 'used' => $coupons_used,
            ],
            'total_revenue' => $total_revenue,
            'total_purchases' => $total_purchases,
        ], 200);
    }

    public function users()
    {
        $users = User::all();
        return view("admin.users", ["users"=> $users]);
    }

    public function user($user_id)
    {
        $user = User::find($user_id);
        $user_courses = UserCourse::where('user_id', $user_id)->get();
        $courses = Course::all();
        $roles = [
            'regular_user',
            'vendor',
            'user-admin'
        ];
        return view('admin.user', ["user"=> $user, 'user_courses' => $user_courses, 'courses' => $courses, 'roles' => $roles]);
    }

    public function activateUser($user_id, Request $request)
    {
        $request->validate([
            'course_id' => 'required'
        ]);

        if (UserCourse::where('user_id', $user_id)->where('course_id', $request->course_id)->where('status', 'active')->exists())
        {
            return back()->withErrors(['course_id' => 'this course is already active']);
        }

        UserCourse::updateOrCreate(['user_id' => $user_id,'course_id' => $request->course_id], [
            'user_id' => $user_id,
            'course_id' => $request->course_id,
            'status' => "active",
            'date_activated' => date('Y-m-d'),
            'date_finished' => null
        ]);

        return back()->with('success', 'Course activated!');
    }

    public function setRole($user_id, Request $request)
    {
        User::where('id', $user_id)->update(['role' => $request->role]);
        return back()->with('role', 'User role has been changed to '. $request->role);
    }

    public function postEarning($user_id, Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'type' => 'required',
        ]);

        Earning::create([
            'user_id' => $user_id,
            'amount' => $request->amount,
            'type' => $request->type,
            'day' => date("Y-m-d"),
        ]);

        return back()->with("earn", "Earning posted");
    }

    public function coupons()
    {
        $coupons = Coupon::all();
        $vendors = User::where('role', 'vendor')->get();
        return view('admin.coupons', ['coupons' => $coupons, 'vendors' => $vendors]);
    }

    public function logout(Request $request){
        Auth::guard("admin")->logout();
        return redirect(route('admin.login'));
    }

    public function courses()
    {
        $courses = Course::orderBy('id', 'desc')->get();
        return view('admin.courses', ['courses' => $courses]);
    }

    public function tasks()
    {
        $tasks = Task::orderBy("id","desc")->get();
        $socials = app('socials');
        return view('admin.tasks', ['tasks' => $tasks, 'socials' => $socials]);
    }

    public function config()
    {
        $configs = Config::all();
        return view('admin.config', ['configs' => $configs]);
    }
}
