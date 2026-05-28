<x-frontend.layout>
    <x-slot name="title">About Us | Shaurya Narayan Foundation</x-slot>

    @php
        $settings = \App\Models\Setting::getAll();
    @endphp

    <!-- Hero Section with Parallax -->
    <div class="relative pt-[180px] pb-32 bg-slate-900 overflow-hidden group">
        <!-- Dynamic Background Image with Parallax -->
        @if(isset($settings['about_us_hero_image']) && $settings['about_us_hero_image'])
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-fixed transition-transform duration-1000 group-hover:scale-105" 
                 style="background-image: url('{{ asset('storage/' . $settings['about_us_hero_image']) }}'); opacity: 0.6;"></div>
        @else
            <!-- Fallback gradient if no image -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-slate-900 opacity-90"></div>
        @endif

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#031533] via-[#031533]/80 to-transparent"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-2xl" data-aos="fade-up">
                <h1 class="text-5xl md:text-6xl font-black text-white mb-6 tracking-tight">About Us</h1>
                
                <!-- Breadcrumbs -->
                <div class="flex items-center gap-2 text-sm font-bold text-gray-300 mb-8 uppercase tracking-widest">
                    <a href="{{ route('home') }}" class="hover:text-brand-primary transition-colors">Home</a>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                    <span class="text-brand-primary">About Us</span>
                </div>

                <p class="text-lg text-gray-300 font-medium leading-relaxed">
                    Shaurya Narayan Foundation is dedicated to creating positive change in society through education, healthcare, environment protection, and community development.
                </p>
            </div>
        </div>
    </div>

    <!-- Our Mission Section -->
    <div class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Text Content -->
                <div data-aos="fade-right">
                    
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 rounded-2xl bg-green-50 flex items-center justify-center">
                            <i class="fas fa-bullseye text-3xl text-green-600"></i>
                        </div>
                        <h2 class="text-4xl font-black text-gray-900 tracking-tight">Our Mission</h2>
                    </div>

                    <div class="space-y-6 text-gray-600 leading-relaxed font-medium">
                        <p>
                            Our mission is to uplift underprivileged communities by providing access to quality education, healthcare, and resources for a better life.
                        </p>
                        <p>
                            We work with dedication and compassion to bring sustainable change and create a brighter tomorrow for all.
                        </p>
                    </div>
                </div>

                <!-- Image Content -->
                <div data-aos="fade-left" data-aos-delay="200">
                    <div class="rounded-[2.5rem] overflow-hidden shadow-2xl relative group">
                        @if(isset($settings['about_us_mission_image']) && $settings['about_us_mission_image'])
                            <img src="{{ asset('storage/' . $settings['about_us_mission_image']) }}" alt="Our Mission" class="w-full h-[400px] object-cover transition-transform duration-700 group-hover:scale-105">
                        @else
                            <div class="w-full h-[400px] bg-slate-200 flex items-center justify-center">
                                <span class="text-slate-400 font-bold uppercase tracking-widest">Image Placeholder</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Values Section -->
    <div class="py-24 bg-gray-50 border-y border-gray-200 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-black text-[#031533] tracking-tight mb-4">Our Values</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Integrity -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 shrink-0 text-green-600 transition-transform group-hover:scale-110">
                            <!-- Handshake Icon (simplified SVG) -->
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-gray-900 mb-2">Integrity</h3>
                            <p class="text-sm font-medium text-gray-600 leading-relaxed">We uphold transparency, honesty, and accountability in everything we do.</p>
                        </div>
                    </div>
                </div>

                <!-- Compassion -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 shrink-0 text-green-600 transition-transform group-hover:scale-110">
                            <i class="fas fa-hand-holding-heart text-4xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-gray-900 mb-2">Compassion</h3>
                            <p class="text-sm font-medium text-gray-600 leading-relaxed">We approach every action with kindness and a deep sense of empathy.</p>
                        </div>
                    </div>
                </div>

                <!-- Empowerment -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 shrink-0 text-green-600 transition-transform group-hover:scale-110">
                            <i class="fas fa-user-check text-4xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-gray-900 mb-2">Empowerment</h3>
                            <p class="text-sm font-medium text-gray-600 leading-relaxed">We empower individuals and communities to become self-reliant and confident.</p>
                        </div>
                    </div>
                </div>

                <!-- Sustainability -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1" data-aos="fade-up" data-aos-delay="400">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 shrink-0 text-green-600 transition-transform group-hover:scale-110">
                            <i class="fas fa-leaf text-4xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-gray-900 mb-2">Sustainability</h3>
                            <p class="text-sm font-medium text-gray-600 leading-relaxed">We are committed to creating long-term impact through sustainable solutions.</p>
                        </div>
                    </div>
                </div>

                <!-- Inclusivity -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1" data-aos="fade-up" data-aos-delay="500">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 shrink-0 text-green-600 transition-transform group-hover:scale-110">
                            <i class="fas fa-users text-4xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-gray-900 mb-2">Inclusivity</h3>
                            <p class="text-sm font-medium text-gray-600 leading-relaxed">We believe in equal opportunities and respect for all, regardless of background.</p>
                        </div>
                    </div>
                </div>

                <!-- Collaboration -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 shrink-0 text-green-600 transition-transform group-hover:scale-110">
                            <i class="fas fa-hands-helping text-4xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-gray-900 mb-2">Collaboration</h3>
                            <p class="text-sm font-medium text-gray-600 leading-relaxed">We work together with partners and communities to achieve greater impact.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Work Section -->
    <div class="py-24 bg-white relative" x-data="{ activeTab: 'sectors' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-black text-[#031533] tracking-tight mb-4">Our Work</h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Sidebar -->
                <div class="w-full lg:w-72 shrink-0">
                    <div class="bg-gray-50 rounded-3xl p-6 border border-gray-100 shadow-sm sticky top-32">
                        
                        <!-- Projects -->
                        <div class="mb-6">
                            <button @click="activeTab = 'projects'" class="w-full flex items-center gap-3 text-left font-black transition-colors mb-4" :class="activeTab === 'projects' ? 'text-gray-900' : 'text-gray-600 hover:text-gray-900'">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" :class="activeTab === 'projects' ? 'bg-green-100 text-green-600' : 'bg-gray-200 text-gray-500'">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                Projects
                            </button>
                            <div class="pl-11 space-y-3" x-show="activeTab === 'projects'">
                                <a href="#" class="block text-sm font-bold text-gray-900 hover:text-brand-primary">- Ongoing Projects</a>
                                <a href="#" class="block text-sm font-bold text-gray-500 hover:text-gray-900">- Completed Projects</a>
                                <a href="#" class="block text-sm font-bold text-gray-500 hover:text-gray-900">- Upcoming Projects</a>
                            </div>
                        </div>

                        <!-- Sectors -->
                        <div class="mb-6">
                            <button @click="activeTab = 'sectors'" class="w-full flex items-center gap-3 text-left font-black transition-colors mb-4" :class="activeTab === 'sectors' ? 'text-gray-900' : 'text-gray-600 hover:text-gray-900'">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" :class="activeTab === 'sectors' ? 'bg-green-100 text-green-600' : 'bg-gray-200 text-gray-500'">
                                    <i class="fas fa-city"></i>
                                </div>
                                Sectors
                            </button>
                            <div class="pl-11 space-y-3" x-show="activeTab === 'sectors'">
                                <a href="#" class="block text-sm font-bold text-gray-900 hover:text-brand-primary">- Education</a>
                                <a href="#" class="block text-sm font-bold text-gray-500 hover:text-gray-900">- Social Welfare</a>
                                <a href="#" class="block text-sm font-bold text-gray-500 hover:text-gray-900">- Environment (Ecology & Green)</a>
                                <a href="#" class="block text-sm font-bold text-gray-500 hover:text-gray-900">- Community Aid</a>
                                <a href="#" class="block text-sm font-bold text-gray-500 hover:text-gray-900">- Skill Development Program</a>
                                <a href="#" class="block text-sm font-bold text-gray-500 hover:text-gray-900">- Women Empowerment</a>
                                <a href="#" class="block text-sm font-bold text-gray-500 hover:text-gray-900">- Healthcare & Sanitation</a>
                                <a href="#" class="block text-sm font-bold text-gray-500 hover:text-gray-900">- Child Welfare</a>
                                <a href="#" class="block text-sm font-bold text-gray-500 hover:text-gray-900">- Rural Development</a>
                            </div>
                        </div>

                        <!-- Campaigns -->
                        <div class="mb-6">
                            <button @click="activeTab = 'campaigns'" class="w-full flex items-center gap-3 text-left font-black transition-colors mb-4" :class="activeTab === 'campaigns' ? 'text-gray-900' : 'text-gray-600 hover:text-gray-900'">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" :class="activeTab === 'campaigns' ? 'bg-green-100 text-green-600' : 'bg-gray-200 text-gray-500'">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                                Campaigns
                            </button>
                        </div>

                        <!-- Awareness -->
                        <div>
                            <button @click="activeTab = 'awareness'" class="w-full flex items-center gap-3 text-left font-black transition-colors" :class="activeTab === 'awareness' ? 'text-gray-900' : 'text-gray-600 hover:text-gray-900'">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" :class="activeTab === 'awareness' ? 'bg-green-100 text-green-600' : 'bg-gray-200 text-gray-500'">
                                    <i class="fas fa-ribbon"></i>
                                </div>
                                Awareness Programs
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Main Content (Sectors Grid) -->
                <div class="flex-1" x-show="activeTab === 'sectors'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        
                        <!-- Education -->
                        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-500">
                            <div class="h-48 bg-slate-200 relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Education">
                                <div class="absolute bottom-4 left-4 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg z-10">
                                    <i class="fas fa-book-open"></i>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-black text-gray-900 mb-3 tracking-tight">Education</h3>
                                <p class="text-sm font-medium text-gray-600 leading-relaxed">We promote quality education and learning opportunities for children and youth.</p>
                            </div>
                        </div>

                        <!-- Social Welfare -->
                        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-500">
                            <div class="h-48 bg-slate-200 relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1576765608532-0739c1482f33?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Social Welfare">
                                <div class="absolute bottom-4 left-4 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg z-10">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-black text-gray-900 mb-3 tracking-tight">Social Welfare</h3>
                                <p class="text-sm font-medium text-gray-600 leading-relaxed">We support the elderly, differently-abled and underprivileged communities.</p>
                            </div>
                        </div>

                        <!-- Environment -->
                        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-500">
                            <div class="h-48 bg-slate-200 relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1611270418597-a6cbf7d6c666?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Environment">
                                <div class="absolute bottom-4 left-4 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg z-10">
                                    <i class="fas fa-tree"></i>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-black text-gray-900 mb-3 tracking-tight">Environment</h3>
                                <p class="text-sm font-medium text-gray-600 leading-relaxed">We protect nature and promote ecological balance through green initiatives.</p>
                            </div>
                        </div>

                        <!-- Community Aid -->
                        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-500">
                            <div class="h-48 bg-slate-200 relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1593113514676-590fb429b9f0?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Community Aid">
                                <div class="absolute bottom-4 left-4 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg z-10">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-black text-gray-900 mb-3 tracking-tight">Community Aid</h3>
                                <p class="text-sm font-medium text-gray-600 leading-relaxed">We stand with communities in times of need and work for their overall development.</p>
                            </div>
                        </div>

                        <!-- Skill Development -->
                        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-500">
                            <div class="h-48 bg-slate-200 relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Skill Development">
                                <div class="absolute bottom-4 left-4 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg z-10">
                                    <i class="fas fa-tools"></i>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-black text-gray-900 mb-3 tracking-tight">Skill Development</h3>
                                <p class="text-sm font-medium text-gray-600 leading-relaxed">We provide training and resources to enable skills for better livelihoods.</p>
                            </div>
                        </div>

                        <!-- Women Empowerment -->
                        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-500">
                            <div class="h-48 bg-slate-200 relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1590402494587-44b71d7772f6?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Women Empowerment">
                                <div class="absolute bottom-4 left-4 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg z-10">
                                    <i class="fas fa-female"></i>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-black text-gray-900 mb-3 tracking-tight">Women Empowerment</h3>
                                <p class="text-sm font-medium text-gray-600 leading-relaxed">We empower women to become independent and leaders of change.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Projects Tab Content -->
                <div class="flex-1" x-show="activeTab === 'projects'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Project 1 -->
                        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm p-8 group hover:shadow-xl transition-all duration-500">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-school text-xl"></i>
                                </div>
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full uppercase tracking-wider">Ongoing</span>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900 mb-3">Project Vidya</h3>
                            <p class="text-gray-600 mb-6 font-medium leading-relaxed">Providing free primary education and school supplies to over 500 children in rural districts, ensuring no child is left behind due to poverty.</p>
                            <a href="#" class="text-blue-600 font-bold hover:text-blue-800 transition-colors flex items-center gap-2 text-sm uppercase tracking-widest">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        
                        <!-- Project 2 -->
                        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm p-8 group hover:shadow-xl transition-all duration-500">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-clinic-medical text-xl"></i>
                                </div>
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full uppercase tracking-wider">Completed</span>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900 mb-3">Sanjeevani Camps</h3>
                            <p class="text-gray-600 mb-6 font-medium leading-relaxed">Successfully organized 50+ free health checkup camps across multiple villages, providing essential medicines and consultations.</p>
                            <a href="#" class="text-blue-600 font-bold hover:text-blue-800 transition-colors flex items-center gap-2 text-sm uppercase tracking-widest">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <!-- Project 3 -->
                        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm p-8 group hover:shadow-xl transition-all duration-500">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-seedling text-xl"></i>
                                </div>
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full uppercase tracking-wider">Upcoming</span>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900 mb-3">Green Earth Initiative</h3>
                            <p class="text-gray-600 mb-6 font-medium leading-relaxed">A massive upcoming drive to plant 10,000 saplings across the state to restore green cover and promote environmental sustainability.</p>
                            <a href="#" class="text-blue-600 font-bold hover:text-blue-800 transition-colors flex items-center gap-2 text-sm uppercase tracking-widest">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Campaigns Tab Content -->
                <div class="flex-1" x-show="activeTab === 'campaigns'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    <div class="bg-indigo-900 rounded-[2.5rem] p-10 md:p-16 text-white relative overflow-hidden shadow-2xl">
                        <div class="relative z-10">
                            <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-xs font-bold uppercase tracking-widest mb-6">Featured Campaign</span>
                            <h3 class="text-4xl md:text-5xl font-black mb-6 tracking-tight">Winter Relief Drive 2026</h3>
                            <p class="text-lg text-indigo-200 mb-10 max-w-2xl font-medium leading-relaxed">Join us in our mission to distribute warm clothing and blankets to the homeless. Your small contribution can save a life this winter.</p>
                            
                            <div class="flex flex-wrap gap-4">
                                <a href="#" class="px-8 py-4 bg-white text-indigo-900 rounded-full font-black hover:bg-gray-100 transition shadow-lg">Donate Now</a>
                                <a href="#" class="px-8 py-4 bg-indigo-800 text-white rounded-full font-bold hover:bg-indigo-700 transition border border-indigo-700">Learn More</a>
                            </div>
                        </div>
                        <i class="fas fa-snowflake absolute -right-10 -bottom-10 text-[200px] text-indigo-800/50"></i>
                    </div>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-gray-50 rounded-3xl p-8 border border-gray-200">
                            <h4 class="text-xl font-black text-gray-900 mb-2">Back to School</h4>
                            <p class="text-gray-600 text-sm mb-4">Collecting bags, books, and stationery for underprivileged children.</p>
                            <a href="#" class="text-indigo-600 text-sm font-bold">View Details &rarr;</a>
                        </div>
                        <div class="bg-gray-50 rounded-3xl p-8 border border-gray-200">
                            <h4 class="text-xl font-black text-gray-900 mb-2">Blood Donation Camp</h4>
                            <p class="text-gray-600 text-sm mb-4">Partnering with local hospitals for a mega blood donation drive.</p>
                            <a href="#" class="text-indigo-600 text-sm font-bold">View Details &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- Awareness Tab Content -->
                <div class="flex-1" x-show="activeTab === 'awareness'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    <div class="space-y-6">
                        <!-- Item -->
                        <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md rounded-[2rem] p-6 flex flex-col md:flex-row gap-6 items-center transition-all">
                            <div class="w-full md:w-48 h-32 bg-purple-100 rounded-xl overflow-hidden shrink-0 relative">
                                <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Yoga">
                            </div>
                            <div>
                                <div class="text-xs font-bold text-purple-600 uppercase tracking-widest mb-2">Health & Wellness</div>
                                <h3 class="text-2xl font-black text-gray-900 mb-2">Mental Health Awareness</h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-4">Conducting seminars and workshops in colleges to break the stigma around mental health and provide access to counseling resources.</p>
                                <span class="text-gray-400 text-xs font-bold"><i class="far fa-calendar-alt mr-1"></i> Conducted Monthly</span>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md rounded-[2rem] p-6 flex flex-col md:flex-row gap-6 items-center transition-all">
                            <div class="w-full md:w-48 h-32 bg-blue-100 rounded-xl overflow-hidden shrink-0 relative">
                                <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Tech">
                            </div>
                            <div>
                                <div class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-2">Digital Literacy</div>
                                <h3 class="text-2xl font-black text-gray-900 mb-2">Cyber Safety for Women</h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-4">Educating women in rural and semi-urban areas about online safety, digital frauds, and secure usage of smartphones and internet.</p>
                                <span class="text-gray-400 text-xs font-bold"><i class="far fa-calendar-alt mr-1"></i> Ongoing Program</span>
                            </div>
                        </div>
                        
                        <!-- Item -->
                        <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md rounded-[2rem] p-6 flex flex-col md:flex-row gap-6 items-center transition-all">
                            <div class="w-full md:w-48 h-32 bg-green-100 rounded-xl overflow-hidden shrink-0 relative">
                                <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Recycle">
                            </div>
                            <div>
                                <div class="text-xs font-bold text-green-600 uppercase tracking-widest mb-2">Environment</div>
                                <h3 class="text-2xl font-black text-gray-900 mb-2">Say No To Single-Use Plastic</h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-4">A city-wide campaign partnering with local shopkeepers and residents to promote cloth bags and proper waste segregation.</p>
                                <span class="text-gray-400 text-xs font-bold"><i class="far fa-calendar-alt mr-1"></i> Phase 1 Completed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Impact in Numbers Banner -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24" data-aos="zoom-in">
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
                        <i class="fas fa-user-graduate text-xl text-white"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-green-400">500+</div>
                        <div class="text-[10px] font-bold text-gray-300 uppercase tracking-widest mt-1">Students Supported</div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                        <i class="fas fa-seedling text-xl text-white"></i>
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
                        <i class="fas fa-handshake text-xl text-white"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-green-400">20+</div>
                        <div class="text-[10px] font-bold text-gray-300 uppercase tracking-widest mt-1">Community Programs</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-frontend.layout>
