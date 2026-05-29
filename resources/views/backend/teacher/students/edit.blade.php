<x-dashboard.layout>
    <x-slot name="title">Edit Student | {{ $student->name }}</x-slot>

    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tight italic uppercase">Edit Student Profile</h2>
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.3em] italic">Modify scholar details or promote to a higher class.</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-10">
                <form action="{{ route('teacher.students.update', $student) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $student->name) }}" placeholder="e.g. Rahul Sharma" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic" required>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Primary Email</label>
                            <input type="email" name="email" value="{{ old('email', $student->email) }}" placeholder="rahul@example.com" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic" required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Student Grade (Assigned Class)</label>
                            <select name="class_id" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic appearance-none" required>
                                <option value="" disabled>Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Profile Status</label>
                            <div class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-xs font-black uppercase tracking-widest text-emerald-600 italic">
                                <i class="fas fa-check-circle mr-2"></i> Active Portal Access
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Date of Birth</label>
                            <input type="date" name="dob" value="{{ old('dob', $student->dob) }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Gender</label>
                            <select name="gender" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic appearance-none">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Blood Group</label>
                            <input type="text" name="blood_group" value="{{ old('blood_group', $student->blood_group) }}" placeholder="e.g. O+" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Aadhaar Number</label>
                            <input type="text" name="aadhaar_number" value="{{ old('aadhaar_number', $student->aadhaar_number) }}" placeholder="XXXX XXXX XXXX" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Category</label>
                            <select name="category" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic appearance-none">
                                <option value="">Select Category</option>
                                <option value="General" {{ old('category', $student->category) == 'General' ? 'selected' : '' }}>General</option>
                                <option value="OBC" {{ old('category', $student->category) == 'OBC' ? 'selected' : '' }}>OBC</option>
                                <option value="SC" {{ old('category', $student->category) == 'SC' ? 'selected' : '' }}>SC</option>
                                <option value="ST" {{ old('category', $student->category) == 'ST' ? 'selected' : '' }}>ST</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Mobile Number</label>
                            <input type="text" name="mobile_number" value="{{ old('mobile_number', $student->mobile_number) }}" placeholder="e.g. 9876543210" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Father Name</label>
                            <input type="text" name="father_name" value="{{ old('father_name', $student->father_name) }}" placeholder="Father's Name" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Mother Name</label>
                            <input type="text" name="mother_name" value="{{ old('mother_name', $student->mother_name) }}" placeholder="Mother's Name" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Guardian Name</label>
                            <input type="text" name="guardian_name" value="{{ old('guardian_name', $student->guardian_name) }}" placeholder="Guardian's Name" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Alternate Contact</label>
                            <input type="text" name="alternate_contact" value="{{ old('alternate_contact', $student->alternate_contact) }}" placeholder="e.g. 9876543211" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>

                        <div class="col-span-1 md:col-span-2 space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Village / Street Address</label>
                            <input type="text" name="address" value="{{ old('address', $student->address) }}" placeholder="Full Address" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Block</label>
                            <input type="text" name="block" value="{{ old('block', $student->block) }}" placeholder="Block" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">District</label>
                            <input type="text" name="district" value="{{ old('district', $student->district) }}" placeholder="District" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">State</label>
                            <input type="text" name="state" value="{{ old('state', $student->state) }}" placeholder="State" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">PIN Code</label>
                            <input type="text" name="pin_code" value="{{ old('pin_code', $student->pin_code) }}" placeholder="PIN Code" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>
                        
                        <div class="col-span-1 md:col-span-2 space-y-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Coaching or School (Optional)</label>
                            <input type="text" name="coaching_or_school" value="{{ old('coaching_or_school', $student->coaching_or_school) }}" placeholder="Coaching or School Name" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold focus:border-indigo-600 focus:bg-white outline-none transition-all italic">
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('teacher.students') }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-slate-900 transition-colors italic">
                            <i class="fas fa-arrow-left mr-2"></i> Cancel Modification
                        </a>
                        <button type="submit" class="bg-indigo-600 text-white font-black py-4 px-10 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-100 active:scale-95 group">
                            Update & Save Changes <i class="fas fa-save ml-2 text-[8px] group-hover:scale-110 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden group">
                <div class="absolute -top-10 -right-10 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fas fa-level-up-alt text-[10rem]"></i>
                </div>
                <h4 class="text-xl font-black italic tracking-tighter uppercase mb-6 relative z-10">Promotion Protocol</h4>
                <div class="space-y-6 relative z-10 font-bold italic text-sm leading-relaxed text-indigo-100/90">
                    <p>1. Changing a student's class will immediately update their accessible curriculum.</p>
                    <p>2. Previous exam results will remain in history but they will now see courses for the new grade.</p>
                    <p>3. Changing the email will require the student to login with the new credentials.</p>
                </div>
            </div>
            <div class="mt-6 bg-slate-900 rounded-[2rem] p-8 text-white relative overflow-hidden">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-slate-800 flex items-center justify-center text-xl font-black italic text-indigo-400">
                        {{ substr($student->name, 0, 1) }}
                    </div>
                    <div>
                        <h5 class="text-sm font-black italic uppercase tracking-tight">{{ $student->name }}</h5>
                        <p class="text-[9px] text-slate-400 font-bold tracking-widest uppercase">ID: SNF-{{ str_pad($student->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                <div class="pt-4 border-t border-slate-800">
                    <p class="text-[8px] text-slate-500 font-bold uppercase tracking-widest italic leading-relaxed">The wallet balance and enrollment history will be preserved during this core modification.</p>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>
