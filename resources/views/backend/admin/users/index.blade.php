<x-dashboard.layout>
    <x-slot name="title">Manage Users</x-slot>

    <!-- Alpine Wrapper -->
    <div x-data="{ activeTab: 'students', roleMap: { 'students': 'student', 'teachers': 'teacher', 'sales': 'sales_agent', 'syndicates': 'syndicate', 'admins': 'admin' } }" class="space-y-6">
    
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-slate-900 tracking-tight">User Management</h2>
                <p class="text-[10px] text-slate-400 font-medium italic">Manage Admins, Teachers, Students, Sales Agents and Syndicate Members.</p>
            </div>
            <div class="flex flex-col md:flex-row items-center gap-2">
                <!-- Search Form -->
                <form action="{{ route('admin.users.index') }}" method="GET" class="relative w-full md:w-auto mr-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..." class="w-full md:w-56 pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 shadow-sm transition-all">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    @if(request('search'))
                        <a href="{{ route('admin.users.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-red-500" title="Clear Search"><i class="fas fa-times"></i></a>
                    @endif
                </form>

                <a :href="'{{ route('admin.users.export.pdf') }}?role=' + roleMap[activeTab]" target="_blank" class="px-3 py-2 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-bold uppercase tracking-widest shadow-sm border border-slate-200 hover:bg-slate-200 transition-all whitespace-nowrap">
                    <i class="fas fa-print mr-1 text-slate-500"></i> Print
                </a>

                <a :href="'{{ route('admin.users.export.csv') }}?role=' + roleMap[activeTab]" class="px-3 py-2 bg-emerald-50 text-emerald-600 rounded-lg text-[10px] font-bold uppercase tracking-widest shadow-sm border border-emerald-200 hover:bg-emerald-600 hover:text-white transition-all whitespace-nowrap">
                    <i class="fas fa-download mr-1"></i> Download
                </a>

                @if(Auth::user()->hasPermission('create_users'))
                <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-[10px] font-bold uppercase tracking-widest shadow-sm hover:bg-indigo-700 transition-all whitespace-nowrap ml-2">
                    <i class="fas fa-user-plus mr-1"></i> Add User
                </a>
                @endif
            </div>
        </div>

        <div class="space-y-4">
        
        <!-- Tab Navigation -->
        <div class="flex space-x-1 bg-slate-100 p-1.5 rounded-xl w-full md:w-max border border-slate-200 overflow-x-auto custom-scrollbar">
            <button @click="activeTab = 'students'" :class="activeTab === 'students' ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200/50'" class="flex-shrink-0 px-4 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all duration-200 focus:outline-none">
                <i class="fas fa-user-graduate mr-1"></i> Students ({{ $students->total() }})
            </button>
            <button @click="activeTab = 'teachers'" :class="activeTab === 'teachers' ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200/50'" class="flex-shrink-0 px-4 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all duration-200 focus:outline-none">
                <i class="fas fa-chalkboard-teacher mr-1"></i> Teachers ({{ $teachers->total() }})
            </button>
            <button @click="activeTab = 'sales'" :class="activeTab === 'sales' ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200/50'" class="flex-shrink-0 px-4 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all duration-200 focus:outline-none">
                <i class="fas fa-headset mr-1"></i> Sales ({{ $salesAgents->total() }})
            </button>
            <button @click="activeTab = 'syndicates'" :class="activeTab === 'syndicates' ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200/50'" class="flex-shrink-0 px-4 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all duration-200 focus:outline-none">
                <i class="fas fa-handshake mr-1"></i> Syndicate ({{ $syndicates->total() }})
            </button>
            <button @click="activeTab = 'admins'" :class="activeTab === 'admins' ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200/50'" class="flex-shrink-0 px-4 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all duration-200 focus:outline-none">
                <i class="fas fa-user-shield mr-1"></i> Admins ({{ $admins->total() }})
            </button>
        </div>

        <!-- Tab Contents Wrapper -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden text-[10px]">
            <div class="overflow-x-auto">
                <table class="w-full text-left table-standard">
                    <thead class="bg-slate-50 text-slate-400 font-bold uppercase tracking-widest text-[9px]">
                        <tr>
                            <th class="px-4 py-2 bg-slate-50 border-b">User</th>
                            <th class="px-4 py-2 bg-slate-50 border-b">Email</th>
                            <th class="px-4 py-2 bg-slate-50 border-b">Mobile</th>
                            <th class="px-4 py-2 bg-slate-50 border-b text-center">Role</th>
                            <th class="px-4 py-2 bg-slate-50 border-b text-center">Joined</th>
                            <th class="px-4 py-2 bg-slate-50 border-b text-center">Status</th>
                            <th class="px-4 py-2 bg-slate-50 border-b text-right">Action</th>
                        </tr>
                    </thead>

                    <!-- Students Tab -->
                    <tbody x-show="activeTab === 'students'" x-cloak class="divide-y divide-slate-100 italic font-medium">
                        @forelse($students as $user)
                            @include('backend.admin.users.partials._user_row', ['user' => $user])
                        @empty
                            <tr><td colspan="6" class="px-4 py-10 text-center text-slate-400 italic">No students found.</td></tr>
                        @endforelse
                    </tbody>

                    <!-- Teachers Tab -->
                    <tbody x-show="activeTab === 'teachers'" x-cloak class="divide-y divide-slate-100 italic font-medium">
                        @forelse($teachers as $user)
                            @include('backend.admin.users.partials._user_row', ['user' => $user])
                        @empty
                            <tr><td colspan="6" class="px-4 py-10 text-center text-slate-400 italic">No teachers found.</td></tr>
                        @endforelse
                    </tbody>

                    <!-- Sales Tab -->
                    <tbody x-show="activeTab === 'sales'" x-cloak class="divide-y divide-slate-100 italic font-medium">
                        @forelse($salesAgents as $user)
                            @include('backend.admin.users.partials._user_row', ['user' => $user])
                        @empty
                            <tr><td colspan="6" class="px-4 py-10 text-center text-slate-400 italic">No sales agents found.</td></tr>
                        @endforelse
                    </tbody>

                    <!-- Syndicates Tab -->
                    <tbody x-show="activeTab === 'syndicates'" x-cloak class="divide-y divide-slate-100 italic font-medium">
                        @forelse($syndicates as $user)
                            @include('backend.admin.users.partials._user_row', ['user' => $user])
                        @empty
                            <tr><td colspan="6" class="px-4 py-10 text-center text-slate-400 italic">No syndicate members found.</td></tr>
                        @endforelse
                    </tbody>

                    <!-- Admins Tab -->
                    <tbody x-show="activeTab === 'admins'" x-cloak class="divide-y divide-slate-100 italic font-medium">
                        @forelse($admins as $user)
                            @include('backend.admin.users.partials._user_row', ['user' => $user])
                        @empty
                            <tr><td colspan="6" class="px-4 py-10 text-center text-slate-400 italic">No admins found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Controls -->
            <div x-show="activeTab === 'students'" x-cloak>
                @if($students->hasPages())
                    <div class="px-4 py-3 bg-slate-50 border-t border-slate-100">{{ $students->appends(request()->except('students_page'))->links() }}</div>
                @endif
            </div>
            
            <div x-show="activeTab === 'teachers'" x-cloak>
                @if($teachers->hasPages())
                    <div class="px-4 py-3 bg-slate-50 border-t border-slate-100">{{ $teachers->appends(request()->except('teachers_page'))->links() }}</div>
                @endif
            </div>

            <div x-show="activeTab === 'sales'" x-cloak>
                @if($salesAgents->hasPages())
                    <div class="px-4 py-3 bg-slate-50 border-t border-slate-100">{{ $salesAgents->appends(request()->except('sales_agents_page'))->links() }}</div>
                @endif
            </div>

            <div x-show="activeTab === 'syndicates'" x-cloak>
                @if($syndicates->hasPages())
                    <div class="px-4 py-3 bg-slate-50 border-t border-slate-100">{{ $syndicates->appends(request()->except('syndicates_page'))->links() }}</div>
                @endif
            </div>

            <div x-show="activeTab === 'admins'" x-cloak>
                @if($admins->hasPages())
                    <div class="px-4 py-3 bg-slate-50 border-t border-slate-100">{{ $admins->appends(request()->except('admins_page'))->links() }}</div>
                @endif
            </div>

        </div>
    </div>
</x-dashboard.layout>
