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

                    @if($user->role === 'student')
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Phone Number</label>
                                <input type="text" value="{{ $user->mobile_number ?? 'Not Provided' }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed" disabled>
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Current Class</label>
                                <input type="text" value="{{ $user->studentClass?->name ?? 'Not Assigned' }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed uppercase" disabled>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Father's Name</label>
                                <input type="text" value="{{ $user->father_name ?? 'Not Provided' }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed" disabled>
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Mother's Name</label>
                                <input type="text" value="{{ $user->mother_name ?? 'Not Provided' }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed" disabled>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Parent Phone</label>
                                <input type="text" value="{{ $user->alternate_contact ?? 'Not Provided' }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed" disabled>
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Aadhaar Number</label>
                                <input type="text" value="{{ $user->aadhaar_number ?? 'Not Provided' }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed" disabled>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Date of Birth</label>
                                <input type="text" value="{{ $user->dob ?? 'Not Provided' }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed" disabled>
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Gender</label>
                                <input type="text" value="{{ $user->gender ?? 'Not Provided' }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed" disabled>
                            </div>
                        </div>

                        <div class="space-y-1.5 mt-4">
                            <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Village / Street Address</label>
                            <input type="text" value="{{ $user->address ?? 'Not Provided' }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed" disabled>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Block</label>
                                <input type="text" value="{{ $user->block }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed" disabled>
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">District</label>
                                <input type="text" value="{{ $user->district }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed" disabled>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">State</label>
                                <input type="text" value="{{ $user->state }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed" disabled>
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">PIN Code</label>
                                <input type="text" value="{{ $user->pin_code }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed" disabled>
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase block ml-1">Coaching or School</label>
                            <input type="text" value="{{ $user->coaching_or_school }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-500 cursor-not-allowed" disabled>
                        </div>
                        <p class="text-[9px] text-slate-400 font-bold italic mt-2">* Demographic details and class assignment are managed by your instructor and cannot be modified here.</p>
                    @endif
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
