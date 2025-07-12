<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('class')->get();

        return Inertia::render('students/Students', [
            'students' => $students
        ]);
    }

    public function create()
    {
        $classes = ClassModel::all();

        return Inertia::render('students/AddStudent', [
            'classes' => $classes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:students,email',
            'gender'   => 'required|in:male,female',
            'class_id' => 'required|exists:classes,id',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $classes = ClassModel::all();

        return Inertia::render('students/EditStudent', [
            'student' => $student,
            'classes' => $classes
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'gender'   => 'required|in:male,female',
            'email'    => 'required|email|unique:students,email,' . $id,
            'class_id' => 'required|exists:classes,id',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->back()->with('success', 'Student deleted successfully.');
    }
}