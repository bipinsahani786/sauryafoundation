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
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="flex items-center gap-4 mb-6 p-4 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                        <div class="relative group">
                            @if($user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="w-16 h-16 rounded-full object-cover border-2 border-white shadow-sm group-hover:opacity-75 transition-all">
                            @else
                                <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-black text-xl border-2 border-white shadow-sm">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Profile Photo</label>
                            <input type="file" name="profile_photo" class="text-[9px] text-slate-500 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[9px] file:font-black file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                        </div>
                    </div>

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
