<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Lecture;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentLmsController extends Controller
{
    public function index()
    {

        $student_lms = Student::with('classes.lectures')
            ->where('user_id', auth()->user()->id)
            ->get();
        return view('studentlms', compact('student_lms'));
    }


    public function showLectures($class_id)
    {
        $lectures =  ClassModel::with('lectures')->find($class_id);
        return view('studentlmslecture', compact('lectures'));
    }
    public function lectureDetails($lecture_id)
    {
        $lectures =  Lecture::with('files')->where('id',$lecture_id)->get();
        return view('studentlmslecturedetails', compact('lectures'));
    }
}
