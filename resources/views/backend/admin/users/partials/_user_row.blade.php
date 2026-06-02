<tr class="hover:bg-slate-50/50 transition-all font-medium">
    <td class="px-4 py-2">
        <div class="flex items-center gap-2">
            <div class="w-6 h-6 rounded bg-slate-50 border border-slate-100 flex items-center justify-center text-indigo-600 font-bold text-[9px] uppercase">{{ substr($user->name, 0, 1) }}</div>
            <span class="text-slate-900 font-bold text-xs">{{ $user->name }}</span>
        </div>
    </td>
    <td class="px-4 py-2 text-slate-700 font-bold">{{ $user->email }}</td>
    <td class="px-4 py-2 text-slate-700 font-bold">{{ $user->mobile_number ?? '-' }}</td>
    <td class="px-4 py-2 text-center">
        <span class="px-2 py-0.5 rounded text-[8px] font-bold uppercase border
            {{ $user->role == 'admin' ? 'bg-purple-50 text-purple-600 border-purple-100' : 'bg-slate-50 text-slate-600 border-slate-100' }}">
            {{ str_replace('_', ' ', $user->role) }}
        </span>
    </td>
    <td class="px-4 py-2 text-center text-slate-500 font-bold uppercase">
        @if($user->role === 'student')
            {{ $user->studentClass->name ?? '-' }}
        @else
            {{ $user->created_at->format('d M y') }}
        @endif
    </td>
    <td class="px-4 py-2 text-center">
        <span class="px-2 py-0.5 rounded text-[8px] font-bold uppercase border
            {{ $user->status == 'active' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-red-50 text-red-600 border-red-100' }}">
            {{ $user->status }}
        </span>
    </td>
    <td class="px-4 py-2 text-right">
        <div class="flex items-center justify-end gap-1.5">
            @if($user->id !== auth()->id() && Auth::user()->hasPermission('impersonate_users'))
                <form action="{{ route('admin.users.impersonate', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="p-1.5 border border-indigo-100 rounded bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all flex items-center gap-1.5 px-3" title="View Dashboard">
                        <i class="fas fa-eye text-[9px]"></i> <span class="text-[8px] uppercase font-black tracking-tighter">View</span>
                    </button>
                </form>
            @endif
            @if(Auth::user()->hasPermission('view_wallet'))
            <a href="{{ route('admin.wallet.index', ['user_id' => $user->id, 'user_name' => $user->name]) }}" class="p-1.5 border border-emerald-100 rounded bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all transition-all flex items-center justify-center" title="Add/Deduct Money">
                <i class="fas fa-wallet text-[10px]"></i>
            </a>
            @endif
            @if(Auth::user()->hasPermission('edit_users'))
            <a href="{{ route('admin.users.edit', $user->id) }}" class="p-1.5 border border-slate-100 rounded hover:bg-white text-slate-400 hover:text-indigo-600 transition-all"><i class="fas fa-edit text-[10px]"></i></a>
            @endif
            @if($user->id !== auth()->id())
                @if(Auth::user()->hasPermission('edit_users'))
                <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="p-1.5 border {{ $user->status == 'active' ? 'border-emerald-100 text-emerald-600 hover:bg-emerald-50' : 'border-red-100 text-red-600 hover:bg-red-50' }} rounded transition-all" title="Toggle Status">
                        <i class="fas {{ $user->status == 'active' ? 'fa-user-check' : 'fa-user-slash' }} text-[10px]"></i>
                    </button>
                </form>
                @endif
                @if(Auth::user()->hasPermission('delete_users'))
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user account?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-1.5 border border-slate-100 rounded hover:bg-white text-slate-400 hover:text-red-600 transition-all"><i class="fas fa-trash-alt text-[10px]"></i></button>
                </form>
                @endif
            @endif
        </div>
    </td>
</tr>
