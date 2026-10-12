<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::withCount('courses')->latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_number' => 'required|string|unique:students,student_number',
            'first_name'     => 'required|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email|unique:students,email',
            'date_of_birth'  => 'required|date',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
                         ->with('success', 'Student registered successfully.');
    }

    public function show(Student $student)
    {
        $student->load('courses');
        $availableCourses = Course::whereNotIn('id', $student->courses->pluck('id'))->get();

        return view('students.show', compact('student', 'availableCourses'));
    }

    public function enroll(Request $request, Student $student)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $student->courses()->attach($validated['course_id'], [
            'enrolled_at' => now(),
        ]);

        return redirect()->route('students.show', $student->id)
                         ->with('success', 'Course enrolled successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
                         ->with('success', 'Student record deleted.');
    }
}

