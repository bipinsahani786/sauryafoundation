<!DOCTYPE html>
<html lang="en" class="scroll-smooth bg-[#030712]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? ($siteSettings['site_name'] ?? 'Shaurya Narayan Foundation') }}</title>
    @if(isset($siteSettings['site_favicon']))
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $siteSettings['site_favicon']) }}">
    @endif

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        brand: {
                            dark: '#030712', card: '#0f172a', primary: '#0ea5e9',
                            primaryGlow: 'rgba(14, 165, 233, 0.4)', accent: '#10b981', border: '#1e293b'
                        }
                    },
                    animation: { 'marquee': 'marquee 30s linear infinite', 'blob': 'blob 7s infinite' },
                    keyframes: {
                        marquee: { '0%': { transform: 'translateX(0%)' }, '100%': { transform: 'translateX(-100%)' } },
                        blob: { '0%, 100%': { transform: 'translate(0px, 0px) scale(1)' }, '50%': { transform: 'translate(20px, -20px) scale(1.05)' } }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .glass-nav {
            background: rgba(3, 7, 18, 0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(30, 41, 59, 0.5);
        }

        .glass-card {
            background: linear-gradient(145deg, rgba(15, 23, 42, 0.6) 0%, rgba(3, 7, 18, 0.8) 100%);
            backdrop-filter: blur(12px);
            border: 1px solid #1e293b;
        }

        .text-gradient {
            background: linear-gradient(to right, #0ea5e9, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .dropdown-menu {
            transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
        }

        .group:hover .dropdown-menu {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
    </style>
</head>

<body class="text-gray-300 font-sans antialiased overflow-x-hidden selection:bg-brand-primary selection:text-white"
    x-data="{ mobileMenuOpen: false, showJoinModal: false }" @keydown.escape="showJoinModal = false">

    <!-- Floating Action Buttons -->
    <div class="fixed bottom-6 right-6 z-[60] flex flex-col space-y-3">
        <button @click="showJoinModal = true"
            class="flex items-center justify-center w-14 h-14 bg-brand-primary text-white rounded-full shadow-[0_0_20px_rgba(14,165,233,0.5)] hover:scale-110 transition-transform group relative">
            <i class="fas fa-edit text-xl"></i>
            <span class="absolute right-full mr-4 px-3 py-1 bg-brand-card border border-brand-border rounded-lg text-[10px] font-black uppercase tracking-widest text-white opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">Join Syndicate</span>
        </button>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings['site_whatsapp'] ?? '911244567890') }}" target="_blank"
            class="flex items-center justify-center w-14 h-14 bg-[#25D366] text-white rounded-full shadow-[0_0_15px_rgba(37,211,102,0.4)] hover:scale-110 transition-transform"><i
                class="fab fa-whatsapp text-2xl"></i></a>
        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_phone'] ?? '+911244567890') }}"
            class="flex items-center justify-center w-14 h-14 bg-brand-card border border-brand-border text-white rounded-full shadow-[0_0_15px_rgba(30,41,59,0.4)] hover:scale-110 transition-transform"><i
                class="fas fa-phone-alt text-xl"></i></a>
    </div>

    <!-- Join Modal -->
    <div x-show="showJoinModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-brand-dark/90 backdrop-blur-sm"
        x-cloak>
        <div @click.away="showJoinModal = false" 
            class="glass-card w-full max-w-2xl rounded-[2rem] md:rounded-[3rem] p-6 md:p-12 relative max-h-[96vh] overflow-y-auto custom-scrollbar"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="scale-90 opacity-0"
            x-transition:enter-end="scale-100 opacity-100">
            
            <button @click="showJoinModal = false" class="absolute top-6 right-6 md:top-8 md:right-8 text-gray-500 hover:text-white transition-colors z-10">
                <i class="fas fa-times text-xl md:text-2xl"></i>
            </button>

            <div class="mb-8 md:mb-10 text-left pr-10 md:pr-0">
                <h3 class="text-xl md:text-3xl font-black text-white mb-2 leading-tight tracking-tight">Join {{ $siteSettings['site_name'] ?? 'Shaurya Narayan' }}</h3>
                <p class="text-gray-400 text-[10px] md:text-sm font-bold uppercase tracking-widest">Become a part of the mission</p>
            </div>

            <x-frontend.contact-form :sectors="$navSectors" />
        </div>
    </div>

    <nav class="glass-nav fixed w-full z-50 top-0 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2 cursor-pointer z-50">
                    @if(isset($siteSettings['site_logo']))
                        <img src="{{ asset('storage/' . $siteSettings['site_logo']) }}" alt="Logo" class="h-10 object-contain">
                    @else
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-primary to-brand-accent flex items-center justify-center shadow-lg">
                            <i class="fas fa-shield-alt text-white text-xl"></i>
                        </div>
                    @endif
                    <span class="text-2xl font-bold text-white tracking-tight">{{ $siteSettings['site_name'] ?? 'Shaurya Narayan Foundation' }}<span
                            class="text-brand-primary">.</span></span>
                </a>

                <div class="hidden lg:flex space-x-8 items-center">
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium hover:text-white transition-colors {{ request()->routeIs('home') ? 'text-white' : '' }}">Home</a>
                    <a href="{{ route('about') }}"
                        class="text-sm font-medium hover:text-white transition-colors {{ request()->routeIs('about') ? 'text-white' : '' }}">About
                        Us</a>

                    <div class="relative group py-6">
                        <button
                            class="text-sm font-medium hover:text-white transition-colors flex items-center gap-1 {{ request()->routeIs('sectors.*') ? 'text-white' : '' }}">
                            Sectors <i class="fas fa-chevron-down text-xs mt-0.5"></i>
                        </button>
                        <div
                            class="dropdown-menu absolute left-0 top-full mt-[-10px] w-64 glass-card rounded-xl shadow-2xl opacity-0 transform translate-y-2 pointer-events-none border border-brand-border overflow-hidden">
                            @foreach($navSectors as $navSector)
                                <a href="{{ route('sectors.detail', $navSector->slug) }}"
                                    class="block px-5 py-4 hover:bg-brand-card text-white border-b border-brand-border/50">
                                    <i class="{{ $navSector->icon ?? 'fas fa-chevron-right' }} text-brand-primary w-6 text-center mr-2"></i>
                                    {{ $navSector->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('process') }}"
                        class="text-sm font-medium hover:text-white transition-colors {{ request()->routeIs('process') ? 'text-white' : '' }}">Process</a>
                    <a href="{{ route('returns') }}"
                        class="text-sm font-medium hover:text-white transition-colors {{ request()->routeIs('returns') ? 'text-white' : '' }}">Returns</a>
                    <div class="h-6 w-px bg-brand-border"></div>
                    @auth
                        @php
                            $dashboardRoute = match(auth()->user()->role) {
                                'superadmin', 'admin' => route('admin.dashboard'),
                                'sales_agent' => route('sales-agent.dashboard'),
                                'teacher' => route('teacher.dashboard'),
                                'student' => route('student.dashboard'),
                                default => route('syndicate.dashboard'),
                            };
                        @endphp
                        <a href="{{ $dashboardRoute }}"
                            class="bg-brand-primary text-white px-8 py-2.5 rounded-full text-sm font-bold hover:bg-brand-primary/80 transition-all shadow-lg shadow-brand-primary/20 flex items-center gap-2">
                            <i class="fas fa-th-large"></i> Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-semibold text-white hover:text-brand-primary flex items-center gap-2 transition-colors"><i
                                class="far fa-user-circle text-lg"></i> Panel Login</a>
                        <button @click="showJoinModal = true"
                            class="bg-white text-brand-dark px-6 py-2.5 rounded-full text-sm font-bold hover:bg-gray-200 transition-all">Join</button>
                    @endauth
                </div>
                
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-2xl text-white">
                    <i :class="mobileMenuOpen ? 'fas fa-times' : 'fas fa-bars'"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="lg:hidden glass-nav border-t border-brand-border p-6 absolute top-full left-0 right-0 z-40 bg-brand-dark shadow-2xl">
            <div class="flex flex-col gap-6">
                <a href="{{ route('home') }}" class="text-lg font-bold text-white"
                    @click="mobileMenuOpen = false">Home</a>
                <a href="{{ route('about') }}" class="text-lg font-bold text-white"
                    @click="mobileMenuOpen = false">About Us</a>
                <div class="flex flex-col gap-4 pl-4 border-l-2 border-brand-primary/30">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sectors</p>
                    @foreach($navSectors as $navSector)
                        <a href="{{ route('sectors.detail', $navSector->slug) }}" @click="mobileMenuOpen = false"
                            class="text-gray-300 font-medium">{{ $navSector->title }}</a>
                    @endforeach
                </div>
                <a href="{{ route('process') }}" class="text-lg font-bold text-white"
                    @click="mobileMenuOpen = false">Process</a>
                <a href="{{ route('returns') }}" class="text-lg font-bold text-white"
                    @click="mobileMenuOpen = false">Returns</a>
                <div class="h-px bg-brand-border my-2"></div>
                @auth
                    <a href="{{ $dashboardRoute }}" class="w-full py-4 bg-brand-primary text-center text-white rounded-xl font-bold shadow-lg" @click="mobileMenuOpen = false">
                        <i class="fas fa-th-large mr-2"></i> Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-brand-primary font-bold"
                        @click="mobileMenuOpen = false">Member Login</a>
                    <button @click="showJoinModal = true; mobileMenuOpen = false"
                        class="w-full py-4 bg-brand-primary text-center text-white rounded-xl font-bold shadow-lg">Join</button>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        <!-- Success/Error Notifications -->
        <div class="fixed top-24 left-1/2 -translate-x-1/2 z-[60] w-full max-w-xl px-4 pointer-events-none">
            @if(session('success'))
                <div class="glass-card border-brand-accent/50 p-5 rounded-2xl flex items-center gap-4 text-brand-accent shadow-2xl pointer-events-auto mb-4 animate-fade-in"
                    x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    <i class="fas fa-check-circle text-2xl"></i>
                    <p class="font-bold text-sm">{{ session('success') }}</p>
                    <button @click="show = false" class="ml-auto text-gray-500 hover:text-white transition-colors"><i
                            class="fas fa-times"></i></button>
                </div>
            @endif

            @if($errors->any())
                <div class="glass-card border-red-500/50 p-5 rounded-2xl flex items-center gap-4 text-red-500 shadow-2xl pointer-events-auto"
                    x-data="{ show: true }" x-show="show">
                    <i class="fas fa-exclamation-circle text-2xl"></i>
                    <div class="text-sm">
                        <ul class="list-none p-0 m-0">
                            @foreach ($errors->all() as $error)
                                <li class="font-bold">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button @click="show = false" class="ml-auto text-gray-500 hover:text-white transition-colors"><i
                            class="fas fa-times"></i></button>
                </div>
            @endif
        </div>
        {{ $slot }}
    </main>
    
    <!-- Global Join Syndicate Section -->
    <section id="apply" class="py-20 md:py-32 bg-[#030712] border-t border-brand-border relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(circle_at_center,rgba(59,130,246,0.05)_0,transparent_70%)]"></div>
        
        <div class="max-w-6xl mx-auto px-4 relative z-10">
            <div class="grid lg:grid-cols-5 gap-12 lg:gap-16 items-start">
                
                <!-- Left Side: Process Info -->
                <div class="lg:col-span-2 space-y-12" data-aos="fade-right">
                    <div>
                        <h2 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tight">Become a Part <br>of the Mission.</h2>
                        <p class="text-gray-400 text-lg leading-relaxed">Join Shaurya Narayan Foundation as a member, volunteer, or syndicate partner to drive real-world impact through institutional assets.</p>
                    </div>

                    <div class="space-y-8">
                        <div class="flex gap-6">
                            <div class="w-12 h-12 rounded-2xl bg-brand-primary/10 border border-brand-primary/20 flex items-center justify-center text-brand-primary font-black shrink-0">1</div>
                            <div>
                                <h4 class="text-white font-bold mb-1">Submit Application</h4>
                                <p class="text-gray-500 text-sm">Tell us about your interests and preferred sector of contribution.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div class="w-12 h-12 rounded-2xl bg-brand-primary/10 border border-brand-primary/20 flex items-center justify-center text-brand-primary font-black shrink-0">2</div>
                            <div>
                                <h4 class="text-white font-bold mb-1">Verification Call</h4>
                                <p class="text-gray-500 text-sm">Our team will reach out to understand your goals and align them with our projects.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div class="w-12 h-12 rounded-2xl bg-brand-primary/10 border border-brand-primary/20 flex items-center justify-center text-brand-primary font-black shrink-0">3</div>
                            <div>
                                <h4 class="text-white font-bold mb-1">Access Dashboard</h4>
                                <p class="text-gray-500 text-sm">Get full access to the syndicate portal and start tracking social ROI.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: The Form -->
                <div class="lg:col-span-3" data-aos="fade-left">
                    <div class="glass-card rounded-[2.5rem] md:rounded-[3.rem] p-6 md:p-12 border border-brand-primary/10 shadow-2xl relative">
                        <x-frontend.contact-form :sectors="$navSectors" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#020617] border-t border-brand-border pt-24 pb-12 relative overflow-hidden">
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-brand-primary/5 rounded-full blur-[100px] -mr-64 -mt-64">
        </div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">
                <div class="col-span-1 lg:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        @if(isset($siteSettings['site_logo']))
                            <img src="{{ asset('storage/' . $siteSettings['site_logo']) }}" alt="Logo" class="h-10 object-contain">
                        @else
                            <div
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-primary to-brand-accent flex items-center justify-center shadow-lg">
                                <i class="fas fa-shield-alt text-white text-xl"></i>
                            </div>
                        @endif
                        <span class="text-2xl font-bold text-white tracking-tight">{{ $siteSettings['site_name'] ?? 'Shaurya Narayan' }}<span
                                class="text-brand-primary">.</span></span>
                    </div>
                    <p class="text-gray-400 mb-8 leading-relaxed">Pioneering the future of real-world asset tokenization
                        and fractional ownership in India. Building wealth through transparency and community scale.</p>
                    <div class="flex gap-4">
                        <a href="{{ $siteSettings['social_linkedin'] ?? '#' }}" target="_blank"
                            class="w-10 h-10 rounded-full bg-brand-card border border-brand-border flex items-center justify-center text-gray-400 hover:text-brand-primary hover:border-brand-primary transition-all"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a href="{{ $siteSettings['social_twitter'] ?? '#' }}" target="_blank"
                            class="w-10 h-10 rounded-full bg-brand-card border border-brand-border flex items-center justify-center text-gray-400 hover:text-brand-primary hover:border-brand-primary transition-all"><i
                                class="fab fa-twitter"></i></a>
                        <a href="{{ $siteSettings['social_instagram'] ?? '#' }}" target="_blank"
                            class="w-10 h-10 rounded-full bg-brand-card border border-brand-border flex items-center justify-center text-gray-400 hover:text-brand-primary hover:border-brand-primary transition-all"><i
                                class="fab fa-instagram"></i></a>
                        <a href="{{ $siteSettings['social_facebook'] ?? '#' }}" target="_blank"
                            class="w-10 h-10 rounded-full bg-brand-card border border-brand-border flex items-center justify-center text-gray-400 hover:text-brand-primary hover:border-brand-primary transition-all"><i
                                class="fab fa-facebook-f"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-8 uppercase text-xs tracking-[0.2em]">Quick Links</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('about') }}"
                                class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><i
                                    class="fas fa-chevron-right text-[10px] text-brand-primary"></i> About Our
                                Mission</a></li>
                        <li><a href="{{ route('process') }}"
                                class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><i
                                    class="fas fa-chevron-right text-[10px] text-brand-primary"></i> Investment
                                Process</a></li>
                        <li><a href="{{ route('returns') }}"
                                class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><i
                                    class="fas fa-chevron-right text-[10px] text-brand-primary"></i> ROI Projections</a>
                        </li>
                        <li><a href="{{ route('home') }}#apply"
                                class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><i
                                    class="fas fa-chevron-right text-[10px] text-brand-primary"></i> Join Syndicate</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-8 uppercase text-xs tracking-[0.2em]">Our Sectors</h4>
                    <ul class="space-y-4">
                        @foreach($navSectors as $navSector)
                            <li><a href="{{ route('sectors.detail', $navSector->slug) }}"
                                    class="text-gray-400 hover:text-white transition-colors flex items-center gap-2">
                                    <i class="{{ $navSector->icon ?? 'fas fa-chevron-right' }} text-xs text-brand-primary"></i>
                                    {{ $navSector->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-8 uppercase text-xs tracking-[0.2em]">Office Address</h4>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <i class="fas fa-map-marker-alt text-brand-primary mt-1"></i>
                            <p class="text-gray-400 text-sm leading-relaxed whitespace-pre-line">{{ $siteSettings['site_address'] ?? "Level 4, Shaurya Narayan Heights, Cyber City, Gurgaon, Haryana - 122002" }}</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="fas fa-phone-alt text-brand-primary"></i>
                            <p class="text-gray-400 text-sm">{{ $siteSettings['site_phone'] ?? '+91 124 456 7890' }}</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="fas fa-envelope text-brand-primary"></i>
                            <p class="text-gray-400 text-sm">{{ $siteSettings['site_email'] ?? 'invest@shaurya.in' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-brand-border flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'Shaurya Narayan Foundation' }}. All rights reserved.</p>
                <div class="flex gap-8">
                    <a href="{{ route('privacy') }}"
                        class="text-gray-500 hover:text-white text-xs transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms') }}"
                        class="text-gray-500 hover:text-white text-xs transition-colors">Terms of Use</a>
                    <a href="#" class="text-gray-500 hover:text-white text-xs transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ 
            duration: 800, 
            once: true, 
            offset: 50,
            disable: 'mobile' // Disable animations on mobile for better performance
        });

        // Global Banner Swiper Initialization
        document.addEventListener('DOMContentLoaded', function() {
            const swiperElements = document.querySelectorAll('.bannerSwiper');
            swiperElements.forEach((el) => {
                new Swiper(el, {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    parallax: true,
                    speed: 1000,
                    pagination: {
                        el: el.querySelector('.swiper-pagination') || '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: el.querySelector('.swiper-button-next') || '.swiper-button-next',
                        prevEl: el.querySelector('.swiper-button-prev') || '.swiper-button-prev',
                    },
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    }
                });
            });
        });
    </script>
    @stack('scripts')
</body>

</html>