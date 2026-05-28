<x-frontend.layout>
    <x-slot name="title">Events | Shaurya Narayan Foundation</x-slot>

    @php
        $heroImage = isset($settings['events_hero_image']) ? asset('storage/' . $settings['events_hero_image']) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2000&auto=format&fit=crop';
    @endphp

    <!-- Hero Section -->
    <div class="relative h-[55vh] md:h-[65vh] w-full flex items-end overflow-hidden group">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-transform duration-1000 group-hover:scale-105"
             style="background-image: url('{{ $heroImage }}'); background-attachment: fixed;"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#031533]/95 via-[#031533]/70 to-[#031533]/30"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pb-12 mt-20">
            <div class="max-w-xl" data-aos="fade-right">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 tracking-tight drop-shadow-xl">
                    Our Events
                </h1>
                <p class="text-base md:text-lg text-gray-200 mb-6 font-medium max-w-lg drop-shadow-md leading-relaxed">
                    Join our upcoming events, workshops and awareness campaigns to be part of our mission and create a positive impact in society.
                </p>
                <nav class="flex items-center gap-2 text-sm" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors font-medium">Home</a>
                    <i class="fas fa-chevron-right text-gray-500 text-xs"></i>
                    <span class="text-green-400 font-bold">Events</span>
                </nav>
            </div>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8" data-aos="fade-up">
                <div>
                    <h2 class="text-2xl font-black text-gray-900">Upcoming Events</h2>
                    <div class="w-12 h-1 bg-green-500 rounded-full mt-2"></div>
                </div>
            </div>

            <!-- Scrollable Cards -->
            <div class="flex overflow-x-auto gap-6 pb-6 custom-scrollbar snap-x" data-aos="fade-up" data-aos-delay="100">

                @forelse($upcomingEvents as $event)
                    <!-- Event Card -->
                    <div class="flex-shrink-0 w-72 bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 group snap-start">
                        <div class="relative overflow-hidden">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-44 object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-44 bg-gradient-to-br from-green-50 to-emerald-100 flex items-center justify-center">
                                    <i class="{{ $event->icon }} text-5xl text-green-400"></i>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3 bg-green-600 text-white rounded-xl px-3 py-2 text-center leading-none shadow-lg">
                                <span class="text-lg font-black block">{{ $event->event_date->format('d') }}</span>
                                <span class="text-[10px] font-bold uppercase tracking-widest block">{{ $event->event_date->format('M') }}</span>
                            </div>
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-green-600 rounded-xl p-2 shadow-lg">
                                <i class="{{ $event->icon }} text-lg"></i>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-black text-gray-900 text-sm mb-2 leading-tight">{{ $event->title }}</h3>
                            <p class="text-gray-500 text-xs mb-4 leading-relaxed">{{ Str::limit($event->description, 80) }}</p>
                            <div class="flex flex-col gap-1.5 text-[10px] text-gray-400 font-bold">
                                @if($event->location)
                                    <span><i class="fas fa-map-marker-alt mr-1.5 text-green-500"></i>{{ $event->location }}</span>
                                @endif
                                @if($event->formatted_time)
                                    <span><i class="far fa-clock mr-1.5 text-green-500"></i>{{ $event->formatted_time }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback static cards -->
                    <div class="flex-shrink-0 w-72 bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 group snap-start">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=600&auto=format&fit=crop" alt="Tree Plantation" class="w-full h-44 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-green-600 text-white rounded-xl px-3 py-2 text-center leading-none shadow-lg">
                                <span class="text-lg font-black block">28</span>
                                <span class="text-[10px] font-bold uppercase tracking-widest block">MAY</span>
                            </div>
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-green-600 rounded-xl p-2 shadow-lg">
                                <i class="fas fa-seedling text-lg"></i>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-black text-gray-900 text-sm mb-2 leading-tight">Tree Plantation Drive 2025</h3>
                            <p class="text-gray-500 text-xs mb-4 leading-relaxed">Join us in planting more trees and making our environment greener.</p>
                            <div class="flex flex-col gap-1.5 text-[10px] text-gray-400 font-bold">
                                <span><i class="fas fa-map-marker-alt mr-1.5 text-green-500"></i>Begusarai, Bihar</span>
                                <span><i class="far fa-clock mr-1.5 text-green-500"></i>9:00 AM – 1:00 PM</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-72 bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 group snap-start">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?q=80&w=600&auto=format&fit=crop" alt="Health Checkup" class="w-full h-44 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-green-600 text-white rounded-xl px-3 py-2 text-center leading-none shadow-lg">
                                <span class="text-lg font-black block">05</span>
                                <span class="text-[10px] font-bold uppercase tracking-widest block">JUN</span>
                            </div>
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-green-600 rounded-xl p-2 shadow-lg">
                                <i class="fas fa-heartbeat text-lg"></i>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-black text-gray-900 text-sm mb-2 leading-tight">Free Health Checkup Camp</h3>
                            <p class="text-gray-500 text-xs mb-4 leading-relaxed">Free health checkups and medicines distribution for rural communities.</p>
                            <div class="flex flex-col gap-1.5 text-[10px] text-gray-400 font-bold">
                                <span><i class="fas fa-map-marker-alt mr-1.5 text-green-500"></i>Begusarai, Bihar</span>
                                <span><i class="far fa-clock mr-1.5 text-green-500"></i>10:00 AM – 2:00 PM</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-72 bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 group snap-start">
                        <div class="relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=600&auto=format&fit=crop" alt="Women Empowerment" class="w-full h-44 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-3 left-3 bg-green-600 text-white rounded-xl px-3 py-2 text-center leading-none shadow-lg">
                                <span class="text-lg font-black block">15</span>
                                <span class="text-[10px] font-bold uppercase tracking-widest block">JUN</span>
                            </div>
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-green-600 rounded-xl p-2 shadow-lg">
                                <i class="fas fa-female text-lg"></i>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-black text-gray-900 text-sm mb-2 leading-tight">Women Empowerment Workshop</h3>
                            <p class="text-gray-500 text-xs mb-4 leading-relaxed">Skill training and motivation session for women empowerment.</p>
                            <div class="flex flex-col gap-1.5 text-[10px] text-gray-400 font-bold">
                                <span><i class="fas fa-map-marker-alt mr-1.5 text-green-500"></i>Begusarai, Bihar</span>
                                <span><i class="far fa-clock mr-1.5 text-green-500"></i>11:00 AM – 2:00 PM</span>
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <!-- Workshops Section -->
    <div class="py-16 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10" data-aos="fade-up">
                <div>
                    <h2 class="text-2xl font-black text-gray-900">Workshops</h2>
                    <div class="w-12 h-1 bg-green-500 rounded-full mt-2"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <!-- Workshop Image -->
                <div class="relative group rounded-3xl overflow-hidden shadow-2xl" data-aos="fade-right">
                    <div class="absolute inset-0 bg-green-600/10 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200&auto=format&fit=crop" alt="Workshops" class="w-full h-[380px] object-cover transition-transform duration-700 group-hover:scale-105">
                </div>

                <!-- Workshop List -->
                <div class="space-y-5" data-aos="fade-left">
                    @forelse($workshops as $workshop)
                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg hover:border-green-200 transition-all duration-300 flex items-center gap-5 group cursor-pointer">
                            <div class="w-12 h-12 bg-green-50 group-hover:bg-green-500 text-green-600 group-hover:text-white rounded-xl flex items-center justify-center transition-all shrink-0">
                                <i class="{{ $workshop->icon }} text-xl"></i>
                            </div>
                            <div class="flex-grow">
                                <h4 class="font-black text-gray-900 text-sm mb-1">{{ $workshop->title }}</h4>
                                <p class="text-xs text-gray-500">{{ Str::limit($workshop->description, 70) }}</p>
                                <div class="flex gap-3 mt-2 text-[10px] text-gray-400 font-bold">
                                    <span><i class="far fa-calendar mr-1"></i>{{ $workshop->formatted_date }}</span>
                                    @if($workshop->formatted_time)
                                        <span><i class="far fa-clock mr-1"></i>{{ $workshop->formatted_time }}</span>
                                    @endif
                                </div>
                            </div>
                            <i class="fas fa-arrow-right text-gray-300 group-hover:text-green-500 transition-colors"></i>
                        </div>
                    @empty
                        <!-- Fallback static workshops -->
                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg hover:border-green-200 transition-all duration-300 flex items-center gap-5 group cursor-pointer">
                            <div class="w-12 h-12 bg-green-50 group-hover:bg-green-500 text-green-600 group-hover:text-white rounded-xl flex items-center justify-center transition-all shrink-0">
                                <i class="fas fa-tools text-xl"></i>
                            </div>
                            <div class="flex-grow">
                                <h4 class="font-black text-gray-900 text-sm mb-1">Skill Development Workshop</h4>
                                <p class="text-xs text-gray-500">Hands-on training to build practical skills for a better future.</p>
                                <div class="flex gap-3 mt-2 text-[10px] text-gray-400 font-bold">
                                    <span><i class="far fa-calendar mr-1"></i>12 Jun, 2025</span>
                                    <span><i class="far fa-clock mr-1"></i>11:00 AM – 1:00 PM</span>
                                </div>
                            </div>
                            <i class="fas fa-arrow-right text-gray-300 group-hover:text-green-500 transition-colors"></i>
                        </div>

                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg hover:border-green-200 transition-all duration-300 flex items-center gap-5 group cursor-pointer">
                            <div class="w-12 h-12 bg-green-50 group-hover:bg-green-500 text-green-600 group-hover:text-white rounded-xl flex items-center justify-center transition-all shrink-0">
                                <i class="fas fa-laptop text-xl"></i>
                            </div>
                            <div class="flex-grow">
                                <h4 class="font-black text-gray-900 text-sm mb-1">Digital Literacy Workshop</h4>
                                <p class="text-xs text-gray-500">Empowering communities with digital knowledge and tools.</p>
                                <div class="flex gap-3 mt-2 text-[10px] text-gray-400 font-bold">
                                    <span><i class="far fa-calendar mr-1"></i>18 Jun, 2025</span>
                                    <span><i class="far fa-clock mr-1"></i>10:00 AM – 12:00 PM</span>
                                </div>
                            </div>
                            <i class="fas fa-arrow-right text-gray-300 group-hover:text-green-500 transition-colors"></i>
                        </div>

                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg hover:border-green-200 transition-all duration-300 flex items-center gap-5 group cursor-pointer">
                            <div class="w-12 h-12 bg-green-50 group-hover:bg-green-500 text-green-600 group-hover:text-white rounded-xl flex items-center justify-center transition-all shrink-0">
                                <i class="fas fa-heartbeat text-xl"></i>
                            </div>
                            <div class="flex-grow">
                                <h4 class="font-black text-gray-900 text-sm mb-1">Health & Hygiene Awareness</h4>
                                <p class="text-xs text-gray-500">Awareness session on health, hygiene and cleanliness.</p>
                                <div class="flex gap-3 mt-2 text-[10px] text-gray-400 font-bold">
                                    <span><i class="far fa-calendar mr-1"></i>25 Jun, 2025</span>
                                    <span><i class="far fa-clock mr-1"></i>11:00 AM – 1:00 PM</span>
                                </div>
                            </div>
                            <i class="fas fa-arrow-right text-gray-300 group-hover:text-green-500 transition-colors"></i>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Awareness Campaigns -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8" data-aos="fade-up">
                <div>
                    <h2 class="text-2xl font-black text-gray-900">Awareness Campaigns</h2>
                    <div class="w-12 h-1 bg-green-500 rounded-full mt-2"></div>
                </div>
            </div>

            <!-- Scrollable Campaign Cards -->
            <div class="flex overflow-x-auto gap-6 pb-6 custom-scrollbar snap-x" data-aos="fade-up" data-aos-delay="100">

                @forelse($campaigns as $campaign)
                    <div class="flex-shrink-0 w-64 group snap-start cursor-pointer">
                        <div class="relative rounded-2xl overflow-hidden mb-4">
                            @if($campaign->image)
                                <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-44 object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-44 bg-gradient-to-br from-green-50 to-emerald-100 flex items-center justify-center">
                                    <i class="{{ $campaign->icon }} text-5xl text-green-400"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors"></div>
                            <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm rounded-xl p-2 shadow-lg">
                                <i class="{{ $campaign->icon }} text-green-600 text-lg"></i>
                            </div>
                        </div>
                        <h3 class="font-black text-gray-900 text-sm mb-1 group-hover:text-green-600 transition-colors">{{ $campaign->title }}</h3>
                        <p class="text-xs text-gray-500 mb-3 leading-relaxed">{{ Str::limit($campaign->description, 70) }}</p>
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-black uppercase tracking-widest
                            @if($campaign->status === 'ongoing') text-green-600
                            @elseif($campaign->status === 'upcoming') text-blue-600
                            @else text-gray-500 @endif">
                            @if($campaign->status === 'ongoing')
                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Ongoing
                            @elseif($campaign->status === 'upcoming')
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Upcoming
                            @else
                                <span class="w-2 h-2 bg-gray-400 rounded-full"></span> Completed
                            @endif
                        </span>
                    </div>
                @empty
                    <!-- Fallback static campaigns -->
                    <div class="flex-shrink-0 w-64 group snap-start cursor-pointer">
                        <div class="relative rounded-2xl overflow-hidden mb-4">
                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=600&auto=format&fit=crop" alt="Environment Campaign" class="w-full h-44 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors"></div>
                            <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm rounded-xl p-2 shadow-lg">
                                <i class="fas fa-leaf text-green-600 text-lg"></i>
                            </div>
                        </div>
                        <h3 class="font-black text-gray-900 text-sm mb-1 group-hover:text-green-600 transition-colors">Save Environment Campaign</h3>
                        <p class="text-xs text-gray-500 mb-3 leading-relaxed">Spreading awareness about protecting nature and preserving our planet.</p>
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-black text-green-600 uppercase tracking-widest">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Ongoing
                        </span>
                    </div>

                    <div class="flex-shrink-0 w-64 group snap-start cursor-pointer">
                        <div class="relative rounded-2xl overflow-hidden mb-4">
                            <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?q=80&w=600&auto=format&fit=crop" alt="No Plastic" class="w-full h-44 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors"></div>
                            <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm rounded-xl p-2 shadow-lg">
                                <i class="fas fa-ban text-red-500 text-lg"></i>
                            </div>
                        </div>
                        <h3 class="font-black text-gray-900 text-sm mb-1 group-hover:text-green-600 transition-colors">Say No to Plastic Campaign</h3>
                        <p class="text-xs text-gray-500 mb-3 leading-relaxed">Promoting a plastic-free lifestyle for a clean and healthy environment.</p>
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-black text-green-600 uppercase tracking-widest">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Ongoing
                        </span>
                    </div>

                    <div class="flex-shrink-0 w-64 group snap-start cursor-pointer">
                        <div class="relative rounded-2xl overflow-hidden mb-4">
                            <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=600&auto=format&fit=crop" alt="Education Campaign" class="w-full h-44 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors"></div>
                            <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm rounded-xl p-2 shadow-lg">
                                <i class="fas fa-book text-blue-600 text-lg"></i>
                            </div>
                        </div>
                        <h3 class="font-black text-gray-900 text-sm mb-1 group-hover:text-green-600 transition-colors">Education for All Campaign</h3>
                        <p class="text-xs text-gray-500 mb-3 leading-relaxed">Encouraging every child to access quality education.</p>
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-black text-green-600 uppercase tracking-widest">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Ongoing
                        </span>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <!-- Stay Updated / Newsletter Banner -->
    <div class="py-16 bg-[#031533]" data-aos="fade-up">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-green-600/20 border border-green-600/40 rounded-2xl flex items-center justify-center shrink-0">
                        <i class="fas fa-envelope text-green-400 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-white">Stay Updated With Our Events</h3>
                        <p class="text-gray-400 text-sm">Subscribe to our newsletter and never miss an update.</p>
                    </div>
                </div>
                <form class="flex items-center gap-3 w-full md:w-auto">
                    @csrf
                    <input type="email" placeholder="Enter your email" class="flex-1 md:w-72 px-5 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-green-500 transition-colors text-sm">
                    <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition-colors text-sm whitespace-nowrap">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #16a34a; border-radius: 10px; }
    </style>

</x-frontend.layout>
