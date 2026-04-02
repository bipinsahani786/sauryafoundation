<x-dashboard.layout>
    <x-slot name="title">Website Settings</x-slot>

    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Global Configuration</h2>
        <p class="text-xs text-slate-400 font-bold italic uppercase tracking-widest mt-1">Manage site branding, contact information, and social connectivity.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Left Column: Branding -->
            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white rounded-[2.5rem] p-10 border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-1 rounded-full bg-indigo-600"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Site Branding</h3>
                    </div>

                    <div class="space-y-6" x-data="{ 
                        logoPreview: '{{ isset($settings['site_logo']) ? asset('storage/' . $settings['site_logo']) : '' }}',
                        faviconPreview: '{{ isset($settings['site_favicon']) ? asset('storage/' . $settings['site_favicon']) : '' }}'
                    }">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Site Name</label>
                            <input type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}" placeholder="Shaurya Narayan Foundation" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:border-indigo-600 outline-none transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Site Logo</label>
                            <div class="relative group">
                                <input type="file" name="site_logo" @change="let reader = new FileReader(); reader.onload = (e) => { logoPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-8 text-center group-hover:border-indigo-600 transition-all">
                                    <template x-if="logoPreview">
                                        <img :src="logoPreview" class="h-12 mx-auto mb-4 object-contain">
                                    </template>
                                    <template x-if="!logoPreview">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-slate-300 mb-4"></i>
                                    </template>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="logoPreview ? 'Change logo' : 'Click to upload logo'"></p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Favicon</label>
                            <div class="flex items-center gap-4 p-4 bg-slate-50 border border-slate-200 rounded-2xl">
                                <div class="w-10 h-10 bg-white rounded-lg border border-slate-200 flex items-center justify-center shrink-0">
                                    <template x-if="faviconPreview">
                                        <img :src="faviconPreview" class="w-6 h-6 object-contain">
                                    </template>
                                    <template x-if="!faviconPreview">
                                        <i class="fas fa-image text-slate-300"></i>
                                    </template>
                                </div>
                                <input type="file" name="site_favicon" @change="let reader = new FileReader(); reader.onload = (e) => { faviconPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="w-full text-[10px] font-black text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-indigo-900 rounded-[2.5rem] p-10 text-white relative overflow-hidden shadow-2xl">
                    <div class="relative z-10">
                        <h4 class="text-lg font-black tracking-tight mb-2">Need Help?</h4>
                        <p class="text-[10px] text-indigo-300 font-bold italic leading-relaxed uppercase tracking-widest">Global settings affect all landing pages. Ensure information accuracy before saving.</p>
                    </div>
                    <i class="fas fa-info-circle absolute -right-4 -bottom-4 text-8xl opacity-10"></i>
                </div>
            </div>

            <!-- Middle Column: Contact Info -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[2.5rem] p-10 border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-1 rounded-full bg-emerald-500"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Contact & Support</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Support Phone</label>
                            <div class="relative">
                                <i class="fas fa-phone-alt absolute left-6 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                <input type="text" name="site_phone" value="{{ $settings['site_phone'] ?? '+91 124 456 7890' }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-14 pr-6 py-4 text-sm font-bold text-slate-900 focus:border-emerald-500 outline-none transition-all">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">WhatsApp Number</label>
                            <div class="relative">
                                <i class="fab fa-whatsapp absolute left-6 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                <input type="text" name="site_whatsapp" value="{{ $settings['site_whatsapp'] ?? '+91 124 456 7890' }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-14 pr-6 py-4 text-sm font-bold text-slate-900 focus:border-emerald-500 outline-none transition-all">
                            </div>
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Support Email</label>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-6 top-1/2 -translate-y-1/2 text-slate-300"></i>
                                <input type="email" name="site_email" value="{{ $settings['site_email'] ?? 'invest@shaurya.in' }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-14 pr-6 py-4 text-sm font-bold text-slate-900 focus:border-emerald-500 outline-none transition-all">
                            </div>
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Physical Address</label>
                            <div class="relative">
                                <i class="fas fa-map-marker-alt absolute left-6 top-6 text-slate-300"></i>
                                <textarea name="site_address" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-14 pr-6 py-4 text-sm font-bold text-slate-900 focus:border-emerald-500 outline-none transition-all">{{ $settings['site_address'] ?? "Level 4, Shaurya Narayan Heights,\nCyber City, Gurgaon,\nHaryana - 122002" }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Connectivity -->
                <div class="bg-white rounded-[2.5rem] p-10 border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-1 rounded-full bg-amber-500"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Social Connectivity</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2 text-indigo-600">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">LinkedIn URL</label>
                            <div class="relative">
                                <i class="fab fa-linkedin-in absolute left-6 top-1/2 -translate-y-1/2"></i>
                                <input type="text" name="social_linkedin" value="{{ $settings['social_linkedin'] ?? '#' }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-14 pr-6 py-4 text-sm font-bold text-slate-900 focus:border-indigo-600 outline-none transition-all">
                            </div>
                        </div>

                        <div class="space-y-2 text-sky-500">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Twitter URL</label>
                            <div class="relative">
                                <i class="fab fa-twitter absolute left-6 top-1/2 -translate-y-1/2"></i>
                                <input type="text" name="social_twitter" value="{{ $settings['social_twitter'] ?? '#' }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-14 pr-6 py-4 text-sm font-bold text-slate-900 focus:border-sky-500 outline-none transition-all">
                            </div>
                        </div>

                        <div class="space-y-2 text-pink-600">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Instagram URL</label>
                            <div class="relative">
                                <i class="fab fa-instagram absolute left-6 top-1/2 -translate-y-1/2"></i>
                                <input type="text" name="social_instagram" value="{{ $settings['social_instagram'] ?? '#' }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-14 pr-6 py-4 text-sm font-bold text-slate-900 focus:border-pink-600 outline-none transition-all">
                            </div>
                        </div>

                        <div class="space-y-2 text-blue-600">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Facebook URL</label>
                            <div class="relative">
                                <i class="fab fa-facebook-f absolute left-6 top-1/2 -translate-y-1/2"></i>
                                <input type="text" name="social_facebook" value="{{ $settings['social_facebook'] ?? '#' }}" class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-14 pr-6 py-4 text-sm font-bold text-slate-900 focus:border-blue-600 outline-none transition-all">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-6">
                    <button type="submit" class="bg-indigo-600 text-white px-12 py-5 rounded-[2rem] text-xs font-black uppercase tracking-widest hover:bg-slate-900 transition-all shadow-2xl shadow-indigo-200 border-b-4 border-indigo-800 active:border-b-0 active:translate-y-1">
                        Deploy Changes <i class="fas fa-rocket ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-dashboard.layout>
