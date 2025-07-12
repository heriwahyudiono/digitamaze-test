<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('class')->get();

        return Inertia::render('teachers/Teachers', [
            'teachers' => $teachers
        ]);
    }

    public function create()
    {
        $classes = ClassModel::all();

        return Inertia::render('teachers/AddTeacher', [
            'classes' => $classes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:teachers,email',
            'gender'   => 'required|in:male,female',
            'class_id' => 'required|exists:classes,id',
        ]);

        Teacher::create($request->all());

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully.');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $classes = ClassModel::all();

        return Inertia::render('teachers/EditTeacher', [
            'teacher' => $teacher,
            'classes' => $classes
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:teachers,email,' . $id,
            'gender'   => 'required|in:male,female',
            'class_id' => 'required|exists:classes,id',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->back()->with('success', 'Teacher deleted successfully.');
    }
}