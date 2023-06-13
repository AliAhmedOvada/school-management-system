<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\Lecture;
use Illuminate\Http\Request;

class ClassController extends Controller
{

    public function index()
    {

        $classes = ClassModel::with('students')->get();
        $lectures = Lecture::get();
        foreach ($classes as $class) {
            $user = User::find($class->user_id);
            $class->user = $user;
        }
        return view('classes.index', compact('classes', 'lectures'));
    }
    public function create()
    {
        $all_users = Student::get();
        return view('classes.create', compact('all_users'));
    }

    public function store(Request $request)
    {

        // Create a new class
        $class = new ClassModel();
        $class->class_name = $request->class_name;
        $class->user_id = auth()->user()->id;
        $class->save();

        $userIds = $request->input('student_ids');
        $syncData = [];
        foreach ($userIds as $userId) {
            $syncData[$userId] = ['created_at' => now(), 'updated_at' => now()];
        }
        $class->students()->sync($syncData);

        return redirect()->route('classes.index')->with('success', 'Class created successfully.');
    }

    public function show(ClassModel $class)
    {
        $lectureIds = $class->lectures->pluck('lecture_name')->toArray();
        $students = $class->students;
        return view('classes.show', compact('students', 'class', 'lectureIds'));
    }


    public function edit($id)
    {
        $class = ClassModel::findOrFail($id);
        $username = User::where('id', $class->user_id)->get();
        return view('classes.edit', compact('class', 'username'));
    }

    public function update(Request $request, $id)
    {
        // Find the class by ID
        $class = ClassModel::findOrFail($id);

        // Validate the input
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            // Add more validation rules if needed
        ]);

        // Update the class
        $class->update($request->all());

        // Redirect to the classes index page
        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

    public function destroy($id)
    {
        // Find the class by ID
        $class = ClassModel::findOrFail($id);

        // Delete the pivot records
        $class->students()->detach();

        // Delete the class
        $class->delete();

        // Redirect to the classes index page
        return redirect()->route('classes.index')->with('success', 'Class deleted successfully.');
    }

    public function updateClassModelLecture(Request $request)
    {
        $lectureIds = $request->input('lectureIds');
        $classId = $request->input('classId');
        $classModel = ClassModel::find($classId);
        if ($classModel) {
            $classModel->lectures()->sync($lectureIds);
        }
        return response()->json(['success' => true]);
    }
}
