<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth')->only([
            'showCourseList',
            'showCourseCreateForm',
            'storeCourse',
            'getCourseListByUniversityDeparmentSemester',
            'manageCourses'
        ]);
    }

    public function manageCourses(){
        return view('user_dashboard.manage_courses');
    }

    public function showCourseCreateForm(){
        return view('course.create');
    }


    public function storeCourse(Request $request){

        $this->validate($request, [
            'department_id' => 'required|integer',
            'semester_no' => 'required|integer',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20',
            'credit' => 'required|integer'
        ]);

        $course = new Course;
        $course->department_id = $request->department_id;
        $course->semester_no = $request->semester_no;
        $course->name = $request->name;
        $course->code = $request->code;
        $course->credit = $request->credit;

        $course->save();

        flash('Course successfully added!')->success();

        return redirect()->route('course.create');

    }

    public function showCourseList(){

        return view('course.view');
    }

    public function getCourseListByUniversityDeparmentSemester(Request $request)
    {
        $course = Course::where('semester_no', $request->semester_no)->get();

        $theads = array('Course Name', 'Course Code', 'Course Credit');

        $properties = array('name', 'code', 'credit');

        return view('partials._table',['theads' => $theads, 'properties' => $properties, 'tds' => $course]);

    }
}
