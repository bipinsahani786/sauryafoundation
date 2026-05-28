<x-frontend.layout>
    <x-slot name="title">Contact Us | Shaurya Narayan Foundation</x-slot>

    {{-- ─── HERO ─────────────────────────────────────────────── --}}
    <div class="relative min-h-[42vh] flex items-center overflow-hidden bg-[#031533]">
        <div class="absolute inset-0 bg-cover bg-center opacity-20"
             style="background-image: url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2000&auto=format&fit=crop')"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#031533] via-[#031533]/90 to-transparent"></div>

        {{-- floating blobs --}}
        <div class="absolute top-10 right-[15%] w-64 h-64 rounded-full bg-green-500/10 blur-[80px] animate-blob"></div>
        <div class="absolute bottom-0 right-[30%] w-48 h-48 rounded-full bg-blue-500/10 blur-[60px] animate-blob" style="animation-delay:3s"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-32 pb-16">
            <div class="max-w-xl" data-aos="fade-right">
                <div class="inline-flex items-center gap-2 bg-green-500/10 border border-green-500/30 text-green-400 text-xs font-black uppercase tracking-widest px-4 py-2 rounded-full mb-6">
                    <i class="fas fa-headset"></i> We'd Love to Hear From You
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-5 tracking-tight drop-shadow-xl">
                    Contact <span class="text-green-400">Us</span>
                </h1>
                <p class="text-gray-300 text-base md:text-lg leading-relaxed mb-8 max-w-md">
                    Have a question, suggestion, or just want to say hello? Reach out to us — we'll get back to you within 24 hours.
                </p>
                <nav class="flex items-center gap-2 text-sm" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors font-medium">Home</a>
                    <i class="fas fa-chevron-right text-gray-600 text-xs"></i>
                    <span class="text-green-400 font-bold">Contact</span>
                </nav>
            </div>
        </div>

        {{-- scroll indicator --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 text-gray-500 animate-bounce">
            <span class="text-[10px] font-bold uppercase tracking-widest">Scroll</span>
            <i class="fas fa-chevron-down text-xs"></i>
        </div>
    </div>

    {{-- ─── QUICK STATS STRIP ─────────────────────────────────── --}}
    <div class="bg-green-600 py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-white text-center">
                <div class="flex items-center justify-center gap-3">
                    <i class="fas fa-clock text-green-200 text-xl"></i>
                    <div class="text-left">
                        <div class="text-xs font-black uppercase tracking-widest text-green-100">Response Time</div>
                        <div class="text-sm font-bold">Within 24 Hours</div>
                    </div>
                </div>
                <div class="flex items-center justify-center gap-3">
                    <i class="fas fa-phone-alt text-green-200 text-xl"></i>
                    <div class="text-left">
                        <div class="text-xs font-black uppercase tracking-widest text-green-100">Phone Hours</div>
                        <div class="text-sm font-bold">Mon–Sat 9AM–6PM</div>
                    </div>
                </div>
                <div class="flex items-center justify-center gap-3">
                    <i class="fas fa-map-marker-alt text-green-200 text-xl"></i>
                    <div class="text-left">
                        <div class="text-xs font-black uppercase tracking-widest text-green-100">Location</div>
                        <div class="text-sm font-bold">Begusarai, Bihar</div>
                    </div>
                </div>
                <div class="flex items-center justify-center gap-3">
                    <i class="fas fa-envelope text-green-200 text-xl"></i>
                    <div class="text-left">
                        <div class="text-xs font-black uppercase tracking-widest text-green-100">Email Support</div>
                        <div class="text-sm font-bold">Always Available</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ─── MAIN CONTENT ──────────────────────────────────────── --}}
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 items-start">

                {{-- ── LEFT: Contact Info Cards ──────────────────────── --}}
                <div class="lg:col-span-2 space-y-5" data-aos="fade-right">

                    <div>
                        <h2 class="text-2xl font-black text-gray-900 mb-1">Get In Touch</h2>
                        <div class="w-10 h-1 bg-green-500 rounded-full mb-4"></div>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            We are committed to empowering communities. Reach out through any of the channels below or fill the form and we'll respond shortly.
                        </p>
                    </div>

                    {{-- Address --}}
                    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200 transition-all duration-300 flex items-start gap-4 group">
                        <div class="w-11 h-11 bg-green-50 group-hover:bg-green-500 text-green-600 group-hover:text-white rounded-xl flex items-center justify-center transition-all shrink-0">
                            <i class="fas fa-map-marker-alt text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-gray-900 text-sm mb-1">Our Address</h4>
                            <p class="text-gray-500 text-xs leading-relaxed">{{ $settings['site_address'] ?? 'Shaurya Narayan Foundation, Begusarai, Bihar - 851101, India' }}</p>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200 transition-all duration-300 flex items-start gap-4 group">
                        <div class="w-11 h-11 bg-green-50 group-hover:bg-green-500 text-green-600 group-hover:text-white rounded-xl flex items-center justify-center transition-all shrink-0">
                            <i class="fas fa-phone-alt text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-gray-900 text-sm mb-1">Phone Number</h4>
                            <a href="tel:{{ $settings['site_phone'] ?? '+919876543210' }}"
                               class="text-green-600 text-xs font-bold hover:underline">{{ $settings['site_phone'] ?? '+91 98765 43210' }}</a>
                            <p class="text-gray-400 text-[10px] mt-0.5">Mon–Sat, 9:00 AM – 6:00 PM</p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200 transition-all duration-300 flex items-start gap-4 group">
                        <div class="w-11 h-11 bg-green-50 group-hover:bg-green-500 text-green-600 group-hover:text-white rounded-xl flex items-center justify-center transition-all shrink-0">
                            <i class="fas fa-envelope text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-gray-900 text-sm mb-1">Email Address</h4>
                            <a href="mailto:{{ $settings['site_email'] ?? 'info@shauryanarayanfoundation.org' }}"
                               class="text-green-600 text-xs font-bold hover:underline">{{ $settings['site_email'] ?? 'info@shauryanarayanfoundation.org' }}</a>
                            <p class="text-gray-400 text-[10px] mt-0.5">We reply within 24 hours</p>
                        </div>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200 transition-all duration-300 flex items-start gap-4 group">
                        <div class="w-11 h-11 bg-green-50 group-hover:bg-[#25D366] text-green-600 group-hover:text-white rounded-xl flex items-center justify-center transition-all shrink-0">
                            <i class="fab fa-whatsapp text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-gray-900 text-sm mb-1">WhatsApp</h4>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['site_whatsapp'] ?? '919876543210') }}"
                               target="_blank"
                               class="text-green-600 text-xs font-bold hover:underline">Chat with us on WhatsApp</a>
                            <p class="text-gray-400 text-[10px] mt-0.5">Instant messaging support</p>
                        </div>
                    </div>

                    {{-- Social Media --}}
                    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                        <h4 class="font-black text-gray-900 text-sm mb-3">Follow Us</h4>
                        <div class="flex gap-3">
                            <a href="{{ $settings['social_facebook'] ?? '#' }}" target="_blank"
                               class="w-9 h-9 rounded-xl bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white flex items-center justify-center transition-all">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                            <a href="{{ $settings['social_instagram'] ?? '#' }}" target="_blank"
                               class="w-9 h-9 rounded-xl bg-pink-50 hover:bg-gradient-to-br hover:from-purple-500 hover:to-orange-400 text-pink-500 hover:text-white flex items-center justify-center transition-all">
                                <i class="fab fa-instagram text-sm"></i>
                            </a>
                            <a href="{{ $settings['social_linkedin'] ?? '#' }}" target="_blank"
                               class="w-9 h-9 rounded-xl bg-sky-50 hover:bg-sky-600 text-sky-600 hover:text-white flex items-center justify-center transition-all">
                                <i class="fab fa-linkedin-in text-sm"></i>
                            </a>
                            <a href="{{ $settings['social_twitter'] ?? '#' }}" target="_blank"
                               class="w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-900 text-slate-700 hover:text-white flex items-center justify-center transition-all">
                                <i class="fab fa-twitter text-sm"></i>
                            </a>
                            <a href="{{ $settings['social_youtube'] ?? '#' }}" target="_blank"
                               class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-600 text-red-600 hover:text-white flex items-center justify-center transition-all">
                                <i class="fab fa-youtube text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- ── RIGHT: Contact Form ──────────────────────────── --}}
                <div class="lg:col-span-3" data-aos="fade-left">
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-lg p-8 md:p-10">
                        <div class="mb-7">
                            <h2 class="text-2xl font-black text-gray-900 mb-1">Send a Message</h2>
                            <div class="w-10 h-1 bg-green-500 rounded-full"></div>
                            <p class="text-gray-500 text-sm mt-3">Fill in the form below and we'll get back to you as soon as possible.</p>
                        </div>

                        {{-- Success Message --}}
                        @if(session('contact_success'))
                            <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl mb-6"
                                 x-data="{ show: true }" x-show="show">
                                <i class="fas fa-check-circle text-xl mt-0.5 shrink-0"></i>
                                <div>
                                    <p class="font-black text-sm">Message Sent!</p>
                                    <p class="text-xs mt-0.5">{{ session('contact_success') }}</p>
                                </div>
                                <button @click="show = false" class="ml-auto text-emerald-400 hover:text-emerald-700 transition-colors">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif

                        {{-- Validation Errors --}}
                        @if($errors->any())
                            <div class="bg-rose-50 border border-rose-200 text-rose-700 px-5 py-4 rounded-2xl mb-6 text-sm">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-5" id="contactForm">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-2">
                                        Full Name <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" name="full_name" value="{{ old('full_name') }}" required
                                           placeholder="Your full name"
                                           class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50 text-sm font-medium text-gray-800 focus:outline-none focus:border-green-500 focus:bg-white transition-all placeholder-gray-400">
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-2">
                                        Email Address <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                           placeholder="your@email.com"
                                           class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50 text-sm font-medium text-gray-800 focus:outline-none focus:border-green-500 focus:bg-white transition-all placeholder-gray-400">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-2">Phone Number</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}"
                                           placeholder="+91 XXXXX XXXXX"
                                           class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50 text-sm font-medium text-gray-800 focus:outline-none focus:border-green-500 focus:bg-white transition-all placeholder-gray-400">
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-2">Subject</label>
                                    <input type="text" name="subject" value="{{ old('subject') }}"
                                           placeholder="What's this about?"
                                           class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50 text-sm font-medium text-gray-800 focus:outline-none focus:border-green-500 focus:bg-white transition-all placeholder-gray-400">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-2">
                                    Message <span class="text-rose-500">*</span>
                                </label>
                                <textarea name="message" rows="5" required
                                          placeholder="Type your message here..."
                                          class="w-full px-4 py-3.5 rounded-xl border border-gray-200 bg-gray-50 text-sm font-medium text-gray-800 focus:outline-none focus:border-green-500 focus:bg-white transition-all placeholder-gray-400 resize-none">{{ old('message') }}</textarea>
                                <p class="text-[10px] text-gray-400 mt-1.5">Minimum 10 characters required</p>
                            </div>

                            {{-- Honeypot anti-spam --}}
                            <div class="hidden" aria-hidden="true">
                                <input type="text" name="website" tabindex="-1" autocomplete="off">
                            </div>

                            <button type="submit" id="submitBtn"
                                    class="w-full py-4 bg-green-600 hover:bg-green-700 text-white font-black rounded-2xl transition-all duration-300 shadow-lg shadow-green-600/20 hover:shadow-xl hover:shadow-green-600/30 hover:-translate-y-0.5 flex items-center justify-center gap-3 text-sm">
                                <i class="fas fa-paper-plane"></i>
                                Send Message
                            </button>

                            <p class="text-center text-gray-400 text-[10px] font-bold uppercase tracking-widest">
                                <i class="fas fa-lock mr-1"></i> Your data is secure & never shared
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ─── GOOGLE MAP ─────────────────────────────────────────── --}}
    <div class="relative h-[380px] overflow-hidden" data-aos="fade-up">
        <div class="absolute inset-0 z-10 pointer-events-none bg-gradient-to-b from-gray-50/60 to-transparent h-20"></div>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57801.55695196585!2d86.0954628!3d25.4183958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f07adbc4c1069b%3A0x1c08ea9879c5be5f!2sBegusarai%2C%20Bihar!5e0!3m2!1sen!2sin!4v1700000000000"
            width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade" class="grayscale hover:grayscale-0 transition-all duration-700">
        </iframe>
        <div class="absolute inset-0 z-10 pointer-events-none bg-gradient-to-t from-gray-50/40 to-transparent h-20 bottom-0 top-auto"></div>
    </div>

    {{-- ─── NEWSLETTER BANNER ──────────────────────────────────── --}}
    <div class="py-16 bg-[#031533]" data-aos="fade-up">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-green-600/20 border border-green-600/40 rounded-2xl flex items-center justify-center shrink-0">
                        <i class="fas fa-envelope text-green-400 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-white">Stay Updated With Our Events</h3>
                        <p class="text-gray-400 text-sm">Subscribe to our newsletter and never miss an update.</p>
                    </div>
                </div>
                <form class="flex items-center gap-3 w-full md:w-auto">
                    @csrf
                    <input type="email" placeholder="Enter your email"
                           class="flex-1 md:w-72 px-5 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-green-500 transition-colors text-sm">
                    <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition-colors text-sm whitespace-nowrap">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(20px, -20px) scale(1.05); }
        }
        .animate-blob { animation: blob 7s infinite; }
    </style>

    @push('scripts')
    <script>
        // Submit button loading state
        document.getElementById('contactForm')?.addEventListener('submit', function () {
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            btn.disabled = true;
            btn.classList.add('opacity-80', 'cursor-not-allowed');
        });
    </script>
    @endpush

</x-frontend.layout>
