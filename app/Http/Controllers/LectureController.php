<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lecture;
use App\Models\Student;
use App\Models\Subject;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function index()
    {
        $lectures = Lecture::with('files', 'classModel','classes')->get();
        return view('lectures.index', compact('lectures'));
    }

    public function create()
    {
        $all_classes = ClassModel::all();
        return view('lectures.create', compact('all_classes'));
    }

    public function store(Request $request)
    {
        $files = $request->file('file');
        if ($files) {
            // Create lecture
            $lecture = Lecture::create([
                'class_id' => $request->input('class_id'),
                'lecture_name' => $request->input('lecture_name'),
            ]);

            foreach ($files as $file) {
                // Handle each uploaded file
                if ($file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('lectures', $fileName, 'public');

                    // Create file entry
                    $lecture->files()->create([
                        'file_name' => $fileName,
                        'lecture_id' => $lecture->id,
                    ]);
                }
            }
        }

        return redirect()->route('lectures.index')->with('success', 'Lecture created successfully.');
    }


    public function edit($id)
    {
        $lecture = Lecture::findOrFail($id);
        if ($lecture) {
            $lecture->room_number = $lecture->room_number;
        }

        $all_students = Student::all();
        $all_subjects = Subject::all();
        $all_classes = ClassModel::all();
        return view('lectures.edit', compact('lecture', 'all_students', 'all_subjects', 'all_classes'));
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'start_time' => 'required',
        //     'end_time' => 'required',
        //     'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        // ]);

        // $lecture = Lecture::findOrFail($id);

        // // Handle file upload if a new file is provided
        // if ($request->hasFile('file')) {
        //     $file = $request->file('file');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $file->storeAs('public/lectures', $fileName);
        //     $lecture->file = $fileName; // Assign the new uploaded file name
        // }

        // $lecture->title = $request->input('title');
        // $lecture->description = $request->input('description');
        // $lecture->start_time = $request->input('start_time');
        // $lecture->end_time = $request->input('end_time');
        // $lecture->save();

        // return redirect()->route('lectures.index')->with('success', 'Lecture updated successfully.');
    }

    public function destroy($id)
    {
        $lecture = Lecture::findOrFail($id);
        $lecture->delete();

        return redirect()->route('lectures.index')->with('success', 'Lecture deleted successfully.');
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }
}
