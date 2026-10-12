@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-xl rounded-lg bg-white p-6 shadow">
    <h1 class="mb-4 text-xl font-bold text-slate-900">Create Course</h1>

    @if ($errors->any())
        <div class="mb-4 rounded border-l-4 border-red-500 bg-red-100 p-3 text-sm text-red-700" role="alert">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="code" class="mb-1 block text-sm font-medium">Course Code</label>
            <input id="code" type="text" name="code" value="{{ old('code') }}" required maxlength="255" class="w-full rounded border p-2 text-sm focus:ring focus:ring-blue-200">
        </div>

        <div class="mb-4">
            <label for="title" class="mb-1 block text-sm font-medium">Course Title</label>
            <input id="title" type="text" name="title" value="{{ old('title') }}" required maxlength="255" class="w-full rounded border p-2 text-sm focus:ring focus:ring-blue-200">
        </div>

        <div class="mb-6">
            <label for="credits" class="mb-1 block text-sm font-medium">Credits</label>
            <input id="credits" type="number" name="credits" value="{{ old('credits') }}" required min="1" class="w-full rounded border p-2 text-sm focus:ring focus:ring-blue-200">
        </div>

        <button type="submit" class="w-full rounded bg-blue-600 py-2 text-sm font-bold text-white hover:bg-blue-700">
            Save Course
        </button>
    </form>
</div>
@endsection
