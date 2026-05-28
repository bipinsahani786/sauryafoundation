<x-dashboard.layout>
    <x-slot name="title">Edit Event</x-slot>

    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Edit Event</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Update event details</p>
        </div>
        <a href="{{ route('admin.events.index') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold rounded-xl transition-colors">
            <i class="fas fa-arrow-left text-xs"></i> Back
        </a>
    </div>

    @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl mb-6 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 space-y-5">
                    <h3 class="text-sm font-black text-slate-700 uppercase tracking-widest border-b border-slate-50 pb-4">Event Details</h3>

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-widest mb-2">Title <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $event->title) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:outline-none focus:border-green-500 focus:bg-white transition-colors"
                               placeholder="Event title">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-widest mb-2">Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:outline-none focus:border-green-500 focus:bg-white transition-colors resize-none"
                                  placeholder="Describe the event...">{{ old('description', $event->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-widest mb-2">Location</label>
                        <input type="text" name="location" value="{{ old('location', $event->location) }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:outline-none focus:border-green-500 focus:bg-white transition-colors"
                               placeholder="e.g. Begusarai, Bihar">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-black text-slate-600 uppercase tracking-widest mb-2">Event Date <span class="text-rose-500">*</span></label>
                            <input type="date" name="event_date" value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}" required
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:outline-none focus:border-green-500 focus:bg-white transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-600 uppercase tracking-widest mb-2">Start Time</label>
                            <input type="time" name="start_time" value="{{ old('start_time', $event->start_time ? \Carbon\Carbon::createFromFormat('H:i:s', $event->start_time)->format('H:i') : '') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:outline-none focus:border-green-500 focus:bg-white transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-600 uppercase tracking-widest mb-2">End Time</label>
                            <input type="time" name="end_time" value="{{ old('end_time', $event->end_time ? \Carbon\Carbon::createFromFormat('H:i:s', $event->end_time)->format('H:i') : '') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:outline-none focus:border-green-500 focus:bg-white transition-colors">
                        </div>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6">
                    <h3 class="text-sm font-black text-slate-700 uppercase tracking-widest border-b border-slate-50 pb-4 mb-5">Event Image</h3>

                    @if($event->image)
                        <div class="mb-4">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-2">Current Image</p>
                            <img id="imagePreview" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover rounded-2xl">
                        </div>
                    @else
                        <img id="imagePreview" src="" alt="Preview" class="hidden mb-4 w-full h-48 object-cover rounded-2xl">
                    @endif

                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-colors group">
                        <i class="fas fa-cloud-upload-alt text-2xl text-slate-300 group-hover:text-green-500 transition-colors mb-1"></i>
                        <span class="text-xs font-bold text-slate-400">Click to replace image</span>
                        <span class="text-[10px] text-slate-300 mt-1">Max 2MB · JPG, PNG, WEBP</span>
                        <input type="file" name="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </label>
                </div>
            </div>

            <!-- Sidebar Options -->
            <div class="space-y-6">
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 space-y-5">
                    <h3 class="text-sm font-black text-slate-700 uppercase tracking-widest border-b border-slate-50 pb-4">Settings</h3>

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-widest mb-2">Category <span class="text-rose-500">*</span></label>
                        <select name="category" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:outline-none focus:border-green-500 focus:bg-white transition-colors">
                            <option value="event" {{ old('category', $event->category) === 'event' ? 'selected' : '' }}>Event</option>
                            <option value="workshop" {{ old('category', $event->category) === 'workshop' ? 'selected' : '' }}>Workshop</option>
                            <option value="campaign" {{ old('category', $event->category) === 'campaign' ? 'selected' : '' }}>Campaign</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-widest mb-2">Status <span class="text-rose-500">*</span></label>
                        <select name="status" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:outline-none focus:border-green-500 focus:bg-white transition-colors">
                            <option value="upcoming" {{ old('status', $event->status) === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="ongoing" {{ old('status', $event->status) === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ old('status', $event->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-widest mb-2">Icon Class</label>
                        <input type="text" name="icon" value="{{ old('icon', $event->icon) }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:outline-none focus:border-green-500 focus:bg-white transition-colors"
                               placeholder="e.g. fas fa-seedling">
                        <p class="text-[10px] text-slate-400 mt-1.5">FontAwesome class (shown when no image)</p>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-widest mb-2">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', $event->order) }}" min="0"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800 focus:outline-none focus:border-green-500 focus:bg-white transition-colors">
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <div>
                            <p class="text-xs font-black text-slate-700">Active</p>
                            <p class="text-[10px] text-slate-400">Show on frontend</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-200 peer-checked:bg-green-500 rounded-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-5"></div>
                        </label>
                    </div>
                </div>

                <button type="submit"
                        class="w-full py-3.5 bg-green-600 hover:bg-green-700 text-white font-black text-sm rounded-2xl transition-colors shadow-lg shadow-green-600/20">
                    <i class="fas fa-save mr-2"></i> Save Changes
                </button>

                <!-- Danger Zone -->
                <form action="{{ route('admin.events.destroy', $event) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this event?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full py-3 bg-rose-50 hover:bg-rose-100 text-rose-600 font-black text-sm rounded-2xl transition-colors border border-rose-100">
                        <i class="fas fa-trash mr-2"></i> Delete Event
                    </button>
                </form>
            </div>
        </div>
    </form>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-dashboard.layout>
