<x-dashboard.layout>
    <x-slot name="title">Sales Agent Profile: {{ $user->name }}</x-slot>

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">Sales Agent: {{ $user->name }}</h2>
            <p class="text-xs text-slate-400 font-bold italic">Overview of enrolled coachings and students.</p>
        </div>
        <div class="flex flex-wrap gap-2 justify-end">
            <a href="{{ route('admin.users.export.csv') }}?role=student&sales_agent_id={{ $user->id }}" class="px-3 py-2 bg-emerald-50 text-emerald-600 rounded-lg text-[10px] font-bold uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition-all whitespace-nowrap">
                <i class="fas fa-user-graduate mr-1"></i> Export Students
            </a>
            <a href="{{ route('admin.users.export.csv') }}?role=teacher&referred_by={{ $user->id }}" class="px-3 py-2 bg-emerald-50 text-emerald-600 rounded-lg text-[10px] font-bold uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition-all whitespace-nowrap">
                <i class="fas fa-school mr-1"></i> Export Coachings
            </a>
            <a href="{{ route('admin.users.edit', $user) }}" class="px-3 py-2 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-bold uppercase tracking-widest hover:bg-slate-200 transition-all whitespace-nowrap">
                <i class="fas fa-edit mr-1"></i> Edit User
            </a>
            <a href="{{ route('admin.users.index') }}?tab=sales" class="px-3 py-2 bg-indigo-50 text-indigo-600 rounded-lg text-[10px] font-bold uppercase tracking-widest hover:bg-indigo-100 transition-all whitespace-nowrap">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </div>

    <!-- Agent Details & Permissions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-1 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-2xl font-black">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="font-black text-slate-900 text-lg">{{ $user->name }}</h3>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-100 text-slate-500">{{ $user->role }}</span>
                </div>
            </div>
            
            <div class="space-y-4 mb-6 text-xs font-medium text-slate-600">
                <div class="flex items-center gap-2">
                    <i class="fas fa-envelope text-slate-400 w-4"></i>
                    <span>{{ $user->email }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-phone text-slate-400 w-4"></i>
                    <span>{{ $user->mobile_number ?? 'N/A' }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-map-marker-alt text-slate-400 w-4"></i>
                    <span>{{ $user->district ?? 'N/A' }}, {{ $user->state ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <h3 class="font-black text-slate-900 text-sm uppercase tracking-widest mb-4">Agent View Permissions</h3>
            <p class="text-xs text-slate-500 mb-6 italic">Control what this sales agent can see on their dashboard regarding their enrolled coachings and students.</p>
            
            <form action="{{ route('admin.users.update-permissions', $user) }}" method="POST">
                @csrf
                @method('PUT')
                
                @php
                    $permissions = $user->agent_permissions ?? [];
                @endphp
                
                <div class="space-y-4 mb-6">
                    <label class="flex items-center justify-between p-3 border border-slate-100 rounded-xl hover:bg-slate-50 cursor-pointer transition-all">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-chalkboard-teacher text-indigo-500"></i>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">View Teachers / Coachings</h4>
                                <p class="text-[10px] text-slate-400 italic">Allow agent to see their enrolled merchants.</p>
                            </div>
                        </div>
                        <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input type="checkbox" name="agent_permissions[view_teachers]" value="1" id="toggle_teachers" class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer border-slate-300 checked:right-0 checked:border-indigo-600 transition-all" {{ isset($permissions['view_teachers']) && $permissions['view_teachers'] == '1' ? 'checked' : '' }}>
                            <label for="toggle_teachers" class="toggle-label block overflow-hidden h-5 rounded-full bg-slate-300 cursor-pointer"></label>
                        </div>
                    </label>

                    <label class="flex items-center justify-between p-3 border border-slate-100 rounded-xl hover:bg-slate-50 cursor-pointer transition-all">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-user-graduate text-emerald-500"></i>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">View Students</h4>
                                <p class="text-[10px] text-slate-400 italic">Allow agent to see students added by their merchants.</p>
                            </div>
                        </div>
                        <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input type="checkbox" name="agent_permissions[view_students]" value="1" id="toggle_students" class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer border-slate-300 checked:right-0 checked:border-emerald-600 transition-all" {{ isset($permissions['view_students']) && $permissions['view_students'] == '1' ? 'checked' : '' }}>
                            <label for="toggle_students" class="toggle-label block overflow-hidden h-5 rounded-full bg-slate-300 cursor-pointer"></label>
                        </div>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-md">Save Permissions</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Enrolled Coachings & Students -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-8">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <h3 class="font-black text-slate-900 uppercase tracking-widest text-sm">Enrolled Coachings</h3>
            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-[10px] font-bold uppercase">{{ $user->referrals->count() }} Total</span>
        </div>
        
        <div class="divide-y divide-slate-100">
            @forelse($user->referrals as $coaching)
                <div x-data="{ open: false }" class="p-0">
                    <div @click="open = !open" class="p-4 flex items-center justify-between hover:bg-slate-50 cursor-pointer transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-school"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">{{ $coaching->name }}</h4>
                                <p class="text-[10px] text-slate-500">{{ $coaching->coaching_or_school ?? 'N/A' }} &bull; {{ $coaching->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-xs font-bold text-slate-600"><i class="fas fa-user-graduate text-emerald-500 mr-1"></i> {{ $coaching->students->count() }} Students</span>
                            @if($coaching->students->count() > 0)
                            <a href="{{ route('admin.users.export.csv') }}?role=student&teacher_id={{ $coaching->id }}" class="p-1.5 bg-emerald-50 text-emerald-600 rounded hover:bg-emerald-600 hover:text-white transition-all text-[10px] font-bold uppercase tracking-widest flex items-center justify-center" title="Download Students" @click.stop>
                                <i class="fas fa-download"></i>
                            </a>
                            @endif
                            <i class="fas fa-chevron-down text-slate-400 transition-transform duration-200" :class="{'rotate-180': open}"></i>
                        </div>
                    </div>
                    
                    <div x-show="open" x-collapse class="bg-slate-50 border-t border-slate-100 p-4">
                        @if($coaching->students->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($coaching->students as $student)
                                    <a href="{{ route('admin.users.edit', $student->id) }}" class="block bg-white p-3 rounded-xl border border-slate-200 shadow-sm flex items-center gap-3 hover:shadow-md hover:border-indigo-200 transition-all cursor-pointer">
                                        <div class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-xs flex-shrink-0">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-bold text-slate-800 text-xs truncate">{{ $student->name }}</p>
                                            <p class="text-[10px] text-slate-500 truncate">{{ $student->studentClass->name ?? 'No Class' }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-slate-400 italic text-center py-4">No students enrolled under this coaching yet.</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-10 text-center">
                    <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                        <i class="fas fa-school"></i>
                    </div>
                    <h3 class="text-slate-500 font-bold">No Coachings Enrolled</h3>
                    <p class="text-xs text-slate-400 mt-1">This sales agent has not enrolled any coachings yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .toggle-checkbox:checked {
            right: 0;
            border-color: inherit;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: inherit;
        }
        /* Color overrides for checked state are handled via border-color classes in HTML */
        #toggle_teachers:checked + .toggle-label { background-color: #4f46e5; }
        #toggle_students:checked + .toggle-label { background-color: #10b981; }
    </style>
</x-dashboard.layout>
