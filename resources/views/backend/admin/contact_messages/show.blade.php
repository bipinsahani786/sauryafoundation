<x-dashboard.layout>
    <x-slot name="title">View Message</x-slot>

    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Message Detail</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">From {{ $contactMessage->full_name }}</p>
        </div>
        <a href="{{ route('admin.contact-messages.index') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold rounded-xl transition-colors">
            <i class="fas fa-arrow-left text-xs"></i> Back to Messages
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-6 text-sm font-medium">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Message Content --}}
        <div class="lg:col-span-2 space-y-5">
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
                {{-- Header --}}
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-50">
                    <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-green-600 font-black text-2xl shrink-0">
                        {{ strtoupper(substr($contactMessage->full_name, 0, 1)) }}
                    </div>
                    <div class="flex-grow">
                        <h3 class="text-lg font-black text-slate-900">{{ $contactMessage->full_name }}</h3>
                        <div class="flex flex-wrap gap-3 mt-1 text-xs text-slate-500 font-medium">
                            <span><i class="fas fa-envelope mr-1.5 text-green-500"></i>{{ $contactMessage->email }}</span>
                            @if($contactMessage->phone)
                                <span><i class="fas fa-phone mr-1.5 text-green-500"></i>{{ $contactMessage->phone }}</span>
                            @endif
                            <span><i class="far fa-clock mr-1.5 text-green-500"></i>{{ $contactMessage->created_at->format('M d, Y · h:i A') }}</span>
                        </div>
                    </div>
                    <span class="px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shrink-0
                        @if($contactMessage->status === 'unread') bg-rose-100 text-rose-700
                        @elseif($contactMessage->status === 'read') bg-sky-100 text-sky-700
                        @else bg-emerald-100 text-emerald-700 @endif">
                        {{ ucfirst($contactMessage->status) }}
                    </span>
                </div>

                {{-- Subject --}}
                @if($contactMessage->subject)
                    <div class="mb-5">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Subject</p>
                        <p class="text-sm font-bold text-slate-800 bg-slate-50 px-4 py-3 rounded-xl">{{ $contactMessage->subject }}</p>
                    </div>
                @endif

                {{-- Message Body --}}
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Message</p>
                    <div class="bg-slate-50 rounded-2xl px-5 py-5 text-sm text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $contactMessage->message }}</div>
                </div>
            </div>

            {{-- Admin Note (display only if exists) --}}
            @if($contactMessage->admin_note)
                <div class="bg-amber-50 border border-amber-100 rounded-[2rem] p-6">
                    <p class="text-[10px] font-black text-amber-500 uppercase tracking-widest mb-2"><i class="fas fa-sticky-note mr-1"></i> Admin Note</p>
                    <p class="text-sm text-amber-800 leading-relaxed">{{ $contactMessage->admin_note }}</p>
                </div>
            @endif
        </div>

        {{-- Sidebar: Status Update --}}
        <div class="space-y-5">
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6">
                <h4 class="text-sm font-black text-slate-700 uppercase tracking-widest border-b border-slate-50 pb-4 mb-5">Update Status</h4>

                <form action="{{ route('admin.contact-messages.status', $contactMessage) }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-widest mb-2">Status</label>
                        <select name="status"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:outline-none focus:border-green-500 focus:bg-white transition-colors">
                            <option value="unread" {{ $contactMessage->status === 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ $contactMessage->status === 'read' ? 'selected' : '' }}>Read</option>
                            <option value="replied" {{ $contactMessage->status === 'replied' ? 'selected' : '' }}>Replied</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-widest mb-2">Admin Note</label>
                        <textarea name="admin_note" rows="4"
                                  placeholder="Internal notes (not visible to sender)..."
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:outline-none focus:border-green-500 focus:bg-white transition-colors resize-none">{{ $contactMessage->admin_note }}</textarea>
                    </div>

                    <button type="submit"
                            class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-black text-sm rounded-2xl transition-colors">
                        <i class="fas fa-save mr-2"></i> Save Changes
                    </button>
                </form>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6">
                <h4 class="text-sm font-black text-slate-700 uppercase tracking-widest border-b border-slate-50 pb-4 mb-5">Quick Actions</h4>
                <div class="space-y-3">
                    <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->subject }}"
                       class="flex items-center gap-3 w-full px-4 py-3 bg-sky-50 hover:bg-sky-100 text-sky-600 font-bold text-sm rounded-xl transition-colors">
                        <i class="fas fa-reply"></i> Reply via Email
                    </a>
                    @if($contactMessage->phone)
                        <a href="tel:{{ $contactMessage->phone }}"
                           class="flex items-center gap-3 w-full px-4 py-3 bg-green-50 hover:bg-green-100 text-green-600 font-bold text-sm rounded-xl transition-colors">
                            <i class="fas fa-phone-alt"></i> Call Sender
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactMessage->phone) }}" target="_blank"
                           class="flex items-center gap-3 w-full px-4 py-3 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 font-bold text-sm rounded-xl transition-colors">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    @endif
                </div>
            </div>

            {{-- Delete --}}
            <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST"
                  onsubmit="return confirm('Permanently delete this message?')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="w-full py-3 bg-rose-50 hover:bg-rose-100 text-rose-600 font-black text-sm rounded-2xl transition-colors border border-rose-100">
                    <i class="fas fa-trash mr-2"></i> Delete Message
                </button>
            </form>
        </div>
    </div>
</x-dashboard.layout>
