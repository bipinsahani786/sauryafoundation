<x-frontend.layout>
    <x-slot name="title">Home | {{ $siteSettings['site_name'] ?? 'Shaurya Narayan Foundation' }}</x-slot>

    <!-- New Hero Section -->
    <section class="relative bg-white pt-[112px] flex flex-col lg:flex-row overflow-hidden lg:h-[700px]">
        
        <!-- Left Side: Text Content -->
        <div class="w-full lg:w-[55%] flex flex-col justify-center pl-6 md:pl-12 lg:pl-20 pr-6 lg:pr-32 py-16 relative z-10">
            <!-- Background subtle image blend -->
            <div class="absolute bottom-0 left-0 w-full h-[60%] opacity-20 pointer-events-none" style="background: url('{{ $banners->first() ? asset('storage/' . $banners->first()->image_path) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&q=80' }}') center bottom/cover; mask-image: linear-gradient(to top, black, transparent); -webkit-mask-image: linear-gradient(to top, black, transparent);"></div>
            
            <div class="relative z-10 max-w-2xl">
                <h1 class="text-[#0a1c3a] text-3xl md:text-4xl lg:text-5xl font-black uppercase tracking-tight leading-[1.1] mb-2">
                    Together, we can
                </h1>
                <h2 class="text-[#278c3c] text-4xl md:text-5xl lg:text-6xl font-black uppercase tracking-tight leading-[1.1] mb-6">
                    Build a better<br>tomorrow
                </h2>
                
                <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-8 max-w-lg font-medium">
                    Shaurya Narayan Foundation is dedicated to creating positive change through education, healthcare, elderly care, environment protection and community development.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('involved.donate') }}" class="px-6 py-3 bg-[#278c3c] text-white rounded-full font-bold text-sm hover:bg-[#1f7230] transition-colors shadow-lg flex items-center gap-2">
                        <i class="fas fa-heart"></i> DONATE NOW
                    </a>
                    <a href="#about" class="px-6 py-3 bg-white text-[#278c3c] border-2 border-[#278c3c] rounded-full font-bold text-sm hover:bg-[#278c3c] hover:text-white transition-colors flex items-center gap-2">
                        <i class="fas fa-users"></i> JOIN US
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Side: Image Collage -->
        <div class="w-full lg:w-[55%] h-[500px] lg:absolute lg:top-0 lg:right-0 lg:bottom-0 lg:h-auto relative overflow-hidden bg-white z-20" style="clip-path: polygon(15% 0, 100% 0, 100% 100%, 0 100%);">
            
            <!-- Diagonal Wrapper to slant everything uniformly -->
            <div class="absolute inset-0 -left-[10%] w-[120%] h-[120%] -top-[10%]">
                
                <!-- Position 1 (Top Left) -->
                @if(isset($sectors[0]))
                <a href="{{ route('sectors.detail', $sectors[0]->slug) }}" class="absolute top-0 left-0 w-[55%] h-[55%] border-[4px] border-white overflow-hidden z-10 group" style="clip-path: polygon(0 0, 100% 0, 75% 100%, 0 100%);">
                    <img src="{{ asset('storage/' . $sectors[0]->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $sectors[0]->title }}">
                    <div class="absolute bottom-10 right-[30%] bg-white px-3 py-1 rounded-full flex items-center gap-2 text-[10px] font-bold shadow-lg uppercase text-green-700 group-hover:bg-green-700 group-hover:text-white transition-colors">
                        <i class="fab fa-envira"></i> {{ $sectors[0]->title }}
                    </div>
                </a>
                @endif

                <!-- Position 2 (Top Right) -->
                @if(isset($sectors[1]))
                <a href="{{ route('sectors.detail', $sectors[1]->slug) }}" class="absolute top-0 right-0 w-[55%] h-[45%] border-[4px] border-white overflow-hidden z-10 group" style="clip-path: polygon(25% 0, 100% 0, 100% 100%, 0 100%);">
                    <img src="{{ asset('storage/' . $sectors[1]->image_path) }}" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700" alt="{{ $sectors[1]->title }}">
                    <div class="absolute bottom-6 left-1/4 bg-white px-3 py-1 rounded-full flex items-center gap-2 text-[10px] font-bold shadow-lg uppercase text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i class="fas fa-graduation-cap"></i> {{ $sectors[1]->title }}
                    </div>
                </a>
                @endif

                <!-- Position 3 (Bottom Left) -->
                @if(isset($sectors[2]))
                <a href="{{ route('sectors.detail', $sectors[2]->slug) }}" class="absolute bottom-0 left-0 w-[50%] h-[55%] border-[4px] border-white overflow-hidden z-10 group" style="clip-path: polygon(0 0, 100% 0, 80% 100%, 0 100%);">
                    <img src="{{ asset('storage/' . $sectors[2]->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $sectors[2]->title }}">
                    <div class="absolute bottom-12 left-10 bg-white px-3 py-1 rounded-full flex items-center gap-2 text-[10px] font-bold shadow-lg uppercase text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <i class="fas fa-hands-helping"></i> {{ $sectors[2]->title }}
                    </div>
                </a>
                @endif

                <!-- Position 4 (Bottom Center) -->
                @if(isset($sectors[3]))
                <a href="{{ route('sectors.detail', $sectors[3]->slug) }}" class="absolute bottom-0 right-[25%] w-[45%] h-[55%] border-[4px] border-white overflow-hidden z-20 group" style="clip-path: polygon(20% 0, 100% 0, 80% 100%, 0 100%);">
                    <img src="{{ asset('storage/' . $sectors[3]->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $sectors[3]->title }}">
                    <div class="absolute bottom-12 left-[20%] bg-white px-3 py-1 rounded-full flex items-center gap-2 text-[10px] font-bold shadow-lg uppercase text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                        <i class="fas fa-users"></i> {{ $sectors[3]->title }}
                    </div>
                </a>
                @endif

                <!-- Position 5 (Right Edge) -->
                @if(isset($sectors[4]))
                <a href="{{ route('sectors.detail', $sectors[4]->slug) }}" class="absolute top-[35%] right-0 w-[30%] h-[65%] border-[4px] border-white overflow-hidden z-10 group" style="clip-path: polygon(20% 0, 100% 0, 100% 100%, 0 100%);">
                    <img src="{{ asset('storage/' . $sectors[4]->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $sectors[4]->title }}">
                    <div class="absolute top-[40%] left-6 bg-white px-3 py-1 rounded-full flex items-center gap-2 text-[10px] font-bold shadow-lg uppercase text-red-600 group-hover:bg-red-600 group-hover:text-white transition-colors">
                        <i class="fas fa-heartbeat"></i> {{ $sectors[4]->title }}
                    </div>
                </a>
                @endif
            </div>

            <!-- Central Logo Badge -->
            <div class="absolute top-1/2 left-[45%] -translate-x-1/2 -translate-y-1/2 w-32 h-32 md:w-40 md:h-40 bg-white rounded-full border-[6px] border-[#278c3c] shadow-2xl flex flex-col items-center justify-center p-3 z-30 transform hover:scale-105 transition-transform duration-500">
                @if(isset($siteSettings['site_logo']))
                    <img src="{{ asset('storage/' . $siteSettings['site_logo']) }}" alt="Logo" class="w-12 h-12 md:w-16 md:h-16 object-contain mb-1">
                @else
                    <div class="w-12 h-12 bg-gray-100 rounded-full mb-1"></div>
                @endif
                <div class="text-center leading-tight">
                    <span class="text-[#278c3c] font-black text-[9px] md:text-[11px] block">SHAURYA NARAYAN</span>
                    <span class="text-[#278c3c] font-bold text-[7px] md:text-[9px] tracking-widest block">FOUNDATION</span>
                </div>
            </div>
            
        </div>
    </section>

    <!-- New Stats Bar -->
    <section class="bg-[#0a1c3a] py-8 border-t-4 border-[#278c3c]">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 divide-x divide-gray-700/50">
                
                <!-- Stat 1 -->
                <div class="flex items-center gap-4 px-4 justify-center md:justify-start">
                    <div class="w-12 h-12 rounded-full bg-[#278c3c] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-black text-xl md:text-2xl leading-none mb-1">10,000+</h4>
                        <p class="text-gray-300 text-xs font-medium">Lives Impacted</p>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="flex items-center gap-4 px-4 justify-center md:justify-start">
                    <div class="w-12 h-12 rounded-full bg-[#278c3c] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-black text-xl md:text-2xl leading-none mb-1">500+</h4>
                        <p class="text-gray-300 text-xs font-medium">Students Supported</p>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="flex items-center gap-4 px-4 justify-center md:justify-start">
                    <div class="w-12 h-12 rounded-full bg-[#278c3c] flex items-center justify-center flex-shrink-0">
                        <i class="fab fa-envira text-white text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-black text-xl md:text-2xl leading-none mb-1">100+</h4>
                        <p class="text-gray-300 text-xs font-medium">Plantation Drives</p>
                    </div>
                </div>

                <!-- Stat 4 -->
                <div class="flex items-center gap-4 px-4 justify-center md:justify-start">
                    <div class="w-12 h-12 rounded-full bg-[#278c3c] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-briefcase-medical text-white text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-black text-xl md:text-2xl leading-none mb-1">50+</h4>
                        <p class="text-gray-300 text-xs font-medium">Health Camps</p>
                    </div>
                </div>

                <!-- Stat 5 -->
                <div class="flex items-center gap-4 px-4 justify-center md:justify-start col-span-2 lg:col-span-1">
                    <div class="w-12 h-12 rounded-full bg-[#278c3c] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-hands-helping text-white text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-black text-xl md:text-2xl leading-none mb-1">20+</h4>
                        <p class="text-gray-300 text-xs font-medium">Community Programs</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
 
    <!-- About Founder Section -->
    <section class="py-20 bg-gray-50 border-b border-gray-100" id="about-founder">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                <!-- Left: Image Collage -->
                <div class="w-full lg:w-1/2" data-aos="fade-right">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Top wide image -->
                        <div class="col-span-2 h-48 md:h-64 rounded-2xl overflow-hidden shadow-lg group">
                            <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&q=80" alt="Foundation Work" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>
                        <!-- Bottom left image -->
                        <div class="h-48 md:h-56 rounded-2xl overflow-hidden shadow-lg group">
                            <img src="https://images.unsplash.com/photo-1593113580556-9a55c2f35472?auto=format&fit=crop&q=80" alt="Team" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>
                        <!-- Bottom right stacked -->
                        <div class="flex flex-col gap-4">
                            <!-- Founder Name Block -->
                            <div class="bg-[#0a1c3a] text-white p-6 rounded-2xl shadow-lg flex flex-col justify-center items-center text-center h-24 md:h-28 hover:bg-[#278c3c] transition-colors duration-500 cursor-default">
                                <h4 class="font-black text-sm md:text-base tracking-wide">Mr. Kaushal Kumar</h4>
                                <p class="text-[10px] md:text-xs font-medium text-gray-300 uppercase tracking-widest mt-1">Founder</p>
                            </div>
                            <!-- Small image -->
                            <div class="flex-grow rounded-2xl overflow-hidden shadow-lg group h-20 md:h-24">
                                <img src="https://images.unsplash.com/photo-1542810634-71277d95dc8c?auto=format&fit=crop&q=80" alt="Community" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Content -->
                <div class="w-full lg:w-1/2" data-aos="fade-left">
                    <span class="inline-block text-[#278c3c] text-xs font-black uppercase tracking-[0.25em] mb-3">ABOUT ME!</span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#0a1c3a] mb-6 leading-tight">
                        A life dedicated to<br>
                        <span class="text-[#278c3c]">service</span>
                    </h2>
                    
                    <div class="w-16 h-1 bg-[#278c3c] rounded-full mb-8"></div>

                    <p class="text-gray-600 text-base md:text-lg leading-relaxed mb-6 font-medium">
                        Shauryanarayan foundation has a bold vision for Empowering Communities Through Education, Healthcare & Sustainable Development
                    </p>
                    
                    <a href="{{ route('about.mission') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-[#0a1c3a] hover:bg-[#278c3c] text-white font-bold rounded-full transition-all duration-300 shadow-[0_10px_20px_rgba(10,28,58,0.2)] hover:shadow-[0_10px_20px_rgba(39,140,60,0.3)] hover:-translate-y-1 text-sm group mt-4">
                        Know More
                        <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-white/30 transition-colors">
                            <i class="fas fa-arrow-right text-xs"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Sectors Section -->
    @if($sectors->count() > 0)
    <section class="py-20 bg-white" id="sectors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-block text-[#278c3c] text-xs font-black uppercase tracking-[0.25em] mb-3">What We Do</span>
                <h2 class="text-4xl md:text-5xl font-black text-[#0a1c3a] mb-5 leading-tight">Our Sectors of <span class="text-[#278c3c]">Work</span></h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-base leading-relaxed">
                    We work across multiple domains to create holistic, lasting impact in communities across Bihar and beyond.
                </p>
                <div class="w-16 h-1 bg-[#278c3c] rounded-full mx-auto mt-6"></div>
            </div>

            <!-- Sector Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach($sectors as $index => $sector)
                <a href="{{ route('sectors.detail', $sector->slug) }}"
                   class="group relative bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 flex flex-col"
                   data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">

                    <!-- Image -->
                    <div class="relative h-52 overflow-hidden">
                        <img src="{{ asset('storage/' . $sector->image_path) }}"
                             alt="{{ $sector->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <!-- Gradient overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a1c3a]/80 via-[#0a1c3a]/20 to-transparent"></div>

                        <!-- Icon badge -->
                        <div class="absolute top-4 right-4 w-11 h-11 bg-white/90 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-lg group-hover:bg-[#278c3c] transition-colors duration-300">
                            <i class="{{ $sector->icon ?? 'fas fa-leaf' }} text-[#278c3c] group-hover:text-white transition-colors duration-300 text-lg"></i>
                        </div>

                        <!-- Tag badge -->
                        @if($sector->tag)
                        <div class="absolute top-4 left-4 bg-[#278c3c] text-white text-[9px] font-black uppercase tracking-widest px-3 py-1 rounded-full">
                            {{ $sector->tag }}
                        </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-lg font-black text-[#0a1c3a] mb-2 group-hover:text-[#278c3c] transition-colors duration-300 leading-snug">
                            {{ $sector->title }}
                        </h3>
                        <p class="text-gray-500 text-sm leading-relaxed flex-grow">
                            {{ Str::limit($sector->description, 100) }}
                        </p>

                        <!-- Arrow link -->
                        <div class="mt-5 flex items-center justify-between pt-4 border-t border-gray-100">
                            <span class="text-xs font-black text-[#278c3c] uppercase tracking-widest">Learn More</span>
                            <div class="w-8 h-8 bg-gray-50 group-hover:bg-[#278c3c] rounded-xl flex items-center justify-center transition-all duration-300">
                                <i class="fas fa-arrow-right text-gray-400 group-hover:text-white text-xs transition-colors duration-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- View All CTA -->
            <div class="text-center mt-12" data-aos="fade-up">
                <a href="{{ route('work.index') }}"
                   class="inline-flex items-center gap-3 px-8 py-4 bg-[#0a1c3a] hover:bg-[#278c3c] text-white font-bold rounded-full transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5 text-sm">
                    <i class="fas fa-th-large"></i>
                    View All Our Work
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- 6. How it Works (Condensed Steps) -->
    {{-- <section class="py-32 relative bg-brand-dark overflow-hidden">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-brand-accent/5 rounded-full blur-[150px]"></div>
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-24" data-aos="fade-up">
                <h2 class="text-brand-primary font-bold tracking-widest uppercase mb-4 text-sm">Simple Payouts</h2>
                <h3 class="text-5xl font-extrabold text-white mb-6">4 Steps to Syndicate Wealth.</h3>
            </div>
            <div class="grid md:grid-cols-4 gap-12 relative">
                <div class="hidden md:block absolute top-[60px] left-0 right-0 h-px bg-brand-border z-0"></div>

                <div class="relative z-10 text-center" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-16 h-16 bg-brand-dark border-2 border-brand-primary rounded-full flex items-center justify-center mx-auto mb-8 text-2xl font-black text-white shadow-[0_0_20px_rgba(14,165,233,0.3)]">1</div>
                    <h5 class="text-xl font-bold text-white mb-3">Apply</h5>
                    <p class="text-gray-500 text-sm">Join our vetted waitlist of high-potential investors.</p>
                </div>
                <div class="relative z-10 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-brand-dark border-2 border-brand-accent rounded-full flex items-center justify-center mx-auto mb-8 text-2xl font-black text-white">2</div>
                    <h5 class="text-xl font-bold text-white mb-3">KYC</h5>
                    <p class="text-gray-500 text-sm">Fast, paperless digital verification for compliance.</p>
                </div>
                <div class="relative z-10 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-brand-dark border-2 border-purple-500 rounded-full flex items-center justify-center mx-auto mb-8 text-2xl font-black text-white">3</div>
                    <h5 class="text-xl font-bold text-white mb-3">Pool</h5>
                    <p class="text-gray-400 font-bold mb-3">Capital is pooled into legally separate asset companies.</p>
                </div>
                <div class="relative z-10 text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-brand-dark border-2 border-yellow-500 rounded-full flex items-center justify-center mx-auto mb-8 text-2xl font-black text-white shadow-[0_0_20px_rgba(234,179,8,0.3)]">4</div>
                    <h5 class="text-xl font-bold text-white mb-3">Yield</h5>
                    <p class="text-gray-500 text-sm">Track your quarterly dividends via your member panel.</p>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- 8. Managed by Experts (Team) -->
    <section class="py-32 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-24" data-aos="fade-up">
                <h2 class="text-brand-primary font-bold tracking-widest uppercase mb-4 text-sm">Leadership</h2>
                <h3 class="text-5xl font-extrabold text-gray-900 mb-6">Our Leadership</h3>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Our leadership team brings decades of experience in real estate, finance, and technology.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 lg:gap-24">
                @foreach($experts as $index => $expert)
                    <!-- Expert {{ $index + 1 }} -->
                    <div class="text-center group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="relative w-56 h-56 md:w-64 md:h-64 mx-auto mb-8">
                            <div class="absolute inset-0 bg-{{ $index % 2 == 0 ? 'brand-primary' : 'brand-accent' }}/20 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-500"></div>
                            <img src="{{ asset('storage/' . $expert->image) }}" class="relative w-full h-full rounded-full border-4 border-gray-200 group-hover:border-{{ $index % 2 == 0 ? 'brand-primary' : 'brand-accent' }} transition-all object-cover" alt="{{ $expert->name }}" loading="lazy">
                            @if($expert->linkedin_url)
                                <a href="{{ $expert->linkedin_url }}" target="_blank" class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-{{ $index % 2 == 0 ? 'brand-primary' : 'brand-accent' }} text-white p-3 rounded-xl shadow-xl hover:scale-110 transition-transform"><i class="fab fa-linkedin-in"></i></a>
                            @endif
                        </div>
                        <h5 class="text-3xl font-black text-gray-900 mb-2">{{ $expert->name }}</h5>
                        <p class="text-{{ $index % 2 == 0 ? 'brand-primary' : 'brand-accent' }} font-bold uppercase tracking-widest text-xs mb-4">{{ $expert->designation }}</p>
                        <p class="text-gray-600 text-sm leading-relaxed px-4">{{ $expert->bio }}</p>
                    </div>
                @endforeach
            </div>
    </section>
    <!-- 9. Voices of the Syndicate (Reviews) -->
    <section class="py-32 bg-gray-50 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-24" data-aos="fade-up">
                <h2 class="text-[#278c3c] font-bold tracking-widest uppercase mb-4 text-sm">Community</h2>
                <h3 class="text-5xl font-extrabold text-[#0a1c3a] mb-6">Voices of the Syndicate.</h3>
            </div>
            <div class="grid lg:grid-cols-3 gap-10">
                @php
                    $colors = ['[#278c3c]', '[#0a1c3a]', 'gray-500'];
                @endphp
                @foreach($testimonials as $index => $testimonial)
                    <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 relative" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <i class="fas fa-quote-left text-gray-100 text-8xl absolute top-8 left-8"></i>
                        <div class="flex gap-1 mb-8 relative z-10 text-yellow-500">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $testimonial->rating ? '' : 'text-slate-200' }}"></i>
                            @endfor
                        </div>
                        <p class="text-gray-700 mb-10 text-lg leading-relaxed relative z-10 italic">"{{ $testimonial->content }}"</p>
                        <div class="flex items-center gap-5 pt-8 border-t border-gray-100">
                            <img src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('images/default-avatar.png') }}" class="w-16 h-16 rounded-3xl object-cover border-2 border-[#278c3c]" alt="{{ $testimonial->name }}" loading="lazy">
                            <div>
                                <p class="text-[#0a1c3a] font-black text-xl">{{ $testimonial->name }}</p>
                                <p class="text-[#278c3c] font-bold text-xs uppercase tracking-widest">{{ $testimonial->designation }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- What People Says Section -->
    <section class="py-24 bg-[#0a1c3a] relative overflow-hidden" id="testimonials">
        <!-- Background Overlay -->
        <div class="absolute inset-0 opacity-10 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&q=80');"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10 mb-20">
            <h3 class="text-3xl md:text-4xl font-bold text-white uppercase tracking-wider">What People Says</h3>
            <div class="w-32 h-1 bg-[#278c3c] mt-4"></div>
        </div>

        <!-- Marquee Container -->
        <div class="relative z-10 w-full overflow-hidden pb-12 flex group">
            @php
            $staticReviews = [
                (object)[
                    'name' => 'Mr. Rohit Singh',
                    'content' => 'I\'m glad I chose Shaurya Narayan Foundation for my studies. The well-equipped facilities and real-world simulations provided a real taste of what the field is like, making my transition into my job seamless.',
                    'image' => 'https://ui-avatars.com/api/?name=Rohit+Singh&background=0284c7&color=fff'
                ],
                (object)[
                    'name' => 'Ms. Aditi Singh',
                    'content' => 'At Shaurya Narayan Foundation, we strive to create an environment where everyone can thrive academically, socially, and personally. Our dedication to quality education and character development ensures that our students are well-prepared for the challenges of tomorrow.',
                    'image' => 'https://ui-avatars.com/api/?name=Aditi+Singh&background=7e22ce&color=fff'
                ],
                (object)[
                    'name' => 'Mr. Prem Shanker',
                    'content' => 'Through a blend of innovative teaching and values-based learning, Shaurya Narayan Foundation aims to inspire and equip students to become thoughtful leaders and lifelong learners who contribute positively to society.',
                    'image' => 'https://ui-avatars.com/api/?name=Prem+Shanker&background=c2410c&color=fff'
                ]
            ];
            @endphp

            <!-- First Marquee Track -->
            <div class="flex animate-marquee min-w-full flex-shrink-0 group-hover:[animation-play-state:paused]">
                @foreach($staticReviews as $testimonial)
                <div class="w-[350px] md:w-[450px] flex-shrink-0 px-4 pt-10 mx-4">
                    <div class="bg-white p-8 pb-12 relative shadow-xl min-h-[220px]">
                        <!-- Avatar -->
                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-white rounded-full p-1.5 shadow-md">
                            <img src="{{ $testimonial->image }}" class="w-full h-full rounded-full object-cover" alt="{{ $testimonial->name }}">
                        </div>
                        
                        <!-- Top Quote Icon -->
                        <div class="text-[#278c3c] text-3xl mb-3 mt-4">
                            <i class="fas fa-quote-left"></i>
                        </div>

                        <h5 class="text-lg font-bold text-gray-900 mb-3">{{ $testimonial->name }}</h5>
                        
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            "{{ $testimonial->content }}"
                        </p>

                        <!-- Bottom Quote Icon -->
                        <div class="absolute bottom-4 right-6 text-[#278c3c] text-3xl">
                            <i class="fas fa-quote-right"></i>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Second Marquee Track (for seamless loop) -->
            <div class="flex animate-marquee min-w-full flex-shrink-0 group-hover:[animation-play-state:paused]" aria-hidden="true">
                @foreach($staticReviews as $testimonial)
                <div class="w-[350px] md:w-[450px] flex-shrink-0 px-4 pt-10 mx-4">
                    <div class="bg-white p-8 pb-12 relative shadow-xl min-h-[220px]">
                        <!-- Avatar -->
                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-white rounded-full p-1.5 shadow-md">
                            <img src="{{ $testimonial->image }}" class="w-full h-full rounded-full object-cover" alt="{{ $testimonial->name }}">
                        </div>
                        
                        <!-- Top Quote Icon -->
                        <div class="text-[#278c3c] text-3xl mb-3 mt-4">
                            <i class="fas fa-quote-left"></i>
                        </div>

                        <h5 class="text-lg font-bold text-gray-900 mb-3">{{ $testimonial->name }}</h5>
                        
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            "{{ $testimonial->content }}"
                        </p>

                        <!-- Bottom Quote Icon -->
                        <div class="absolute bottom-4 right-6 text-[#278c3c] text-3xl">
                            <i class="fas fa-quote-right"></i>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Partners & Sponsors -->
    <section class="py-24 bg-white border-t border-gray-100 overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-[#0a1c3a] mb-8">Partners & Sponsors</h2>
            
            <h4 class="text-xl font-bold text-[#278c3c] mb-6">Investment & Partnership Opportunity</h4>
            
            <p class="text-gray-600 text-lg leading-relaxed mb-6">
                Our organization is actively working on projects across these sectors.<br>
                You too can contribute your valuable time and financial support as a part of our cooperation and development model.
            </p>
            
            <p class="text-gray-800 font-bold text-lg">
                Together, we can create positive social impact and build a better future for society.
            </p>
        </div>

        <!-- Marquee Logos -->
        <div class="relative w-full overflow-hidden flex group pt-10">
            @if(isset($partners) && $partners->count() > 0)
            <!-- First Track -->
            <div class="flex animate-marquee min-w-full flex-shrink-0 items-center group-hover:[animation-play-state:paused]">
                @foreach($partners as $partner)
                <div class="w-[200px] md:w-[250px] flex-shrink-0 px-8 mx-4 transition-all duration-300">
                    <img src="{{ asset('storage/' . $partner->image_path) }}" class="w-full h-auto object-contain hover:scale-110 transition-transform cursor-pointer" alt="{{ $partner->name }}">
                </div>
                @endforeach
            </div>

            <!-- Second Track -->
            <div class="flex animate-marquee min-w-full flex-shrink-0 items-center group-hover:[animation-play-state:paused]" aria-hidden="true">
                @foreach($partners as $partner)
                <div class="w-[200px] md:w-[250px] flex-shrink-0 px-8 mx-4 transition-all duration-300">
                    <img src="{{ asset('storage/' . $partner->image_path) }}" class="w-full h-auto object-contain hover:scale-110 transition-transform cursor-pointer" alt="{{ $partner->name }}">
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- 13. Application Form -->




</x-frontend.layout>
