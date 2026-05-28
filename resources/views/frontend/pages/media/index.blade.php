<x-frontend.layout>
    @php
        $settings = \App\Models\Setting::getAll();
        $heroImage = isset($settings['media_hero_image']) ? asset('storage/' . $settings['media_hero_image']) : 'https://images.unsplash.com/photo-1543269865-cbf427effbad?q=80&w=2000&auto=format&fit=crop';
        $videoThumb = isset($settings['media_featured_video_thumbnail']) ? asset('storage/' . $settings['media_featured_video_thumbnail']) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1200&auto=format&fit=crop';
        $videoUrl = $settings['media_featured_video_url'] ?? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
    @endphp

    <!-- Parallax Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden min-h-[60vh] flex items-center bg-fixed bg-center bg-cover" 
         style="background-image: url('{{ $heroImage }}');">
        
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#031533]/95 via-[#031533]/80 to-transparent z-0"></div>
        <div class="absolute inset-0 bg-black/30 z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="max-w-3xl" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white mb-6 tracking-tight leading-tight">
                    Media & Stories
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-8 font-medium leading-relaxed max-w-2xl">
                    Discover our latest news, inspiring stories, gallery and videos that showcase the impact of our work.
                </p>
                <div class="flex items-center gap-3 text-sm font-bold text-gray-300">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                    <span class="text-green-500">Media</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog & News Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-black text-[#031533] tracking-tight">Blog & News</h2>
                <a href="#" class="hidden md:flex text-green-600 font-bold hover:text-green-800 transition-colors items-center gap-2 text-sm uppercase tracking-widest">
                    View All Posts <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Blog 1 -->
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-300 hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-48 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Tree Plantation">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-3">
                            <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full uppercase tracking-wider">Environment</span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider"><i class="far fa-calendar-alt mr-1"></i> May 12, 2025</span>
                        </div>
                        <h3 class="text-lg font-black text-gray-900 mb-2 leading-snug">Tree Plantation Drive 2025</h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">Volunteers came together to make our environment greener and healthier.</p>
                        <a href="#" class="text-green-600 text-xs font-bold hover:text-green-800 transition-colors">Read More &rarr;</a>
                    </div>
                </div>

                <!-- Blog 2 -->
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-300 hover:-translate-y-1" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-48 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1576765608532-0739c1482f33?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Health Camp">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-3">
                            <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full uppercase tracking-wider">Health</span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider"><i class="far fa-calendar-alt mr-1"></i> May 08, 2025</span>
                        </div>
                        <h3 class="text-lg font-black text-gray-900 mb-2 leading-snug">Free Health Camp in Rural Areas</h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">A step towards healthier communities with free checkups and medicines.</p>
                        <a href="#" class="text-green-600 text-xs font-bold hover:text-green-800 transition-colors">Read More &rarr;</a>
                    </div>
                </div>

                <!-- Blog 3 -->
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-300 hover:-translate-y-1" data-aos="fade-up" data-aos-delay="300">
                    <div class="h-48 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1590402494587-44b71d7772f6?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Women Empowerment">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-3">
                            <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full uppercase tracking-wider">Women Empowerment</span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider"><i class="far fa-calendar-alt mr-1"></i> May 04, 2025</span>
                        </div>
                        <h3 class="text-lg font-black text-gray-900 mb-2 leading-snug">Empowering Women Through Skills</h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">Skill training program helping women become independent and confident.</p>
                        <a href="#" class="text-green-600 text-xs font-bold hover:text-green-800 transition-colors">Read More &rarr;</a>
                    </div>
                </div>

                <!-- Blog 4 -->
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-300 hover:-translate-y-1" data-aos="fade-up" data-aos-delay="400">
                    <div class="h-48 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Education">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-3">
                            <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full uppercase tracking-wider">Education</span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider"><i class="far fa-calendar-alt mr-1"></i> Apr 28, 2025</span>
                        </div>
                        <h3 class="text-lg font-black text-gray-900 mb-2 leading-snug">Education Support Drive 2025</h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">Providing books, stationery and learning support to underprivileged children.</p>
                        <a href="#" class="text-green-600 text-xs font-bold hover:text-green-800 transition-colors">Read More &rarr;</a>
                    </div>
                </div>
            </div>
            
            <a href="#" class="mt-8 flex md:hidden text-green-600 font-bold hover:text-green-800 transition-colors items-center justify-center gap-2 text-sm uppercase tracking-widest w-full">
                View All Posts <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Latest Updates Section -->
    <div class="py-16 bg-gray-50 border-t border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-10" data-aos="fade-up">
                <h2 class="text-3xl font-black text-[#031533] tracking-tight">Latest Updates</h2>
                <a href="#" class="hidden md:flex text-green-600 font-bold hover:text-green-800 transition-colors items-center gap-2 text-sm uppercase tracking-widest">
                    View All Updates <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="flex overflow-x-auto gap-6 pb-6 custom-scrollbar snap-x">
                <!-- Update 1 -->
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all flex gap-4 min-w-[300px] md:min-w-[350px] snap-start" data-aos="fade-right" data-aos-delay="100">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center shrink-0">
                        <i class="{{ $settings['media_update_1_icon'] ?? 'fas fa-desktop' }} text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-gray-900 mb-1">{{ $settings['media_update_1_title'] ?? 'New Computer Lab Inaugurated' }}</h4>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2"><i class="far fa-calendar-alt mr-1"></i> {{ $settings['media_update_1_date'] ?? 'May 15, 2025' }}</p>
                        <p class="text-xs text-gray-600">{{ $settings['media_update_1_desc'] ?? 'A new computer lab established for students.' }}</p>
                    </div>
                </div>

                <!-- Update 2 -->
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all flex gap-4 min-w-[300px] md:min-w-[350px] snap-start" data-aos="fade-right" data-aos-delay="200">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center shrink-0">
                        <i class="{{ $settings['media_update_2_icon'] ?? 'fas fa-hand-holding-heart' }} text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-gray-900 mb-1">{{ $settings['media_update_2_title'] ?? 'Donation Drive Success' }}</h4>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2"><i class="far fa-calendar-alt mr-1"></i> {{ $settings['media_update_2_date'] ?? 'May 10, 2025' }}</p>
                        <p class="text-xs text-gray-600">{{ $settings['media_update_2_desc'] ?? 'Thank you to all donors for your generous support.' }}</p>
                    </div>
                </div>

                <!-- Update 3 -->
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all flex gap-4 min-w-[300px] md:min-w-[350px] snap-start" data-aos="fade-right" data-aos-delay="300">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center shrink-0">
                        <i class="{{ $settings['media_update_3_icon'] ?? 'fas fa-hands-wash' }} text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-gray-900 mb-1">{{ $settings['media_update_3_title'] ?? 'Workshop on Hygiene' }}</h4>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2"><i class="far fa-calendar-alt mr-1"></i> {{ $settings['media_update_3_date'] ?? 'May 06, 2025' }}</p>
                        <p class="text-xs text-gray-600">{{ $settings['media_update_3_desc'] ?? 'Awareness workshop conducted in rural schools.' }}</p>
                    </div>
                </div>

                <!-- Update 4 -->
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all flex gap-4 min-w-[300px] md:min-w-[350px] snap-start" data-aos="fade-right" data-aos-delay="400">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center shrink-0">
                        <i class="{{ $settings['media_update_4_icon'] ?? 'fas fa-box-open' }} text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-gray-900 mb-1">{{ $settings['media_update_4_title'] ?? 'Food Distribution Program' }}</h4>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2"><i class="far fa-calendar-alt mr-1"></i> {{ $settings['media_update_4_date'] ?? 'May 02, 2025' }}</p>
                        <p class="text-xs text-gray-600">{{ $settings['media_update_4_desc'] ?? 'Food packets distributed to homeless people.' }}</p>
                    </div>
                </div>
            </div>
            
            <a href="#" class="mt-8 flex md:hidden text-green-600 font-bold hover:text-green-800 transition-colors items-center justify-center gap-2 text-sm uppercase tracking-widest w-full">
                View All Updates <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Success Stories Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-black text-[#031533] tracking-tight">Success Stories</h2>
                <a href="#" class="hidden md:flex text-green-600 font-bold hover:text-green-800 transition-colors items-center gap-2 text-sm uppercase tracking-widest">
                    View All Stories <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Story 1 -->
                <div class="bg-gray-50 rounded-[2.5rem] overflow-hidden flex flex-col sm:flex-row border border-gray-100 shadow-sm group hover:shadow-xl transition-all" data-aos="fade-right">
                    <div class="w-full sm:w-2/5 h-64 sm:h-auto overflow-hidden">
                        <img src="{{ isset($settings['media_story_1_image']) ? asset('storage/' . $settings['media_story_1_image']) : 'https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=600&auto=format&fit=crop' }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Story 1">
                    </div>
                    <div class="w-full sm:w-3/5 p-8 flex flex-col justify-center">
                        <span class="text-green-600 text-[10px] font-bold uppercase tracking-widest mb-2 block">{{ $settings['media_story_1_tag'] ?? 'Education' }}</span>
                        <h3 class="text-2xl font-black text-gray-900 mb-3">{{ $settings['media_story_1_title'] ?? 'From Village Student to Engineer' }}</h3>
                        <p class="text-sm text-gray-600 mb-6 leading-relaxed">{{ $settings['media_story_1_desc'] ?? 'An inspiring journey of Priya Kumari, who overcame challenges and achieved her dream of becoming an engineer with the support of Shaurya Narayan Foundation.' }}</p>
                        <a href="{{ $settings['media_story_1_link'] ?? '#' }}" class="inline-flex px-6 py-2 bg-green-600 text-white text-xs font-bold rounded-full hover:bg-green-700 transition w-max">
                            Read Story &rarr;
                        </a>
                    </div>
                </div>

                <!-- Story 2 -->
                <div class="bg-gray-50 rounded-[2.5rem] overflow-hidden flex flex-col sm:flex-row border border-gray-100 shadow-sm group hover:shadow-xl transition-all" data-aos="fade-right">
                    <div class="w-full sm:w-2/5 h-64 sm:h-auto overflow-hidden">
                        <img src="{{ isset($settings['media_story_2_image']) ? asset('storage/' . $settings['media_story_2_image']) : 'https://images.unsplash.com/photo-1574482620826-40685ca5ebe2?q=80&w=600&auto=format&fit=crop' }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Story 2">
                    </div>
                    <div class="w-full sm:w-3/5 p-8 flex flex-col justify-center">
                        <span class="text-green-600 text-[10px] font-bold uppercase tracking-widest mb-2 block">{{ $settings['media_story_2_tag'] ?? 'Elderly Care' }}</span>
                        <h3 class="text-2xl font-black text-gray-900 mb-3">{{ $settings['media_story_2_title'] ?? 'A New Life at Anath Ashram' }}</h3>
                        <p class="text-sm text-gray-600 mb-6 leading-relaxed">{{ $settings['media_story_2_desc'] ?? 'How our care and support brought happiness and dignity to the elderly at our old age home.' }}</p>
                        <a href="{{ $settings['media_story_2_link'] ?? '#' }}" class="inline-flex px-6 py-2 bg-green-600 text-white text-xs font-bold rounded-full hover:bg-green-700 transition w-max">
                            Read Story &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- Dots -->
            <div class="flex justify-center gap-2 mt-8">
                <div class="w-2.5 h-2.5 rounded-full bg-green-600"></div>
                <div class="w-2.5 h-2.5 rounded-full bg-gray-300"></div>
            </div>
            
            <a href="#" class="mt-8 flex md:hidden text-green-600 font-bold hover:text-green-800 transition-colors items-center justify-center gap-2 text-sm uppercase tracking-widest w-full">
                View All Stories <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Gallery Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-10" data-aos="fade-up">
                <h2 class="text-3xl font-black text-[#031533] tracking-tight">Gallery</h2>
                <a href="#" class="hidden md:flex text-green-600 font-bold hover:text-green-800 transition-colors items-center gap-2 text-sm uppercase tracking-widest">
                    View Full Gallery <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-4">
                <!-- Gallery Item 1 -->
                <div class="relative h-32 rounded-2xl overflow-hidden group cursor-pointer" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Education">
                    <div class="absolute inset-0 bg-black/50 transition-opacity group-hover:bg-black/60 flex flex-col items-center justify-center p-4 text-center">
                        <i class="fas fa-graduation-cap text-white text-xl mb-2"></i>
                        <span class="text-white text-xs font-bold">Education Gallery</span>
                    </div>
                </div>

                <!-- Gallery Item 2 -->
                <div class="relative h-32 rounded-2xl overflow-hidden group cursor-pointer" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1576765608532-0739c1482f33?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Social Welfare">
                    <div class="absolute inset-0 bg-black/50 transition-opacity group-hover:bg-black/60 flex flex-col items-center justify-center p-4 text-center">
                        <i class="fas fa-user-friends text-white text-xl mb-2"></i>
                        <span class="text-white text-xs font-bold">Social Welfare Gallery</span>
                    </div>
                </div>

                <!-- Gallery Item 3 -->
                <div class="relative h-32 rounded-2xl overflow-hidden group cursor-pointer" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://images.unsplash.com/photo-1574482620826-40685ca5ebe2?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Anath Ashram">
                    <div class="absolute inset-0 bg-black/50 transition-opacity group-hover:bg-black/60 flex flex-col items-center justify-center p-4 text-center">
                        <i class="fas fa-home text-white text-xl mb-2"></i>
                        <span class="text-white text-xs font-bold">Anath Ashram Gallery</span>
                    </div>
                </div>

                <!-- Gallery Item 4 -->
                <div class="relative h-32 rounded-2xl overflow-hidden group cursor-pointer" data-aos="fade-up" data-aos-delay="400">
                    <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Community Hall">
                    <div class="absolute inset-0 bg-black/50 transition-opacity group-hover:bg-black/60 flex flex-col items-center justify-center p-4 text-center">
                        <i class="fas fa-building text-white text-xl mb-2"></i>
                        <span class="text-white text-xs font-bold">Community Hall Gallery</span>
                    </div>
                </div>

                <!-- Gallery Item 5 -->
                <div class="relative h-32 rounded-2xl overflow-hidden group cursor-pointer" data-aos="fade-up" data-aos-delay="500">
                    <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Skill Development">
                    <div class="absolute inset-0 bg-black/50 transition-opacity group-hover:bg-black/60 flex flex-col items-center justify-center p-4 text-center">
                        <i class="fas fa-cogs text-white text-xl mb-2"></i>
                        <span class="text-white text-xs font-bold">Skill Development Gallery</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Gallery Item 6 -->
                <div class="relative h-32 rounded-2xl overflow-hidden group cursor-pointer" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1590402494587-44b71d7772f6?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Women Empowerment">
                    <div class="absolute inset-0 bg-black/50 transition-opacity group-hover:bg-black/60 flex flex-col items-center justify-center p-4 text-center">
                        <i class="fas fa-female text-white text-xl mb-2"></i>
                        <span class="text-white text-xs font-bold">Women Empowerment Gallery</span>
                    </div>
                </div>

                <!-- Gallery Item 7 -->
                <div class="relative h-32 rounded-2xl overflow-hidden group cursor-pointer" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1611270418597-a6cbf7d6c666?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Environment">
                    <div class="absolute inset-0 bg-black/50 transition-opacity group-hover:bg-black/60 flex flex-col items-center justify-center p-4 text-center">
                        <i class="fas fa-leaf text-white text-xl mb-2"></i>
                        <span class="text-white text-xs font-bold">Environmental Protection Gallery</span>
                    </div>
                </div>

                <!-- Gallery Item 8 -->
                <div class="relative h-32 rounded-2xl overflow-hidden group cursor-pointer" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://images.unsplash.com/photo-1502086223501-7ea6ecd79368?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Child Welfare">
                    <div class="absolute inset-0 bg-black/50 transition-opacity group-hover:bg-black/60 flex flex-col items-center justify-center p-4 text-center">
                        <i class="fas fa-child text-white text-xl mb-2"></i>
                        <span class="text-white text-xs font-bold">Child Welfare Gallery</span>
                    </div>
                </div>

                <!-- Gallery Item 9 -->
                <div class="relative h-32 rounded-2xl overflow-hidden group cursor-pointer" data-aos="fade-up" data-aos-delay="400">
                    <img src="https://images.unsplash.com/photo-1584515933487-779824d29309?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Health">
                    <div class="absolute inset-0 bg-black/50 transition-opacity group-hover:bg-black/60 flex flex-col items-center justify-center p-4 text-center">
                        <i class="fas fa-stethoscope text-white text-xl mb-2"></i>
                        <span class="text-white text-xs font-bold">Health and Medical Gallery</span>
                    </div>
                </div>
            </div>
            
            <a href="#" class="mt-8 flex md:hidden text-green-600 font-bold hover:text-green-800 transition-colors items-center justify-center gap-2 text-sm uppercase tracking-widest w-full">
                View Full Gallery <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Videos Section -->
    <div class="py-20 bg-gray-50 border-t border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-black text-[#031533] tracking-tight">Videos</h2>
                <a href="#" class="hidden md:flex text-green-600 font-bold hover:text-green-800 transition-colors items-center gap-2 text-sm uppercase tracking-widest">
                    View All Videos <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" x-data="{
                isPlaying: false,
                activeVideo: {
                    title: '{{ $settings['media_vid_1_title'] ?? 'Plantation Drive 2025 - Making Earth Greener' }}',
                    url: '{{ str_replace('watch?v=', 'embed/', $settings['media_vid_1_url'] ?? 'https://www.youtube.com/embed/dQw4w9WgXcQ') }}',
                    thumb: '{{ isset($settings['media_vid_1_thumb']) ? asset('storage/' . $settings['media_vid_1_thumb']) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1200&auto=format&fit=crop' }}'
                },
                videos: [
                    {
                        title: '{{ $settings['media_vid_1_title'] ?? 'Plantation Drive 2025 - Making Earth Greener' }}',
                        url: '{{ str_replace('watch?v=', 'embed/', $settings['media_vid_1_url'] ?? 'https://www.youtube.com/embed/dQw4w9WgXcQ') }}',
                        thumb: '{{ isset($settings['media_vid_1_thumb']) ? asset('storage/' . $settings['media_vid_1_thumb']) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1200&auto=format&fit=crop' }}',
                        duration: '{{ $settings['media_vid_1_duration'] ?? '05:20' }}'
                    },
                    {
                        title: '{{ $settings['media_vid_2_title'] ?? 'Health Camp Highlights 2025' }}',
                        url: '{{ str_replace('watch?v=', 'embed/', $settings['media_vid_2_url'] ?? 'https://www.youtube.com/embed/tgbNymZ7vqY') }}',
                        thumb: '{{ isset($settings['media_vid_2_thumb']) ? asset('storage/' . $settings['media_vid_2_thumb']) : 'https://images.unsplash.com/photo-1576765608532-0739c1482f33?q=80&w=400&auto=format&fit=crop' }}',
                        duration: '{{ $settings['media_vid_2_duration'] ?? '04:35' }}'
                    },
                    {
                        title: '{{ $settings['media_vid_3_title'] ?? 'Women Empowerment Workshop' }}',
                        url: '{{ str_replace('watch?v=', 'embed/', $settings['media_vid_3_url'] ?? 'https://www.youtube.com/embed/tgbNymZ7vqY') }}',
                        thumb: '{{ isset($settings['media_vid_3_thumb']) ? asset('storage/' . $settings['media_vid_3_thumb']) : 'https://images.unsplash.com/photo-1590402494587-44b71d7772f6?q=80&w=400&auto=format&fit=crop' }}',
                        duration: '{{ $settings['media_vid_3_duration'] ?? '03:12' }}'
                    },
                    {
                        title: '{{ $settings['media_vid_4_title'] ?? 'Education Support Program' }}',
                        url: '{{ str_replace('watch?v=', 'embed/', $settings['media_vid_4_url'] ?? 'https://www.youtube.com/embed/tgbNymZ7vqY') }}',
                        thumb: '{{ isset($settings['media_vid_4_thumb']) ? asset('storage/' . $settings['media_vid_4_thumb']) : 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=400&auto=format&fit=crop' }}',
                        duration: '{{ $settings['media_vid_4_duration'] ?? '02:45' }}'
                    }
                ]
            }">
                <!-- Main Featured Video -->
                <div class="lg:col-span-2" data-aos="fade-right">
                    <div class="block relative rounded-[2.5rem] overflow-hidden shadow-lg border border-gray-100 h-[300px] sm:h-[400px] lg:h-[500px]">
                        
                        <!-- Thumbnail View -->
                        <div x-show="!isPlaying" class="absolute inset-0 cursor-pointer group" @click="isPlaying = true">
                            <img :src="activeVideo.thumb" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Featured Video">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                                <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center border-2 border-white group-hover:scale-110 transition-transform shadow-2xl">
                                    <i class="fas fa-play text-3xl text-white ml-1"></i>
                                </div>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-black/80 to-transparent">
                                <h3 class="text-2xl font-black text-white mb-2 shadow-sm" x-text="activeVideo.title"></h3>
                            </div>
                        </div>

                        <!-- Video Player View -->
                        <div x-show="isPlaying" class="absolute inset-0 bg-black">
                            <template x-if="isPlaying">
                                <iframe :src="activeVideo.url + '?autoplay=1'" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </template>
                        </div>

                    </div>
                </div>

                <!-- Video List -->
                <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar" data-aos="fade-up">
                    <template x-for="(video, index) in videos" :key="index">
                        <!-- Video Item -->
                        <button @click="activeVideo = video; isPlaying = true;" class="w-full text-left flex gap-4 p-4 rounded-3xl transition-all group border-2" :class="activeVideo.url === video.url ? 'bg-white border-green-500 shadow-md' : 'hover:bg-white border-transparent'">
                            <div class="w-32 h-20 rounded-xl overflow-hidden relative shrink-0">
                                <img :src="video.thumb" class="w-full h-full object-cover" alt="Video">
                                <div class="absolute inset-0 bg-black/30 flex items-center justify-center transition-colors" :class="activeVideo.url === video.url ? 'bg-black/10' : 'group-hover:bg-black/50'">
                                    <i class="fas fa-play text-white text-sm" x-show="activeVideo.url !== video.url"></i>
                                    <i class="fas fa-pause text-white text-sm" x-show="activeVideo.url === video.url"></i>
                                </div>
                                <span class="absolute bottom-1 right-1 bg-black/80 text-white text-[10px] font-bold px-1.5 py-0.5 rounded" x-text="video.duration"></span>
                            </div>
                            <div class="flex flex-col justify-center">
                                <h4 class="text-sm font-black mb-1 transition-colors leading-tight" :class="activeVideo.url === video.url ? 'text-green-600' : 'text-gray-900 group-hover:text-green-600'" x-text="video.title"></h4>
                            </div>
                        </button>
                    </template>
                </div>
            </div>
            
            <a href="#" class="mt-8 flex md:hidden text-green-600 font-bold hover:text-green-800 transition-colors items-center justify-center gap-2 text-sm uppercase tracking-widest w-full">
                View All Videos <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Newsletter Section -->
    <div class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="zoom-in">
            <div class="bg-gray-50 border border-gray-200 rounded-[3rem] p-8 md:p-10 flex flex-col md:flex-row items-center gap-8 shadow-sm">
                <div class="w-20 h-20 bg-green-100 text-green-600 rounded-[2rem] flex items-center justify-center shrink-0">
                    <i class="fas fa-envelope-open-text text-3xl"></i>
                </div>
                <div class="text-center md:text-left flex-1">
                    <h3 class="text-2xl font-black text-gray-900 mb-2">Stay Updated With Our Activities</h3>
                    <p class="text-sm text-gray-600 font-medium">Subscribe to our newsletter and never miss an update.</p>
                </div>
                <div class="w-full md:w-auto flex-1">
                    <form class="flex gap-2 w-full">
                        <input type="email" placeholder="Enter your email" class="w-full bg-white border border-gray-300 rounded-full px-6 py-3 text-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all">
                        <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-full text-sm font-bold hover:bg-green-700 transition shadow-md shrink-0">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-frontend.layout>
