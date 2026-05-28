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

                <!-- Get Involved Page Settings -->
                <div class="bg-white rounded-[2.5rem] p-10 border border-slate-200 shadow-sm" x-data="{ involvedHeroPreview: '{{ isset($settings['involved_hero_image']) ? asset('storage/' . $settings['involved_hero_image']) : '' }}' }">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-1 rounded-full bg-green-500"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Get Involved Page Settings</h3>
                    </div>

                    <div class="grid grid-cols-1 mb-8">
                        <!-- Hero Image -->
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Hero Background Image</label>
                            <div class="relative group h-full min-h-[200px]">
                                <input type="file" name="involved_hero_image" @change="let reader = new FileReader(); reader.onload = (e) => { involvedHeroPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="h-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-4 text-center flex flex-col items-center justify-center group-hover:border-green-500 transition-all">
                                    <template x-if="involvedHeroPreview">
                                        <img :src="involvedHeroPreview" class="h-24 w-full object-cover mb-4 rounded-xl shadow-lg">
                                    </template>
                                    <template x-if="!involvedHeroPreview">
                                        <div class="mb-4">
                                            <i class="fas fa-image text-4xl text-slate-300"></i>
                                        </div>
                                    </template>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="involvedHeroPreview ? 'Change' : 'Upload'"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bank details & QR -->
                <div class="bg-white rounded-[2.5rem] p-10 border border-slate-200 shadow-sm" x-data="{ qrPreview: '{{ isset($settings['admin_qr_code']) ? asset('storage/' . $settings['admin_qr_code']) : '' }}' }">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-1 rounded-full bg-emerald-500"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Top-up Account Details</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Bank Name</label>
                                <input type="text" name="admin_bank_name" value="{{ $settings['admin_bank_name'] ?? '' }}" placeholder="State Bank of India" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:border-emerald-500 outline-none transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Account Number</label>
                                <input type="text" name="admin_account_no" value="{{ $settings['admin_account_no'] ?? '' }}" placeholder="XXXX XXXX XXXX" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:border-emerald-500 outline-none transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">IFSC Code</label>
                                <input type="text" name="admin_ifsc_code" value="{{ $settings['admin_ifsc_code'] ?? '' }}" placeholder="SBIN0001234" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:border-emerald-500 outline-none transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">UPI ID</label>
                                <input type="text" name="admin_upi_id" value="{{ $settings['admin_upi_id'] ?? '' }}" placeholder="admin@upi" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:border-emerald-500 outline-none transition-all">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Payment QR Code</label>
                            <div class="relative group h-full min-h-[260px]">
                                <input type="file" name="admin_qr_code" @change="let reader = new FileReader(); reader.onload = (e) => { qrPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="h-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-8 text-center flex flex-col items-center justify-center group-hover:border-emerald-500 transition-all">
                                    <template x-if="qrPreview">
                                        <img :src="qrPreview" class="h-40 w-40 object-contain mb-4 rounded-xl shadow-lg">
                                    </template>
                                    <template x-if="!qrPreview">
                                        <div class="mb-4">
                                            <i class="fas fa-qrcode text-5xl text-slate-300"></i>
                                        </div>
                                    </template>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="qrPreview ? 'Change QR Code' : 'Upload Payment QR'"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- About Me Images -->
                <div class="bg-white rounded-[2.5rem] p-10 border border-slate-200 shadow-sm mb-8" x-data="{ 
                        aboutMeTopPreview: '{{ isset($settings['about_me_top_image']) ? asset('storage/' . $settings['about_me_top_image']) : '' }}',
                        aboutMeLeftPreview: '{{ isset($settings['about_me_left_image']) ? asset('storage/' . $settings['about_me_left_image']) : '' }}',
                        aboutMeRightPreview: '{{ isset($settings['about_me_right_image']) ? asset('storage/' . $settings['about_me_right_image']) : '' }}'
                    }">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-1 rounded-full bg-blue-500"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">About Me Section Images</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Top Image -->
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Top Banner Image</label>
                            <div class="relative group h-full min-h-[200px]">
                                <input type="file" name="about_me_top_image" @change="let reader = new FileReader(); reader.onload = (e) => { aboutMeTopPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="h-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-4 text-center flex flex-col items-center justify-center group-hover:border-blue-500 transition-all">
                                    <template x-if="aboutMeTopPreview">
                                        <img :src="aboutMeTopPreview" class="h-24 w-full object-cover mb-4 rounded-xl shadow-lg">
                                    </template>
                                    <template x-if="!aboutMeTopPreview">
                                        <div class="mb-4">
                                            <i class="fas fa-image text-4xl text-slate-300"></i>
                                        </div>
                                    </template>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="aboutMeTopPreview ? 'Change' : 'Upload'"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Left Image -->
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Bottom Left Image</label>
                            <div class="relative group h-full min-h-[200px]">
                                <input type="file" name="about_me_left_image" @change="let reader = new FileReader(); reader.onload = (e) => { aboutMeLeftPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="h-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-4 text-center flex flex-col items-center justify-center group-hover:border-blue-500 transition-all">
                                    <template x-if="aboutMeLeftPreview">
                                        <img :src="aboutMeLeftPreview" class="h-24 w-24 object-cover mb-4 rounded-xl shadow-lg">
                                    </template>
                                    <template x-if="!aboutMeLeftPreview">
                                        <div class="mb-4">
                                            <i class="fas fa-image text-4xl text-slate-300"></i>
                                        </div>
                                    </template>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="aboutMeLeftPreview ? 'Change' : 'Upload'"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Image -->
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Bottom Right Image</label>
                            <div class="relative group h-full min-h-[200px]">
                                <input type="file" name="about_me_right_image" @change="let reader = new FileReader(); reader.onload = (e) => { aboutMeRightPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="h-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-4 text-center flex flex-col items-center justify-center group-hover:border-blue-500 transition-all">
                                    <template x-if="aboutMeRightPreview">
                                        <img :src="aboutMeRightPreview" class="h-24 w-24 object-cover mb-4 rounded-xl shadow-lg">
                                    </template>
                                    <template x-if="!aboutMeRightPreview">
                                        <div class="mb-4">
                                            <i class="fas fa-image text-4xl text-slate-300"></i>
                                        </div>
                                    </template>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="aboutMeRightPreview ? 'Change' : 'Upload'"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- About Us Page Images -->
                <div class="bg-white rounded-[2.5rem] p-10 border border-slate-200 shadow-sm mb-8" x-data="{ 
                        aboutUsHeroPreview: '{{ isset($settings['about_us_hero_image']) ? asset('storage/' . $settings['about_us_hero_image']) : '' }}',
                        aboutUsMissionPreview: '{{ isset($settings['about_us_mission_image']) ? asset('storage/' . $settings['about_us_mission_image']) : '' }}'
                    }">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-1 rounded-full bg-fuchsia-500"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">About Us Page Images</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Hero Image -->
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Hero Background Image</label>
                            <div class="relative group h-full min-h-[200px]">
                                <input type="file" name="about_us_hero_image" @change="let reader = new FileReader(); reader.onload = (e) => { aboutUsHeroPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="h-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-4 text-center flex flex-col items-center justify-center group-hover:border-fuchsia-500 transition-all">
                                    <template x-if="aboutUsHeroPreview">
                                        <img :src="aboutUsHeroPreview" class="h-24 w-full object-cover mb-4 rounded-xl shadow-lg">
                                    </template>
                                    <template x-if="!aboutUsHeroPreview">
                                        <div class="mb-4">
                                            <i class="fas fa-image text-4xl text-slate-300"></i>
                                        </div>
                                    </template>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="aboutUsHeroPreview ? 'Change' : 'Upload'"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Mission Image -->
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Our Mission Image</label>
                            <div class="relative group h-full min-h-[200px]">
                                <input type="file" name="about_us_mission_image" @change="let reader = new FileReader(); reader.onload = (e) => { aboutUsMissionPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="h-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-4 text-center flex flex-col items-center justify-center group-hover:border-fuchsia-500 transition-all">
                                    <template x-if="aboutUsMissionPreview">
                                        <img :src="aboutUsMissionPreview" class="h-24 w-full object-cover mb-4 rounded-xl shadow-lg">
                                    </template>
                                    <template x-if="!aboutUsMissionPreview">
                                        <div class="mb-4">
                                            <i class="fas fa-image text-4xl text-slate-300"></i>
                                        </div>
                                    </template>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="aboutUsMissionPreview ? 'Change' : 'Upload'"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Our Work Page Images -->
                <div class="bg-white rounded-[2.5rem] p-10 border border-slate-200 shadow-sm mb-8" x-data="{ 
                        ourWorkHeroPreview: '{{ isset($settings['our_work_hero_image']) ? asset('storage/' . $settings['our_work_hero_image']) : '' }}'
                    }">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-1 rounded-full bg-orange-500"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Our Work Page Images</h3>
                    </div>

                    <div class="grid grid-cols-1 gap-8">
                        <!-- Hero Image -->
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Hero Background Image</label>
                            <div class="relative group h-full min-h-[200px]">
                                <input type="file" name="our_work_hero_image" @change="let reader = new FileReader(); reader.onload = (e) => { ourWorkHeroPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="h-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-4 text-center flex flex-col items-center justify-center group-hover:border-orange-500 transition-all">
                                    <template x-if="ourWorkHeroPreview">
                                        <img :src="ourWorkHeroPreview" class="h-24 w-full object-cover mb-4 rounded-xl shadow-lg">
                                    </template>
                                    <template x-if="!ourWorkHeroPreview">
                                        <div class="mb-4">
                                            <i class="fas fa-image text-4xl text-slate-300"></i>
                                        </div>
                                    </template>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="ourWorkHeroPreview ? 'Change' : 'Upload'"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Media Page Settings -->
                <div class="bg-white rounded-[2.5rem] p-10 border border-slate-200 shadow-sm mb-8" x-data="{ 
                        mediaHeroPreview: '{{ isset($settings['media_hero_image']) ? asset('storage/' . $settings['media_hero_image']) : '' }}',
                        vid1Preview: '{{ isset($settings['media_vid_1_thumb']) ? asset('storage/' . $settings['media_vid_1_thumb']) : '' }}',
                        vid2Preview: '{{ isset($settings['media_vid_2_thumb']) ? asset('storage/' . $settings['media_vid_2_thumb']) : '' }}',
                        vid3Preview: '{{ isset($settings['media_vid_3_thumb']) ? asset('storage/' . $settings['media_vid_3_thumb']) : '' }}',
                        vid4Preview: '{{ isset($settings['media_vid_4_thumb']) ? asset('storage/' . $settings['media_vid_4_thumb']) : '' }}',
                        story1Preview: '{{ isset($settings['media_story_1_image']) ? asset('storage/' . $settings['media_story_1_image']) : '' }}',
                        story2Preview: '{{ isset($settings['media_story_2_image']) ? asset('storage/' . $settings['media_story_2_image']) : '' }}'
                    }">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-1 rounded-full bg-cyan-500"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Media Page Settings</h3>
                    </div>

                    <div class="grid grid-cols-1 mb-8">
                        <!-- Hero Image -->
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Hero Background Image</label>
                            <div class="relative group h-full min-h-[200px]">
                                <input type="file" name="media_hero_image" @change="let reader = new FileReader(); reader.onload = (e) => { mediaHeroPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="h-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-4 text-center flex flex-col items-center justify-center group-hover:border-cyan-500 transition-all">
                                    <template x-if="mediaHeroPreview">
                                        <img :src="mediaHeroPreview" class="h-24 w-full object-cover mb-4 rounded-xl shadow-lg">
                                    </template>
                                    <template x-if="!mediaHeroPreview">
                                        <div class="mb-4">
                                            <i class="fas fa-image text-4xl text-slate-300"></i>
                                        </div>
                                    </template>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="mediaHeroPreview ? 'Change' : 'Upload'"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="text-sm font-bold text-gray-800 mb-4 border-b pb-2">Latest Updates (Media Page)</h4>
                    <div class="space-y-8 mb-8">
                        
                        <!-- Update 1 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-3xl">
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 1 Title</label>
                                <input type="text" name="media_update_1_title" value="{{ $settings['media_update_1_title'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. New Computer Lab">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 1 Date</label>
                                <input type="text" name="media_update_1_date" value="{{ $settings['media_update_1_date'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. May 15, 2025">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 1 Description</label>
                                <textarea name="media_update_1_desc" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" rows="2" placeholder="Brief description...">{{ $settings['media_update_1_desc'] ?? '' }}</textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 1 Icon Class (FontAwesome)</label>
                                <input type="text" name="media_update_1_icon" value="{{ $settings['media_update_1_icon'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. fas fa-desktop">
                            </div>
                        </div>

                        <!-- Update 2 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-3xl">
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 2 Title</label>
                                <input type="text" name="media_update_2_title" value="{{ $settings['media_update_2_title'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. Donation Drive">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 2 Date</label>
                                <input type="text" name="media_update_2_date" value="{{ $settings['media_update_2_date'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. May 10, 2025">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 2 Description</label>
                                <textarea name="media_update_2_desc" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" rows="2" placeholder="Brief description...">{{ $settings['media_update_2_desc'] ?? '' }}</textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 2 Icon Class (FontAwesome)</label>
                                <input type="text" name="media_update_2_icon" value="{{ $settings['media_update_2_icon'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. fas fa-hand-holding-heart">
                            </div>
                        </div>

                        <!-- Update 3 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-3xl">
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 3 Title</label>
                                <input type="text" name="media_update_3_title" value="{{ $settings['media_update_3_title'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. Workshop on Hygiene">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 3 Date</label>
                                <input type="text" name="media_update_3_date" value="{{ $settings['media_update_3_date'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. May 06, 2025">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 3 Description</label>
                                <textarea name="media_update_3_desc" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" rows="2" placeholder="Brief description...">{{ $settings['media_update_3_desc'] ?? '' }}</textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 3 Icon Class (FontAwesome)</label>
                                <input type="text" name="media_update_3_icon" value="{{ $settings['media_update_3_icon'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. fas fa-hands-wash">
                            </div>
                        </div>

                        <!-- Update 4 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-3xl">
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 4 Title</label>
                                <input type="text" name="media_update_4_title" value="{{ $settings['media_update_4_title'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. Food Distribution">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 4 Date</label>
                                <input type="text" name="media_update_4_date" value="{{ $settings['media_update_4_date'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. May 02, 2025">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 4 Description</label>
                                <textarea name="media_update_4_desc" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" rows="2" placeholder="Brief description...">{{ $settings['media_update_4_desc'] ?? '' }}</textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Update 4 Icon Class (FontAwesome)</label>
                                <input type="text" name="media_update_4_icon" value="{{ $settings['media_update_4_icon'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. fas fa-box-open">
                            </div>
                        </div>

                    </div>

                    <h4 class="text-sm font-bold text-gray-800 mb-4 border-b pb-2">Success Stories (Media Page)</h4>
                    <div class="space-y-8 mb-8">
                        
                        <!-- Story 1 -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-slate-50 p-6 rounded-3xl">
                            <div class="space-y-2 col-span-2">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Story 1 Category/Tag</label>
                                    <input type="text" name="media_story_1_tag" value="{{ $settings['media_story_1_tag'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. Education">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Story 1 Title</label>
                                    <input type="text" name="media_story_1_title" value="{{ $settings['media_story_1_title'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. From Village Student to Engineer">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Story 1 Description</label>
                                    <textarea name="media_story_1_desc" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" rows="3" placeholder="Brief description...">{{ $settings['media_story_1_desc'] ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Story 1 Link</label>
                                    <input type="text" name="media_story_1_link" value="{{ $settings['media_story_1_link'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="Link to full story">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Story 1 Image</label>
                                <div class="relative group h-full min-h-[120px]">
                                    <input type="file" name="media_story_1_image" @change="let reader = new FileReader(); reader.onload = (e) => { story1Preview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="h-full bg-white border-2 border-dashed border-slate-200 rounded-xl p-2 text-center flex flex-col items-center justify-center group-hover:border-cyan-500 transition-all">
                                        <template x-if="story1Preview"><img :src="story1Preview" class="h-24 w-full object-cover mb-2 rounded-lg"></template>
                                        <template x-if="!story1Preview"><i class="fas fa-image text-3xl text-slate-300 mb-2"></i></template>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="story1Preview ? 'Change' : 'Upload'"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Story 2 -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-slate-50 p-6 rounded-3xl">
                            <div class="space-y-2 col-span-2">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Story 2 Category/Tag</label>
                                    <input type="text" name="media_story_2_tag" value="{{ $settings['media_story_2_tag'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. Elderly Care">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Story 2 Title</label>
                                    <input type="text" name="media_story_2_title" value="{{ $settings['media_story_2_title'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. A New Life at Anath Ashram">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Story 2 Description</label>
                                    <textarea name="media_story_2_desc" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" rows="3" placeholder="Brief description...">{{ $settings['media_story_2_desc'] ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Story 2 Link</label>
                                    <input type="text" name="media_story_2_link" value="{{ $settings['media_story_2_link'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="Link to full story">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Story 2 Image</label>
                                <div class="relative group h-full min-h-[120px]">
                                    <input type="file" name="media_story_2_image" @change="let reader = new FileReader(); reader.onload = (e) => { story2Preview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="h-full bg-white border-2 border-dashed border-slate-200 rounded-xl p-2 text-center flex flex-col items-center justify-center group-hover:border-cyan-500 transition-all">
                                        <template x-if="story2Preview"><img :src="story2Preview" class="h-24 w-full object-cover mb-2 rounded-lg"></template>
                                        <template x-if="!story2Preview"><i class="fas fa-image text-3xl text-slate-300 mb-2"></i></template>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="story2Preview ? 'Change' : 'Upload'"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="text-sm font-bold text-gray-800 mb-4 border-b pb-2">Video Slots (Scrollable List)</h4>
                    <div class="space-y-8">
                        
                        <!-- Video 1 -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-slate-50 p-6 rounded-3xl">
                            <div class="space-y-2 col-span-2">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Video 1 Title</label>
                                    <input type="text" name="media_vid_1_title" value="{{ $settings['media_vid_1_title'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. Plantation Drive 2025">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Video 1 Link (YouTube)</label>
                                    <input type="text" name="media_vid_1_url" value="{{ $settings['media_vid_1_url'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="https://www.youtube.com/watch?v=...">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Video 1 Duration</label>
                                    <input type="text" name="media_vid_1_duration" value="{{ $settings['media_vid_1_duration'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. 05:20">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Video 1 Thumbnail</label>
                                <div class="relative group h-full min-h-[120px]">
                                    <input type="file" name="media_vid_1_thumb" @change="let reader = new FileReader(); reader.onload = (e) => { vid1Preview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="h-full bg-white border-2 border-dashed border-slate-200 rounded-xl p-2 text-center flex flex-col items-center justify-center group-hover:border-cyan-500 transition-all">
                                        <template x-if="vid1Preview"><img :src="vid1Preview" class="h-16 w-full object-cover mb-2 rounded-lg"></template>
                                        <template x-if="!vid1Preview"><i class="fas fa-video text-2xl text-slate-300 mb-2"></i></template>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="vid1Preview ? 'Change' : 'Upload'"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Video 2 -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-slate-50 p-6 rounded-3xl">
                            <div class="space-y-2 col-span-2">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Video 2 Title</label>
                                    <input type="text" name="media_vid_2_title" value="{{ $settings['media_vid_2_title'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. Health Camp Highlights">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Video 2 Link (YouTube)</label>
                                    <input type="text" name="media_vid_2_url" value="{{ $settings['media_vid_2_url'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="https://www.youtube.com/watch?v=...">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Video 2 Duration</label>
                                    <input type="text" name="media_vid_2_duration" value="{{ $settings['media_vid_2_duration'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20" placeholder="e.g. 04:35">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Video 2 Thumbnail</label>
                                <div class="relative group h-full min-h-[120px]">
                                    <input type="file" name="media_vid_2_thumb" @change="let reader = new FileReader(); reader.onload = (e) => { vid2Preview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="h-full bg-white border-2 border-dashed border-slate-200 rounded-xl p-2 text-center flex flex-col items-center justify-center group-hover:border-cyan-500 transition-all">
                                        <template x-if="vid2Preview"><img :src="vid2Preview" class="h-16 w-full object-cover mb-2 rounded-lg"></template>
                                        <template x-if="!vid2Preview"><i class="fas fa-video text-2xl text-slate-300 mb-2"></i></template>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="vid2Preview ? 'Change' : 'Upload'"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Video 3 -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-slate-50 p-6 rounded-3xl">
                            <div class="space-y-2 col-span-2">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Video 3 Title</label>
                                    <input type="text" name="media_vid_3_title" value="{{ $settings['media_vid_3_title'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Video 3 Link (YouTube)</label>
                                    <input type="text" name="media_vid_3_url" value="{{ $settings['media_vid_3_url'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Video 3 Duration</label>
                                    <input type="text" name="media_vid_3_duration" value="{{ $settings['media_vid_3_duration'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Video 3 Thumbnail</label>
                                <div class="relative group h-full min-h-[120px]">
                                    <input type="file" name="media_vid_3_thumb" @change="let reader = new FileReader(); reader.onload = (e) => { vid3Preview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="h-full bg-white border-2 border-dashed border-slate-200 rounded-xl p-2 text-center flex flex-col items-center justify-center group-hover:border-cyan-500 transition-all">
                                        <template x-if="vid3Preview"><img :src="vid3Preview" class="h-16 w-full object-cover mb-2 rounded-lg"></template>
                                        <template x-if="!vid3Preview"><i class="fas fa-video text-2xl text-slate-300 mb-2"></i></template>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="vid3Preview ? 'Change' : 'Upload'"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Video 4 -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-slate-50 p-6 rounded-3xl">
                            <div class="space-y-2 col-span-2">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Video 4 Title</label>
                                    <input type="text" name="media_vid_4_title" value="{{ $settings['media_vid_4_title'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Video 4 Link (YouTube)</label>
                                    <input type="text" name="media_vid_4_url" value="{{ $settings['media_vid_4_url'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Video 4 Duration</label>
                                    <input type="text" name="media_vid_4_duration" value="{{ $settings['media_vid_4_duration'] ?? '' }}" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500/20">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 text-center">Video 4 Thumbnail</label>
                                <div class="relative group h-full min-h-[120px]">
                                    <input type="file" name="media_vid_4_thumb" @change="let reader = new FileReader(); reader.onload = (e) => { vid4Preview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="h-full bg-white border-2 border-dashed border-slate-200 rounded-xl p-2 text-center flex flex-col items-center justify-center group-hover:border-cyan-500 transition-all">
                                        <template x-if="vid4Preview"><img :src="vid4Preview" class="h-16 w-full object-cover mb-2 rounded-lg"></template>
                                        <template x-if="!vid4Preview"><i class="fas fa-video text-2xl text-slate-300 mb-2"></i></template>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="vid4Preview ? 'Change' : 'Upload'"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Events Page Settings -->
                <div class="bg-white rounded-[2.5rem] p-10 border border-slate-200 shadow-sm" x-data="{
                    eventsHeroPreview: '{{ isset($settings['events_hero_image']) ? asset('storage/' . $settings['events_hero_image']) : '' }}',
                    eventsWorkshopPreview: '{{ isset($settings['events_workshop_image']) ? asset('storage/' . $settings['events_workshop_image']) : '' }}'
                }">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-1 rounded-full bg-green-600"></div>
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Events Page Settings</h3>
                    </div>
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Events Hero Image</label>
                            <div class="relative group">
                                <input type="file" name="events_hero_image" @change="let reader = new FileReader(); reader.onload = (e) => { eventsHeroPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-6 text-center group-hover:border-green-500 transition-all">
                                    <template x-if="eventsHeroPreview"><img :src="eventsHeroPreview" class="h-24 mx-auto mb-2 object-cover w-full rounded-xl"></template>
                                    <template x-if="!eventsHeroPreview"><i class="fas fa-image text-3xl text-slate-300 mb-2"></i></template>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="eventsHeroPreview ? 'Change Image' : 'Upload Hero Image'"></p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Workshops Section Image</label>
                            <div class="relative group">
                                <input type="file" name="events_workshop_image" @change="let reader = new FileReader(); reader.onload = (e) => { eventsWorkshopPreview = e.target.result }; reader.readAsDataURL($event.target.files[0])" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-6 text-center group-hover:border-green-500 transition-all">
                                    <template x-if="eventsWorkshopPreview"><img :src="eventsWorkshopPreview" class="h-24 mx-auto mb-2 object-cover w-full rounded-xl"></template>
                                    <template x-if="!eventsWorkshopPreview"><i class="fas fa-image text-3xl text-slate-300 mb-2"></i></template>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="eventsWorkshopPreview ? 'Change Image' : 'Upload Workshop Image'"></p>
                                </div>
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
