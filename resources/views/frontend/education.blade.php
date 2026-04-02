<x-frontend.layout>
    <x-slot name="title">Education Infra Syndicate | Shaurya Narayan Foundation</x-slot>

    <!-- 1. Dynamic Banner Slider -->
    <section class="relative pt-20 overflow-hidden bg-brand-dark">
        <div class="swiper bannerSwiper">
            <div class="swiper-wrapper">
                @forelse($banners as $banner)
                    <div class="swiper-slide relative min-h-[70vh] md:min-h-[85vh] flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 z-0">
                            <img src="{{ asset('storage/' . $banner->image_path) }}" class="w-full h-full object-cover opacity-40 scale-105 animate-slow-zoom" alt="{{ $banner->title }}">
                            <div class="absolute inset-0 bg-gradient-to-b from-brand-dark via-transparent to-brand-dark"></div>
                        </div>
                        <div class="max-w-6xl mx-auto px-4 relative z-10 text-center">
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-brand-accent/30 bg-brand-accent/10 mb-8 text-xs md:text-sm animate-fade-in-up">
                                <i class="fas fa-school text-brand-accent"></i> <span class="text-brand-accent font-bold uppercase tracking-widest text-[10px]">Education Infra Syndicate</span>
                            </div>
                            <h1 class="text-4xl md:text-7xl font-black text-white tracking-tighter leading-tight mb-8 animate-fade-in-up uppercase">
                                {!! nl2br(e($banner->title)) !!}
                            </h1>
                            <p class="text-lg md:text-2xl text-gray-400 font-medium mb-10 max-w-3xl mx-auto leading-relaxed animate-fade-in-up italic">
                                {{ $banner->description }}
                            </p>
                            @if($banner->link)
                                <div class="flex justify-center animate-fade-in-up">
                                    <a href="{{ $banner->link }}" class="px-8 md:px-12 py-4 md:py-5 bg-brand-accent text-white rounded-full font-black text-lg md:text-xl hover:-translate-y-1 transition-all shadow-lg hover:shadow-brand-accent/40 uppercase tracking-widest text-[#4f46e5]">Explore Assets <i class="fas fa-arrow-right ml-2 text-sm"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <!-- Fallback Hero -->
                    <div class="swiper-slide relative min-h-[85vh] flex items-center justify-center overflow-hidden">
                        <div class="max-w-7xl mx-auto px-4 mt-20">
                            <div class="grid md:grid-cols-2 gap-20 items-center">
                                <div data-aos="fade-right">
                                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-brand-accent/30 bg-brand-accent/10 mb-6 text-sm text-[10px] uppercase font-black tracking-widest text-[#4f46e5]">
                                        <i class="fas fa-school text-brand-accent"></i> Stability First
                                    </div>
                                    <h1 class="text-6xl font-black text-white mb-8 tracking-tighter uppercase leading-[1.1]">Invest in the <br><span class="text-gradient font-bold">Schools</span> of Tomorrow.</h1>
                                    <p class="text-xl text-gray-400 leading-relaxed font-medium italic">Education infrastructure represents the ultimate compounding asset. We build modern smart schools and leasing them to premier K-12 operators.</p>
                                </div>
                                <div class="relative" data-aos="fade-left">
                                    <div class="absolute inset-0 bg-brand-accent/20 blur-[120px] opacity-20"></div>
                                    <img src="{{ asset('images/edu-1.png') }}" class="relative rounded-[3rem] border border-brand-border shadow-2xl opacity-80" alt="Education Infra">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- 2. Sector Stats -->
    <section class="py-24 bg-brand-card/5 border-y border-brand-border">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center" data-aos="fade-up" data-aos-delay="0"><p class="text-4xl font-black text-white mb-2">16.5%</p><p class="text-brand-accent text-xs uppercase font-bold tracking-widest">Compounded IRR</p></div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="100"><p class="text-4xl font-black text-white mb-2">15 Yr+</p><p class="text-brand-accent text-xs uppercase font-bold tracking-widest">Lease Terms</p></div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200"><p class="text-4xl font-black text-white mb-2">₹18Cr</p><p class="text-brand-accent text-xs uppercase font-bold tracking-widest">Avg School AUM</p></div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="300"><p class="text-4xl font-black text-white mb-2">Safe</p><p class="text-brand-accent text-xs uppercase font-bold tracking-widest">Risk Profile</p></div>
        </div>
    </section>

    <!-- 3. The Power of Education -->
    <section class="py-32 bg-brand-dark">
        <div class="max-w-7xl mx-auto px-4 grid lg:grid-cols-2 gap-20 items-center">
            <div data-aos="fade-right">
                <h3 class="text-4xl font-black text-white mb-8">A Legacy Asset Class.</h3>
                <p class="text-gray-500 text-lg leading-relaxed mb-8">Education is a fundamental right and a massive commercial opportunity. With Shaurya Narayan Foundation, you co-own the physical bricks-and-mortar foundations of education, backed by long-term institutional leases.</p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-6 glass-card rounded-2xl border-brand-border"><p class="text-white font-bold mb-1">Fee Stability</p><p class="text-xs text-gray-500">Fees increase 10% annually.</p></div>
                    <div class="p-6 glass-card rounded-2xl border-brand-border"><p class="text-white font-bold mb-1">Land Hubs</p><p class="text-xs text-gray-500">Usually prime institutional land.</p></div>
                </div>
            </div>
            <div class="relative" data-aos="fade-left">
                 <div class="glass-card p-1 rounded-3xl overflow-hidden border-brand-accent/20"><img src="{{ asset('images/edu-1.png') }}" class="w-full h-auto opacity-60 filter saturate-[0.8] contrast-[1.1]"></div>
            </div>
        </div>
    </section>

    <!-- 4. Smart Classrooms (Operational Detail) -->
    <section class="py-32 bg-brand-card/10">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-4xl font-black text-white text-center mb-20">The Smart School Standard</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-card p-10 rounded-3xl" data-aos="fade-up">
                    <i class="fas fa-microchip text-4xl text-brand-accent mb-6"></i>
                    <h5 class="text-xl font-bold text-white mb-4">IoT Enabled</h5>
                    <p class="text-gray-500 text-sm">Automated energy & security systems to reduce operational costs and increase NOI.</p>
                </div>
                <div class="glass-card p-10 rounded-3xl" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-swimming-pool text-4xl text-brand-accent mb-6"></i>
                    <h5 class="text-xl font-bold text-white mb-4">Tier 1 Amenities</h5>
                    <p class="text-gray-500 text-sm">International standard sports facilities that justify premium fee structures.</p>
                </div>
                <div class="glass-card p-10 rounded-3xl" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-leaf text-4xl text-brand-accent mb-6"></i>
                    <h5 class="text-xl font-bold text-white mb-4">Sustainability</h5>
                    <p class="text-gray-500 text-sm">Solar-powered campuses that qualify for ESG grants and lower tax overheads.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Stable Yield Model -->
    <section class="py-32 border-y border-brand-border bg-brand-dark">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold text-white mb-8">Long-Term Lease Security</h3>
            <p class="text-gray-500 text-lg mb-12">Our syndicate assets are leased to established educational chains on 15 to 25-year lock-in periods. This ensures that even during economic downturns, your dividend flow remains uninterrupted.</p>
            <div class="flex justify-center gap-12">
                <div class="text-center"><p class="text-3xl font-black text-brand-accent">99.2%</p><p class="text-xs text-gray-500 uppercase font-bold tracking-widest mt-2">Rent Collection</p></div>
                <div class="text-center"><p class="text-3xl font-black text-brand-accent">10%</p><p class="text-xs text-gray-500 uppercase font-bold tracking-widest mt-2">Annual Escalation</p></div>
            </div>
        </div>
    </section>

    <!-- 6. Project Showcase -->
    <section class="py-32">
        <div class="max-w-7xl mx-auto px-4">
             <h3 class="text-4xl font-black text-white mb-16 text-center">Acquired Portfolios</h3>
             <div class="grid md:grid-cols-2 gap-10">
                 <div class="glass-card rounded-[3rem] overflow-hidden group border-brand-accent/20" data-aos="zoom-in">
                    <div class="aspect-video relative overflow-hidden"><img src="{{ asset('images/edu-1.png') }}" class="w-full h-full object-cover group-hover:scale-105 transition-all opacity-70"></div>
                    <div class="p-10">
                        <h5 class="text-2xl font-bold text-white mb-2">Shaurya International Academy</h5>
                        <p class="text-brand-accent font-bold text-sm uppercase tracking-widest mb-4">Chandigarh City Hub</p>
                        <p class="text-gray-500 text-sm italic">"Completed Phase 1. 1200 Students Capacity."</p>
                    </div>
                 </div>
                 <div class="glass-card rounded-[3rem] overflow-hidden group border-brand-accent/20" data-aos="zoom-in" data-aos-delay="100">
                    <div class="aspect-video relative overflow-hidden"><img src="{{ asset('images/edu-1.png') }}" class="w-full h-full object-cover group-hover:scale-105 transition-all opacity-70 filter hue-rotate-90"></div>
                    <div class="p-10">
                        <h5 class="text-2xl font-bold text-white mb-2">Global Smart Campus #14</h5>
                        <p class="text-brand-accent font-bold text-sm uppercase tracking-widest mb-4">Cyber City, Noida</p>
                        <p class="text-gray-500 text-sm italic">"Fully Operational. Annuity returns yielding 15.5% CAGR."</p>
                    </div>
                 </div>
             </div>
        </div>
    </section>

    <!-- 7. Impact Reporting -->
    <section class="py-32 bg-brand-accent/5 border-y border-brand-accent/20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h3 class="text-3xl font-black text-white mb-6">Invest with Purpose</h3>
            <p class="text-gray-400 text-lg leading-relaxed mb-10">Beyond profits, you are contributing to the educational backbone of the nation. Every member gets a yearly impact report detailing how many students' futures we are powering together.</p>
            <div class="flex items-center justify-center gap-6"><i class="fas fa-graduation-cap text-5xl text-brand-accent animate-bounce"></i> <span class="text-2xl font-black text-white">50,000+ Potential Reached</span></div>
        </div>
    </section>

    <!-- 8. Sector FAQ -->
    <section class="py-32 bg-brand-dark">
        <div class="max-w-4xl mx-auto px-4">
            <h3 class="text-4xl font-extrabold text-white text-center mb-16">Institutional Wisdom</h3>
            <div class="space-y-4">
                <details class="group p-8 glass-card rounded-3xl border-brand-border cursor-pointer"><summary class="text-xl font-bold text-white flex justify-between items-center">What is the lock-in period? <i class="fas fa-chevron-down text-brand-accent"></i></summary><p class="mt-6 text-gray-500 leading-relaxed">Education infra is a long-term play. We recommend a 5-year lock-in to fully realize the capital appreciation of the institutional land and building.</p></details>
                <details class="group p-8 glass-card rounded-3xl border-brand-border cursor-pointer"><summary class="text-xl font-bold text-white flex justify-between items-center">How safe is my capital? <i class="fas fa-chevron-down text-brand-accent"></i></summary><p class="mt-6 text-gray-500 leading-relaxed">Highly safe. These are hard-asset investments where the liquidation value of the land alone often covers the initial capital contribution over time.</p></details>
            </div>
        </div>
    </section>

    <!-- 9. ROI Vision -->
    <section class="py-24 bg-[#020617] text-center">
        <div class="max-w-3xl mx-auto px-4">
            <p class="text-gray-500 font-bold mb-4 uppercase tracking-[0.3em] text-xs">Compound Interest is the 8th Wonder</p>
            <h4 class="text-4xl font-black text-white mb-10 tracking-tight">Watch your wealth grow <br>with the student population.</h4>
            <div class="bg-brand-card p-10 rounded-3xl border border-brand-accent/30 flex items-center justify-center gap-10">
                <div class="text-left"><p class="text-gray-500 text-xs">₹50L Today</p><p class="text-2xl font-black text-white">₹1.15 Cr</p></div>
                <div class="text-3xl text-brand-accent"><i class="fas fa-arrow-right"></i></div>
                <div class="text-left"><p class="text-gray-500 text-xs text-brand-accent">In 7 Years</p><p class="text-sm font-bold text-gray-400">@ 13% CAGR + 4% Appr.</p></div>
            </div>
        </div>
    </section>


</x-frontend.layout>
