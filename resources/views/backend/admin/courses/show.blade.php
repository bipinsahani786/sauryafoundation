<x-dashboard.layout>
    <x-slot name="title">{{ $course->title }} | Global Course Builder</x-slot>

    @if(!$course->is_global && $course->studentClass)
        <div class="mb-4 pl-4">
            <h2 class="text-sm font-black text-indigo-600 uppercase tracking-[0.2em] italic drop-shadow-sm">TARGET: {{ $course->studentClass->name }}</h2>
        </div>
    @endif

    <div class="space-y-8" x-data="{ showSubjectModal: false }">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm relative overflow-hidden italic">
            @if($course->is_global)
                <div class="absolute top-0 right-0">
                    <span class="bg-indigo-600 text-white text-[7px] font-black uppercase tracking-[0.2em] px-4 py-1.5 rounded-bl-xl shadow-lg">Universal Global</span>
                </div>
            @endif
            <div class="flex items-center gap-6">
                <a href="{{ route('admin.courses.index') }}" class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center text-slate-400 hover:text-indigo-600 transition-all shadow-sm">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-[1.5rem] flex items-center justify-center shadow-inner">
                    <i class="fas fa-graduation-cap text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight uppercase italic">{{ $course->title }}</h1>
                    <div class="flex items-center gap-4 text-[9px] font-black uppercase tracking-widest text-slate-400 mt-1">
                        <span class="{{ $course->status == 'published' ? 'text-emerald-600' : 'text-amber-600' }}">{{ $course->status }}</span>
                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                        <span class="text-indigo-600">₹{{ number_format($course->price) }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.courses.edit', $course) }}" class="bg-slate-100 text-slate-600 px-6 py-3.5 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all shadow-sm italic flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this completely? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-rose-50 text-rose-600 px-6 py-3.5 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all shadow-sm italic flex items-center">
                        <i class="fas fa-trash-alt mr-2"></i> Delete
                    </button>
                </form>
                @if($course->status === 'draft')
                    <form action="{{ route('admin.courses.publish', $course) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-emerald-600 text-white px-8 py-3.5 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-900 transition-all shadow-xl shadow-emerald-100 italic">
                            <i class="fas fa-paper-plane mr-2"></i> Go Live
                        </button>
                    </form>
                @endif
                <button @click="showSubjectModal = true" class="bg-indigo-600 text-white px-8 py-3.5 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-900 transition-all shadow-xl shadow-indigo-100 italic">
                    <i class="fas fa-plus mr-2"></i> Add Subject
                </button>
            </div>
        </div>

        <!-- Course Builder Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Sidebar: Subjects & Topics -->
            <div class="md:col-span-1 space-y-4">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] px-4 italic">Syllabus Architecture</h3>
                <div class="space-y-3">
                    @foreach($course->subjects as $subject)
                        <div class="bg-white rounded-[2rem] border border-slate-200 overflow-hidden shadow-sm italic">
                            <div class="p-5 bg-slate-50/50 flex items-center justify-between border-b border-slate-50">
                                <span class="text-[10px] font-black text-slate-800 uppercase tracking-wider">{{ $subject->title }}</span>
                                <div x-data="{ showTopicModal: false, showEditSubjectModal: false }" class="flex items-center gap-1">
                                    <button @click="showEditSubjectModal = true" class="w-6 h-6 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-amber-500 hover:bg-amber-500 hover:text-white transition-all shadow-sm" title="Edit Subject">
                                        <i class="fas fa-edit text-[8px]"></i>
                                    </button>
                                    <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" onsubmit="return confirm('Delete this subject and ALL its topics?');" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-6 h-6 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-rose-500 hover:bg-rose-500 hover:text-white transition-all shadow-sm" title="Delete Subject">
                                            <i class="fas fa-trash-alt text-[8px]"></i>
                                        </button>
                                    </form>
                                    <button @click="showTopicModal = true" class="w-6 h-6 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all shadow-sm" title="Add Topic">
                                        <i class="fas fa-plus text-[8px]"></i>
                                    </button>
                                    
                                    <!-- Edit Subject Modal -->
                                    <div x-show="showEditSubjectModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4" x-cloak>
                                        <div @click.away="showEditSubjectModal = false" class="bg-white rounded-[2.5rem] p-10 max-w-sm w-full shadow-2xl italic">
                                            <h3 class="text-xl font-black text-slate-900 mb-2 italic">Edit Domain</h3>
                                            <form action="{{ route('admin.subjects.update', $subject) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="text" name="title" value="{{ $subject->title }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold mb-6 outline-none focus:border-indigo-600 italic uppercase" required>
                                                <div class="flex gap-4">
                                                    <button type="button" @click="showEditSubjectModal = false" class="flex-1 py-4 font-black text-slate-400 text-[9px] uppercase tracking-widest">Abort</button>
                                                    <button type="submit" class="flex-[2] bg-indigo-600 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest italic shadow-xl shadow-indigo-100">Update Domain</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <!-- Topic Modal -->
                                    <div x-show="showTopicModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4" x-cloak>
                                        <div @click.away="showTopicModal = false" class="bg-white rounded-[2.5rem] p-10 max-w-sm w-full shadow-2xl italic">
                                            <h3 class="text-xl font-black text-slate-900 mb-2 italic">New Topic Terminal</h3>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-6">Parent Subject: {{ $subject->title }}</p>
                                            <form action="{{ route('admin.subjects.add-topic', $subject) }}" method="POST">
                                                @csrf
                                                <input type="text" name="title" placeholder="Topic Heading" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold mb-6 outline-none focus:border-indigo-600 italic" required>
                                                <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest italic shadow-xl shadow-indigo-100">Establish Topic</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 space-y-1">
                                @foreach($subject->topics as $topic)
                                    <a href="#topic_{{ $topic->id }}" class="block w-full text-left px-4 py-3 rounded-xl text-[11px] font-black uppercase tracking-tight transition-all text-slate-500 hover:bg-slate-50 hover:text-indigo-600 italic">
                                        <i class="fas fa-caret-right mr-2 text-[8px] opacity-30"></i> {{ $topic->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Main Panel: Content Management -->
            <div class="md:col-span-3 space-y-8">
                @if($course->subjects->isEmpty())
                    <div class="bg-white rounded-[3rem] border-2 border-dashed border-slate-200 py-32 text-center shadow-sm">
                        <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-300">
                             <i class="fas fa-layer-group text-3xl"></i>
                        </div>
                        <h3 class="text-slate-900 font-black uppercase tracking-tight italic mb-2">Curriculum Terminal Empty</h3>
                        <p class="text-slate-400 text-xs font-bold italic max-w-xs mx-auto leading-relaxed">Initiate your first academic subject bracket to begin deployment.</p>
                        <button @click="showSubjectModal = true" class="mt-8 bg-indigo-600 text-white px-8 py-3.5 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-900 transition-all italic shadow-xl shadow-indigo-100">
                             <i class="fas fa-plus mr-2"></i> Deploy Primary Subject
                        </button>
                    </div>
                @else
                    @foreach($course->subjects as $subject)
                        @foreach($subject->topics as $topic)
                            <div id="topic_{{ $topic->id }}" class="bg-white rounded-[3rem] border border-slate-200 p-10 shadow-sm scroll-mt-24 italic group">
                                <div class="flex items-center justify-between mb-10 pb-6 border-b border-slate-100">
                                    <div>
                                        <span class="text-[9px] font-black text-indigo-600 uppercase tracking-[0.2em] italic mb-1 block">{{ $subject->title }} Terminal</span>
                                        <h2 class="text-2xl font-black text-slate-900 tracking-tight italic">{{ $topic->title }}</h2>
                                    </div>
                                    <div x-data="{ showContentModal: false, showEditTopicModal: false }" class="flex items-center gap-2">
                                        <button @click="showEditTopicModal = true" class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition-all shadow-sm flex items-center justify-center" title="Edit Topic">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        
                                        <form action="{{ route('admin.topics.destroy', $topic) }}" method="POST" onsubmit="return confirm('Delete this entire topic and all its content?');" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-10 h-10 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition-all shadow-sm flex items-center justify-center" title="Delete Topic">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>

                                        <button @click="showContentModal = true" class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl hover:bg-slate-900 hover:text-white transition-all shadow-inner flex items-center justify-center ml-2" title="Add Content">
                                            <i class="fas fa-plus"></i>
                                        </button>

                                        <!-- Edit Topic Modal -->
                                        <div x-show="showEditTopicModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4" x-cloak>
                                            <div @click.away="showEditTopicModal = false" class="bg-white rounded-[2.5rem] p-10 max-w-sm w-full shadow-2xl italic text-left">
                                                <h3 class="text-xl font-black text-slate-900 mb-2 italic">Edit Topic Terminal</h3>
                                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-6">Parent Subject: {{ $subject->title }}</p>
                                                <form action="{{ route('admin.topics.update', $topic) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <input type="text" name="title" value="{{ $topic->title }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold mb-6 outline-none focus:border-indigo-600 italic" required>
                                                    <div class="flex gap-4">
                                                        <button type="button" @click="showEditTopicModal = false" class="flex-1 py-4 font-black text-slate-400 text-[9px] uppercase tracking-widest text-center">Abort</button>
                                                        <button type="submit" class="flex-[2] bg-indigo-600 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest italic shadow-xl shadow-indigo-100">Update Topic</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Content Modal -->
                                        <div x-show="showContentModal" class="fixed inset-0 z-50 flex items-start justify-center bg-slate-900/40 backdrop-blur-sm p-4 overflow-y-auto pt-10" x-cloak>
                                            <div @click.away="showContentModal = false" class="bg-white rounded-[3rem] p-10 max-w-sm w-full shadow-2xl max-h-[90vh] overflow-y-auto custom-scrollbar italic" x-data="{ type: 'note' }">
                                                <h3 class="text-xl font-black text-slate-900 mb-2 italic">Inject Knowledge</h3>
                                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-8">Node: {{ $topic->title }}</p>
                                                
                                                <form action="{{ route('admin.topics.add-content', $topic) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                                    @csrf
                                                    <div class="grid grid-cols-3 gap-2 p-1.5 bg-slate-100 rounded-2xl shadow-inner">
                                                        <button type="button" @click="type = 'note'" :class="type === 'note' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'" class="py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all">Doc</button>
                                                        <button type="button" @click="type = 'video'" :class="type === 'video' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'" class="py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all">Vid</button>
                                                        <button type="button" @click="type = 'test'" :class="type === 'test' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-500'" class="py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all">Lab</button>
                                                    </div>
                                                    <input type="hidden" name="type" :value="type">
                                                    
                                                    <div class="space-y-4">
                                                        <input type="text" name="title" placeholder="Lesson Blueprint Title" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:border-indigo-600 transition-all italic" required>
                                                        
                                                        <div x-show="type === 'note'" class="space-y-6">
                                                            <textarea name="body" rows="6" placeholder="Knowledge transcription..." class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:border-indigo-600 italic"></textarea>
                                                            
                                                            <div class="p-10 border-2 border-dashed border-slate-200 rounded-[2rem] bg-slate-50 text-center group/pdf hover:border-indigo-300 hover:bg-indigo-50/50 transition-all">
                                                                <label class="cursor-pointer">
                                                                    <i class="fas fa-file-pdf text-3xl text-slate-300 mb-3 group-hover/pdf:text-indigo-500 transition-colors"></i>
                                                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest group-hover/pdf:text-slate-900 transition-colors">Binary PDF Attachment</p>
                                                                    <input type="file" name="attachment" class="hidden" accept="application/pdf" onchange="const name = this.files[0] ? this.files[0].name.substring(0, 20) + '...' : 'PDF Loaded'; this.nextElementSibling.innerText = name">
                                                                    <span class="text-[8px] font-black text-indigo-600 uppercase tracking-widest mt-2 block italic">AES-256 (PDF) < 10MB</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div x-show="type === 'video'">
                                                            <input type="text" name="body" placeholder="YouTube Universal ID" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:border-indigo-600 italic">
                                                            <p class="text-[8px] text-slate-400 mt-2 ml-2 italic">Paste full URL or just the video ID.</p>
                                                        </div>

                                                        <div x-show="type === 'test'">
                                                            <select name="quiz_id" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:border-indigo-600 italic appearance-none">
                                                                <option value="">Link Test Terminal</option>
                                                                @foreach($quizzes as $quiz)
                                                                    <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest italic shadow-xl shadow-indigo-100 hover:bg-slate-900 transition-all">Finalize Injection</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @php
                                        $contents = $topic->contents()->orderBy('order')->get();
                                    @endphp
                                    @foreach($contents as $content)
                                        <div class="flex items-center gap-6 p-6 rounded-[2rem] bg-white border border-slate-200 shadow-sm hover:shadow-xl transition-all group/card relative" x-data="{ showEditModal: false }">
                                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-inner transition-transform group-hover/card:scale-110 {{ $content->type === 'video' ? 'bg-rose-50 text-rose-600' : ($content->type === 'test' ? 'bg-amber-50 text-amber-600' : 'bg-indigo-50 text-indigo-600') }}">
                                                <i class="fas {{ $content->type === 'video' ? 'fa-play-circle text-xl' : ($content->type === 'test' ? 'fa-vial text-xl' : 'fa-file-signature text-xl') }}"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-black text-slate-900 truncate tracking-tight italic">{{ $content->title }}</h4>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <span class="text-[8px] text-slate-400 font-bold uppercase tracking-[0.2em] italic">{{ $content->type }} UNIT</span>
                                                    @if($content->attachment_path)
                                                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                                        <i class="fas fa-file-pdf text-red-400 text-[8px]"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="flex items-center gap-2 opacity-0 group-hover/card:opacity-100 transition-opacity">
                                                @if($content->attachment_path)
                                                    <a href="{{ asset('storage/' . $content->attachment_path) }}" target="_blank" class="w-9 h-9 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                                        <i class="fas fa-eye text-xs"></i>
                                                    </a>
                                                @endif
                                                
                                                <button @click="showEditModal = true" class="w-9 h-9 bg-slate-50 text-slate-600 rounded-xl flex items-center justify-center hover:bg-slate-900 hover:text-white transition-all shadow-sm">
                                                    <i class="fas fa-edit text-xs"></i>
                                                </button>

                                                <form action="{{ route('admin.contents.destroy', $content) }}" method="POST" onsubmit="return confirm('Purge this knowledge node?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="w-9 h-9 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                                        <i class="fas fa-trash-alt text-xs"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Edit Content Modal -->
                                            <div x-show="showEditModal" class="fixed inset-0 z-50 flex items-start justify-center bg-slate-900/40 backdrop-blur-sm p-4 overflow-y-auto pt-10" x-cloak>
                                                <div @click.away="showEditModal = false" class="bg-white rounded-[3rem] p-10 max-w-sm w-full shadow-2xl max-h-[90vh] overflow-y-auto custom-scrollbar italic">
                                                    <h3 class="text-xl font-black text-slate-900 mb-2 italic">Re-Blueprint</h3>
                                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-8">Node Fix: {{ $content->title }}</p>

                                                    <form action="{{ route('admin.contents.update', $content) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                                        @csrf @method('PUT')
                                                        
                                                        <div class="space-y-4">
                                                            <div class="space-y-1.5">
                                                                <label class="text-[8px] font-black text-slate-400 uppercase tracking-widest ml-4">Title Update</label>
                                                                <input type="text" name="title" value="{{ $content->title }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:border-indigo-600 italic shadow-inner" required>
                                                            </div>
                                                            
                                                            @if($content->type === 'note')
                                                                <div class="space-y-1.5">
                                                                    <label class="text-[8px] font-black text-slate-400 uppercase tracking-widest ml-4">Transcription Update</label>
                                                                    <textarea name="body" rows="6" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:border-indigo-600 shadow-inner italic">{{ $content->body }}</textarea>
                                                                </div>

                                                                <div class="p-8 border-2 border-dashed border-slate-200 rounded-[2rem] bg-slate-50 text-center group/repdf hover:border-indigo-300 transition-all">
                                                                    <label class="cursor-pointer">
                                                                        <i class="fas fa-file-pdf text-3xl text-slate-300 mb-2 opacity-50"></i>
                                                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic leading-none">
                                                                            {{ $content->attachment_path ? 'Overwrite Document' : 'Supply Document' }}
                                                                        </p>
                                                                        <input type="file" name="attachment" class="hidden" accept="application/pdf">
                                                                        <span class="text-[8px] font-black text-indigo-600 uppercase tracking-widest mt-2 block">BINARY PDF < 10MB</span>
                                                                    </label>
                                                                </div>
                                                            @elseif($content->type === 'video')
                                                                <div class="space-y-1.5">
                                                                    <label class="text-[8px] font-black text-slate-400 uppercase tracking-widest ml-4">Stream ID Correction</label>
                                                                    <input type="text" name="body" value="{{ $content->body }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:border-indigo-600 italic">
                                                                </div>
                                                            @else
                                                                <div class="space-y-1.5">
                                                                    <label class="text-[8px] font-black text-slate-400 uppercase tracking-widest ml-4">Link New Test Node</label>
                                                                    <select name="quiz_id" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold outline-none focus:border-indigo-600 appearance-none italic">
                                                                        @foreach($quizzes as $quiz)
                                                                            <option value="{{ $quiz->id }}" {{ $content->quiz_id == $quiz->id ? 'selected' : '' }}>{{ $quiz->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        
                                                        <div class="flex gap-4 pt-4">
                                                            <button type="button" @click="showEditModal = false" class="flex-1 py-4 text-slate-400 font-black text-[9px] uppercase tracking-widest italic">Cancel</button>
                                                            <button type="submit" class="flex-[2] bg-indigo-600 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest italic shadow-xl shadow-indigo-100">Sync Blueprint</button>
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
            <div @click.away="showSubjectModal = false" class="bg-white rounded-[3rem] p-12 max-w-sm w-full shadow-2xl italic">
                <div class="mb-8">
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight italic">Initialize Domain</h3>
                    <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Foundational academic unit bracket.</p>
                </div>
                <form action="{{ route('admin.courses.add-subject', $course) }}" method="POST">
                    @csrf
                    <input type="text" name="title" placeholder="e.g. CORE QUANTITATIVE" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold mb-8 outline-none focus:border-indigo-600 italic uppercase" required>
                    <div class="flex gap-4">
                        <button type="button" @click="showSubjectModal = false" class="flex-1 py-4 font-black text-slate-400 text-[9px] uppercase tracking-widest">Abort</button>
                        <button type="submit" class="flex-[2] bg-indigo-600 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest italic shadow-xl shadow-indigo-100">Establish Domain</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard.layout>
