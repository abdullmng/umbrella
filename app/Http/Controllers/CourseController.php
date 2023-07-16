<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function create(Request $request)
    {
        $request->validate([
            "name"=> 'required',
            "duration" => 'required',
            'amount' => 'required',
        ]);

        $details = $request->except('_token', 'image');
        $file = $request->file("image")->store('public/uploads');
        $image = Storage::url($file);
        $details['image'] = $image;

        Course::create($details);

        return back()->with("success","Course added successfully");
    }

    public function delete($course_id)
    {
        Course::where('id', $course_id)->delete();
        return back()->with("success", "Course deleted");
    }
}
