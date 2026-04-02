<x-dashboard.layout>
    <x-slot name="title">Edit Testimonial</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.testimonials.index') }}" class="text-xs font-bold text-slate-400 hover:text-indigo-600 transition-all uppercase tracking-widest flex items-center gap-2 mb-4">
            <i class="fas fa-arrow-left"></i> Back to Testimonials
        </a>
        <h2 class="text-xl font-bold text-slate-900 tracking-tight text-[11px] uppercase tracking-[0.2em]">Edit review</h2>
        <p class="text-xs text-slate-400 font-medium italic">Update the customer review details.</p>
    </div>

    <div class="max-w-3xl">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Client Name</label>
                        <input type="text" name="name" placeholder="John Doe" value="{{ old('name', $testimonial->name) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-xs font-bold focus:border-indigo-500 outline-none transition-all italic" required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Designation</label>
                        <input type="text" name="designation" placeholder="CEO, Tech Corp" value="{{ old('designation', $testimonial->designation) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-xs font-bold focus:border-indigo-500 outline-none transition-all italic" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Review Content</label>
                    <textarea name="content" rows="4" placeholder="Share the feedback here..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-xs font-bold focus:border-indigo-500 outline-none transition-all italic leading-relaxed" required>{{ old('content', $testimonial->content) }}</textarea>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Rating (1-5)</label>
                        <select name="rating" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-xs font-bold focus:border-indigo-500 outline-none transition-all italic">
                            <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>5 Stars</option>
                            <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>4 Stars</option>
                            <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>3 Stars</option>
                            <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>2 Stars</option>
                            <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>1 Star</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Profile Image</label>
                        @if($testimonial->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $testimonial->image) }}" class="h-16 w-16 object-cover rounded-xl border border-slate-200">
                            </div>
                        @endif
                        <input type="file" name="image" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-400 text-[10px] font-bold focus:border-indigo-500 outline-none transition-all italic">
                    </div>
                </div>

                <div class="flex items-center gap-3 py-2">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600 font-black"></div>
                    </label>
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Mark as Active</span>
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-xl text-[10px] font-black uppercase tracking-[0.2em] shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all">Update Testimonial</button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>
