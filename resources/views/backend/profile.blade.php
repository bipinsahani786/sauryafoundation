<x-dashboard.layout>
    <x-slot name="title">My Profile</x-slot>

    <div class="w-full">
        <div class="mb-6">
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">Account Settings</h2>
            <p class="text-xs text-slate-400 font-medium italic">Manage your profile details and security.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Profile Info -->
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Profile Information</h3>
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Full Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Email Address</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2.5 rounded-lg text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-sm">Save Changes</button>
                </form>
            </div>

            <!-- Password Update -->
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Security</h3>
                <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Current Password</label>
                        <input type="password" name="current_password" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">New Password</label>
                        <input type="password" name="password" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <button type="submit" class="w-full bg-slate-900 text-white font-bold py-2.5 rounded-lg text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-sm">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard.layout>
