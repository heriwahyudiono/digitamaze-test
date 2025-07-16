<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Kelas;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'students' => Student::with('class')->get(),
            'teachers' => Teacher::with('class')->get(),
            'classes'  => Kelas::with(['students', 'teachers'])->get(),
            'totalStudents' => Student::count(),
            'totalTeachers' => Teacher::count(),
            'totalClasses'  => Kelas::count(),
        ]);
    }
}