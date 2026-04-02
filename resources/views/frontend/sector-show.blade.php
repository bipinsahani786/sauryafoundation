<x-frontend.layout>
    <x-slot name="title">{{ $sector->title }} | Shaurya Narayan Foundation</x-slot>

    <!-- 1. Dynamic Hero -->
    <section class="relative pt-40 pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-16 items-center mb-32">
                <div data-aos="fade-right">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-brand-primary/30 bg-brand-primary/10 mb-6 text-sm">
                        <i class="{{ $sector->icon ?? 'fas fa-chart-line' }} text-brand-primary"></i> 
                        <span class="text-brand-primary font-bold uppercase tracking-widest text-xs">{{ $sector->tag ?? 'Premium Asset Class' }}</span>
                    </div>
                    <h1 class="text-6xl font-black text-white mb-8 tracking-tighter">{{ $sector->title }}</h1>
                    <p class="text-xl text-gray-400 leading-relaxed mb-8">{{ $sector->description }}</p>
                    <a href="#apply" class="inline-flex items-center gap-3 bg-white text-brand-dark px-8 py-4 rounded-full font-bold hover:bg-gray-200 transition-all shadow-xl">
                        Invest in this Sector <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="relative" data-aos="fade-left">
                    <div class="absolute inset-0 bg-brand-primary/20 blur-[120px] opacity-20"></div>
                    <img src="{{ asset('storage/' . $sector->image_path) }}" class="relative rounded-[3rem] border border-brand-border shadow-2xl w-full object-cover aspect-[4/3]" alt="{{ $sector->title }}">
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Sector Stats -->
    <section class="py-24 bg-brand-card/5 border-y border-brand-border">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center" data-aos="fade-up" data-aos-delay="0">
                <p class="text-4xl font-black text-white mb-2">{{ $sector->stats['yield'] ?? '21.5%' }}</p>
                <p class="text-brand-primary text-xs uppercase font-bold tracking-widest">Target Yield</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <p class="text-4xl font-black text-white mb-2">{{ $sector->stats['asset_class'] ?? 'Institutional' }}</p>
                <p class="text-brand-primary text-xs uppercase font-bold tracking-widest">Asset Class</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <p class="text-4xl font-black text-white mb-2">{{ $sector->stats['transparency'] ?? '100%' }}</p>
                <p class="text-brand-primary text-xs uppercase font-bold tracking-widest">Transparency</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                <p class="text-4xl font-black text-white mb-2">{{ $sector->stats['exit_window'] ?? 'T+5 Yr' }}</p>
                <p class="text-brand-primary text-xs uppercase font-bold tracking-widest">Exit window</p>
            </div>
        </div>
    </section>

    <!-- 3. Main Content Section -->
    <section class="py-32 bg-brand-dark overflow-hidden">
        <div class="max-w-5xl mx-auto px-4">
            <div class="glass-card p-12 md:p-20 rounded-[4rem] border-brand-border prose prose-invert max-w-none prose-p:text-gray-400 prose-headings:text-white prose-headings:font-black">
                @if($sector->content)
                    {!! $sector->content !!}
                @else
                    <div class="text-center">
                        <h3 class="text-4xl">About {{ $sector->title }}</h3>
                        <p class="text-lg leading-relaxed">
                            {{ $sector->description }}
                        </p>
                        <p class="mt-8 text-gray-500 italic">Detailed investment breakdown and operational roadmap will be provided in the specific syndicate memo after application.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- 4. Operational Excellence (Generic but Professional) -->
    <section class="py-32 border-y border-brand-border bg-brand-card/10">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold text-white mb-8">We Handle Everything.</h3>
            <p class="text-gray-500 text-lg mb-12">From facility management to marketing the assets across the syndicate network, Shaurya Narayan Foundation's ops team ensures maximum occupancy and yield optimization.</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="p-6 glass-card rounded-2xl border-brand-border text-xs font-bold text-gray-400">Marketing & Sales</div>
                <div class="p-6 glass-card rounded-2xl border-brand-border text-xs font-bold text-gray-400">Staff Hiring</div>
                <div class="p-6 glass-card rounded-2xl border-brand-border text-xs font-bold text-gray-400">Maintenance</div>
                <div class="p-6 glass-card rounded-2xl border-brand-border text-xs font-bold text-gray-400">Legal Filings</div>
            </div>
        </div>
    </section>


</x-frontend.layout>
