<?php

namespace App\Http\Controllers;

use App\Http\Models\Course;
use App\Http\Models\Treatment;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function courses(){
        $courses = Course::orderBy('prescription', 'asc')->paginate(15);
        return view('courses', ['courses' => $courses]);
    }

    public function addCourse(){
        return view('addCourse');
    }

    public function saveCourse(Request $request){
        $request->validate(['prescription' => 'required', 'term' => 'required'],
                            ['prescription.required' => 'Призначення обов\'язкове до заповнення!',
                            'term.required' => 'Термін обов\'язковий!']);

        $course = new Course;

        $course->prescription = $request->prescription;
        $course->term = $request->term;
        $course->save();

        return redirect()->route('courses');
    }
}
