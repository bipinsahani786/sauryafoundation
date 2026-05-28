<x-dashboard.layout>
    <x-slot name="title">Manage Events</x-slot>

    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Events</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Manage events, workshops & campaigns</p>
        </div>
        <a href="{{ route('admin.events.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-xl transition-colors shadow-sm">
            <i class="fas fa-plus text-xs"></i> Add Event
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-6 text-sm font-medium">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Filter Tabs -->
    <div class="flex gap-2 mb-6 flex-wrap">
        @foreach(['All' => '', 'Events' => 'event', 'Workshops' => 'workshop', 'Campaigns' => 'campaign'] as $label => $value)
            <a href="{{ request()->fullUrlWithQuery(['category' => $value]) }}"
               class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-colors
                   {{ request('category', '') === $value ? 'bg-green-600 text-white' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left table-standard">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-8 py-4">Event</th>
                        <th class="px-8 py-4">Category</th>
                        <th class="px-8 py-4">Date & Time</th>
                        <th class="px-8 py-4">Location</th>
                        <th class="px-8 py-4">Status</th>
                        <th class="px-8 py-4">Active</th>
                        <th class="px-8 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($events as $event)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    @if($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}" class="w-10 h-10 rounded-xl object-cover shrink-0" alt="{{ $event->title }}">
                                    @else
                                        <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center shrink-0">
                                            <i class="{{ $event->icon }} text-green-500"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">{{ $event->title }}</p>
                                        <p class="text-[10px] text-slate-400 font-medium mt-0.5">{{ Str::limit($event->description, 40) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                                    @if($event->category === 'event') bg-blue-100 text-blue-700
                                    @elseif($event->category === 'workshop') bg-purple-100 text-purple-700
                                    @else bg-amber-100 text-amber-700 @endif">
                                    {{ ucfirst($event->category) }}
                                </span>
                            </td>
                            <td class="px-8 py-4">
                                <p class="text-xs font-bold text-slate-700">{{ $event->formatted_date }}</p>
                                @if($event->formatted_time)
                                    <p class="text-[10px] text-slate-400 font-medium mt-0.5">{{ $event->formatted_time }}</p>
                                @endif
                            </td>
                            <td class="px-8 py-4">
                                <p class="text-xs text-slate-500 font-medium">{{ $event->location ?? '—' }}</p>
                            </td>
                            <td class="px-8 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                                    @if($event->status === 'upcoming') bg-sky-100 text-sky-700
                                    @elseif($event->status === 'ongoing') bg-emerald-100 text-emerald-700
                                    @else bg-slate-100 text-slate-500 @endif">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>
                            <td class="px-8 py-4">
                                <form action="{{ route('admin.events.toggle-status', $event) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-10 h-5 rounded-full transition-colors duration-200 relative focus:outline-none
                                            {{ $event->is_active ? 'bg-green-500' : 'bg-slate-200' }}">
                                        <span class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200
                                            {{ $event->is_active ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                    </button>
                                </form>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                    <button @click="open = !open" class="p-2 text-slate-400 hover:text-indigo-600 transition-colors rounded-xl hover:bg-indigo-50">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-cloak
                                         class="origin-top-right absolute right-0 mt-2 w-40 rounded-2xl shadow-xl bg-white border border-slate-100 ring-1 ring-black ring-opacity-5 z-10 overflow-hidden">
                                        <a href="{{ route('admin.events.edit', $event) }}"
                                           class="block w-full text-left px-4 py-3 text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-colors">
                                            <i class="fas fa-pencil-alt mr-2"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST"
                                              onsubmit="return confirm('Delete this event?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="block w-full text-left px-4 py-3 text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-rose-600 transition-colors border-t border-slate-50">
                                                <i class="fas fa-trash mr-2"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-8 py-12 text-center text-slate-400">
                                <div class="w-16 h-16 mx-auto bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-calendar-times text-2xl text-slate-300"></i>
                                </div>
                                <p class="text-sm font-bold">No events found.</p>
                                <a href="{{ route('admin.events.create') }}" class="mt-3 inline-block text-green-600 text-xs font-bold hover:underline">
                                    Add your first event →
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($events->hasPages())
            <div class="p-6 border-t border-slate-50">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
