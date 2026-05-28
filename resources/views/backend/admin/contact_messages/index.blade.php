<x-dashboard.layout>
    <x-slot name="title">Contact Messages</x-slot>

    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Contact Messages</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">
                Messages from the contact form
                @if($unreadCount > 0)
                    &nbsp;·&nbsp;<span class="text-rose-500">{{ $unreadCount }} unread</span>
                @endif
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-6 text-sm font-medium">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Filter Tabs --}}
    <div class="flex gap-2 mb-6 flex-wrap">
        @foreach(['All' => '', 'Unread' => 'unread', 'Read' => 'read', 'Replied' => 'replied'] as $label => $val)
            <a href="{{ request()->fullUrlWithQuery(['status' => $val]) }}"
               class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-colors
                   {{ $status === $val ? 'bg-green-600 text-white' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                {{ $label }}
                @if($val === 'unread' && $unreadCount > 0)
                    <span class="ml-1 bg-rose-500 text-white rounded-full px-1.5 py-0.5 text-[9px]">{{ $unreadCount }}</span>
                @endif
            </a>
        @endforeach
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Sender</th>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Subject</th>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Message</th>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($messages as $msg)
                        <tr class="hover:bg-slate-50/50 transition-colors {{ $msg->isUnread() ? 'bg-rose-50/30' : '' }}">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-green-50 flex items-center justify-center text-green-600 font-black text-sm shrink-0">
                                        {{ strtoupper(substr($msg->full_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 {{ $msg->isUnread() ? 'font-black' : '' }}">{{ $msg->full_name }}</p>
                                        <p class="text-[10px] text-slate-400 font-medium">{{ $msg->email }}</p>
                                        @if($msg->phone)
                                            <p class="text-[10px] text-slate-400 font-medium">{{ $msg->phone }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-4">
                                <p class="text-xs font-bold text-slate-700">{{ $msg->subject ?: '—' }}</p>
                            </td>
                            <td class="px-8 py-4 max-w-[220px]">
                                <p class="text-xs text-slate-500 truncate">{{ Str::limit($msg->message, 60) }}</p>
                            </td>
                            <td class="px-8 py-4">
                                <p class="text-xs text-slate-500 font-medium">{{ $msg->created_at->format('M d, Y') }}</p>
                                <p class="text-[10px] text-slate-400">{{ $msg->created_at->format('h:i A') }}</p>
                            </td>
                            <td class="px-8 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                                    @if($msg->status === 'unread') bg-rose-100 text-rose-700
                                    @elseif($msg->status === 'read') bg-sky-100 text-sky-700
                                    @else bg-emerald-100 text-emerald-700 @endif">
                                    {{ ucfirst($msg->status) }}
                                </span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.contact-messages.show', $msg) }}"
                                       class="p-2 text-slate-400 hover:text-indigo-600 transition-colors rounded-xl hover:bg-indigo-50" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.contact-messages.destroy', $msg) }}" method="POST"
                                          onsubmit="return confirm('Delete this message?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 transition-colors rounded-xl hover:bg-rose-50" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-14 text-center text-slate-400">
                                <div class="w-16 h-16 mx-auto bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-inbox text-2xl text-slate-300"></i>
                                </div>
                                <p class="text-sm font-bold">No messages found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="p-6 border-t border-slate-50">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
