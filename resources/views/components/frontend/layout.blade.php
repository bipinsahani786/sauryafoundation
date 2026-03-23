<!DOCTYPE html>
<html lang="en" class="scroll-smooth bg-[#030712]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Shaurya Foundation | Premium Syndicate Investments' }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
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
        .glass-nav { background: rgba(3, 7, 18, 0.85); backdrop-filter: blur(16px); border-bottom: 1px solid rgba(30, 41, 59, 0.5); }
        .glass-card { background: linear-gradient(145deg, rgba(15, 23, 42, 0.6) 0%, rgba(3, 7, 18, 0.8) 100%); backdrop-filter: blur(12px); border: 1px solid #1e293b; }
        .text-gradient { background: linear-gradient(to right, #0ea5e9, #10b981); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .dropdown-menu { transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out; }
        .group:hover .dropdown-menu { opacity: 1; transform: translateY(0); pointer-events: auto; }
    </style>
</head>
<body class="text-gray-300 font-sans antialiased overflow-x-hidden selection:bg-brand-primary selection:text-white">

    <div class="fixed bottom-6 right-6 z-50 flex flex-col space-y-3">
        <a href="#" class="flex items-center justify-center w-14 h-14 bg-[#25D366] text-white rounded-full shadow-[0_0_15px_rgba(37,211,102,0.4)] hover:scale-110 transition-transform"><i class="fab fa-whatsapp text-2xl"></i></a>
        <a href="#" class="flex items-center justify-center w-14 h-14 bg-brand-primary text-white rounded-full shadow-[0_0_15px_rgba(14,165,233,0.4)] hover:scale-110 transition-transform"><i class="fas fa-phone-alt text-xl"></i></a>
    </div>

    <nav class="glass-nav fixed w-full z-50 top-0 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2 cursor-pointer z-50">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-primary to-brand-accent flex items-center justify-center shadow-lg"><i class="fas fa-shield-alt text-white text-xl"></i></div>
                    <span class="text-2xl font-bold text-white tracking-tight">Shaurya<span class="text-brand-primary">.</span></span>
                </a>
                
                <div class="hidden lg:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="text-sm font-medium hover:text-white transition-colors {{ request()->routeIs('home') ? 'text-white' : '' }}">Home</a>
                    <a href="{{ route('about') }}" class="text-sm font-medium hover:text-white transition-colors {{ request()->routeIs('about') ? 'text-white' : '' }}">About</a>
                    
                    <div class="relative group py-6">
                        <button class="text-sm font-medium hover:text-white transition-colors flex items-center gap-1 {{ request()->routeIs('sectors.*') ? 'text-white' : '' }}">
                            Sectors <i class="fas fa-chevron-down text-xs mt-0.5"></i>
                        </button>
                        <div class="dropdown-menu absolute left-0 top-full mt-[-10px] w-64 glass-card rounded-xl shadow-2xl opacity-0 transform translate-y-2 pointer-events-none border border-brand-border overflow-hidden">
                            <a href="{{ route('sectors.marriage-halls') }}" class="block px-5 py-4 hover:bg-brand-card text-white border-b border-brand-border/50"><i class="fas fa-hotel text-brand-primary w-6 text-center mr-2"></i> Marriage Halls</a>
                            <a href="{{ route('sectors.education') }}" class="block px-5 py-4 hover:bg-brand-card text-white border-b border-brand-border/50"><i class="fas fa-school text-brand-accent w-6 text-center mr-2"></i> Education / Schools</a>
                            <a href="{{ route('sectors.coaching') }}" class="block px-5 py-4 hover:bg-brand-card text-white"><i class="fas fa-laptop-code text-purple-500 w-6 text-center mr-2"></i> Digital Coaching</a>
                        </div>
                    </div>

                    <a href="{{ route('process') }}" class="text-sm font-medium hover:text-white transition-colors {{ request()->routeIs('process') ? 'text-white' : '' }}">Process</a>
                    <a href="{{ route('returns') }}" class="text-sm font-medium hover:text-white transition-colors {{ request()->routeIs('returns') ? 'text-white' : '' }}">Returns</a>
                    <div class="h-6 w-px bg-brand-border"></div>
                    <a href="#" class="text-sm font-semibold text-white hover:text-brand-primary flex items-center gap-2"><i class="far fa-user-circle text-lg"></i> Panel Login</a>
                    <a href="{{ route('home') }}#apply" class="bg-white text-brand-dark px-6 py-2.5 rounded-full text-sm font-bold hover:bg-gray-200">Join Syndicate</a>
                </div>
                <button class="lg:hidden text-2xl text-white"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-[#020617] border-t border-brand-border pt-24 pb-12 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-brand-primary/5 rounded-full blur-[100px] -mr-64 -mt-64"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">
                <div class="col-span-1 lg:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-primary to-brand-accent flex items-center justify-center shadow-lg"><i class="fas fa-shield-alt text-white text-xl"></i></div>
                        <span class="text-2xl font-bold text-white tracking-tight">Shaurya<span class="text-brand-primary">.</span></span>
                    </div>
                    <p class="text-gray-400 mb-8 leading-relaxed">Pioneering the future of real-world asset tokenization and fractional ownership in India. Building wealth through transparency and community scale.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-brand-card border border-brand-border flex items-center justify-center text-gray-400 hover:text-brand-primary hover:border-brand-primary transition-all"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-brand-card border border-brand-border flex items-center justify-center text-gray-400 hover:text-brand-primary hover:border-brand-primary transition-all"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-brand-card border border-brand-border flex items-center justify-center text-gray-400 hover:text-brand-primary hover:border-brand-primary transition-all"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-brand-card border border-brand-border flex items-center justify-center text-gray-400 hover:text-brand-primary hover:border-brand-primary transition-all"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-8 uppercase text-xs tracking-[0.2em]">Quick Links</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-primary"></i> About Our Mission</a></li>
                        <li><a href="{{ route('process') }}" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-primary"></i> Investment Process</a></li>
                        <li><a href="{{ route('returns') }}" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-primary"></i> ROI Projections</a></li>
                        <li><a href="{{ route('home') }}#apply" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-brand-primary"></i> Join Syndicate</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-8 uppercase text-xs tracking-[0.2em]">Our Sectors</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('sectors.marriage-halls') }}" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-hotel text-xs text-brand-primary"></i> Marriage Halls</a></li>
                        <li><a href="{{ route('sectors.education') }}" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-school text-xs text-brand-accent"></i> Education Infra</a></li>
                        <li><a href="{{ route('sectors.coaching') }}" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-laptop-code text-xs text-purple-500"></i> Digital Coaching</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-8 uppercase text-xs tracking-[0.2em]">Office Address</h4>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <i class="fas fa-map-marker-alt text-brand-primary mt-1"></i>
                            <p class="text-gray-400 text-sm leading-relaxed">Level 4, Shaurya Heights, <br>Cyber City, Gurgaon, <br>Haryana - 122002</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="fas fa-phone-alt text-brand-primary"></i>
                            <p class="text-gray-400 text-sm">+91 124 456 7890</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="fas fa-envelope text-brand-primary"></i>
                            <p class="text-gray-400 text-sm">invest@shaurya.in</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="pt-8 border-t border-brand-border flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-sm">&copy; 2026 Shaurya Foundation. All rights reserved.</p>
                <div class="flex gap-8">
                    <a href="{{ route('privacy') }}" class="text-gray-500 hover:text-white text-xs transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="text-gray-500 hover:text-white text-xs transition-colors">Terms of Use</a>
                    <a href="#" class="text-gray-500 hover:text-white text-xs transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true, offset: 50 });</script>
</body>
</html>
