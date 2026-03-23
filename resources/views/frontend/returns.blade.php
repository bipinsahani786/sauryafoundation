<x-frontend.layout>
    <x-slot name="title">ROI & Returns | Shaurya Foundation</x-slot>

    <!-- 1. Hero -->
    <section class="relative pt-48 pb-32 bg-[#02040a] overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
            <h2 class="text-brand-primary font-bold tracking-[.4em] mb-4 uppercase text-xs">Financial Alpha</h2>
            <h1 class="text-6xl md:text-8xl font-black text-white tracking-tighter mb-8 leading-none" data-aos="fade-up">Real Assets.<br><span class="text-gradient">Real Returns.</span></h1>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Conservative projections meeting aggressive execution. Our IRR outpaces traditional benchmarks by 3x-4x.</p>
        </div>
    </section>

    <!-- 2. Yield Comparison (Stock vs REIT vs Shaurya) -->
    <section class="py-32 bg-brand-dark">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="glass-card p-10 rounded-3xl border-t-4 border-t-red-500/30" data-aos="fade-up">
                    <h5 class="text-red-500 font-black mb-6 uppercase tracking-widest text-sm">Mutual Funds</h5>
                    <div class="text-4xl font-black text-white mb-4">12% - 14%</div>
                    <p class="text-gray-500 text-sm">High volatility. Market linked. Zero collateral ownership.</p>
                </div>
                <div class="glass-card p-10 rounded-3xl border-t-4 border-t-brand-primary/30" data-aos="fade-up" data-aos-delay="100">
                    <h5 class="text-brand-primary font-black mb-6 uppercase tracking-widest text-sm">Standard REITS</h5>
                    <div class="text-4xl font-black text-white mb-4">6% - 8%</div>
                    <p class="text-gray-500 text-sm">Low yield. High management fees. Passive rental only.</p>
                </div>
                <div class="glass-card p-10 rounded-3xl border-t-4 border-t-brand-accent/30 bg-brand-accent/5" data-aos="fade-up" data-aos-delay="200">
                    <h5 class="text-brand-accent font-black mb-6 uppercase tracking-widest text-sm">Shaurya Syndicate</h5>
                    <div class="text-4xl font-black text-brand-accent mb-4">18% - 24%</div>
                    <p class="text-gray-400 text-sm font-bold italic">Rental Yield + Operational Alpha + Capital Growth.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Sector Breakdown (Table) -->
    <section class="py-32 bg-brand-card/5 border-y border-brand-border">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-4xl font-black text-white text-center mb-16">Target Sector IRR Matrix</h3>
            <div class="overflow-x-auto glass-card rounded-3xl border border-brand-border h-[min-content] overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-brand-border bg-brand-card/20">
                            <th class="px-8 py-6 text-brand-primary font-bold uppercase tracking-widest text-xs">Asset Class</th>
                            <th class="px-8 py-6 text-brand-primary font-bold uppercase tracking-widest text-xs">Target IRR</th>
                            <th class="px-8 py-6 text-brand-primary font-bold uppercase tracking-widest text-xs">Payout Frequency</th>
                            <th class="px-8 py-6 text-brand-primary font-bold uppercase tracking-widest text-xs">Exit Window</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-400">
                        <tr class="border-b border-brand-border/40 hover:bg-brand-card transition-colors">
                            <td class="px-8 py-6 font-bold text-white">Marriage Halls</td>
                            <td class="px-8 py-6 text-brand-accent font-black">22.4%</td>
                            <td class="px-8 py-6">Quarterly</td>
                            <td class="px-8 py-6">3 - 5 Years</td>
                        </tr>
                        <tr class="border-b border-brand-border/40 hover:bg-brand-card transition-colors">
                            <td class="px-8 py-6 font-bold text-white">Schools / Edu Infra</td>
                            <td class="px-8 py-6 text-brand-accent font-black">16.8%</td>
                            <td class="px-8 py-6">Annually</td>
                            <td class="px-8 py-6">5 - 7 Years</td>
                        </tr>
                        <tr class="hover:bg-brand-card transition-colors">
                            <td class="px-8 py-6 font-bold text-white">Digital Coaching</td>
                            <td class="px-8 py-6 text-brand-accent font-black">28.5%</td>
                            <td class="px-8 py-6">Monthly</td>
                            <td class="px-8 py-6">2 - 3 Years</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- 4. Interactive Calculator (Static Visual) -->
    <section class="py-32">
        <div class="max-w-5xl mx-auto px-4">
            <div class="glass-card p-12 md:p-20 rounded-[3rem] text-center border-brand-primary/20">
                <h3 class="text-3xl font-bold text-white mb-6">Wealth Projection Tool</h3>
                <p class="text-gray-500 mb-12 max-w-xl mx-auto">Estimated growth of ₹25 Lakhs core investment in the Marriage Hall syndicate over 60 months.</p>
                <div class="flex items-end justify-center h-64 gap-4 mb-8">
                     <div class="w-16 bg-gray-800 rounded-t-xl h-[40%] text-white text-[10px] py-4">YR 1</div>
                     <div class="w-16 bg-gray-800 rounded-t-xl h-[55%] text-white text-[10px] py-4">YR 2</div>
                     <div class="w-16 bg-brand-primary rounded-t-xl h-[70%] text-white text-[10px] py-4 shadow-lg shadow-brand-primary/20">YR 3</div>
                     <div class="w-16 bg-brand-primary rounded-t-xl h-[85%] text-white text-[10px] py-4 shadow-lg shadow-brand-primary/20">YR 4</div>
                     <div class="w-20 bg-gradient-to-t from-brand-primary to-brand-accent rounded-t-xl h-full text-white text-xs font-black py-4 shadow-lg shadow-brand-accent/20 flex items-start justify-center">₹58.6L</div>
                </div>
                <p class="text-brand-accent font-black text-2xl">ROI Multiplier: 2.34x</p>
            </div>
        </div>
    </section>

    <!-- 5. Dividend Policy -->
    <section class="py-32 bg-brand-card/10">
        <div class="max-w-7xl mx-auto px-4 grid lg:grid-cols-2 gap-20 items-center">
            <div data-aos="fade-right">
                <h3 class="text-4xl font-black text-white mb-8">Dividend Principles.</h3>
                <p class="text-gray-500 text-lg mb-8">We prioritize regular liquidity for our members. 80% of quarterly operational profits are distributed as dividends, while 20% is held for asset maintenance and scale reserves.</p>
                <div class="flex gap-4">
                    <div class="p-6 glass-card rounded-2xl flex-1 text-center"><p class="text-brand-primary font-black text-2xl">80%</p><p class="text-gray-600 text-xs uppercase">Payout Ratio</p></div>
                    <div class="p-6 glass-card rounded-2xl flex-1 text-center"><p class="text-brand-accent font-black text-2xl">T+3</p><p class="text-gray-600 text-xs uppercase">Transfer Speed</p></div>
                </div>
            </div>
            <div class="glass-card p-10 rounded-3xl" data-aos="fade-left">
                <i class="fas fa-history text-4xl text-brand-primary mb-6"></i>
                <h5 class="text-xl font-bold text-white mb-4">Historical Performance</h5>
                <p class="text-gray-500 mb-6">Since 2018, we haven't missed a single dividend cycle, even during the 2020-21 pandemic disruptions.</p>
                <span class="text-brand-primary font-bold">Audited by SVK & Associates</span>
            </div>
        </div>
    </section>

    <!-- 6. Capital Appreciation -->
    <section class="py-32 border-t border-brand-border overflow-hidden relative">
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand-accent/10 blur-[150px]"></div>
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h3 class="text-4xl font-extrabold text-white mb-8">Beyond Yield: Asset Growth.</h3>
            <p class="text-gray-400 max-w-3xl mx-auto text-lg mb-16">The real wealth is in the land. Our assets are strategically located in high-growth corridors where land appreciation averages 8-12% annually on top of business yields.</p>
            <div class="flex flex-wrap justify-center gap-6">
                <div class="px-8 py-4 glass-card rounded-full text-brand-accent font-bold"><i class="fas fa-arrow-up mr-2"></i> Prime Land Growth</div>
                <div class="px-8 py-4 glass-card rounded-full text-brand-accent font-bold"><i class="fas fa-arrow-up mr-2"></i> Infrastructure Premium</div>
            </div>
        </div>
    </section>

    <!-- 7. Fee Structure (Transparency) -->
    <section class="py-32 bg-[#01040a]">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h3 class="text-2xl font-bold text-white mb-12">Fair Fee Alignment</h3>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="p-8 glass-card border border-brand-border rounded-3xl">
                    <p class="text-gray-500 text-xs uppercase mb-2">Management Fee</p>
                    <p class="text-3xl font-black text-white mb-4">2% AUM / Yr</p>
                    <p class="text-xs text-gray-600">Covers A-Z asset operations and staff.</p>
                </div>
                <div class="p-8 glass-card border border-brand-accent/30 rounded-3xl">
                    <p class="text-brand-accent text-xs uppercase mb-2">Success Proxy</p>
                    <p class="text-3xl font-black text-white mb-4">15% on Returns</p>
                    <p class="text-xs text-gray-600">Only applicable above 12% Hurdle Rate. We win only when YOU win.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. Risk Management (Financial) -->
    <section class="py-32 border-y border-brand-border bg-brand-dark">
        <div class="max-w-7xl mx-auto px-4 grid lg:grid-cols-2 gap-20 items-center">
             <div class="glass-card p-12 rounded-[3rem] relative overflow-hidden">
                <div class="absolute inset-0 bg-brand-accent/5"></div>
                <h4 class="text-2xl font-bold text-white mb-10 relative z-10">Risk Mitigation Protocols</h4>
                <div class="space-y-6 relative z-10">
                    <div class="flex gap-4"><i class="fas fa-shield-alt text-brand-accent text-xl mt-1"></i> <p class="text-gray-400 text-sm">Diversification across 3 distinct sub-sectors.</p></div>
                    <div class="flex gap-4"><i class="fas fa-shield-alt text-brand-accent text-xl mt-1"></i> <p class="text-gray-400 text-sm">Escrow-managed capital deployment only upon title clearance.</p></div>
                    <div class="flex gap-4"><i class="fas fa-shield-alt text-brand-accent text-xl mt-1"></i> <p class="text-gray-400 text-sm">Conservative LTV (Loan-to-Value) maintainance on assets.</p></div>
                </div>
             </div>
             <div>
                <h3 class="text-4xl font-black text-white mb-8">Safety of Capital <br>is Objective #1.</h3>
                <p class="text-gray-500 text-lg leading-relaxed">Returns are important, but preservation of capital is paramount. Every syndicate asset is insured by top-tier firms against operational and physical risks.</p>
             </div>
        </div>
    </section>

    <!-- 9. Secondary Market Liquidity -->
    <section class="py-32 bg-brand-card/5">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold text-white mb-8">Flexible Exit Options</h3>
            <p class="text-gray-500 mb-12">While these are long-term assets, we provide a private marketplace where you can list your fractional share for sale to other syndicate members after common lock-in. <strong>Avg Exit Time: 14 Days.</strong></p>
            <div class="inline-flex items-center gap-3 px-8 py-4 glass-card rounded-full border-brand-primary/30"><span class="w-3 h-3 bg-brand-accent rounded-full animate-pulse"></span> <span class="text-xs text-white font-bold uppercase">LIVE LIQUIDITY MARKET</span></div>
        </div>
    </section>

    <!-- 10. Final CDA -->
    <section class="py-40 relative overflow-hidden bg-brand-dark">
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h4 class="text-5xl font-black text-white mb-10" data-aos="fade-up">Secure Your Slot.</h4>
            <a href="{{ route('home') }}#apply" class="px-16 py-6 bg-brand-primary text-white rounded-full font-black text-2xl hover:scale-110 transition-all shadow-2xl">Invest Now <i class="fas fa-long-arrow-alt-right ml-3"></i></a>
        </div>
    </section>

</x-frontend.layout>
