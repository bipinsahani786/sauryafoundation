<x-dashboard.layout>
    <x-slot name="title">{{ isset($user) ? 'Edit User' : 'Add New User' }}</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-indigo-600 text-[9px] font-bold uppercase flex items-center gap-1 hover:underline mb-1"><i class="fas fa-arrow-left"></i> Back to Users</a>
        <h2 class="text-lg font-bold text-slate-900 tracking-tight">{{ isset($user) ? 'Edit User Account' : 'Create New User Account' }}</h2>
        <p class="text-xs text-slate-400 font-medium italic">Enter details to {{ isset($user) ? 'update' : 'setup' }} user access.</p>
    </div>

    <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm w-full">
        <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST" class="space-y-4" x-data="{ role: '{{ $user->role ?? old('role', 'admin') }}' }">
            @csrf
            @if(isset($user)) @method('PUT') @endif
            
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Full Name</label>
                    <input type="text" name="name" value="{{ $user->name ?? old('name') }}" placeholder="John Doe" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all" required>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Role</label>
                    <select name="role" x-model="role" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all" required>
                        <option value="admin" {{ (isset($user) && $user->role == 'admin') ? 'selected' : '' }}>Admin</option>
                        <option value="teacher" {{ (isset($user) && $user->role == 'teacher') ? 'selected' : '' }}>Teacher</option>
                        <option value="sales_agent" {{ (isset($user) && $user->role == 'sales_agent') ? 'selected' : '' }}>Sales Agent</option>
                        <option value="student" {{ (isset($user) && $user->role == 'student') ? 'selected' : '' }}>Student</option>
                        <option value="syndicate" {{ (isset($user) && $user->role == 'syndicate') ? 'selected' : '' }}>Syndicate Member</option>
                    </select>
                </div>

                <!-- Student Demographic Section (Only for Student) -->
                <div class="col-span-2 mt-2 space-y-4 p-6 bg-slate-50 rounded-xl border border-slate-200" x-show="role === 'student'" x-cloak x-transition>
                    <div class="flex items-center justify-between mb-2 border-b border-slate-200 pb-4">
                        <label class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Student Details</label>
                        <span class="text-[9px] font-bold text-emerald-600 uppercase tracking-widest bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100 italic">Student Setup</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Assigned Class</label>
                            <select name="class_id" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all" :required="role === 'student'">
                                <option value="">-- Select Class --</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ (isset($user) && $user->class_id == $class->id) || old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Date of Birth</label>
                            <input type="date" name="dob" value="{{ $user->dob ?? old('dob') }}" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Gender</label>
                            <select name="gender" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all">
                                <option value="">Select Gender</option>
                                <option value="male" {{ (isset($user) && $user->gender == 'male') || old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ (isset($user) && $user->gender == 'female') || old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ (isset($user) && $user->gender == 'other') || old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Blood Group</label>
                            <input type="text" name="blood_group" value="{{ $user->blood_group ?? old('blood_group') }}" placeholder="e.g. O+" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Aadhaar Number</label>
                            <input type="text" name="aadhaar_number" value="{{ $user->aadhaar_number ?? old('aadhaar_number') }}" placeholder="XXXX XXXX XXXX" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Category</label>
                            <select name="category" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all">
                                <option value="">Select Category</option>
                                <option value="General" {{ (isset($user) && $user->category == 'General') || old('category') == 'General' ? 'selected' : '' }}>General</option>
                                <option value="OBC" {{ (isset($user) && $user->category == 'OBC') || old('category') == 'OBC' ? 'selected' : '' }}>OBC</option>
                                <option value="SC" {{ (isset($user) && $user->category == 'SC') || old('category') == 'SC' ? 'selected' : '' }}>SC</option>
                                <option value="ST" {{ (isset($user) && $user->category == 'ST') || old('category') == 'ST' ? 'selected' : '' }}>ST</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Father's Name</label>
                            <input type="text" name="father_name" value="{{ $user->father_name ?? old('father_name') }}" placeholder="Father's Name" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Mother's Name</label>
                            <input type="text" name="mother_name" value="{{ $user->mother_name ?? old('mother_name') }}" placeholder="Mother's Name" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Guardian Name</label>
                            <input type="text" name="guardian_name" value="{{ $user->guardian_name ?? old('guardian_name') }}" placeholder="Guardian's Name" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Alternate Contact</label>
                            <input type="text" name="alternate_contact" value="{{ $user->alternate_contact ?? old('alternate_contact') }}" placeholder="Alternate Number" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <!-- Shared Location/Contact Section (For Student, Teacher, Sales Agent, Syndicate) -->
                <div class="col-span-2 mt-2 space-y-4 p-6 bg-slate-50 rounded-xl border border-slate-200" x-show="['student', 'teacher', 'sales_agent', 'syndicate'].includes(role)" x-cloak x-transition>
                    <div class="flex items-center justify-between mb-2 border-b border-slate-200 pb-4">
                        <label class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Contact & Location Details</label>
                        <span class="text-[9px] font-bold text-sky-600 uppercase tracking-widest bg-sky-50 px-3 py-1 rounded-full border border-sky-100 italic">Demographics</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Mobile Number</label>
                            <input type="text" name="mobile_number" value="{{ $user->mobile_number ?? old('mobile_number') }}" placeholder="e.g. 9876543210" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all" :required="['teacher', 'sales_agent', 'syndicate'].includes(role)">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Coaching / School Name</label>
                            <input type="text" name="coaching_or_school" value="{{ $user->coaching_or_school ?? old('coaching_or_school') }}" placeholder="Coaching or School Name" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <div class="col-span-1 md:col-span-2 space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Village / Street Address</label>
                            <input type="text" name="address" value="{{ $user->address ?? old('address') }}" placeholder="Full Address" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all" :required="['teacher', 'sales_agent', 'syndicate'].includes(role)">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Block</label>
                            <input type="text" name="block" value="{{ $user->block ?? old('block') }}" placeholder="Block" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all" :required="['teacher', 'sales_agent', 'syndicate'].includes(role)">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">District</label>
                            <input type="text" name="district" value="{{ $user->district ?? old('district') }}" placeholder="District" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all" :required="['teacher', 'sales_agent', 'syndicate'].includes(role)">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">State</label>
                            <input type="text" name="state" value="{{ $user->state ?? old('state') }}" placeholder="State" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all" :required="['teacher', 'sales_agent', 'syndicate'].includes(role)">
                        </div>
                        <div class="space-y-1.5" x-show="role === 'student'">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">PIN Code</label>
                            <input type="text" name="pin_code" value="{{ $user->pin_code ?? old('pin_code') }}" placeholder="PIN Code" class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <!-- Permissions Section (Only for Admin) -->
                <div class="col-span-2 mt-4 space-y-4 p-6 bg-slate-50 rounded-xl border border-slate-200" x-show="role === 'admin'" x-cloak x-transition>
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Staff Permissions</label>
                        <span class="text-[9px] font-bold text-indigo-600 uppercase tracking-widest bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100 italic">Access Control</span>
                    </div>
                    <p class="text-[9px] text-slate-400 font-medium italic mb-4">Grant specific access rights to this admin staff member.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($permissions->groupBy('group') as $group => $groupPermissions)
                            <div class="space-y-4" x-data="{ 
                                allChecked: false,
                                init() {
                                    this.updateAllChecked();
                                },
                                updateAllChecked() {
                                    const checkboxes = Array.from($el.querySelectorAll('input[type=checkbox]:not(.select-all)'));
                                    this.allChecked = checkboxes.length > 0 && checkboxes.every(c => c.checked);
                                },
                                toggleGroup() {
                                    const checkboxes = $el.querySelectorAll('input[type=checkbox]:not(.select-all)');
                                    checkboxes.forEach(c => c.checked = this.allChecked);
                                }
                            }">
                                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                                    <span class="text-[9px] font-black text-slate-800 uppercase tracking-widest">{{ $group }}</span>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" x-model="allChecked" @change="toggleGroup()" class="select-all w-3 h-3 rounded text-indigo-600 focus:ring-0 border-slate-300">
                                        <span class="text-[8px] font-bold text-slate-400 uppercase tracking-tighter">Select All</span>
                                    </label>
                                </div>
                                <div class="grid grid-cols-1 gap-2">
                                    @foreach($groupPermissions as $permission)
                                        <label class="flex items-center gap-3 p-2.5 bg-white rounded-xl border border-slate-100 hover:border-indigo-100 transition-all cursor-pointer group">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                                @change="updateAllChecked()"
                                                class="w-4 h-4 rounded text-indigo-600 focus:ring-indigo-500 border-slate-300"
                                                {{ (isset($user) && $user->permissions->contains($permission->id)) ? 'checked' : '' }}>
                                            <div class="flex flex-col">
                                                <span class="text-[9px] font-black text-slate-600 uppercase tracking-widest group-hover:text-indigo-600">{{ $permission->label }}</span>
                                                <span class="text-[7px] font-bold text-slate-300 uppercase tracking-tighter transition-colors group-hover:text-indigo-300">{{ str_replace('_', ' ', $permission->name) }}</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="space-y-1.5" x-show="role !== 'student'" x-cloak>
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Commission Percentage (%)</label>
                <input type="number" step="0.01" name="commission_percent" value="{{ $user->commission_percent ?? old('commission_percent', 0) }}" placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-xs font-semibold focus:border-indigo-500 focus:bg-white outline-none transition-all">
                <p class="text-[9px] text-slate-400 italic font-medium ml-1">Applied to Teachers (on quiz sales) and Sales Agents (on teacher referrals).</p>
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
