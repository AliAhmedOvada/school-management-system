<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {

        $students = Student::with('classes')->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {

        $all_users = User::where('id', auth()->id())->where('role_id', 2)->get();
        return view('students.create', compact('all_users'));
    }

    public function store(Request $request)
    {
        // Create a new class
        Student::create($request->all());

        // Redirect to the classes index page
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the student data
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
