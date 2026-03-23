<x-frontend.layout>
    <x-slot name="title">About Us | Shaurya Foundation</x-slot>

    <!-- 1. Hero Section -->
    <section class="relative pt-40 pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <h2 class="text-brand-primary font-bold tracking-widest uppercase mb-4 text-sm" data-aos="fade-up">Our Story</h2>
            <h1 class="text-6xl md:text-8xl font-black text-white mb-8 tracking-tighter" data-aos="fade-up" data-aos-delay="100">Legacy Built on <br><span class="text-gradient">Transparency.</span></h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="200">Shaurya Foundation was established to bridge the gap between retail capital and institutional-grade real estate assets in India.</p>
        </div>
    </section>

    <!-- 2. Values / Pillars -->
    <section class="py-24 bg-brand-card/5">
        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-12">
            <div class="glass-card p-10 rounded-3xl" data-aos="fade-up" data-aos-delay="0">
                <div class="w-14 h-14 bg-brand-primary/20 rounded-2xl flex items-center justify-center mb-8"><i class="fas fa-eye text-2xl text-brand-primary"></i></div>
                <h4 class="text-2xl font-bold text-white mb-4">Vision</h4>
                <p class="text-gray-500 leading-relaxed">To become the world's most trusted gatekeeper for high-yield real-world asset syndication.</p>
            </div>
            <div class="glass-card p-10 rounded-3xl" data-aos="fade-up" data-aos-delay="100">
                <div class="w-14 h-14 bg-brand-accent/20 rounded-2xl flex items-center justify-center mb-8"><i class="fas fa-bullseye text-2xl text-brand-accent"></i></div>
                <h4 class="text-2xl font-bold text-white mb-4">Mission</h4>
                <p class="text-gray-500 leading-relaxed">Lowering entry barriers for prime infrastructure ownership through legal and tech innovation.</p>
            </div>
            <div class="glass-card p-10 rounded-3xl" data-aos="fade-up" data-aos-delay="200">
                <div class="w-14 h-14 bg-purple-500/20 rounded-2xl flex items-center justify-center mb-8"><i class="fas fa-heart text-2xl text-purple-400"></i></div>
                <h4 class="text-2xl font-bold text-white mb-4">Core Values</h4>
                <p class="text-gray-500 leading-relaxed">Uncompromising integrity, radical transparency, and member-first capital preservation.</p>
            </div>
        </div>
    </section>

    <!-- 3. Our Journey (Timeline) -->
    <section class="py-32 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-4xl font-black text-white text-center mb-20">The Shaurya Timeline</h3>
            <div class="space-y-16 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-brand-border before:via-brand-primary before:to-brand-border">
                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border border-brand-border bg-brand-dark text-brand-primary shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10"><i class="fas fa-rocket text-xs"></i></div>
                    <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] glass-card p-6 rounded-2xl border-brand-primary/20" data-aos="fade-right">
                        <div class="flex items-center justify-between space-x-2 mb-1">
                            <div class="font-black text-white text-xl">2018: Inception</div>
                            <time class="font-bold text-xs text-brand-primary uppercase tracking-widest">Year 0</time>
                        </div>
                        <div class="text-gray-500">Founded as a boutique advisory for high-net-worth real estate syndicates in North India.</div>
                    </div>
                </div>
                <!-- Add more years here -->
                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border border-brand-border bg-brand-dark text-brand-accent shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10"><i class="fas fa-building text-xs"></i></div>
                    <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] glass-card p-6 rounded-2xl border-brand-accent/20" data-aos="fade-left">
                        <div class="flex items-center justify-between space-x-2 mb-1">
                            <div class="font-black text-white text-xl">2021: First 10 Assets</div>
                            <time class="font-bold text-xs text-brand-accent uppercase tracking-widest">Expansion</time>
                        </div>
                        <div class="text-gray-500">Hit the milestone of ₹25Cr AUM across Marriage Halls and Educational institutes.</div>
                    </div>
                </div>
                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border border-brand-border bg-brand-dark text-purple-400 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10"><i class="fas fa-microchip text-xs"></i></div>
                    <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] glass-card p-6 rounded-2xl border-purple-500/20" data-aos="fade-right">
                        <div class="flex items-center justify-between space-x-2 mb-1">
                            <div class="font-black text-white text-xl">2024: Tech Launch</div>
                            <time class="font-bold text-xs text-purple-400 uppercase tracking-widest">Scale</time>
                        </div>
                        <div class="text-gray-500">Launched our proprietary LP/Syndicate management portal for real-time tracking.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Why Shaurya? (Features) -->
    <section class="py-32 bg-[#010409]">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div data-aos="fade-right">
                    <h3 class="text-brand-primary font-bold uppercase tracking-widest text-sm mb-4">Our Unique Edge</h3>
                    <h4 class="text-5xl font-black text-white mb-8">What Sets Us <br>Apart.</h4>
                    <p class="text-gray-500 text-lg mb-10 leading-relaxed">We don't just find assets; we engineer income streams. Our dual-layered diligence ensures maximum safety.</p>
                </div>
                <div class="grid gap-6">
                    <div class="p-8 glass-card rounded-3xl border-l-4 border-brand-primary">
                        <h5 class="text-white font-bold text-xl mb-2">Legal Separation</h5>
                        <p class="text-gray-500 text-sm italic">Each asset is ring-fenced in its own legal entity (LLP).</p>
                    </div>
                    <div class="p-8 glass-card rounded-3xl border-l-4 border-brand-accent">
                        <h5 class="text-white font-bold text-xl mb-2">Operational Alpha</h5>
                        <p class="text-gray-500 text-sm italic">We manage the businesses to maximize yield above market benchmarks.</p>
                    </div>
                    <div class="p-8 glass-card rounded-3xl border-l-4 border-purple-400">
                        <h5 class="text-white font-bold text-xl mb-2">Exit Liquidity</h5>
                        <p class="text-gray-500 text-sm italic">Internal marketplace for secondary stake transfers.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Leadership (Detailed) -->
    <section class="py-32 bg-brand-dark overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-5xl font-black text-white text-center mb-24">The Visionaries</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-20">
                <div class="text-center group" data-aos="fade-up">
                    <div class="relative w-64 h-64 mx-auto mb-10 overflow-hidden rounded-[3rem] border-2 border-brand-border">
                        <img src="{{ asset('images/expert-1.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <h5 class="text-3xl font-black text-white mb-2">Amit Sharma</h5>
                    <p class="text-brand-primary font-bold tracking-[0.3em] uppercase text-xs mb-6">CEO & Founder</p>
                    <p class="text-gray-500 px-8 text-sm leading-relaxed mb-6 italic">"Our goal is simple: make prime commercial assets accessible to every serious Indian investor."</p>
                    <div class="flex justify-center gap-4 text-gray-500">
                        <a href="#" class="hover:text-brand-primary"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative w-64 h-64 mx-auto mb-10 overflow-hidden rounded-[3rem] border-2 border-brand-border">
                        <img src="{{ asset('images/expert-2.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <h5 class="text-3xl font-black text-white mb-2">Priya Verma</h5>
                    <p class="text-brand-accent font-bold tracking-[0.3em] uppercase text-xs mb-6">COO</p>
                    <p class="text-gray-500 px-8 text-sm leading-relaxed mb-6 italic">"Operation excellence is the foundation of our high-yield promise to the syndicate."</p>
                    <div class="flex justify-center gap-4 text-gray-500">
                        <a href="#" class="hover:text-brand-accent"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative w-64 h-64 mx-auto mb-10 overflow-hidden rounded-[3rem] border-2 border-brand-border">
                        <img src="{{ asset('images/expert-3.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <h5 class="text-3xl font-black text-white mb-2">Vikram राव</h5>
                    <p class="text-purple-400 font-bold tracking-[0.3em] uppercase text-xs mb-6">CIO</p>
                    <p class="text-gray-500 px-8 text-sm leading-relaxed mb-6 italic">"Risk mitigation is the first step towards generating lasting generational wealth."</p>
                    <div class="flex justify-center gap-4 text-gray-500">
                        <a href="#" class="hover:text-purple-400"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Partners & Ecosystem -->
    <section class="py-24 border-y border-brand-border bg-brand-card/30 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h5 class="text-gray-500 font-black uppercase tracking-[0.4em] text-xs mb-12">Trusted Ecosystem Partners</h5>
            <div class="flex flex-wrap justify-center gap-16 opacity-40 grayscale group hover:grayscale-0 transition-all">
                <i class="fab fa-aws text-5xl"></i>
                <i class="fab fa-google-pay text-5xl"></i>
                <i class="fab fa-cc-visa text-5xl"></i>
                <i class="fab fa-salesforce text-5xl"></i>
                <i class="fab fa-stripe text-5xl"></i>
                <i class="fab fa-digital-ocean text-5xl"></i>
            </div>
        </div>
    </section>

    <!-- 7. Media & Press Glimpse -->
    <section class="py-32">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h3 class="text-3xl font-bold text-white mb-4">In the Headlines</h3>
                <p class="text-gray-500">Recognition from industry leaders and media platforms.</p>
            </div>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="glass-card p-10 rounded-3xl hover:border-brand-primary transition-all cursor-pointer">
                    <div class="text-brand-primary font-black mb-4">ECONOMIC TIMES</div>
                    <h6 class="text-xl font-bold text-white mb-3">"Shaurya Foundation Surpasses ₹50Cr Milestone in Asset Tokenization."</h6>
                    <p class="text-gray-500 text-sm">A deep dive into how fractional ownership is winning over retail investors in India.</p>
                </div>
                <div class="glass-card p-10 rounded-3xl hover:border-brand-accent transition-all cursor-pointer">
                    <div class="text-brand-accent font-black mb-4">MONEYCONTROL</div>
                    <h6 class="text-xl font-bold text-white mb-3">"The Future of Alternative Investing: P2P Syndicates."</h6>
                    <p class="text-gray-500 text-sm">How Shaurya is outperforming traditional FDs by 3x through calculated asset exposure.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. Offices / Presence -->
    <section class="py-32 bg-brand-card/10">
        <div class="max-w-7xl mx-auto px-4 grid lg:grid-cols-2 gap-20 items-center">
            <div class="relative h-[400px] rounded-3xl overflow-hidden border border-brand-border shadow-2xl" data-aos="zoom-in">
                <div class="absolute inset-0 bg-brand-primary/20 blur-[100px] opacity-40"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                     <i class="fas fa-map-marked-alt text-8xl text-brand-primary opacity-20"></i>
                </div>
                <div class="absolute bottom-6 left-6 right-6 p-6 glass-nav rounded-2xl border border-brand-border">
                    <p class="text-white font-bold mb-1">NCR Regional Headquarters</p>
                    <p class="text-gray-500 text-sm italic">Gurgaon, Haryana, Cyber City Hub</p>
                </div>
            </div>
            <div data-aos="fade-left">
                <h3 class="text-4xl font-extrabold text-white mb-8">Visit Our Global <br>Experience Center.</h3>
                <p class="text-gray-400 text-lg mb-8">We believe in physical transparency. Investors are always welcome to visit our offices and view the asset portfolio documentation in person.</p>
                <a href="{{ route('home') }}#apply" class="px-8 py-4 bg-brand-primary/10 border border-brand-primary text-brand-primary font-bold rounded-full hover:bg-brand-primary hover:text-white transition-all">Book an Office Visit</a>
            </div>
        </div>
    </section>

    <!-- 9. Ethics & Compliance -->
    <section class="py-32 bg-black border-y border-brand-border">
        <div class="max-w-3xl mx-auto px-4 text-center">
             <i class="fas fa-gavel text-6xl text-brand-accent mb-8"></i>
             <h4 class="text-3xl font-black text-white mb-6">Zero-Compromise Compliance</h4>
             <p class="text-gray-500 leading-relaxed text-lg italic">"We operate under the strictest interpretation of the LLP Act and RERA guidelines. Every penny of syndicate capital is protected by a multi-signature escrow protocol."</p>
        </div>
    </section>

    <!-- 10. Application Form -->
    <section id="apply" class="py-40 relative bg-brand-dark overflow-hidden">
        <div class="absolute inset-0 bg-brand-primary/5"></div>
        <div class="max-w-4xl mx-auto px-4 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <h4 class="text-5xl font-black text-white mb-6">Join the Mission</h4>
                <p class="text-gray-400 text-xl">Start your fractional ownership journey with Shaurya today.</p>
            </div>
            
            <form action="{{ route('apply') }}" method="POST" class="glass-card p-10 md:p-16 rounded-[3rem] border border-brand-primary/20" data-aos="zoom-in">
                @csrf
                <input type="hidden" name="sector" value="General Inquiry">
                <div class="grid md:grid-cols-2 gap-8 mb-8">
                    <div class="space-y-3">
                        <label class="text-xs font-bold text-brand-primary uppercase tracking-widest ml-2">Full Name</label>
                        <input type="text" name="name" placeholder="Rahul Sharma" class="w-full bg-brand-dark/50 border border-brand-border rounded-2xl px-8 py-5 text-white outline-none focus:border-brand-primary transition-all" required>
                    </div>
                    <div class="space-y-3">
                        <label class="text-xs font-bold text-brand-primary uppercase tracking-widest ml-2">Phone Number</label>
                        <input type="tel" name="phone" placeholder="+91 XXXX XXXX" class="w-full bg-brand-dark/50 border border-brand-border rounded-2xl px-8 py-5 text-white outline-none focus:border-brand-primary transition-all" required>
                    </div>
                </div>
                <div class="space-y-3 mb-10">
                    <label class="text-xs font-bold text-brand-primary uppercase tracking-widest ml-2">Email Address</label>
                    <input type="email" name="email" placeholder="rahul@example.com" class="w-full bg-brand-dark/50 border border-brand-border rounded-2xl px-8 py-5 text-white outline-none focus:border-brand-primary transition-all" required>
                </div>
                <button type="submit" class="w-full bg-brand-primary text-white font-black py-6 rounded-2xl text-xl hover:scale-[1.02] shadow-[0_20px_40px_rgba(14,165,233,0.3)] transition-all flex items-center justify-center gap-3">
                    Submit Member Application <i class="fas fa-arrow-right text-sm"></i>
                </button>
            </form>
        </div>
    </section>
</x-frontend.layout>
