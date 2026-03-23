<x-frontend.layout>
    <x-slot name="title">Home | Shaurya Foundation Syndicate</x-slot>

    <!-- 1. Hero Section -->
    <section class="relative pt-48 pb-32 min-h-[90vh] flex items-center justify-center overflow-hidden">
        <div class="absolute top-0 -left-10 w-[500px] h-[500px] bg-brand-primary rounded-full mix-blend-multiply blur-[180px] opacity-20 animate-blob"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-brand-accent rounded-full mix-blend-multiply blur-[180px] opacity-20 animate-blob" style="animation-delay: 2s;"></div>
        
        <div class="max-w-6xl mx-auto px-4 relative z-10 text-center" data-aos="zoom-in">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-brand-border bg-brand-card/50 mb-10 text-sm">
                <span class="relative flex h-2.5 w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-accent opacity-75"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-brand-accent"></span></span>
                <span class="font-bold tracking-tight text-gray-200">SYNDICATE FY 2026 OPEN FOR WHITS</span>
            </div>
            <h1 class="text-6xl md:text-8xl font-extrabold text-white tracking-tighter leading-[1] mb-10">
                Institutional <span class="text-gradient">Real Asset</span> <br class="hidden md:block"/> Syndication.
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 font-light mb-12 max-w-3xl mx-auto leading-relaxed">
                Unlock high-yield commercial assets through community-driven capital. Co-own Marriage Halls, Smart Schools, and EdTech platforms.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="#apply" class="px-10 py-5 bg-brand-primary text-white rounded-full font-extrabold text-xl hover:-translate-y-1 transition-all shadow-[0_0_30px_rgba(14,165,233,0.3)] hover:shadow-[0_0_50px_rgba(14,165,233,0.5)]">Start Your Journey <i class="fas fa-arrow-right ml-2 text-sm"></i></a>
                <a href="{{ route('process') }}" class="px-10 py-5 bg-transparent border border-brand-border text-white rounded-full font-bold text-xl hover:bg-brand-card transition-all">How it Works</a>
            </div>
        </div>
    </section>

    <!-- 2. Trust Bar / Marquee -->
    <div class="py-12 border-y border-brand-border bg-brand-card/30 flex overflow-hidden">
        <div class="flex whitespace-nowrap animate-marquee items-center gap-24 px-4 opacity-50">
            <span class="text-2xl font-black uppercase tracking-[.25em] text-gray-500 flex items-center gap-3"><i class="fas fa-check-double text-brand-accent"></i> ISO-9001 Certified</span>
            <span class="text-2xl font-black uppercase tracking-[.25em] text-gray-500 flex items-center gap-3"><i class="fas fa-university text-brand-primary"></i> RERA Compliant</span>
            <span class="text-2xl font-black uppercase tracking-[.25em] text-gray-500 flex items-center gap-3"><i class="fas fa-balance-scale-right text-brand-accent"></i> Legal Trustee Backed</span>
            <span class="text-2xl font-black uppercase tracking-[.25em] text-gray-500 flex items-center gap-3"><i class="fas fa-chart-pie text-brand-primary"></i> 18%+ Projected IRR</span>
            <span class="text-2xl font-black uppercase tracking-[.25em] text-gray-500 flex items-center gap-3"><i class="fas fa-check-double text-brand-accent"></i> ISO-9001 Certified</span>
            <span class="text-2xl font-black uppercase tracking-[.25em] text-gray-500 flex items-center gap-3"><i class="fas fa-university text-brand-primary"></i> RERA Compliant</span>
        </div>
    </div>

    <!-- 3. Key Stats Section -->
    <section class="py-24 bg-[#010409]">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center" data-aos="fade-up" data-aos-delay="0">
                <p class="text-5xl font-black text-white mb-2 tracking-tight">₹45Cr+</p>
                <p class="text-brand-primary font-bold uppercase text-xs tracking-widest">AUM Managed</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <p class="text-5xl font-black text-white mb-2 tracking-tight">1200+</p>
                <p class="text-brand-accent font-bold uppercase text-xs tracking-widest">Active Members</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <p class="text-5xl font-black text-white mb-2 tracking-tight">18.4%</p>
                <p class="text-purple-500 font-bold uppercase text-xs tracking-widest">Average IRR</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                <p class="text-5xl font-black text-white mb-2 tracking-tight">12+</p>
                <p class="text-yellow-500 font-bold uppercase text-xs tracking-widest">Operational Assets</p>
            </div>
        </div>
    </section>

    <!-- 4. The Core Problem vs Solution -->
    <section class="py-32 relative overflow-hidden bg-brand-dark">
        <div class="max-w-7xl mx-auto px-4 grid lg:grid-cols-2 gap-20 items-center">
            <div data-aos="fade-right">
                <h2 class="text-brand-primary font-bold tracking-widest uppercase mb-4 text-sm">The Paradigm Shift</h2>
                <h3 class="text-5xl font-extrabold text-white leading-tight mb-8">Breaking the Barriers of <br>Infrastructure Investing.</h3>
                <p class="text-xl text-gray-400 leading-relaxed mb-10">Traditionally, only the ultra-wealthy could own marriage halls or educational institutes. Shaurya Foundation democratizes this through fractional ownership.</p>
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
                            <h5 class="text-white font-bold text-lg mb-1">Shaurya Syndicate Model</h5>
                            <p class="text-gray-500 text-sm">Participate in Crores worth of assets with accessible stake sizes.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative" data-aos="fade-left">
                <div class="absolute inset-0 bg-brand-primary/10 blur-[80px] rounded-full"></div>
                <div class="glass-card p-1 rounded-3xl overflow-hidden shadow-2xl relative">
                    <img src="{{ asset('images/marriage-1.png') }}" class="w-full h-auto opacity-80" alt="Syndicate Asset">
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

    <!-- 5. Investment Sectors (Brief Overview) -->
    <section class="py-32 bg-brand-card/10">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-20" data-aos="fade-up">
                <h2 class="text-brand-primary font-bold tracking-widest uppercase mb-4 text-sm">Opportunities</h2>
                <h3 class="text-5xl font-extrabold text-white mb-6">Sectors You Can Invest In.</h3>
                <p class="text-gray-400 max-w-2xl mx-auto text-lg">We handpick recession-resistant industries to ensure safety and scale.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <a href="{{ route('sectors.marriage-halls') }}" class="group glass-card p-4 rounded-[2.5rem] block transition-all hover:scale-[1.02]" data-aos="fade-up" data-aos-delay="0">
                    <div class="aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 relative">
                        <img src="{{ asset('images/marriage-1.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-60">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark to-transparent"></div>
                        <div class="absolute bottom-6 left-6"><span class="px-4 py-1.5 bg-brand-primary/20 backdrop-blur-md border border-brand-primary/30 rounded-full text-brand-primary text-xs font-bold uppercase tracking-widest">Yield Focused</span></div>
                    </div>
                    <div class="px-4 pb-6">
                        <h4 class="text-2xl font-bold text-white mb-3">Marriage Halls & Banquets</h4>
                        <p class="text-gray-500 text-sm mb-6 leading-relaxed">Stable rental income combined with high-turnover seasonal event yields.</p>
                        <span class="text-brand-primary font-bold inline-flex items-center gap-2 group-hover:gap-4 transition-all">Learn More <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
                <a href="{{ route('sectors.education') }}" class="group glass-card p-4 rounded-[2.5rem] block transition-all hover:scale-[1.02]" data-aos="fade-up" data-aos-delay="100">
                    <div class="aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 relative">
                        <img src="{{ asset('images/edu-1.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-60">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark to-transparent"></div>
                        <div class="absolute bottom-6 left-6"><span class="px-4 py-1.5 bg-brand-accent/20 backdrop-blur-md border border-brand-accent/30 rounded-full text-brand-accent text-xs font-bold uppercase tracking-widest">Stability Focused</span></div>
                    </div>
                    <div class="px-4 pb-6">
                        <h4 class="text-2xl font-bold text-white mb-3">Educational Infrastructure</h4>
                        <p class="text-gray-500 text-sm mb-6 leading-relaxed">Investing in schools and institute buildings for long-term compound growth.</p>
                        <span class="text-brand-accent font-bold inline-flex items-center gap-2 group-hover:gap-4 transition-all">Learn More <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
                <a href="{{ route('sectors.coaching') }}" class="group glass-card p-4 rounded-[2.5rem] block transition-all hover:scale-[1.02]" data-aos="fade-up" data-aos-delay="200">
                    <div class="aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 relative">
                        <img src="{{ asset('images/coach-1.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-60">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark to-transparent"></div>
                        <div class="absolute bottom-6 left-6"><span class="px-4 py-1.5 bg-purple-500/20 backdrop-blur-md border border-purple-500/30 rounded-full text-purple-400 text-xs font-bold uppercase tracking-widest">Growth Focused</span></div>
                    </div>
                    <div class="px-4 pb-6">
                        <h4 class="text-2xl font-bold text-white mb-3">Digital Coaching Platforms</h4>
                        <p class="text-gray-500 text-sm mb-6 leading-relaxed">High-scale hybrid models combining tech scalability with physical centers.</p>
                        <span class="text-purple-400 font-bold inline-flex items-center gap-2 group-hover:gap-4 transition-all">Learn More <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                <!-- Expert 1 -->
                <div class="text-center group" data-aos="fade-up" data-aos-delay="0">
                    <div class="relative w-64 h-64 mx-auto mb-8">
                        <div class="absolute inset-0 bg-brand-primary/20 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-500"></div>
                        <img src="{{ asset('images/expert-1.png') }}" class="relative w-64 h-64 rounded-full border-4 border-brand-border group-hover:border-brand-primary transition-all object-cover" alt="Amit Sharma">
                        <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-brand-primary text-white p-3 rounded-xl shadow-xl"><i class="fab fa-linkedin-in"></i></div>
                    </div>
                    <h5 class="text-3xl font-black text-white mb-2">Amit Sharma</h5>
                    <p class="text-brand-primary font-bold uppercase tracking-widest text-xs mb-4">CEO & Real Estate Veteran</p>
                    <p class="text-gray-500 text-sm leading-relaxed px-4">20+ years in asset management. Ex-Director at major REITs.</p>
                </div>
                <!-- Expert 2 -->
                <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative w-64 h-64 mx-auto mb-8">
                        <div class="absolute inset-0 bg-brand-accent/20 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-500"></div>
                        <img src="{{ asset('images/expert-2.png') }}" class="relative w-64 h-64 rounded-full border-4 border-brand-border group-hover:border-brand-accent transition-all object-cover" alt="Priya Verma">
                        <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-brand-accent text-white p-3 rounded-xl shadow-xl"><i class="fab fa-linkedin-in"></i></div>
                    </div>
                    <h5 class="text-3xl font-black text-white mb-2">Priya Verma</h5>
                    <p class="text-brand-accent font-bold uppercase tracking-widest text-xs mb-4">Chief Operations Officer</p>
                    <p class="text-gray-500 text-sm leading-relaxed px-4">Expert in hospitality management and large-scale banquet operations.</p>
                </div>
                <!-- Expert 3 -->
                <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative w-64 h-64 mx-auto mb-8">
                        <div class="absolute inset-0 bg-purple-500/20 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-500"></div>
                        <img src="{{ asset('images/expert-3.png') }}" class="relative w-64 h-64 rounded-full border-4 border-brand-border group-hover:border-purple-500 transition-all object-cover" alt="Vikram Singh Rao">
                        <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-purple-500 text-white p-3 rounded-xl shadow-xl"><i class="fab fa-linkedin-in"></i></div>
                    </div>
                    <h5 class="text-3xl font-black text-white mb-2">Vikram Rao</h5>
                    <p class="text-purple-500 font-bold uppercase tracking-widest text-xs mb-4">Chief Investment Officer</p>
                    <p class="text-gray-500 text-sm leading-relaxed px-4">Chartered Accountant with focus on distressed asset restructuring.</p>
                </div>
            </div>
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
                <div class="glass-card p-10 rounded-[3rem] border-brand-primary/20 relative" data-aos="fade-up" data-aos-delay="0">
                    <i class="fas fa-quote-left text-brand-primary/10 text-8xl absolute top-8 left-8"></i>
                    <div class="flex gap-1 mb-8 relative z-10 text-yellow-500"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-gray-300 mb-10 text-lg leading-relaxed relative z-10 italic">"The transparency is what sold me. Being able to track the actual bookings of the marriage hall I invested in through my personal panel is revolutionary. It's truly passive."</p>
                    <div class="flex items-center gap-5 pt-8 border-t border-brand-border">
                        <img src="{{ asset('images/review-1.png') }}" class="w-16 h-16 rounded-3xl object-cover border-2 border-brand-primary" alt="Rahul V.">
                        <div>
                            <p class="text-white font-black text-xl">Rahul Verma</p>
                            <p class="text-brand-primary font-bold text-xs uppercase tracking-widest">Tech Entrepreneur</p>
                        </div>
                    </div>
                </div>
                <!-- Add more reviews here to fill the space -->
                <div class="glass-card p-10 rounded-[3rem] border-brand-accent/20 relative" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-quote-left text-brand-accent/10 text-8xl absolute top-8 left-8"></i>
                    <div class="flex gap-1 mb-8 relative z-10 text-yellow-500"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-gray-300 mb-10 text-lg leading-relaxed relative z-10 italic">"Institutional real estate has always been my dream. Shaurya made it possible with just a fraction of the capital. Their asset selection process is unparalleled."</p>
                    <div class="flex items-center gap-5 pt-8 border-t border-brand-border">
                        <img src="{{ asset('images/review-2.png') }}" class="w-16 h-16 rounded-3xl object-cover border-2 border-brand-accent" alt="Anita D.">
                        <div>
                            <p class="text-white font-black text-xl">Anita Desai</p>
                            <p class="text-brand-accent font-bold text-xs uppercase tracking-widest">HNI Investor</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-10 rounded-[3rem] border-purple-500/20 relative" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-quote-left text-purple-500/10 text-8xl absolute top-8 left-8"></i>
                    <div class="flex gap-1 mb-8 relative z-10 text-yellow-500"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-gray-300 mb-10 text-lg leading-relaxed relative z-10 italic">"The digital coaching model is a genius addition to the portfolio. Combining high-growth tech with infrastructure stability is brilliant asset allocation."</p>
                    <div class="flex items-center gap-5 pt-8 border-t border-brand-border">
                        <img src="{{ asset('images/review-3.png') }}" class="w-16 h-16 rounded-3xl object-cover border-2 border-purple-500" alt="Suresh N.">
                        <div>
                            <p class="text-white font-black text-xl">Suresh Nair</p>
                            <p class="text-purple-500 font-bold text-xs uppercase tracking-widest">Finance Consultant</p>
                        </div>
                    </div>
                </div>
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
    <section id="apply" class="py-32 bg-[#030712] relative">
        <div class="max-w-5xl mx-auto px-4 relative z-10" data-aos="fade-up">
            <div class="glass-card rounded-[4rem] p-12 md:p-24 border border-brand-primary/20 shadow-2xl relative overflow-hidden">
                <div class="absolute -top-32 -left-32 w-64 h-64 bg-brand-primary/20 blur-[100px] rounded-full"></div>
                <div class="text-center mb-16">
                    <h2 class="text-5xl font-black text-white mb-6 tracking-tight">Join the Syndicate</h2>
                    <p class="text-gray-400 text-xl">Fill out the detailed application form for personalized callback.</p>
                </div>
                <form class="space-y-8">
                    <div class="grid md:grid-cols-2 gap-6 md:gap-10">
                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-brand-primary uppercase tracking-[0.2em] ml-2">Full Legal Name</label>
                            <input type="text" placeholder="e.g. Rahul Sharma" class="w-full bg-brand-dark/80 border border-brand-border rounded-[1.5rem] md:rounded-[2rem] px-6 md:px-8 py-5 md:py-6 text-white placeholder:text-gray-700 focus:border-brand-primary outline-none transition-all shadow-inner" required>
                        </div>
                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-brand-primary uppercase tracking-[0.2em] ml-2">Contact Number</label>
                            <input type="tel" placeholder="+91 XXXX XXXX" class="w-full bg-brand-dark/80 border border-brand-border rounded-[1.5rem] md:rounded-[2rem] px-6 md:px-8 py-5 md:py-6 text-white placeholder:text-gray-700 focus:border-brand-primary outline-none transition-all shadow-inner" required>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-brand-primary uppercase tracking-[0.2em] ml-2">Email Address</label>
                        <input type="email" placeholder="rahul@example.com" class="w-full bg-brand-dark/80 border border-brand-border rounded-[1.5rem] md:rounded-[2rem] px-6 md:px-8 py-5 md:py-6 text-white placeholder:text-gray-700 focus:border-brand-primary outline-none transition-all shadow-inner" required>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-brand-primary uppercase tracking-[0.2em] ml-2">Key Sector of Interest</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="has-[:checked]:bg-brand-primary/10 has-[:checked]:border-brand-primary transition-all cursor-pointer border border-brand-border p-5 md:p-6 rounded-2xl md:rounded-3xl block">
                                <input type="radio" name="sector" class="hidden" checked>
                                <div class="text-center font-bold text-white text-sm md:text-base">Marriage Halls</div>
                            </label>
                            <label class="has-[:checked]:bg-brand-primary/10 has-[:checked]:border-brand-primary transition-all cursor-pointer border border-brand-border p-5 md:p-6 rounded-2xl md:rounded-3xl block">
                                <input type="radio" name="sector" class="hidden">
                                <div class="text-center font-bold text-white text-sm md:text-base">Edu Infrastructure</div>
                            </label>
                            <label class="has-[:checked]:bg-brand-primary/10 has-[:checked]:border-brand-primary transition-all cursor-pointer border border-brand-border p-5 md:p-6 rounded-2xl md:rounded-3xl block">
                                <input type="radio" name="sector" class="hidden">
                                <div class="text-center font-bold text-white text-sm md:text-base">Digital Coaching</div>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-brand-primary to-brand-accent text-white font-black py-6 md:py-7 rounded-[1.5rem] md:rounded-[2rem] text-xl md:text-2xl hover:scale-[1.02] active:scale-95 transition-all shadow-[0_20px_50px_rgba(14,165,233,0.35)]">
                        Submit Member Application <i class="fas fa-rocket ml-3"></i>
                    </button>
                    <p class="text-center text-gray-600 text-[10px] md:text-xs">A data protection agreement is automatically generated upon submission.</p>
                </form>
            </div>
        </div>
    </section>

</x-frontend.layout>
