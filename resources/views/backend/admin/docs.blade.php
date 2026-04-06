<x-dashboard.layout title="Project Encyclopedia">
    <div class="space-y-12 pb-24">
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-slate-900 rounded-[2.5rem] p-8 lg:p-16 shadow-2xl shadow-indigo-100/50">
            <div class="relative z-10">
                <h2 class="text-3xl lg:text-6xl font-black text-white mb-4 leading-tight tracking-tight">Software Module<br><span class="text-indigo-500">Encyclopedia</span></h2>
                <p class="text-slate-400 text-xs lg:text-lg max-w-2xl font-medium leading-relaxed">
                    Har module ka step-by-step detail yaha available hai. Neeche diye gaye menu se kisi bhi module ko deep me samjhein.
                </p>
            </div>
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-600/20 rounded-full blur-[100px]"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Navigation Sidebar -->
            <div class="lg:col-span-3 space-y-6 sticky top-24 h-fit">
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 px-2">Module Menu</h3>
                    <nav class="space-y-1 custom-scrollbar max-h-[60vh] overflow-y-auto pr-2">
                        <a href="#plans" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-all">
                            <i class="fas fa-layer-group w-4 opacity-50"></i> Plans & Membership
                        </a>
                        <a href="#cms" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-all">
                            <i class="fas fa-images w-4 opacity-50"></i> Website CMS
                        </a>
                        <a href="#finance" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-all">
                            <i class="fas fa-wallet w-4 opacity-50"></i> Finance & Payouts
                        </a>
                        <a href="#users" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-all">
                            <i class="fas fa-user-shield w-4 opacity-50"></i> User Management
                        </a>
                        <a href="#exams" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-all">
                            <i class="fas fa-vial w-4 opacity-50"></i> Exam Center
                        </a>
                        <a href="#academy" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-all">
                            <i class="fas fa-graduation-cap w-4 opacity-50"></i> LMS Academy
                        </a>
                        <a href="#settings" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-all">
                            <i class="fas fa-cog w-4 opacity-50"></i> Site Settings
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Content Encyclopedia -->
            <div class="lg:col-span-9 space-y-16">
                
                <!-- 1. PLANS MODULE -->
                <section id="plans" class="scroll-mt-24 space-y-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 text-xl shadow-sm"><i class="fas fa-layer-group"></i></div>
                        <h4 class="text-2xl font-black text-slate-900 uppercase">Plans & Membership</h4>
                    </div>
                    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm space-y-6">
                        <p class="text-sm text-slate-600 leading-relaxed font-medium">Syndicate me join karne ke liye students plans buy karte hain.</p>
                        <ul class="space-y-4">
                            <li class="flex gap-4 p-4 bg-slate-50 rounded-2xl">
                                <div class="w-2 h-2 rounded-full bg-indigo-600 mt-2 shrink-0"></div>
                                <div class="space-y-1">
                                    <h5 class="text-xs font-black text-slate-900">View All Plans</h5>
                                    <p class="text-[11px] text-slate-500 font-medium">Yaha aap dekh sakte hain kounsa plan active hai aur kounsa de-active. Aap status toggle kar sakte hain.</p>
                                </div>
                            </li>
                            <li class="flex gap-4 p-4 bg-slate-50 rounded-2xl">
                                <div class="w-2 h-2 rounded-full bg-indigo-600 mt-2 shrink-0"></div>
                                <div class="space-y-1">
                                    <h5 class="text-xs font-black text-slate-900">Add New Plan</h5>
                                    <p class="text-[11px] text-slate-500 font-medium">Naya plan banate waqt uska Price aur Level zaroori mention karein.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>

                <!-- 2. CMS MODULE -->
                <section id="cms" class="scroll-mt-24 space-y-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 text-xl shadow-sm"><i class="fas fa-images"></i></div>
                        <h4 class="text-2xl font-black text-slate-900 uppercase">Website CMS (Banners & Sectors)</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm space-y-3">
                            <h5 class="text-xs font-black text-emerald-600 uppercase">Home Banners</h5>
                            <p class="text-[11px] text-slate-500 leading-relaxed">Website ke front page par jo slide-show chalta hai, wo yaha se control hota hai. Image ka ratio 3:1 rakhein.</p>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm space-y-3">
                            <h5 class="text-xs font-black text-emerald-600 uppercase">Home Sectors</h5>
                            <p class="text-[11px] text-slate-500 leading-relaxed">Sectors matlab website par categories (e.g. Education, Coaching). Har sector ka description aur image yaha se set karein.</p>
                        </div>
                    </div>
                </section>

                <!-- 3. FINANCE & PAYOUTS -->
                <section id="finance" class="scroll-mt-24 space-y-8">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 text-xl shadow-sm"><i class="fas fa-wallet"></i></div>
                        <h4 class="text-2xl font-black text-slate-900 uppercase">Finance, Payouts & KYC</h4>
                    </div>
                    
                    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm space-y-8">
                        <div class="p-6 bg-amber-50 rounded-2xl border border-amber-100 space-y-3">
                            <h5 class="text-xs font-black text-amber-800 uppercase italic">Financial Life-Cycle:</h5>
                            <div class="flex flex-col gap-4">
                                <div class="flex gap-4">
                                    <div class="w-6 h-6 rounded bg-amber-200 flex items-center justify-center text-[10px] font-black shrink-0 shadow-sm">1</div>
                                    <p class="text-[11px] text-amber-800 leading-relaxed font-medium"><span class="font-black">Wallet Top-up:</span> Student paisa pay karke UTR bhejta hai. Admin approve karta hai.</p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-6 h-6 rounded bg-amber-200 flex items-center justify-center text-[10px] font-black shrink-0 shadow-sm">2</div>
                                    <p class="text-[11px] text-amber-800 leading-relaxed font-medium"><span class="font-black">KYC Update:</span> Teacher/Agent apne Bank Details update karte hain. Aap use <span class="underline">Payouts & KYC</span> me verify karte hain.</p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-6 h-6 rounded bg-amber-200 flex items-center justify-center text-[10px] font-black shrink-0 shadow-sm">3</div>
                                    <p class="text-[11px] text-amber-800 leading-relaxed font-medium"><span class="font-black">Payout Approve:</span> Verify hone ke baad Admin paisa transfer karta hai aur button dabata hai.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- 4. USERS MODULE -->
                <section id="users" class="scroll-mt-24 space-y-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 text-xl shadow-sm"><i class="fas fa-user-shield"></i></div>
                        <h4 class="text-2xl font-black text-slate-900 uppercase">User Management</h4>
                    </div>
                    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm space-y-6">
                        <div class="p-6 bg-blue-600 text-white rounded-2xl space-y-2 shadow-lg shadow-blue-100">
                            <h5 class="text-xs font-black uppercase tracking-widest flex items-center gap-2 italic"><i class="fas fa-user-secret"></i> Impersonation (Viewing Mode)</h5>
                            <p class="text-[11px] leading-relaxed opacity-90">Ye sabse powered feature hai. Aap kisi bhi user ke samne <span class="font-black">Eye Icon</span> par click karke unka dashboard aise dekh sakte hain jaise wo khud dekh raha hai. <span class="font-black italic underline">"Debug karne ke liye best hai."</span></p>
                        </div>
                        <p class="text-[11px] text-slate-500 font-medium">Aap yaha se kisi bhi user ka Password change kar sakte hain ya unhe block kar sakte hain.</p>
                    </div>
                </section>

                <!-- 5. EXAM CENTER -->
                <section id="exams" class="scroll-mt-24 space-y-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600 text-xl shadow-sm"><i class="fas fa-vial"></i></div>
                        <h4 class="text-2xl font-black text-slate-900 uppercase">Exam & Quiz Center</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm space-y-4">
                            <h5 class="text-[10px] font-black text-indigo-600 uppercase tracking-widest italic">Verify Exams</h5>
                            <p class="text-[11px] text-slate-500 leading-relaxed font-medium">Jab Teacher exam banata hai, wo yaha Admin ko approval ke liye dikhta hai. Aap use check karke "Publish" karte hain.</p>
                        </div>
                        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm space-y-4">
                            <h5 class="text-[10px] font-black text-indigo-600 uppercase tracking-widest italic">Manage Exams</h5>
                            <p class="text-[11px] text-slate-500 leading-relaxed font-medium">Global exams (jo platform khud karwata hai) wo yaha se banaye aur manage kiye jate hain.</p>
                        </div>
                    </div>
                </section>

                <!-- 6. LMS ACADEMY -->
                <section id="academy" class="scroll-mt-24 space-y-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600 text-xl shadow-sm"><i class="fas fa-graduation-cap"></i></div>
                        <h4 class="text-2xl font-black text-slate-900 uppercase">Academy (Courses & Notes)</h4>
                    </div>
                    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                        <div class="space-y-6">
                            <div class="flex gap-4 border-b border-slate-50 pb-6">
                                <div class="w-10 h-10 rounded bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 shadow-sm"><i class="fas fa-book"></i></div>
                                <div class="space-y-1">
                                    <h5 class="text-xs font-black text-slate-900 uppercase">Academy Structure</h5>
                                    <p class="text-[11px] text-slate-500 font-medium italic">"Subject -> Topic -> Content (Video/Text)." Har course yahi sequence follow karta hai.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 shadow-sm"><i class="fas fa-file-pdf"></i></div>
                                <div class="space-y-1">
                                    <h5 class="text-xs font-black text-slate-900 uppercase">Global Notes Management</h5>
                                    <p class="text-[11px] text-slate-500 font-medium italic">Aap notes upload karke price set kar sakte hain. Student isse buy karke PDF download kar sakta hai.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- 7. SETTINGS -->
                <section id="settings" class="scroll-mt-24 space-y-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-slate-900 border border-slate-700 flex items-center justify-center text-white text-xl shadow-sm"><i class="fas fa-cog"></i></div>
                        <h4 class="text-2xl font-black text-slate-900 uppercase">Site Settings</h4>
                    </div>
                    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm space-y-4">
                        <p class="text-[11px] text-slate-500 font-medium italic">"Yaha galat entry pure website ka design kharab kar sakti hai."</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
                                <h6 class="text-[10px] font-black text-slate-900 uppercase mb-1">Company Info</h6>
                                <p class="text-[10px] text-slate-500">Logo, Name aur SEO details.</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
                                <h6 class="text-[10px] font-black text-slate-900 uppercase mb-1">Footer & Social</h6>
                                <p class="text-[10px] text-slate-500">Contact details aur Links.</p>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-dashboard.layout>
