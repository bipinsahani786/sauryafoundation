<x-frontend.layout>
    @php
        $settings = \App\Models\Setting::getAll();
        $heroImage = isset($settings['our_work_hero_image']) ? asset('storage/' . $settings['our_work_hero_image']) : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=2000&auto=format&fit=crop';
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
                    Our Work
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-8 font-medium leading-relaxed max-w-2xl">
                    We work in diverse sectors to create lasting change and build a better, healthier and stronger society for all.
                </p>
                <div class="flex items-center gap-3 text-sm font-bold text-gray-300">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                    <span class="text-brand-primary">Our Work</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Section -->
    <div class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-black text-[#031533] tracking-tight mb-4">Projects</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Ongoing Projects -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden group hover:shadow-xl transition-all duration-300 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-56 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Ongoing Projects">
                        <div class="absolute -bottom-6 left-6 w-14 h-14 bg-green-500 rounded-2xl flex items-center justify-center text-white shadow-lg z-10 border-4 border-white transform transition-transform group-hover:rotate-12">
                            <i class="fas fa-hourglass-half text-xl"></i>
                        </div>
                    </div>
                    <div class="p-8 pt-10">
                        <h3 class="text-xl font-black text-gray-900 mb-3">Ongoing Projects</h3>
                        <p class="text-sm font-medium text-gray-600 leading-relaxed mb-6">Active initiatives that are currently creating impact in communities.</p>
                        <a href="#" class="text-green-600 font-bold hover:text-green-800 transition-colors flex items-center gap-2 text-sm uppercase tracking-widest">
                            View Projects <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Completed Projects -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden group hover:shadow-xl transition-all duration-300 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-56 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Completed Projects">
                        <div class="absolute -bottom-6 left-6 w-14 h-14 bg-green-500 rounded-2xl flex items-center justify-center text-white shadow-lg z-10 border-4 border-white transform transition-transform group-hover:rotate-12">
                            <i class="fas fa-check text-xl"></i>
                        </div>
                    </div>
                    <div class="p-8 pt-10">
                        <h3 class="text-xl font-black text-gray-900 mb-3">Completed Projects</h3>
                        <p class="text-sm font-medium text-gray-600 leading-relaxed mb-6">Successfully completed projects that made a meaningful difference.</p>
                        <a href="#" class="text-green-600 font-bold hover:text-green-800 transition-colors flex items-center gap-2 text-sm uppercase tracking-widest">
                            View Projects <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Upcoming Projects -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden group hover:shadow-xl transition-all duration-300 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="h-56 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Upcoming Projects">
                        <div class="absolute -bottom-6 left-6 w-14 h-14 bg-green-500 rounded-2xl flex items-center justify-center text-white shadow-lg z-10 border-4 border-white transform transition-transform group-hover:rotate-12">
                            <i class="fas fa-calendar-alt text-xl"></i>
                        </div>
                    </div>
                    <div class="p-8 pt-10">
                        <h3 class="text-xl font-black text-gray-900 mb-3">Upcoming Projects</h3>
                        <p class="text-sm font-medium text-gray-600 leading-relaxed mb-6">Future projects aimed at expanding our reach and impact.</p>
                        <a href="#" class="text-green-600 font-bold hover:text-green-800 transition-colors flex items-center gap-2 text-sm uppercase tracking-widest">
                            View Projects <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sectors Section -->
    <div class="py-24 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-black text-[#031533] tracking-tight mb-4">Sectors</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Row 1 -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-all text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 mx-auto mb-4 text-green-600 transition-transform group-hover:scale-110">
                        <i class="fas fa-graduation-cap text-5xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">Education</h3>
                    <p class="text-xs font-medium text-gray-500 leading-relaxed">Quality education and learning opportunities for every child.</p>
                </div>
                
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-all text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 mx-auto mb-4 text-green-600 transition-transform group-hover:scale-110">
                        <i class="fas fa-user-friends text-5xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">Social Welfare</h3>
                    <p class="text-xs font-medium text-gray-500 leading-relaxed">Supporting communities and uplifting the underprivileged.</p>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-all text-center group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 mx-auto mb-4 text-green-600 transition-transform group-hover:scale-110">
                        <i class="fas fa-home text-5xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">Anath Ashram<br><span class="text-sm text-gray-500 font-bold">(Old Age Home)</span></h3>
                    <p class="text-xs font-medium text-gray-500 leading-relaxed">Providing care, shelter, and respect to the elderly.</p>
                </div>

                <!-- Row 2 -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-all text-center group" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 mx-auto mb-4 text-green-600 transition-transform group-hover:scale-110">
                        <i class="fas fa-building text-5xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">Community Hall</h3>
                    <p class="text-xs font-medium text-gray-500 leading-relaxed">Creating spaces for community gatherings and events.</p>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-all text-center group" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-16 h-16 mx-auto mb-4 text-green-600 transition-transform group-hover:scale-110">
                        <i class="fas fa-cogs text-5xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">Skill Development</h3>
                    <p class="text-xs font-medium text-gray-500 leading-relaxed">Empowering individuals with skills for a better tomorrow.</p>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-all text-center group" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-16 h-16 mx-auto mb-4 text-green-600 transition-transform group-hover:scale-110">
                        <i class="fas fa-female text-5xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">Women Empowerment</h3>
                    <p class="text-xs font-medium text-gray-500 leading-relaxed">Empowering women to become independent and leaders.</p>
                </div>

                <!-- Row 3 -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-all text-center group" data-aos="fade-up" data-aos-delay="700">
                    <div class="w-16 h-16 mx-auto mb-4 text-green-600 transition-transform group-hover:scale-110">
                        <i class="fas fa-leaf text-5xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">Environmental Protection</h3>
                    <p class="text-xs font-medium text-gray-500 leading-relaxed">Protecting nature and promoting a sustainable environment.</p>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-all text-center group" data-aos="fade-up" data-aos-delay="800">
                    <div class="w-16 h-16 mx-auto mb-4 text-green-600 transition-transform group-hover:scale-110">
                        <i class="fas fa-child text-5xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">Child Welfare</h3>
                    <p class="text-xs font-medium text-gray-500 leading-relaxed">Ensuring child safety, care, and overall development.</p>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition-all text-center group" data-aos="fade-up" data-aos-delay="900">
                    <div class="w-16 h-16 mx-auto mb-4 text-green-600 transition-transform group-hover:scale-110">
                        <i class="fas fa-stethoscope text-5xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">Health and Medical</h3>
                    <p class="text-xs font-medium text-gray-500 leading-relaxed">Promoting good health and providing medical support.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Campaigns & Awareness Programs -->
    <div class="py-24 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Campaigns -->
                <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between" data-aos="fade-right">
                    <div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center shrink-0">
                                <i class="fas fa-bullhorn text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900">Campaigns</h3>
                        </div>
                        <p class="text-gray-600 mb-8 font-medium leading-relaxed">Our campaigns raise awareness and drive action on important social issues.</p>
                        
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                                <i class="fas fa-check-circle text-green-500"></i> Health Awareness Campaigns
                            </li>
                            <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                                <i class="fas fa-check-circle text-green-500"></i> Education for All Campaign
                            </li>
                            <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                                <i class="fas fa-check-circle text-green-500"></i> Clean & Green Campaign
                            </li>
                            <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                                <i class="fas fa-check-circle text-green-500"></i> Women Safety Campaigns
                            </li>
                        </ul>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-6 items-center">
                        <a href="#" class="w-full sm:w-auto px-6 py-3 bg-green-600 text-white text-sm font-black rounded-xl hover:bg-green-700 transition shadow-lg text-center flex items-center justify-center gap-2">
                            Explore Campaigns <i class="fas fa-arrow-right"></i>
                        </a>
                        <div class="w-full sm:w-1/2 h-32 rounded-xl overflow-hidden shrink-0 mt-4 sm:mt-0">
                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover" alt="Campaigns">
                        </div>
                    </div>
                </div>

                <!-- Awareness Programs -->
                <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between" data-aos="fade-left">
                    <div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center shrink-0">
                                <i class="fas fa-ribbon text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900">Awareness Programs</h3>
                        </div>
                        <p class="text-gray-600 mb-8 font-medium leading-relaxed">We organize programs to educate and empower communities.</p>
                        
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                                <i class="fas fa-check-circle text-green-500"></i> Health & Hygiene Awareness
                            </li>
                            <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                                <i class="fas fa-check-circle text-green-500"></i> Environment Awareness
                            </li>
                            <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                                <i class="fas fa-check-circle text-green-500"></i> Education Awareness
                            </li>
                            <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                                <i class="fas fa-check-circle text-green-500"></i> Social Awareness
                            </li>
                        </ul>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-6 items-center">
                        <a href="#" class="w-full sm:w-auto px-6 py-3 bg-green-600 text-white text-sm font-black rounded-xl hover:bg-green-700 transition shadow-lg text-center flex items-center justify-center gap-2">
                            Explore Programs <i class="fas fa-arrow-right"></i>
                        </a>
                        <div class="w-full sm:w-1/2 h-32 rounded-xl overflow-hidden shrink-0 mt-4 sm:mt-0">
                            <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover" alt="Awareness">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Our Impact in Numbers Banner -->
    <div class="bg-gray-50 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="zoom-in">
            <div class="bg-[#031533] rounded-[2rem] p-8 md:p-12 shadow-2xl relative overflow-hidden">
                <h3 class="text-2xl font-black text-white mb-8 tracking-tight text-center md:text-left">Our Impact in Numbers</h3>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                            <i class="fas fa-users text-xl text-white"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-green-400">10,000+</div>
                            <div class="text-[10px] font-bold text-gray-300 uppercase tracking-widest mt-1">Lives Impacted</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                            <i class="fas fa-graduation-cap text-xl text-white"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-green-400">500+</div>
                            <div class="text-[10px] font-bold text-gray-300 uppercase tracking-widest mt-1">Students Supported</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                            <i class="fas fa-leaf text-xl text-white"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-green-400">100+</div>
                            <div class="text-[10px] font-bold text-gray-300 uppercase tracking-widest mt-1">Plantation Drives</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                            <i class="fas fa-medkit text-xl text-white"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-green-400">50+</div>
                            <div class="text-[10px] font-bold text-gray-300 uppercase tracking-widest mt-1">Health Camps</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                            <i class="fas fa-hands-helping text-xl text-white"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-green-400">20+</div>
                            <div class="text-[10px] font-bold text-gray-300 uppercase tracking-widest mt-1">Community Programs</div>
                        </div>
                    </div>

                </div>

                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/3 w-64 h-64 bg-brand-primary/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/3 w-64 h-64 bg-green-500/20 rounded-full blur-3xl pointer-events-none"></div>
            </div>
        </div>
    </div>
</x-frontend.layout>
