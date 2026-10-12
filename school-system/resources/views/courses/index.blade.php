@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Courses</h1>
        <p class="mt-1 text-sm text-slate-600">Manage courses and see student enrollments.</p>
    </div>
    <a href="{{ route('courses.create') }}" class="rounded bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
        Create Course
    </a>
</div>

<div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-left">
            <thead class="bg-slate-200 text-xs uppercase text-slate-700">
                <tr>
                    <th scope="col" class="p-4">Course Code</th>
                    <th scope="col" class="p-4">Title</th>
                    <th scope="col" class="p-4">Credits</th>
                    <th scope="col" class="p-4">Students</th>
                    <th scope="col" class="p-4">Activities</th>
                </tr>
            </thead>
            <tbody class="divide-y text-sm">
                @forelse ($courses as $course)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 font-mono text-xs font-semibold text-slate-700">{{ $course->code }}</td>
                        <td class="p-4 font-semibold text-slate-900">{{ $course->title }}</td>
                        <td class="p-4 text-slate-600">{{ $course->credits }}</td>
                        <td class="p-4 text-slate-600">{{ $course->students_count }}</td>
                        <td class="p-4 text-slate-600">{{ $course->activities_count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-500">
                            No courses have been created yet. Create a course to begin enrolling students and adding activities.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $courses->links() }}
</div>
@endsection
