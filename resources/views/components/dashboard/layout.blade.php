<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} | {{ $siteSettings['site_name'] ?? 'Shaurya Narayan Foundation' }}</title>
    @if(isset($siteSettings['site_favicon']))
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $siteSettings['site_favicon']) }}">
    @endif
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
        .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #4f46e5; }
    </style>
</head>
<body class="text-slate-700 antialiased flex flex-col h-screen overflow-hidden" x-data="{ sidebarOpen: false, openMenu: null }">
    @if(session()->has('impersonate_id'))
        <div class="bg-indigo-600 text-white py-2 px-4 flex items-center justify-between shrink-0 z-[100] shadow-lg">
            <div class="flex items-center gap-3">
                <i class="fas fa-user-secret text-sm"></i>
                <span class="text-[10px] font-black uppercase tracking-widest leading-none">Viewing mode: <span class="underline">{{ Auth::user()->name }}</span> ({{ Auth::user()->role }})</span>
            </div>
            <a href="{{ route('admin.users.stop-impersonating') }}" class="bg-white text-indigo-600 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-tighter hover:bg-slate-100 transition-all">
                Stop Viewing
            </a>
        </div>
    @endif
    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/50 lg:hidden"></div>

    <div class="flex flex-1 overflow-hidden bg-slate-50">
        <!-- Sidebar -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 transform lg:translate-x-0 lg:static transition-transform duration-200 ease-in-out flex flex-col overflow-y-auto custom-scrollbar">
            
            <div class="p-6">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-2">
                        @if(isset($siteSettings['site_logo']))
                            <img src="{{ asset('storage/' . $siteSettings['site_logo']) }}" alt="Logo" class="h-8 object-contain">
                        @else
                            <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white shadow-sm">
                                <i class="fas fa-shield-alt text-sm"></i>
                            </div>
                        @endif
                        <span class="text-[10px] font-black tracking-widest text-slate-900 uppercase italic leading-tight">{{ $siteSettings['site_name'] ?? 'Shaurya Narayan' }}</span>
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

                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.dashboard') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-home w-4"></i> <span>Dashboard</span>
                        </a>

                        @if(Auth::user()->hasPermission('view_plans'))
                        <div x-data="{ open: {{ request()->routeIs('admin.plans.*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" class="w-full {{ $linkClasses }} {{ $inactiveClasses }}">
                                <span class="flex items-center gap-3">
                                    <i class="fas fa-layer-group w-4"></i> <span>Plans</span>
                                </span>
                                <i class="fas fa-chevron-down text-[8px] transition-transform" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="open" x-cloak class="mt-1 ml-6 space-y-1 border-l border-slate-100">
                                <a href="{{ route('admin.plans.index') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('admin.plans.index') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">View All</a>
                                @if(Auth::user()->hasPermission('create_plans'))
                                <a href="{{ route('admin.plans.create') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('admin.plans.create') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">Add New</a>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if(Auth::user()->hasPermission('view_banners'))
                        <div x-data="{ open: {{ request()->routeIs('admin.banners.*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" class="w-full {{ $linkClasses }} {{ $inactiveClasses }}">
                                <span class="flex items-center gap-3">
                                    <i class="fas fa-images w-4"></i> <span>Home Banners</span>
                                </span>
                                <i class="fas fa-chevron-down text-[8px] transition-transform" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="open" x-cloak class="mt-1 ml-6 space-y-1 border-l border-slate-100">
                                <a href="{{ route('admin.banners.index') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('admin.banners.index') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">View All</a>
                                @if(Auth::user()->hasPermission('create_banners'))
                                <a href="{{ route('admin.banners.create') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('admin.banners.create') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">Add New</a>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if(Auth::user()->hasPermission('view_sectors'))
                        <div x-data="{ open: {{ request()->routeIs('admin.home-sectors.*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" class="w-full {{ $linkClasses }} {{ $inactiveClasses }}">
                                <span class="flex items-center gap-3">
                                    <i class="fas fa-briefcase w-4"></i> <span>Home Sectors</span>
                                </span>
                                <i class="fas fa-chevron-down text-[8px] transition-transform" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="open" x-cloak class="mt-1 ml-6 space-y-1 border-l border-slate-100">
                                <a href="{{ route('admin.home-sectors.index') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('admin.home-sectors.index') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">View All</a>
                                @if(Auth::user()->hasPermission('create_sectors'))
                                <a href="{{ route('admin.home-sectors.create') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('admin.home-sectors.create') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">Add New</a>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if(Auth::user()->hasPermission('view_testimonials') || Auth::user()->hasPermission('view_industry_experts'))
                        <div x-data="{ open: {{ request()->is('admin/testimonials*') || request()->is('admin/industry-experts*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" class="w-full {{ $linkClasses }} {{ $inactiveClasses }}">
                                <span class="flex items-center gap-3">
                                    <i class="fas fa-quote-right w-4"></i> <span>Dynamic Content</span>
                                </span>
                                <i class="fas fa-chevron-down text-[8px] transition-transform" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="open" x-cloak class="mt-1 ml-6 space-y-1 border-l border-slate-100">
                                @if(Auth::user()->hasPermission('view_testimonials'))
                                <a href="{{ route('admin.testimonials.index') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('admin.testimonials.*') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">Testimonials</a>
                                @endif
                                @if(Auth::user()->hasPermission('view_industry_experts'))
                                <a href="{{ route('admin.industry-experts.index') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('admin.industry-experts.*') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">Industry Experts</a>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if(Auth::user()->hasPermission('view_applications'))
                        <a href="{{ route('admin.applications') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.applications') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-users w-4"></i> <span>User Leads</span>
                        </a>
                        @endif
                        
                        @if(Auth::user()->hasPermission('view_subscriptions'))
                        <a href="{{ route('admin.subscriptions') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.subscriptions') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-check-circle w-4"></i> <span>Payments</span>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('view_payouts'))
                        <a href="{{ route('admin.payouts.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.payouts.*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-hand-holding-usd w-4"></i> <span>Payouts & KYC</span>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('view_wallet'))
                        <div x-data="{ open: {{ request()->routeIs('admin.wallet.*') || request()->routeIs('admin.wallet.topups.*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" class="w-full {{ $linkClasses }} {{ $inactiveClasses }}">
                                <span class="flex items-center gap-3">
                                    <i class="fas fa-wallet w-4"></i> <span>Wallet & Topups</span>
                                </span>
                                <i class="fas fa-chevron-down text-[8px] transition-transform" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="open" x-cloak class="mt-1 ml-6 space-y-1 border-l border-slate-100">
                                <a href="{{ route('admin.wallet.index') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('admin.wallet.index') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">Manual Adjust</a>
                                @if(Auth::user()->hasPermission('view_topup_requests'))
                                <a href="{{ route('admin.wallet.topups.index') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('admin.wallet.topups.*') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">Top-up Requests</a>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if(Auth::user()->hasPermission('view_finance'))
                        <a href="{{ route('admin.finance.ledger') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.finance.ledger') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-file-invoice-dollar w-4"></i> <span>Financial Ledger</span>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('view_audit_logs'))
                        <a href="{{ route('admin.activity-logs.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.activity-logs.*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-fingerprint w-4"></i> <span>Activity Logs</span>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('view_users'))
                        <a href="{{ route('admin.users.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.users.*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-user-shield w-4"></i> <span>Users</span>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('view_exams'))
                        <a href="{{ route('admin.quiz-approvals') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.quiz-approvals') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-file-invoice-dollar w-4"></i> <span>Verify Exams</span>
                        </a>
                        
                        <a href="{{ route('admin.quizzes.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.quizzes.*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-vial w-4"></i> <span>Manage Exams</span>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('view_classes'))
                        <a href="{{ route('admin.student-classes.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.student-classes.*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-school w-4"></i> <span>Academic Classes</span>
                        </a>

                        <a href="{{ route('admin.courses.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.courses.*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-graduation-cap w-4"></i> <span>Academy (LMS)</span>
                        </a>
                        <a href="{{ route('admin.study-materials.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.study-materials.*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-book w-4"></i> <span>Global Notes</span>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('view_settings'))
                        <a href="{{ route('admin.settings.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.settings.*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-cog w-4 font-black"></i> <span class="font-black italic">Site Settings</span>
                        </a>
                        @endif

                        <a href="{{ route('admin.docs') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.docs') ? $activeClasses : $inactiveClasses }} mt-6 border-t border-slate-100 pt-6">
                            <i class="fas fa-book-reader w-4 text-indigo-600"></i> <span class="text-indigo-600">Project Docs (Tutorial)</span>
                        </a>
                    @elseif(Auth::user()->role === 'teacher')
                        <a href="{{ route('teacher.dashboard') }}" class="{{ $linkClasses }} {{ request()->routeIs('teacher.dashboard') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-th-large w-4"></i> <span>Dashboard</span>
                        </a>
                        <div x-data="{ open: {{ request()->routeIs('teacher.students*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" class="w-full {{ $linkClasses }} {{ request()->routeIs('teacher.students*') ? 'text-indigo-600 bg-indigo-50' : $inactiveClasses }}">
                                <span class="flex items-center gap-3">
                                    <i class="fas fa-user-graduate w-4"></i> <span>My Students</span>
                                </span>
                                <i class="fas fa-chevron-down text-[8px] transition-transform" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="open" x-cloak class="mt-1 ml-6 space-y-1 border-l border-slate-100">
                                <a href="{{ route('teacher.students') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('teacher.students') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}" id="sidebar_link_teacher_students_all">View All</a>
                                <a href="{{ route('teacher.students.create') }}" class="block px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ request()->routeIs('teacher.students.create') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}" id="sidebar_link_teacher_students_add">Quick Admission</a>
                            </div>
                        </div>
                        <a href="{{ route('teacher.courses.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('teacher.courses*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-graduation-cap w-4"></i> <span>Academy</span>
                        </a>
                        <a href="{{ route('teacher.quizzes.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('teacher.quizzes*') ? $activeClasses : $inactiveClasses }}" id="sidebar_link_teacher_exams">
                            <i class="fas fa-vial w-4"></i> <span>Exam Center</span>
                        </a>
                        <a href="{{ route('teacher.study-materials.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('teacher.study-materials.*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-book w-4"></i> <span>My Study Notes</span>
                        </a>
                        <a href="{{ route('teacher.wallet') }}" class="{{ $linkClasses }} {{ request()->routeIs('teacher.wallet*') ? $activeClasses : $inactiveClasses }}" id="sidebar_wallet_link_teacher">
                            <i class="fas fa-wallet w-4"></i> <span>My Wallet</span>
                        </a>
                    @elseif(Auth::user()->role === 'sales_agent')
                        <a href="{{ route('sales-agent.dashboard') }}" class="{{ $linkClasses }} {{ request()->routeIs('sales-agent.dashboard') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-th-large w-4"></i> <span>Dashboard</span>
                        </a>
                        <a href="{{ route('sales-agent.merchants') }}" class="{{ $linkClasses }} {{ request()->routeIs('sales-agent.merchants*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-school w-4"></i> <span>My Merchants</span>
                        </a>
                        <a href="{{ route('sales-agent.wallet') }}" class="{{ $linkClasses }} {{ request()->routeIs('sales-agent.wallet*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-wallet w-4"></i> <span>My Wallet</span>
                        </a>
                    @elseif(Auth::user()->role === 'student')
                        <a href="{{ route('student.dashboard') }}" class="{{ $linkClasses }} {{ request()->routeIs('student.dashboard') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-th-large w-4"></i> <span>Dashboard</span>
                        </a>
                        <a href="{{ route('student.courses.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('student.courses*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-university w-4"></i> <span>My Academy</span>
                        </a>
                        <a href="{{ route('student.study-materials.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('student.study-materials.*') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-book-open w-4"></i> <span>Study Vault</span>
                        </a>
                        <a href="{{ route('student.exams') }}" class="{{ $linkClasses }} {{ request()->routeIs('student.exams*', 'student.results*') ? $activeClasses : $inactiveClasses }}" id="sidebar_link_student_portal">
                            <i class="fas fa-vial-circle-check w-4"></i> <span>Test Portal</span>
                        </a>
                        <a href="{{ route('student.wallet') }}" class="{{ $linkClasses }} {{ request()->routeIs('student.wallet*') ? $activeClasses : $inactiveClasses }}" id="sidebar_wallet_link_student">
                            <i class="fas fa-wallet w-4"></i> <span>My Wallet</span>
                        </a>
                    @else
                        <a href="{{ route('syndicate.dashboard') }}" class="{{ $linkClasses }} {{ request()->routeIs('syndicate.dashboard') ? $activeClasses : $inactiveClasses }}">
                            <i class="fas fa-chart-pie w-4"></i> <span>Dashboard</span>
                        </a>
                        <a href="{{ route('syndicate.plans') }}" class="{{ $linkClasses }} {{ request()->routeIs('syndicate.plans') ? $activeClasses : $inactiveClasses }}" id="sidebar_link_syndicate_plans">
                            <i class="fas fa-plus-circle w-4"></i> <span>Join Plan</span>
                        </a>
                        <a href="{{ route('syndicate.wallet') }}" class="{{ $linkClasses }} {{ request()->routeIs('syndicate.wallet*') ? $activeClasses : $inactiveClasses }}" id="sidebar_wallet_link_syndicate">
                            <i class="fas fa-wallet w-4"></i> <span>My Wallet</span>
                        </a>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="{{ $linkClasses }} {{ request()->routeIs('profile.edit') ? $activeClasses : $inactiveClasses }}">
                        <i class="fas fa-user-circle w-4"></i> <span>My Profile</span>
                    </a>
                </nav>
            </div>

            <div class="mt-auto p-6 border-t border-slate-100">
                <div class="flex items-center gap-3 mb-4">
                    <div class="relative group">
                        @if(Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="w-9 h-9 rounded-full object-cover border border-slate-200 shadow-sm transition-all group-hover:scale-105">
                        @else
                            <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 font-black text-[10px] uppercase shadow-sm group-hover:bg-indigo-50 transition-all">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
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
        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto custom-scrollbar">
            <!-- Top Header -->
            <header class="h-14 shrink-0 bg-white border-b border-slate-200 flex items-center justify-between px-6 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden text-slate-400">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">{{ $title ?? 'Dashboard' }}</h1>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-[9px] font-black text-emerald-600 uppercase tracking-widest bg-emerald-50 px-4 py-1.5 rounded-full border border-emerald-100 flex items-center gap-2 group hover:bg-emerald-100 transition-all cursor-pointer shadow-sm shadow-emerald-50" id="header_wallet_balance_container">
                        <i class="fas fa-wallet text-[10px]"></i>
                        <span id="header_wallet_balance">₹{{ number_format(Auth::user()->wallet_balance, 2) }}</span>
                    </div>
                    <div class="text-[8px] font-black text-indigo-600 uppercase tracking-widest bg-indigo-50 px-4 py-1.5 rounded-full border border-indigo-100 lg:block hidden">Syndicate Active</div>
                </div>
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

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-lg flex items-center gap-3 text-red-700 shadow-sm">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                        <p class="text-xs font-bold">{{ session('error') }}</p>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
