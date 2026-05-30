<x-dashboard.layout>
    <x-slot name="title">Generate Admit Card</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.admit-cards.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">
            <i class="fas fa-arrow-left mr-1"></i> Back to List
        </a>
        <h2 class="text-lg font-bold text-slate-900 tracking-tight mt-2">Generate Admit Card</h2>
        <p class="text-[10px] text-slate-400 font-medium italic">Fill the details to generate an admit card for a student.</p>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden max-w-3xl">
        <form action="{{ route('admin.admit-cards.store') }}" method="POST" class="p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Student Selection -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest">Select Student <span class="text-red-500">*</span></label>
                    <select name="user_id" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all font-medium" required>
                        <option value="">-- Select a Student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('user_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->name }} ({{ $student->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Class -->
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest">Class / Grade</label>
                    <select name="student_class" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all font-medium">
                        <option value="">-- Select Class --</option>
                        @foreach($classes as $studentClass)
                            <option value="{{ $studentClass->name }}" {{ old('student_class') == $studentClass->name ? 'selected' : '' }}>
                                {{ $studentClass->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('student_class') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Exam Name -->
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest">Exam Name <span class="text-red-500">*</span></label>
                    <input type="text" name="exam_name" value="{{ old('exam_name') }}" placeholder="e.g. Annual Scholarship Exam 2026" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all font-medium" required>
                    @error('exam_name') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Roll Number -->
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest">Roll Number <span class="text-red-500">*</span></label>
                    <input type="text" name="roll_no" value="{{ old('roll_no', $suggestedRollNo) }}" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all font-medium" required>
                    @error('roll_no') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Exam Center -->
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest">Exam Center <span class="text-red-500">*</span></label>
                    <input type="text" name="exam_center" value="{{ old('exam_center') }}" placeholder="e.g. Center Code: 001, Main Hall" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all font-medium" required>
                    @error('exam_center') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Exam Date & Time -->
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest">Exam Date & Time <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="exam_date" value="{{ old('exam_date') }}" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all font-medium text-slate-700" required>
                    @error('exam_date') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Instructions -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest">Important Instructions</label>
                    <textarea name="instructions" rows="4" placeholder="Enter any specific instructions for the candidate..." class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all font-medium">{{ old('instructions', "1. Please bring a valid photo ID.\n2. Do not bring any electronic devices into the examination hall.") }}</textarea>
                    @error('instructions') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                </div>

            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 transition-all active:scale-95">
                    Generate Admit Card <i class="fas fa-check ml-1"></i>
                </button>
            </div>
        </form>
    </div>
</x-dashboard.layout>
