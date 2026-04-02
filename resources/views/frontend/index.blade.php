<x-frontend.layout>
    <x-slot name="title">Home | {{ $siteSettings['site_name'] ?? 'Shaurya Narayan Foundation' }}</x-slot>

    <!-- 1. Dynamic Banner Slider -->
    <section class="relative pt-20 overflow-hidden bg-brand-dark">
        <div class="swiper bannerSwiper">
            <div class="swiper-wrapper">
                @forelse($banners as $banner)
                    <div class="swiper-slide relative min-h-[70vh] md:min-h-[85vh] flex items-center justify-center overflow-hidden">
                        <!-- Background Image with Overlay -->
                        <div class="absolute inset-0 z-0">
                            <img src="{{ asset('storage/' . $banner->image_path) }}" class="w-full h-full object-cover opacity-40 scale-105 animate-slow-zoom" alt="{{ $banner->title }}">
                            <div class="absolute inset-0 bg-gradient-to-b from-brand-dark via-transparent to-brand-dark"></div>
                        </div>

                        <!-- Content -->
                        <div class="max-w-6xl mx-auto px-4 relative z-10 text-center">
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-brand-border bg-brand-card/50 mb-8 text-xs md:text-sm animate-fade-in-up">
                                <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-accent opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-brand-accent"></span></span>
                                <span class="font-bold tracking-tight text-gray-200 uppercase tracking-widest">Syndicate Open FY 2026</span>
                            </div>
                            <h1 class="text-4xl md:text-7xl lg:text-8xl font-extrabold text-white tracking-tighter leading-tight mb-8 animate-fade-in-up" style="animation-delay: 200ms;">
                                {!! nl2br(e($banner->title)) !!}
                            </h1>
                            <p class="text-lg md:text-2xl text-gray-400 font-light mb-10 max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 400ms;">
                                {{ $banner->description }}
                            </p>
                            @if($banner->link)
                                <div class="flex justify-center animate-fade-in-up" style="animation-delay: 600ms;">
                                    <a href="{{ $banner->link }}" class="px-8 md:px-12 py-4 md:py-5 bg-brand-primary text-white rounded-full font-extrabold text-lg md:text-xl hover:-translate-y-1 transition-all shadow-[0_0_30px_rgba(14,165,233,0.3)] hover:shadow-[0_0_50px_rgba(14,165,233,0.5)]">Explore Opportunity <i class="fas fa-arrow-right ml-2 text-sm"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <!-- Fallback Hero if no banners -->
                    <div class="swiper-slide relative min-h-[85vh] flex items-center justify-center">
                        <div class="absolute top-0 -left-10 w-[500px] h-[500px] bg-brand-primary rounded-full mix-blend-multiply blur-[180px] opacity-20 animate-blob"></div>
                        <div class="max-w-6xl mx-auto px-4 relative z-10 text-center">
                            <h1 class="text-6xl md:text-8xl font-extrabold text-white tracking-tighter leading-[1] mb-10">Institutional <span class="text-gradient">Real Asset</span> Syndication.</h1>
                            <p class="text-xl md:text-2xl text-gray-400 font-light mb-12 max-w-3xl mx-auto leading-relaxed">Unlock high-yield commercial assets through community-driven capital.</p>
                            <a href="#apply" class="px-10 py-5 bg-brand-primary text-white rounded-full font-extrabold text-xl hover:-translate-y-1 transition-all">Start Your Journey</a>
                        </div>
                    </div>
                @endforelse
            </div>
            <!-- Navigation -->
            <div class="swiper-button-next !text-white !opacity-20 hover:!opacity-100 transition-opacity hidden md:flex"></div>
            <div class="swiper-button-prev !text-white !opacity-20 hover:!opacity-100 transition-opacity hidden md:flex"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- 2. Dynamic Investment Sectors (Moved here and made dynamic) -->
    <section class="py-24 bg-brand-card/5 border-b border-brand-border" id="sectors">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-brand-primary font-bold tracking-widest uppercase mb-4 text-xs">Opportunities</h2>
                <h3 class="text-4xl md:text-5xl font-extrabold text-white mb-6">Sectors You Can Invest In.</h3>
                <p class="text-gray-400 max-w-2xl mx-auto text-lg">We handpick recession-resistant industries to ensure safety and scale.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($sectors as $sector)
                    <a href="{{ route('sectors.detail', $sector->slug) }}" 
                       class="group glass-card p-4 rounded-[2.5rem] block transition-all hover:scale-[1.02]" 
                       data-aos="fade-up" 
                       data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 relative">
                            <img src="{{ asset('storage/' . $sector->image_path) }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-60" 
                                 alt="{{ $sector->title }}"
                                 loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark to-transparent"></div>
                            @if($sector->tag)
                                <div class="absolute bottom-6 left-6">
                                    <span class="px-4 py-1.5 bg-brand-primary/20 backdrop-blur-md border border-brand-primary/30 rounded-full text-brand-primary text-xs font-bold uppercase tracking-widest">
                                        {{ $sector->tag }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="px-4 pb-6">
                            <h4 class="text-2xl font-bold text-white mb-3">{{ $sector->title }}</h4>
                            <p class="text-gray-500 text-sm mb-6 leading-relaxed">{{ $sector->description }}</p>
                            <span class="text-brand-primary font-bold inline-flex items-center gap-2 group-hover:gap-4 transition-all uppercase text-xs tracking-widest">
                                Learn More <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-12 text-center text-gray-500 italic">No investment sectors configured yet.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 3. Trust Bar / Marquee (Kept same) -->
    <div class="py-12 border-b border-brand-border bg-brand-card/30 flex overflow-hidden">
        <div class="flex whitespace-nowrap animate-marquee items-center gap-24 px-4 opacity-50">
            <span class="text-xl font-black uppercase tracking-[.25em] text-gray-500 flex items-center gap-3"><i class="fas fa-check-double text-brand-accent"></i> ISO-9001 Certified</span>
            <span class="text-xl font-black uppercase tracking-[.25em] text-gray-500 flex items-center gap-3"><i class="fas fa-university text-brand-primary"></i> RERA Compliant</span>
            <span class="text-xl font-black uppercase tracking-[.25em] text-gray-500 flex items-center gap-3"><i class="fas fa-balance-scale-right text-brand-accent"></i> Legal Trustee Backed</span>
            <span class="text-xl font-black uppercase tracking-[.25em] text-gray-500 flex items-center gap-3"><i class="fas fa-chart-pie text-brand-primary"></i> 18%+ Projected IRR</span>
        </div>
    </div>

    <!-- 4. Key Stats Section -->
    <section class="py-16 bg-[#010409]">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center" data-aos="fade-up" data-aos-delay="0">
                <p class="text-4xl md:text-5xl font-black text-white mb-2 tracking-tight">₹45Cr+</p>
                <p class="text-brand-primary font-bold uppercase text-[10px] tracking-widest">AUM Managed</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <p class="text-4xl md:text-5xl font-black text-white mb-2 tracking-tight">1200+</p>
                <p class="text-brand-accent font-bold uppercase text-[10px] tracking-widest">Active Members</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <p class="text-4xl md:text-5xl font-black text-white mb-2 tracking-tight">18.4%</p>
                <p class="text-purple-500 font-bold uppercase text-[10px] tracking-widest">Average IRR</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                <p class="text-4xl md:text-5xl font-black text-white mb-2 tracking-tight">12+</p>
                <p class="text-yellow-500 font-bold uppercase text-[10px] tracking-widest">Operational Assets</p>
            </div>
        </div>
    </section>

    <!-- 5. The Core Problem vs Solution -->
    <section class="py-32 relative overflow-hidden bg-brand-dark">
        <div class="max-w-7xl mx-auto px-4 grid lg:grid-cols-2 gap-20 items-center">
            <div data-aos="fade-right">
                <h2 class="text-brand-primary font-bold tracking-widest uppercase mb-4 text-sm">The Paradigm Shift</h2>
                <h3 class="text-5xl font-extrabold text-white leading-tight mb-8">Breaking the Barriers of <br>Infrastructure Investing.</h3>
                <p class="text-xl text-gray-400 leading-relaxed mb-10">Traditionally, only the ultra-wealthy could own marriage halls or educational institutes. Shaurya Narayan Foundation democratizes this through fractional ownership.</p>
                <div class="space-y-6">
                    <div class="flex items-start gap-4 p-6 glass-card rounded-2xl border-l-4 border-l-red-500/50">
                        <i class="fas fa-times-circle text-red-500 text-2xl mt-1"></i>
                        <div>
                            <h5 class="text-white font-bold text-lg mb-1">High Capital Requirements</h5>
                            <p class="text-gray-500 text-sm">Commercial properties usually require ₹5Cr+ entry capital.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-6 glass-card rounded-2xl border-l-4 border-l-brand-accent/50">
                        <i class="fas fa-check-circle text-brand-accent text-2xl mt-1"></i>
                        <div>
                            <h5 class="text-white font-bold text-lg mb-1">Shaurya Narayan Foundation Model</h5>
                            <p class="text-gray-500 text-sm">Participate in Crores worth of assets with accessible stake sizes.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative" data-aos="fade-left">
                <div class="absolute inset-0 bg-brand-primary/10 blur-[80px] rounded-full"></div>
                <div class="glass-card p-1 rounded-3xl overflow-hidden shadow-2xl relative">
                    <img src="{{ asset('images/marriage-1.png') }}" class="w-full h-auto opacity-80" alt="Syndicate Asset" loading="lazy">
                    <div class="absolute bottom-6 left-6 right-6 p-6 glass-nav rounded-2xl border border-brand-border">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-brand-primary font-bold text-xs uppercase tracking-widest">Latest Acquisition</p>
                                <p class="text-white font-bold text-xl">Heritage Banquet, Gurgaon</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-xs">Target Yield</p>
                                <p class="text-brand-accent font-black">21.5% IRR</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. How it Works (Condensed Steps) -->
    <section class="py-32 relative bg-brand-dark overflow-hidden">
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
    </section>

    <!-- 7. ROI Calculator / Table Preview -->
    <section class="py-32 bg-brand-card/5 border-y border-brand-border">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-brand-primary font-bold tracking-widest uppercase mb-4 text-sm">Transparency</h2>
                    <h3 class="text-5xl font-extrabold text-white mb-8">Data-Driven <br>ROI Projections.</h3>
                    <p class="text-gray-400 text-lg mb-10">We prioritize long-term capital preservation plus operational alpha. See how different sectors perform over a 5-year cycle.</p>
                    <div class="space-y-4">
                        <div class="px-8 py-5 glass-card rounded-2xl flex justify-between items-center group hover:border-brand-primary transition-all">
                            <span class="text-white font-bold">Marriage Halls</span>
                            <span class="text-brand-primary font-black text-xl">21.4% IRR</span>
                        </div>
                        <div class="px-8 py-5 glass-card rounded-2xl flex justify-between items-center group hover:border-brand-accent transition-all">
                            <span class="text-white font-bold">Education Infra</span>
                            <span class="text-brand-accent font-black text-xl">16.2% IRR</span>
                        </div>
                        <div class="px-8 py-5 glass-card rounded-2xl flex justify-between items-center group hover:border-purple-500 transition-all">
                            <span class="text-white font-bold">Digital Coaching</span>
                            <span class="text-purple-400 font-black text-xl">28.5% IRR</span>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-10 rounded-[3rem] relative" data-aos="fade-left">
                    <div class="absolute top-0 right-0 w-48 h-48 bg-brand-primary/10 blur-[60px] overflow-hidden"></div>
                    <h5 class="text-2xl font-bold text-white mb-10 flex items-center gap-3"><i class="fas fa-chart-line text-brand-primary"></i> 5-Year Growth Forecast</h5>
                    <div class="space-y-8">
                        <div>
                            <div class="flex justify-between mb-3 text-sm font-bold tracking-wider">
                                <span class="text-gray-400 uppercase">Capital Appreciation</span>
                                <span class="text-brand-primary">78.5%</span>
                            </div>
                            <div class="h-2.5 w-full bg-brand-border rounded-full overflow-hidden">
                                <div class="h-full bg-brand-primary rounded-full w-[78%]" data-aos="slide-right" data-aos-delay="500"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-3 text-sm font-bold tracking-wider">
                                <span class="text-gray-400 uppercase">Operational Yield</span>
                                <span class="text-brand-accent">12.4% / Yr</span>
                            </div>
                            <div class="h-2.5 w-full bg-brand-border rounded-full overflow-hidden">
                                <div class="h-full bg-brand-accent rounded-full w-[65%]" data-aos="slide-right" data-aos-delay="700"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-3 text-sm font-bold tracking-wider">
                                <span class="text-gray-400 uppercase">Secondary Market Exit</span>
                                <span class="text-purple-400">95% Liquidity</span>
                            </div>
                            <div class="h-2.5 w-full bg-brand-border rounded-full overflow-hidden">
                                <div class="h-full bg-purple-500 rounded-full w-[95%]" data-aos="slide-right" data-aos-delay="900"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 p-6 bg-brand-primary/5 border border-brand-primary/20 rounded-2xl text-center">
                        <p class="text-gray-400 text-sm">Calculated based on FY 2024-25 average market rental data and asset revaluation indices.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. Managed by Experts (Team) -->
    <section class="py-32 bg-brand-dark overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-24" data-aos="fade-up">
                <h2 class="text-brand-primary font-bold tracking-widest uppercase mb-4 text-sm">Leadership</h2>
                <h3 class="text-5xl font-extrabold text-white mb-6">Built by Industry Experts.</h3>
                <p class="text-gray-400 max-w-2xl mx-auto text-lg">Our leadership team brings decades of experience in real estate, finance, and technology.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 lg:gap-24">
                @foreach($experts as $index => $expert)
                    <!-- Expert {{ $index + 1 }} -->
                    <div class="text-center group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="relative w-56 h-56 md:w-64 md:h-64 mx-auto mb-8">
                            <div class="absolute inset-0 bg-{{ $index % 2 == 0 ? 'brand-primary' : 'brand-accent' }}/20 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-500"></div>
                            <img src="{{ asset('storage/' . $expert->image) }}" class="relative w-full h-full rounded-full border-4 border-brand-border group-hover:border-{{ $index % 2 == 0 ? 'brand-primary' : 'brand-accent' }} transition-all object-cover" alt="{{ $expert->name }}" loading="lazy">
                            @if($expert->linkedin_url)
                                <a href="{{ $expert->linkedin_url }}" target="_blank" class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-{{ $index % 2 == 0 ? 'brand-primary' : 'brand-accent' }} text-white p-3 rounded-xl shadow-xl hover:scale-110 transition-transform"><i class="fab fa-linkedin-in"></i></a>
                            @endif
                        </div>
                        <h5 class="text-3xl font-black text-white mb-2">{{ $expert->name }}</h5>
                        <p class="text-{{ $index % 2 == 0 ? 'brand-primary' : 'brand-accent' }} font-bold uppercase tracking-widest text-xs mb-4">{{ $expert->designation }}</p>
                        <p class="text-gray-500 text-sm leading-relaxed px-4">{{ $expert->bio }}</p>
                    </div>
                @endforeach
            </div>
    </section>

    <!-- 9. Voices of the Syndicate (Reviews) -->
    <section class="py-32 bg-brand-card/5 border-t border-brand-border">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-24" data-aos="fade-up">
                <h2 class="text-brand-primary font-bold tracking-widest uppercase mb-4 text-sm">Community</h2>
                <h3 class="text-5xl font-extrabold text-white mb-6">Voices of the Syndicate.</h3>
            </div>
            <div class="grid lg:grid-cols-3 gap-10">
                @php
                    $colors = ['brand-primary', 'brand-accent', 'purple-500'];
                @endphp
                @foreach($testimonials as $index => $testimonial)
                    <div class="glass-card p-10 rounded-[3rem] border-{{ $colors[$index % 3] }}/20 relative" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <i class="fas fa-quote-left text-{{ $colors[$index % 3] }}/10 text-8xl absolute top-8 left-8"></i>
                        <div class="flex gap-1 mb-8 relative z-10 text-yellow-500">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $testimonial->rating ? '' : 'text-slate-600' }}"></i>
                            @endfor
                        </div>
                        <p class="text-gray-300 mb-10 text-lg leading-relaxed relative z-10 italic">"{{ $testimonial->content }}"</p>
                        <div class="flex items-center gap-5 pt-8 border-t border-brand-border">
                            <img src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('images/default-avatar.png') }}" class="w-16 h-16 rounded-3xl object-cover border-2 border-{{ $colors[$index % 3] }}" alt="{{ $testimonial->name }}" loading="lazy">
                            <div>
                                <p class="text-white font-black text-xl">{{ $testimonial->name }}</p>
                                <p class="text-{{ $colors[$index % 3] }} font-bold text-xs uppercase tracking-widest">{{ $testimonial->designation }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 10. Risk Management & Legal -->
    <section class="py-32 bg-brand-dark">
        <div class="max-w-7xl mx-auto px-4">
            <div class="glass-card p-12 md:p-20 rounded-[4rem] border-brand-border relative overflow-hidden" data-aos="zoom-in">
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-primary/10 rounded-full blur-[100px]"></div>
                <div class="grid lg:grid-cols-5 gap-16 items-center">
                    <div class="lg:col-span-3">
                        <h2 class="text-brand-primary font-bold tracking-widest uppercase mb-4 text-sm">Legal Safety</h2>
                        <h3 class="text-5xl font-extrabold text-white mb-8">Your Investment, <br>Legally Secured.</h3>
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="flex items-start gap-4">
                                <i class="fas fa-shield-alt text-brand-primary text-2xl mt-1"></i>
                                <div><h6 class="text-white font-bold mb-2">Escrow Protected</h6><p class="text-gray-500 text-sm">Capital stays in RBI-regulated escrow until asset deployment.</p></div>
                            </div>
                            <div class="flex items-start gap-4">
                                <i class="fas fa-file-contract text-brand-accent text-2xl mt-1"></i>
                                <div><h6 class="text-white font-bold mb-2">LLP Structure</h6><p class="text-gray-500 text-sm">Each asset is held by an independent LLP with audited books.</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-2 text-center lg:text-right">
                        <p class="text-6xl font-black text-white mb-2">ZERO</p>
                        <p class="text-gray-500 uppercase tracking-widest text-sm mb-10">LITIGATION HISTORY</p>
                        <a href="{{ route('terms') }}" class="text-brand-primary font-bold hover:underline">View Compliance Framework <i class="fas fa-long-arrow-alt-right ml-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 11. FAQ Section -->
    <section class="py-32 bg-[#010409]">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-4xl font-extrabold text-white text-center mb-16" data-aos="fade-up">Frequently Asked Questions</h2>
            <div class="space-y-6">
                <!-- FAQ 1 -->
                <div class="glass-card rounded-[2rem] border-brand-border overflow-hidden" data-aos="fade-up" data-aos-delay="0">
                    <details class="group p-8">
                        <summary class="flex justify-between items-center cursor-pointer list-none">
                            <h5 class="text-xl font-bold text-white pr-8">How is my ownership legal documented?</h5>
                            <span class="text-brand-primary transition-transform group-open:rotate-180"><i class="fas fa-chevron-down"></i></span>
                        </summary>
                        <p class="mt-6 text-gray-500 leading-relaxed text-lg">Every asset is registered under a separate LLP (Limited Liability Partnership). As an investor, you become a partner in that LLP with a profit-sharing percentage proportional to your investment contribution.</p>
                    </details>
                </div>
                <!-- FAQ 2 -->
                <div class="glass-card rounded-[2rem] border-brand-border overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <details class="group p-8">
                        <summary class="flex justify-between items-center cursor-pointer list-none">
                            <h5 class="text-xl font-bold text-white pr-8">When do I start receiving payouts?</h5>
                            <span class="text-brand-primary transition-transform group-open:rotate-180"><i class="fas fa-chevron-down"></i></span>
                        </summary>
                        <p class="mt-6 text-gray-500 leading-relaxed text-lg">Operational yield starts as soon as the asset becomes functional. For Marriage Halls, this is typically 6-8 months after capital deployment if it's a new build, or immediate for acquisitions.</p>
                    </details>
                </div>
                <!-- FAQ 3 -->
                <div class="glass-card rounded-[2rem] border-brand-border overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <details class="group p-8">
                        <summary class="flex justify-between items-center cursor-pointer list-none">
                            <h5 class="text-xl font-bold text-white pr-8">How do I exit the investment?</h5>
                            <span class="text-brand-primary transition-transform group-open:rotate-180"><i class="fas fa-chevron-down"></i></span>
                        </summary>
                        <p class="mt-6 text-gray-500 leading-relaxed text-lg">You can list your fractional stake on our internal secondary market panel for other members to buy, or wait for the full asset exit (sale) at the end of the 5-7 year cycle.</p>
                    </details>
                </div>
            </div>
        </div>
    </section>

    <!-- 12. Final CTA & Portfolio Glimpse -->
    <section class="py-32 border-t border-brand-border relative overflow-hidden bg-brand-dark">
        <div class="max-w-7xl mx-auto px-4 flex flex-col items-center text-center">
            <h2 class="text-5xl md:text-7xl font-black text-white tracking-tighter mb-12" data-aos="fade-up">Ready to Revolutionize <br>Your Portfolio?</h2>
            <div class="bg-brand-primary/10 p-8 rounded-[3rem] border border-brand-primary/20 mb-16" data-aos="zoom-in">
                <p class="text-brand-primary font-black uppercase tracking-[0.4em] mb-4">Limited Slots Available</p>
                <p class="text-gray-400 max-w-xl mx-auto italic">"Only 4 spots remaining for the NCR Banquet Syndicate project closing this Friday."</p>
            </div>
        </div>
    </section>

    <!-- 13. Application Form -->


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bannerSwiper = new Swiper('.bannerSwiper', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                parallax: true,
                speed: 1000,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                }
            });
        });
    </script>

</x-frontend.layout>
