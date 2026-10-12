<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Academic SMS | School Management System')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .nav-link {
            transition: all 0.25s ease;
        }

        .nav-link:hover {
            transform: translateY(-2px);
        }

        .page-background {
            background:
                radial-gradient(circle at top left, #dbeafe 0, transparent 35%),
                radial-gradient(circle at bottom right, #e0e7ff 0, transparent 35%),
                #f8fafc;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
    </style>
</head>
<body class="page-background min-h-screen text-slate-800 antialiased">
    <nav class="bg-gradient-to-r from-slate-950 via-blue-950 to-indigo-950 text-white shadow-xl">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="flex min-h-20 flex-wrap items-center justify-between gap-4 py-4">
                <a href="{{ route('students.index') }}" class="group flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-400 to-indigo-500 shadow-lg shadow-blue-500/30 transition-transform group-hover:rotate-6">
                        <span class="text-2xl" aria-hidden="true">🎓</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-extrabold tracking-tight">
                            Academic<span class="text-blue-400">SMS</span>
                        </h1>
                        <p class="text-xs uppercase tracking-widest text-slate-400">
                            School Management System
                        </p>
                    </div>
                </a>

                <div class="flex flex-wrap items-center gap-2 text-sm font-semibold">
                    <a href="{{ route('students.index') }}"
                       @class([
                           'nav-link rounded-xl px-4 py-2.5',
                           'bg-white/15 text-blue-300 ring-1 ring-white/10' => request()->routeIs('students.*'),
                           'text-slate-300 hover:bg-white/10 hover:text-white' => ! request()->routeIs('students.*'),
                       ])>
                        <span class="mr-1" aria-hidden="true">👨‍🎓</span> Students
                    </a>
                    <a href="{{ route('courses.index') }}"
                       @class([
                           'nav-link rounded-xl px-4 py-2.5',
                           'bg-white/15 text-blue-300 ring-1 ring-white/10' => request()->routeIs('courses.*'),
                           'text-slate-300 hover:bg-white/10 hover:text-white' => ! request()->routeIs('courses.*'),
                       ])>
                        <span class="mr-1" aria-hidden="true">📚</span> Courses
                    </a>
                    <a href="{{ route('activities.index') }}"
                       @class([
                           'nav-link rounded-xl px-4 py-2.5',
                           'bg-white/15 text-blue-300 ring-1 ring-white/10' => request()->routeIs('activities.*'),
                           'text-slate-300 hover:bg-white/10 hover:text-white' => ! request()->routeIs('activities.*'),
                       ])>
                        <span class="mr-1" aria-hidden="true">📅</span> Activities
                    </a>
                    <a href="{{ route('students.create') }}"
                       class="nav-link ml-1 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-500 px-4 py-2.5 text-white shadow-lg shadow-blue-900/30 hover:from-blue-600 hover:to-indigo-600">
                        <span class="text-lg leading-none" aria-hidden="true">+</span>
                        Register Student
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-7xl px-5 py-8 lg:px-8">
        @if (session('success'))
            <div class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 shadow-sm" role="status">
                <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-emerald-100">
                    <span class="text-lg" aria-hidden="true">✓</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold">Success!</p>
                    <p class="mt-1 text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="glass-card rounded-3xl p-5 shadow-sm md:p-8">
            @yield('content')
        </div>
    </main>

    <footer class="mx-auto max-w-7xl px-5 pb-8 lg:px-8">
        <div class="flex flex-col items-center justify-between gap-3 border-t border-slate-200 pt-5 text-sm text-slate-500 sm:flex-row">
            <p>
                © {{ date('Y') }}
                <span class="font-bold text-slate-700">Academic SMS</span>.
                All rights reserved.
            </p>
            <p class="flex items-center gap-2">
                <span>Made with</span>
                <span class="text-red-500" aria-label="love">♥</span>
                <span>for better education</span>
            </p>
        </div>
    </footer>
</body>
</html>
