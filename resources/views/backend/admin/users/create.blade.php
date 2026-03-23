<x-dashboard.layout>
    <x-slot name="title">{{ isset($user) ? 'Edit User' : 'Add New User' }}</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-indigo-600 text-[9px] font-bold uppercase flex items-center gap-1 hover:underline mb-1"><i class="fas fa-arrow-left"></i> Back to Users</a>
        <h2 class="text-lg font-bold text-slate-900 tracking-tight">{{ isset($user) ? 'Edit User Account' : 'Create New User Account' }}</h2>
        <p class="text-xs text-slate-400 font-medium italic">Enter details to {{ isset($user) ? 'update' : 'setup' }} user access.</p>
    </div>

    <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm w-full">
        <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            @if(isset($user)) @method('PUT') @endif
            
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Full Name</label>
                    <input type="text" name="name" value="{{ $user->name ?? old('name') }}" placeholder="John Doe" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all" required>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Role</label>
                    <select name="role" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all" required>
                        <option value="admin" {{ (isset($user) && $user->role == 'admin') ? 'selected' : '' }}>Admin</option>
                        <option value="syndicate" {{ (isset($user) && $user->role == 'syndicate') ? 'selected' : '' }}>Syndicate Member</option>
                    </select>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Email Address</label>
                <input type="email" name="email" value="{{ $user->email ?? old('email') }}" placeholder="email@example.com" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">{{ isset($user) ? 'New Password' : 'Password' }}</label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all" {{ isset($user) ? '' : 'required' }}>
                    @if(isset($user)) <p class="text-[9px] text-slate-400 italic font-medium ml-1">Leave blank to keep current.</p> @endif
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all" {{ isset($user) ? '' : 'required' }}>
                </div>
            </div>

            <div class="pt-4 flex gap-2 child:transition-all">
                <button type="submit" class="flex-1 bg-slate-900 text-white font-bold py-3 rounded-lg text-xs uppercase tracking-widest hover:bg-indigo-600 shadow-md">
                    {{ isset($user) ? 'Update User' : 'Create User' }}
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-slate-100 text-slate-500 border border-slate-200 rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-slate-200 text-center">Cancel</a>
            </div>
        </form>
    </div>
</x-dashboard.layout>
