<x-dashboard.layout>
    <x-slot name="title">Manage Users</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">User Management</h2>
            <p class="text-[10px] text-slate-400 font-medium italic">Manage Admins and Syndicate Members.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="px-3 py-2 bg-indigo-600 text-white rounded-lg text-[10px] font-bold uppercase tracking-widest shadow-sm hover:bg-indigo-700 transition-all">
            <i class="fas fa-user-plus mr-1"></i> Add New User
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden text-[10px]">
        <div class="overflow-x-auto">
            <table class="w-full text-left table-standard">
                <thead class="bg-slate-50 text-slate-400 font-bold uppercase tracking-widest text-[9px]">
                    <tr>
                        <th class="px-4 py-2 bg-slate-50 border-b">User</th>
                        <th class="px-4 py-2 bg-slate-50 border-b">Email</th>
                        <th class="px-4 py-2 bg-slate-50 border-b text-center">Role</th>
                        <th class="px-4 py-2 bg-slate-50 border-b text-center">Joined</th>
                        <th class="px-4 py-2 bg-slate-50 border-b text-center">Status</th>
                        <th class="px-4 py-2 bg-slate-50 border-b text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 italic font-medium">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/50 transition-all font-medium">
                            <td class="px-4 py-2">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded bg-slate-50 border border-slate-100 flex items-center justify-center text-indigo-600 font-bold text-[9px] uppercase">{{ substr($user->name, 0, 1) }}</div>
                                    <span class="text-slate-900 font-bold text-xs">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-2 text-slate-700 font-bold">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-center">
                                <span class="px-2 py-0.5 rounded text-[8px] font-bold uppercase border
                                    {{ $user->role == 'admin' ? 'bg-purple-50 text-purple-600 border-purple-100' : 'bg-slate-50 text-slate-600 border-slate-100' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center text-slate-500 font-bold uppercase">
                                {{ $user->created_at->format('d M y') }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                <span class="px-2 py-0.5 rounded text-[8px] font-bold uppercase border
                                    {{ $user->status == 'active' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-red-50 text-red-600 border-red-100' }}">
                                    {{ $user->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="p-1.5 border border-slate-100 rounded hover:bg-white text-slate-400 hover:text-indigo-600 transition-all"><i class="fas fa-edit text-[10px]"></i></a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="p-1.5 border {{ $user->status == 'active' ? 'border-emerald-100 text-emerald-600 hover:bg-emerald-50' : 'border-red-100 text-red-600 hover:bg-red-50' }} rounded transition-all" title="Toggle Status">
                                                <i class="fas {{ $user->status == 'active' ? 'fa-user-check' : 'fa-user-slash' }} text-[10px]"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user account?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 border border-slate-100 rounded hover:bg-white text-slate-400 hover:text-red-600 transition-all"><i class="fas fa-trash-alt text-[10px]"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-slate-400 italic">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="px-4 py-3 bg-slate-50 border-t border-slate-100">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</x-dashboard.layout>
