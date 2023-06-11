<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function courses(Request $request)
    {
        $courses = Course::orderBy('id', 'DESC')->paginate();
        if ($request->get('s'))
        {
            $courses = Course::where('name', 'like', '%'.$request->s.'%')->orWhere('short_description', 'like', '%'.$request->s.'%')->orWhere('description', 'like', '%'.$request->s.'%')->paginate();
        }
        return view('users.courses', ['courses' => $courses]);
    }

    public function course($course_id)
    {
        $course = Course::find($course_id);
        return view('users.course', ['course' => $course]);
    }
}
