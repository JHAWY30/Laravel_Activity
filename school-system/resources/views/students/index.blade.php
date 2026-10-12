@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Students</h1>
        <p class="mt-1 text-sm text-slate-600">Manage student records and course enrollments.</p>
    </div>
    <a href="{{ route('students.create') }}" class="rounded bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
        Register Student
    </a>
</div>

<div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-left">
            <thead class="bg-slate-200 text-xs uppercase text-slate-700">
                <tr>
                    <th scope="col" class="p-4">Student Number</th>
                    <th scope="col" class="p-4">Name</th>
                    <th scope="col" class="p-4">Email</th>
                    <th scope="col" class="p-4">Courses</th>
                    <th scope="col" class="p-4">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y text-sm">
                @forelse ($students as $student)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 font-mono text-xs text-slate-600">{{ $student->student_number }}</td>
                        <td class="p-4 font-semibold text-slate-900">{{ $student->full_name }}</td>
                        <td class="p-4 text-slate-600">{{ $student->email }}</td>
                        <td class="p-4 text-slate-600">{{ $student->courses_count }}</td>
                        <td class="p-4">
                            <a href="{{ route('students.show', $student) }}" class="font-semibold text-blue-700 hover:text-blue-900">
                                View details
                            </a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="ml-3 inline"
                                  onsubmit="return confirm('Delete this student record? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-semibold text-red-700 hover:text-red-900">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-500">
                            No students are registered yet. Use “Register Student” to add the first record.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $students->links() }}
</div>
@endsection
