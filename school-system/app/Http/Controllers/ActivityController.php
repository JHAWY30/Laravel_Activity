<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('course')
            ->withCount('submissions')
            ->latest()
            ->paginate(10);

        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        $courses = Course::orderBy('code')->get();

        return view('activities.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'max_points' => ['required', 'integer', 'min:1'],
            'due_date' => ['required', 'date_format:Y-m-d\\TH:i'],
        ]);

        $activity = Activity::create($validated);

        return redirect()->route('activities.show', $activity)
            ->with('success', 'Activity created successfully.');
    }

    public function show(Activity $activity)
    {
        $activity->load(['course', 'submissions.student']);

        $submittedStudentIds = $activity->submissions->pluck('student_id');
        $pendingStudents = $activity->course->students()
            ->whereNotIn('students.id', $submittedStudentIds)
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view('activities.show', compact('activity', 'pendingStudents'));
    }

    public function submit(Request $request, Activity $activity)
    {
        $courseId = (int) $activity->getAttribute('course_id');
        $activityId = (int) $activity->getKey();

        $validated = $request->validate([
            'student_id' => [
                'required',
                'integer',
                Rule::exists('enrollments', 'student_id')
                    ->where('course_id', $courseId),
                Rule::unique('submissions', 'student_id')
                    ->where('activity_id', $activityId),
            ],
            'submission_text' => ['required', 'string'],
        ]);

        $activity->submissions()->create([
            'student_id' => $validated['student_id'],
            'submission_text' => $validated['submission_text'],
            'submitted_at' => now(),
        ]);

        return redirect()->route('activities.show', $activity)
            ->with('success', 'Work submitted successfully.');
    }
}
