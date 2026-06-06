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
                @if($course->status === 'draft')
                    <form action="{{ route('teacher.courses.publish', $course) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-bold text-xs hover:bg-emerald-700 transition-all">
                            <i class="fas fa-paper-plane mr-2"></i> Publish Course
                        </button>
                    </form>
                @else
                    <form action="{{ route('teacher.courses.unpublish', $course) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-slate-600 text-white px-5 py-2.5 rounded-xl font-bold text-xs hover:bg-slate-700 transition-all">
                            <i class="fas fa-eye-slash mr-2"></i> Unpublish
                        </button>
                    </form>
                @endif
                <a href="{{ route('teacher.courses.edit', $course) }}" class="bg-slate-100 text-slate-600 px-5 py-2.5 rounded-xl font-bold text-xs hover:bg-slate-200 transition-all">
                    <i class="fas fa-edit mr-2"></i> Edit Course
                </a>
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
                <div class="space-y-4">
                    @foreach($course->subjects as $subject)
                        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                            <div class="p-4 bg-slate-50/50 flex flex-col gap-2 border-b border-slate-50">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black text-slate-700">{{ $subject->title }}</span>
                                    <div class="flex items-center gap-1">
                                        <button @click="const title = prompt('Rename Subject', '{{ $subject->title }}'); if(title) { document.getElementById('update_subject_{{ $subject->id }}').title.value = title; document.getElementById('update_subject_{{ $subject->id }}').submit(); }" class="text-[10px] text-slate-400 hover:text-indigo-600"><i class="fas fa-edit"></i></button>
                                        <form id="update_subject_{{ $subject->id }}" action="{{ route('teacher.subjects.update', $subject) }}" method="POST" class="hidden">@csrf @method('PUT') <input type="hidden" name="title"></form>
                                        
                                        <form action="{{ route('teacher.subjects.destroy', $subject) }}" method="POST" onsubmit="return confirm('Delete this subject and all its topics?')">@csrf @method('DELETE') <button type="submit" class="text-[10px] text-slate-400 hover:text-red-600"><i class="fas fa-trash"></i></button></form>
                                    </div>
                                </div>
                                <div x-data="{ showTopicModal: false }">
                                    <button @click="showTopicModal = true" class="text-[10px] text-indigo-600 font-bold hover:underline tracking-tight"><i class="fas fa-plus mr-1"></i> Add Topic</button>
                                    
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
                                    <div class="group flex items-center justify-between px-3 py-2 rounded-lg transition-all hover:bg-slate-50">
                                        <button class="flex-1 text-left text-xs font-bold {{ isset($activeTopic) && $activeTopic->id === $topic->id ? 'text-indigo-700' : 'text-slate-500' }}">
                                            {{ $topic->title }}
                                        </button>
                                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button @click="const title = prompt('Rename Topic', '{{ $topic->title }}'); if(title) { document.getElementById('update_topic_{{ $topic->id }}').title.value = title; document.getElementById('update_topic_{{ $topic->id }}').submit(); }" class="text-[9px] text-slate-400 hover:text-indigo-600"><i class="fas fa-edit"></i></button>
                                            <form id="update_topic_{{ $topic->id }}" action="{{ route('teacher.topics.update', $topic) }}" method="POST" class="hidden">@csrf @method('PUT') <input type="hidden" name="title"></form>
                                            
                                            <form action="{{ route('teacher.topics.destroy', $topic) }}" method="POST" onsubmit="return confirm('Delete this topic?')">@csrf @method('DELETE') <button type="submit" class="text-[9px] text-slate-400 hover:text-red-600"><i class="fas fa-trash"></i></button></form>
                                        </div>
                                    </div>
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
                                        <div x-show="showContentModal" class="fixed inset-0 z-50 flex items-start justify-center bg-slate-900/40 backdrop-blur-sm p-4 overflow-y-auto pt-10" x-cloak>
                                            <div @click.away="showContentModal = false" class="bg-white rounded-[2rem] p-8 max-w-md w-full shadow-2xl max-h-[90vh] overflow-y-auto custom-scrollbar" x-data="{ type: 'note' }">
                                                <h3 class="text-lg font-black text-slate-900 mb-6">Add Content to {{ $topic->title }}</h3>
                                                <form id="add_content_form_{{ $topic->id }}" action="{{ route('teacher.topics.add-content', $topic) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                                    @csrf
                                                    <div class="grid grid-cols-3 gap-2 p-1 bg-slate-50 rounded-xl">
                                                        <button type="button" @click="type = 'note'" :class="type === 'note' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'" class="py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Note</button>
                                                        <button type="button" @click="type = 'video'" :class="type === 'video' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'" class="py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Video</button>
                                                        <button type="button" @click="type = 'test'" :class="type === 'test' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'" class="py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Test</button>
                                                    </div>
                                                    <input type="hidden" name="type" :value="type">
                                                    
                                                    <div class="space-y-3">
                                                        <input type="text" name="title" id="content_title_{{ $topic->id }}" placeholder="Content Title" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm font-bold outline-none focus:border-indigo-600 transition-all font-bold" required>
                                                        
                                                        <div x-show="type === 'note'" class="space-y-4">
                                                            <textarea name="body" id="content_body_{{ $topic->id }}" rows="4" placeholder="Type your text notes here..." class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm font-medium outline-none focus:border-indigo-600 font-medium"></textarea>
                                                            
                                                            <div class="p-5 border-2 border-dashed border-slate-100 rounded-[1.5rem] bg-slate-50 text-center group hover:border-indigo-200 transition-all">
                                                                <label class="cursor-pointer">
                                                                    <i class="fas fa-file-import text-2xl text-slate-300 mb-2 group-hover:text-indigo-400 transition-colors"></i>
                                                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-indigo-600 transition-colors">Attach PDF / Image Resources</p>
                                                                    <input type="file" name="attachment" id="content_pdf_{{ $topic->id }}" class="hidden" accept="application/pdf,image/*" onchange="const name = this.files[0] ? this.files[0].name : 'Attachment Selected'; this.nextElementSibling.innerText = name">
                                                                    <span class="text-[8px] font-black text-indigo-600 uppercase tracking-widest mt-1 block">Max 10MB PDF/Image</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div x-show="type === 'video'">
                                                            <input type="text" name="body" id="content_video_url_{{ $topic->id }}" placeholder="YouTube Video URL" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm font-medium outline-none focus:border-indigo-600 font-medium">
                                                        </div>

                                                        <div x-show="type === 'test'">
                                                            <select name="quiz_id" id="content_quiz_id_{{ $topic->id }}" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm font-bold outline-none focus:border-indigo-600">
                                                                <option value="">Select a Quiz</option>
                                                                @foreach($quizzes as $quiz)
                                                                    <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <button type="submit" id="content_submit_btn_{{ $topic->id }}" class="w-full bg-indigo-600 text-white py-4 rounded-xl font-black text-xs uppercase tracking-widest mt-4 shadow-lg shadow-indigo-100 hover:-translate-y-0.5 transition-all">Publish Lesson Content</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($topic->contents as $content)
                                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-white border border-slate-100 shadow-sm hover:shadow-md transition-all group" x-data="{ showEditModal: false }">
                                            <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ $content->type === 'video' ? 'bg-rose-50 text-rose-600' : ($content->type === 'test' ? 'bg-amber-50 text-amber-600' : 'bg-indigo-50 text-indigo-600') }} transition-transform group-hover:scale-110">
                                                <i class="fas {{ $content->type === 'video' ? 'fa-play' : ($content->type === 'test' ? 'fa-vial' : 'fa-file-alt') }} text-xs"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-[11px] font-black text-slate-900 truncate tracking-tight">{{ $content->title }}</h4>
                                                <div class="flex items-center gap-2">
                                                    <p class="text-[8px] text-slate-400 font-bold uppercase tracking-[0.2em]">{{ $content->type }}</p>
                                                    @if($content->attachment_path)
                                                        @php
                                                            $ext = strtolower(pathinfo($content->attachment_path, PATHINFO_EXTENSION));
                                                            $isImg = in_array($ext, ['png', 'jpg', 'jpeg', 'webp', 'gif']);
                                                        @endphp
                                                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                                        <i class="fas {{ $isImg ? 'fa-file-image text-emerald-500' : 'fa-file-pdf text-red-400' }} text-[8px]"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                @if($content->attachment_path)
                                                    <a href="{{ route('courses.download-attachment', $content) }}" target="_blank" id="view_pdf_{{ $content->id }}" class="w-7 h-7 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all shadow-sm" title="View Attachment">
                                                        <i class="fas fa-eye text-[10px]"></i>
                                                    </a>
                                                @endif
                                                
                                                <button @click="showEditModal = true" id="edit_content_{{ $content->id }}" class="w-7 h-7 bg-slate-50 text-slate-600 rounded-lg flex items-center justify-center hover:bg-slate-900 hover:text-white transition-all shadow-sm" title="Edit">
                                                    <i class="fas fa-pencil-alt text-[10px]"></i>
                                                </button>

                                                <form action="{{ route('teacher.contents.destroy', $content) }}" method="POST" onsubmit="return confirm('Archive this lesson? (Cannot be undone)')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" id="delete_content_{{ $content->id }}" class="w-7 h-7 bg-red-50 text-red-600 rounded-lg flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm" title="Delete">
                                                        <i class="fas fa-trash text-[10px]"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Edit Content Modal -->
                                            <div x-show="showEditModal" class="fixed inset-0 z-50 flex items-start justify-center bg-slate-900/40 backdrop-blur-sm p-4 overflow-y-auto pt-10" x-cloak>
                                                <div @click.away="showEditModal = false" class="bg-white rounded-[2rem] p-8 max-w-md w-full shadow-2xl max-h-[90vh] overflow-y-auto custom-scrollbar" x-data="{ type: '{{ $content->type }}' }">
                                                    <div class="flex items-center justify-between mb-8">
                                                        <div>
                                                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Edit Lesson</h3>
                                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Modifying content for {{ $topic->title }}</p>
                                                        </div>
                                                        <button @click="showEditModal = false" class="text-slate-300 hover:text-slate-900 transition-colors"><i class="fas fa-times"></i></button>
                                                    </div>

                                                    <form id="edit_content_form_{{ $content->id }}" action="{{ route('teacher.contents.update', $content) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <div class="space-y-4">
                                                            <div class="space-y-1.5">
                                                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Lesson Title</label>
                                                                <input type="text" name="title" value="{{ $content->title }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold outline-none focus:border-indigo-600 shadow-inner" required>
                                                            </div>
                                                            
                                                            @if($content->type === 'note')
                                                                <div class="space-y-1.5">
                                                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Text Notes</label>
                                                                    <textarea name="body" rows="6" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 text-sm font-medium outline-none focus:border-indigo-600 shadow-inner leading-relaxed">{{ $content->body }}</textarea>
                                                                </div>

                                                                <div class="p-6 border-2 border-dashed border-slate-100 rounded-[1.5rem] bg-slate-50 text-center group hover:border-indigo-200 transition-all relative overflow-hidden">
                                                                    <label class="cursor-pointer">
                                                                        <i class="fas fa-file-import text-2xl text-slate-300 mb-2 group-hover:text-indigo-400 transition-colors"></i>
                                                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-indigo-600 transition-colors">
                                                                            {{ $content->attachment_path ? 'Replace Attachment' : 'Attach PDF / Image Resources' }}
                                                                        </p>
                                                                        <input type="file" name="attachment" class="hidden" accept="application/pdf,image/*" onchange="const name = this.files[0] ? this.files[0].name : 'Attachment Selected'; this.nextElementSibling.innerText = name">
                                                                        <span class="text-[8px] font-black text-indigo-600 uppercase tracking-widest mt-1 block">Max 10MB PDF/Image</span>
                                                                    </label>
                                                                </div>
                                                            @elseif($content->type === 'video')
                                                                <div class="space-y-1.5">
                                                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">YouTube URL</label>
                                                                    <input type="text" name="body" value="{{ $content->body }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 text-sm font-medium outline-none focus:border-indigo-600 shadow-inner">
                                                                </div>
                                                            @else
                                                                <div class="space-y-1.5">
                                                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Select Quiz</label>
                                                                    <select name="quiz_id" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold outline-none focus:border-indigo-600">
                                                                        @foreach($quizzes as $quiz)
                                                                            <option value="{{ $quiz->id }}" {{ $content->quiz_id == $quiz->id ? 'selected' : '' }}>{{ $quiz->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        
                                                        <div class="flex gap-4 pt-4">
                                                            <button type="button" @click="showEditModal = false" class="flex-1 py-4 text-slate-400 font-bold text-[10px] uppercase tracking-[0.2em] hover:text-slate-900 transition-colors">Cancel</button>
                                                            <button type="submit" class="flex-[2] bg-indigo-600 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:shadow-indigo-200 transition-all">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
