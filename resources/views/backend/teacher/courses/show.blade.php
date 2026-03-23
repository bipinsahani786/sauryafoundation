<x-dashboard.layout>
    <x-slot name="title">{{ $course->title }} | Course Builder</x-slot>

    <div class="space-y-8" x-data="{ showSubjectModal: false }">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-book-bookmark text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black text-slate-900 tracking-tight">{{ $course->title }}</h1>
                    <div class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-slate-400">
                        <span>{{ $course->status }}</span>
                        <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                        <span>₹{{ $course->price }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button @click="showSubjectModal = true" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold text-xs hover:bg-indigo-700 transition-all">
                    <i class="fas fa-plus mr-2"></i> Add Subject
                </button>
            </div>
        </div>

        <!-- Course Builder Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Sidebar: Subjects & Topics -->
            <div class="md:col-span-1 space-y-4">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Course Syllabus</h3>
                <div class="space-y-2">
                    @foreach($course->subjects as $subject)
                        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                            <div class="p-4 bg-slate-50/50 flex items-center justify-between border-b border-slate-50">
                                <span class="text-xs font-black text-slate-700">{{ $subject->title }}</span>
                                <div x-data="{ showTopicModal: false }">
                                    <button @click="showTopicModal = true" class="text-[10px] text-indigo-600 font-bold hover:underline">Add Topic</button>
                                    
                                    <!-- Topic Modal -->
                                    <div x-show="showTopicModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4" x-cloak>
                                        <div @click.away="showTopicModal = false" class="bg-white rounded-[2rem] p-8 max-w-sm w-full shadow-2xl">
                                            <h3 class="text-lg font-black text-slate-900 mb-4">New Topic for {{ $subject->title }}</h3>
                                            <form action="{{ route('teacher.subjects.add-topic', $subject) }}" method="POST">
                                                @csrf
                                                <input type="text" name="title" placeholder="Topic Title" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm font-bold mb-4 outline-none focus:border-indigo-600" required>
                                                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-black text-xs uppercase tracking-widest">Create Topic</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 space-y-1">
                                @foreach($subject->topics as $topic)
                                    <button class="w-full text-left px-3 py-2 rounded-lg text-xs font-bold transition-all {{ isset($activeTopic) && $activeTopic->id === $topic->id ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50' }}">
                                        {{ $topic->title }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Main Panel: Content Management -->
            <div class="md:col-span-3 space-y-6">
                @if($course->subjects->isEmpty())
                    <div class="bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200 py-32 text-center">
                        <i class="fas fa-layer-group text-4xl text-slate-300 mb-4"></i>
                        <h3 class="text-slate-900 font-bold">Build Your Syllabus</h3>
                        <p class="text-slate-500 text-sm max-w-xs mx-auto">Start by adding a subject like "Physics" or "General Awareness".</p>
                    </div>
                @else
                    @foreach($course->subjects as $subject)
                        @foreach($subject->topics as $topic)
                            <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
                                <div class="flex items-center justify-between mb-8">
                                    <div>
                                        <span class="text-[9px] font-black text-indigo-600 uppercase tracking-widest">{{ $subject->title }}</span>
                                        <h2 class="text-xl font-black text-slate-900">{{ $topic->title }}</h2>
                                    </div>
                                    <div x-data="{ showContentModal: false }">
                                        <button @click="showContentModal = true" class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl hover:bg-indigo-100 transition-all">
                                            <i class="fas fa-plus"></i>
                                        </button>

                                        <!-- Content Modal -->
                                        <div x-show="showContentModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4" x-cloak>
                                            <div @click.away="showContentModal = false" class="bg-white rounded-[2rem] p-8 max-w-md w-full shadow-2xl" x-data="{ type: 'note' }">
                                                <h3 class="text-lg font-black text-slate-900 mb-6">Add Content to {{ $topic->title }}</h3>
                                                <form action="{{ route('teacher.topics.add-content', $topic) }}" method="POST" class="space-y-4">
                                                    @csrf
                                                    <div class="grid grid-cols-3 gap-2 p-1 bg-slate-50 rounded-xl">
                                                        <button type="button" @click="type = 'note'" :class="type === 'note' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'" class="py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Note</button>
                                                        <button type="button" @click="type = 'video'" :class="type === 'video' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'" class="py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Video</button>
                                                        <button type="button" @click="type = 'test'" :class="type === 'test' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'" class="py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Test</button>
                                                    </div>
                                                    <input type="hidden" name="type" :value="type">
                                                    
                                                    <div class="space-y-3">
                                                        <input type="text" name="title" placeholder="Content Title" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm font-bold outline-none focus:border-indigo-600" required>
                                                        
                                                        <div x-show="type === 'note'">
                                                            <textarea name="body" rows="4" placeholder="Type your notes here..." class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm font-medium outline-none focus:border-indigo-600"></textarea>
                                                        </div>

                                                        <div x-show="type === 'video'">
                                                            <input type="text" name="body" placeholder="YouTube Video URL" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm font-medium outline-none focus:border-indigo-600">
                                                        </div>

                                                        <div x-show="type === 'test'">
                                                            <select name="quiz_id" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm font-bold outline-none focus:border-indigo-600">
                                                                <option value="">Select a Quiz</option>
                                                                @foreach($quizzes as $quiz)
                                                                    <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-xl font-black text-xs uppercase tracking-widest mt-4">Publish Content</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($topic->contents as $content)
                                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                            <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ $content->type === 'video' ? 'bg-rose-100 text-rose-600' : ($content->type === 'test' ? 'bg-amber-100 text-amber-600' : 'bg-indigo-100 text-indigo-600') }}">
                                                <i class="fas {{ $content->type === 'video' ? 'fa-play' : ($content->type === 'test' ? 'fa-vial' : 'fa-file-alt') }} text-sm"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-xs font-black text-slate-900 truncate">{{ $content->title }}</h4>
                                                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-widest">{{ $content->type }}</p>
                                            </div>
                                            <button class="text-slate-300 hover:text-rose-500 transition-colors">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Subject Modal -->
        <div x-show="showSubjectModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4" x-cloak>
            <div @click.away="showSubjectModal = false" class="bg-white rounded-[3rem] p-10 max-w-md w-full shadow-2xl">
                <div class="mb-6">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Add New Subject</h3>
                    <p class="text-slate-500 text-xs font-medium">Create a new academic unit for this course.</p>
                </div>
                <form action="{{ route('teacher.courses.add-subject', $course) }}" method="POST">
                    @csrf
                    <input type="text" name="title" placeholder="e.g., Organic Chemistry" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-bold mb-6 outline-none focus:border-indigo-600 transition-all" required>
                    <div class="flex gap-4">
                        <button type="button" @click="showSubjectModal = false" class="flex-1 py-3.5 font-bold text-slate-400 text-xs uppercase tracking-widest">Cancel</button>
                        <button type="submit" class="flex-[2] bg-indigo-600 text-white py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-indigo-100">Deploy Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard.layout>
