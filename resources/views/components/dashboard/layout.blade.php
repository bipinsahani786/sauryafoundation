<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} | Shaurya Syndicate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; font-size: 0.875rem; }
        .sidebar-link-active { background-color: #4f46e5; color: white !important; }
        .table-standard th { background-color: #f8fafc; color: #64748b; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.025em; padding: 0.75rem 1.5rem; }
        .table-standard td { padding: 1rem 1.5rem; border-bottom: 1px solid #e2e8f0; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="text-slate-700 antialiased" x-data="{ sidebarOpen: false, openMenu: null }">
    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/50 lg:hidden"></div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 transform lg:translate-x-0 lg:static transition-transform duration-200 ease-in-out flex flex-col">
            
            <div class="p-6">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white shadow-sm">
                            <i class="fas fa-shield-alt text-sm"></i>
                        </div>
                        <span class="text-sm font-black tracking-widest text-slate-900 uppercase italic">Shaurya <span class="text-indigo-600">Syndicate</span></span>
                    </div>
                    <button @click="sidebarOpen = false" class="lg:hidden text-slate-400">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <nav class="space-y-1">
                    @php
                        $linkClasses = "flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all font-bold text-[10px] uppercase tracking-widest";
                        $activeClasses = "sidebar-link-active";
                        $inactiveClasses = "text-slate-500 hover:bg-slate-50 hover:text-indigo-600";
                    @endphp

                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
                        <a href="{{ route('admin.dashboard') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.dashboard') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-home w-4"></i> <span>Dashboard</span>
                        </a>

                        <div x-data="{ open: {{ request()->routeIs('admin.plans.*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" class="w-full {{ $linkClasses }} {{ $inactiveClasses }}">
                                <span class="flex items-center gap-3">
                                    <i class="fas fa-layer-group w-4"></i> <span>Plans</span>
                                </span>
                                <i class="fas fa-chevron-down text-[8px] transition-transform" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="open" x-cloak class="mt-1 ml-6 space-y-1 border-l border-slate-100">
                                <a href="{{ route('admin.plans.index') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('admin.plans.index') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">View All</a>
                                <a href="{{ route('admin.plans.create') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('admin.plans.create') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">Add New</a>
                            </div>
                        </div>

                        <a href="{{ route('admin.applications') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.applications') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-users w-4"></i> <span>User Leads</span>
                        </a>
                        
                        <a href="{{ route('admin.subscriptions') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.subscriptions') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-check-circle w-4"></i> <span>Payments</span>
                        </a>

                        <a href="{{ route('admin.users.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.users.*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-user-shield w-4"></i> <span>Users</span>
                        </a>

                        <a href="{{ route('admin.quizzes.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.quizzes.*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-file-invoice-dollar w-4"></i> <span>Verify Exams</span>
                        </a>
                    @elseif(Auth::user()->role === 'teacher')
                        <a href="{{ route('teacher.dashboard') }}" class="{{ $linkClasses }} {{ request()->routeIs('teacher.dashboard') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-th-large w-4"></i> <span>Dashboard</span>
                        </a>
                        <a href="{{ route('teacher.students') }}" class="{{ $linkClasses }} {{ request()->routeIs('teacher.students*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-user-graduate w-4"></i> <span>My Students</span>
                        </a>
                        <a href="{{ route('teacher.courses.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('teacher.courses*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-graduation-cap w-4"></i> <span>Academy</span>
                        </a>
                        <a href="{{ route('teacher.quizzes.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('teacher.quizzes*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-vial w-4"></i> <span>Exam Center</span>
                        </a>
                    @elseif(Auth::user()->role === 'student')
                        <a href="{{ route('student.dashboard') }}" class="{{ $linkClasses }} {{ request()->routeIs('student.dashboard') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-th-large w-4"></i> <span>Dashboard</span>
                        </a>
                        <a href="{{ route('student.courses') }}" class="{{ $linkClasses }} {{ request()->routeIs('student.courses*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-university w-4"></i> <span>My Academy</span>
                        </a>
                        <a href="{{ route('student.exams') }}" class="{{ $linkClasses }} {{ request()->routeIs('student.exams*', 'student.results*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-vial-circle-check w-4"></i> <span>Test Portal</span>
                        </a>
                    @else
                        <a href="{{ route('syndicate.dashboard') }}" class="{{ $linkClasses }} {{ request()->routeIs('syndicate.dashboard') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-chart-pie w-4"></i> <span>Dashboard</span>
                        </a>
                        <a href="{{ route('syndicate.plans') }}" class="{{ $linkClasses }} {{ request()->routeIs('syndicate.plans') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-plus-circle w-4"></i> <span>Join Plan</span>
                        </a>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="{{ $linkClasses }} {{ request()->routeIs('profile.edit') ? $activeClasses : $inactiveClasses }}">
                        <i class="fas fa-user-circle w-4"></i> <span>My Profile</span>
                    </a>
                </nav>
            </div>

            <div class="mt-auto p-6 border-t border-slate-100">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 font-black text-[10px] uppercase shadow-sm">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div class="min-w-0">
                        <p class="text-slate-900 font-black text-[10px] uppercase tracking-wider truncate">{{ Auth::user()->name }}</p>
                        <p class="text-slate-400 text-[8px] uppercase font-black tracking-[0.2em]">{{ Auth::user()->role }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 bg-slate-50">
            <!-- Top Header -->
            <header class="h-14 bg-white border-b border-slate-200 flex items-center justify-between px-6 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden text-slate-400">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">{{ $title ?? 'Dashboard' }}</h1>
                </div>
                <div class="text-[8px] font-black text-indigo-600 uppercase tracking-widest bg-indigo-50 px-4 py-1.5 rounded-full border border-indigo-100 lg:block hidden">Syndicate Active</div>
            </header>

            <div class="p-6 lg:p-10 max-w-7xl mx-auto w-full">
                <!-- Alerts -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-lg flex items-center gap-3 text-emerald-700 shadow-sm">
                        <i class="fas fa-check-circle text-emerald-500"></i>
                        <p class="text-xs font-bold">{{ session('success') }}</p>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-lg flex flex-col gap-2 text-red-700 shadow-sm">
                        @foreach($errors->all() as $error)
                            <p class="text-[10px] font-bold"><i class="fas fa-exclamation-triangle mr-1"></i> {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
