<x-dashboard.layout>
    <x-slot name="title">Edit Course | {{ $course->title }}</x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-black text-slate-900 tracking-tight">Modify Course Details</h1>
                        <p class="text-slate-500 text-sm font-medium">Updating identity for {{ $course->title }}</p>
                    </div>
                    <form action="{{ route('teacher.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('EXTREME CAUTION: This will delete the course and all its contents permanently. Proceed?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-4 bg-red-50 text-red-600 rounded-3xl hover:bg-red-600 hover:text-white transition-all shadow-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>

            <form action="{{ route('teacher.courses.update', $course) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="space-y-1.5">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Course Title</label>
                    <input type="text" name="title" value="{{ $course->title }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3 text-sm font-bold outline-none focus:border-indigo-600 transition-all shadow-inner" required>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Description</label>
                    <textarea name="description" rows="4" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3 text-sm font-medium outline-none focus:border-indigo-600 transition-all shadow-inner">{{ $course->description }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Target Class (Grade)</label>
                        <select name="class_id" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3 text-sm font-bold outline-none focus:border-indigo-600 transition-all appearance-none shadow-inner" required>
                            @foreach($classes as $studentClass)
                                <option value="{{ $studentClass->id }}" {{ $course->class_id == $studentClass->id ? 'selected' : '' }}>{{ $studentClass->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Enrollment Price (₹)</label>
                        <input type="number" name="price" value="{{ $course->price }}" min="0" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3 text-sm font-bold outline-none focus:border-indigo-600 transition-all shadow-inner" required>
                    </div>
                </div>

                <div class="pt-4 flex items-center border-t border-slate-50 mt-8 gap-4">
                    <a href="{{ route('teacher.courses.show', $course) }}" class="flex-1 text-center py-4 text-slate-500 font-bold text-sm hover:text-slate-700 transition-colors">Cancel</a>
                    <button type="submit" class="flex-[2] bg-indigo-600 text-white font-black py-4 rounded-2xl text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                        Update Essence <i class="fas fa-check-circle ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>
