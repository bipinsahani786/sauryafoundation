<x-dashboard.layout>
    <x-slot name="title">Bulk Generate Admit Cards</x-slot>

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <style>
        .ts-control { border-color: #e2e8f0; border-radius: 0.5rem; padding: 0.5rem 1rem; background-color: #f8fafc; font-size: 0.875rem; font-weight: 500; min-height: 42px; display: flex; align-items: center; }
        .ts-control.focus { border-color: #6366f1; box-shadow: 0 0 0 1px #6366f1; }
        .ts-wrapper.single .ts-control { padding-left: 1rem; }
    </style>

    <div class="mb-6">
        <a href="{{ route('admin.admit-cards.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">
            <i class="fas fa-arrow-left mr-1"></i> Back to List
        </a>
        <h2 class="text-lg font-bold text-slate-900 tracking-tight mt-2">Bulk Generate Admit Cards</h2>
        <p class="text-[10px] text-slate-400 font-medium italic">Generate admit cards in bulk for all students enrolled in a specific exam.</p>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden max-w-3xl">
        <form action="{{ route('admin.admit-cards.bulk-store') }}" method="POST" class="p-6" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Exam/Quiz Selection -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest">Select Exam / Quiz <span class="text-red-500">*</span></label>
                    <select id="quiz_select" name="quiz_id" class="w-full" required>
                        <option value="">-- Select or Search an Exam --</option>
                        @foreach($quizzes as $quiz)
                            <option value="{{ $quiz->id }}" data-title="{{ $quiz->title }}" data-enrolled="{{ $quiz->enrolled_count }}" {{ old('quiz_id') == $quiz->id ? 'selected' : '' }}>
                                {{ $quiz->title }} ({{ $quiz->enrolled_count }} enrolled student{{ $quiz->enrolled_count != 1 ? 's' : '' }})
                            </option>
                        @endforeach
                    </select>
                    @error('quiz_id') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Class Selection (Optional Filter) -->
                <div class="space-y-2" id="class_container" style="display: none;">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest">Enrolled Classes</label>
                    <select id="class_select" name="class_ids[]" class="w-full" multiple>
                        <!-- Options will be populated dynamically -->
                    </select>
                </div>

                <!-- Students Selection (Optional Filter) -->
                <div class="space-y-2 md:col-span-2" id="student_container" style="display: none;">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest">Select Specific Students (Optional)</label>
                    <select id="student_select" name="student_ids[]" class="w-full" multiple>
                        <!-- Options will be populated dynamically -->
                    </select>
                    <p class="text-xs text-slate-400 mt-1">Leave empty to generate for ALL enrolled students.</p>
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

                <!-- Custom Header Image -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest">Custom Header Image (Optional)</label>
                    <input type="file" name="header_image" accept="image/*" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all font-medium">
                    <p class="text-[9px] text-slate-400 font-medium mt-1">Upload a specific header image for these admit cards. If left blank, the default system header will be used.</p>
                    @error('header_image') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                </div>

            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 transition-all active:scale-95">
                    Generate in Bulk <i class="fas fa-magic ml-1"></i>
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quizSelect = new TomSelect("#quiz_select", {
                create: false,
                sortField: { field: "text", direction: "asc" },
                placeholder: "-- Select or Search an Exam --",
                render: {
                    item: function(data, escape) { return data.title ? '<div>' + escape(data.title) + '</div>' : '<div>' + escape(data.text) + '</div>'; },
                    option: function(data, escape) { return data.title ? '<div><span class="font-bold">' + escape(data.title) + '</span> <span class="text-slate-400 text-xs ml-1">(' + escape(data.enrolled) + ' enrolled)</span></div>' : '<div>' + escape(data.text) + '</div>'; }
                }
            });

            const classSelect = new TomSelect("#class_select", {
                create: false,
                sortField: { field: "text", direction: "asc" },
                placeholder: "-- Select Classes --"
            });

            const studentSelect = new TomSelect("#student_select", {
                create: false,
                sortField: { field: "text", direction: "asc" },
                placeholder: "-- Select Specific Students (Optional) --",
                render: {
                    item: function(data, escape) { return '<div>' + escape(data.text) + '</div>'; },
                    option: function(data, escape) { return '<div><span class="font-bold">' + escape(data.name) + '</span> <span class="text-slate-400 text-xs ml-1">(' + escape(data.email) + ')</span> <span class="text-indigo-400 text-[10px] ml-1">[' + escape(data.class_name) + ']</span></div>'; }
                }
            });

            function fetchStudents() {
                const quizId = quizSelect.getValue();
                const classIds = classSelect.getValue() || [];

                if (!quizId) {
                    document.getElementById('class_container').style.display = 'none';
                    document.getElementById('student_container').style.display = 'none';
                    return;
                }

                document.getElementById('class_container').style.display = 'block';
                document.getElementById('student_container').style.display = 'block';

                let url = `{{ route('admin.admit-cards.get-enrolled-students') }}?quiz_id=${quizId}`;
                if (Array.isArray(classIds)) {
                    classIds.forEach(id => { url += `&class_ids[]=${id}`; });
                } else if (classIds) {
                    url += `&class_ids[]=${classIds}`;
                }

                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        // Update classes only if we are changing quiz (not class)
                        if (classIds.length === 0) {
                            classSelect.clear();
                            classSelect.clearOptions();
                            const newClassIds = [];
                            data.classes.forEach(c => {
                                classSelect.addOption({value: c.id, text: c.name});
                                newClassIds.push(c.id);
                            });
                            // Auto-select all classes
                            classSelect.setValue(newClassIds);
                        }

                        // Update students
                        studentSelect.clear();
                        studentSelect.clearOptions();
                        const studentIds = [];
                        data.students.forEach(s => {
                            studentSelect.addOption({
                                value: s.id, 
                                text: s.name,
                                name: s.name,
                                email: s.email,
                                class_name: s.class_name
                            });
                            studentIds.push(s.id);
                        });
                        // Auto-select all students
                        studentSelect.setValue(studentIds);
                    });
            }

            quizSelect.on('change', function() {
                classSelect.clear();
                fetchStudents();
            });

            classSelect.on('change', function() {
                fetchStudents();
            });
        });
    </script>
</x-dashboard.layout>
