<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $classes = ClassModel::with(['students', 'teachers'])
            ->when($request->class_id, function ($query) use ($request) {
                return $query->where('id', $request->class_id);
            })
            ->get();

        $classOptions = ClassModel::select('id', 'class_name')->get();

        return Inertia::render('classes/Classes', [
            'classes' => $classes,
            'classOptions' => $classOptions,
            'filters' => $request->only(['class_id'])
        ]);
    }

    public function create()
    {
        return Inertia::render('classes/AddClass');
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:100',
        ]);

        ClassModel::create([
            'class_name' => $request->class_name
        ]);

        return redirect()->route('classes.index')->with('success', 'Class created successfully.');
    }

    public function edit($id)
    {
        $class = ClassModel::findOrFail($id);

        return Inertia::render('classes/EditClass', [
            'classData' => $class
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'class_name' => 'required|string|max:100',
        ]);

        $class = ClassModel::findOrFail($id);
        $class->update([
            'class_name' => $request->class_name
        ]);

        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

    public function destroy($id)
    {
        $class = ClassModel::findOrFail($id);
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Class deleted successfully.');
    }
}