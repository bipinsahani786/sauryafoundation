<x-frontend.layout>
    <x-slot name="title">Join Syndicate | Shaurya Syndicate</x-slot>

    <div class="relative min-h-[85vh] flex items-center justify-center pt-24 pb-12 px-4 overflow-hidden">
        <!-- Background Blobs -->
        <div class="absolute top-1/4 -right-20 w-[300px] h-[300px] bg-purple-500 rounded-full mix-blend-multiply blur-[100px] opacity-10 animate-blob"></div>
        <div class="absolute bottom-1/4 -left-20 w-[300px] h-[300px] bg-brand-primary rounded-full mix-blend-multiply blur-[100px] opacity-10 animate-blob" style="animation-delay: 3s;"></div>

        <div class="max-w-md w-full relative z-10" data-aos="zoom-in" x-data="{ role: 'syndicate' }">
            <div class="glass-card p-8 rounded-[3rem] border-brand-accent/20 shadow-2xl">
                <div class="text-center mb-8">
                    <div class="w-12 h-12 bg-gradient-to-br from-brand-accent to-brand-primary rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg -rotate-3 text-white">
                        <i class="fas fa-user-plus text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-black text-white mb-1 tracking-tighter">Register</h2>
                    <p class="text-gray-500 font-bold uppercase tracking-[0.2em] text-[8px] mb-6">Select Your Terminal Access</p>

                    <div class="flex p-1 bg-brand-dark/80 rounded-2xl border border-brand-border/50 mb-2">
                        <button type="button" @click="role = 'syndicate'" :class="role === 'syndicate' ? 'bg-gradient-to-r from-brand-accent to-brand-primary text-white shadow-lg' : 'text-gray-500 hover:text-gray-300'" class="flex-1 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all duration-300">
                            Syndicate
                        </button>
                        <button type="button" @click="role = 'teacher'" :class="role === 'teacher' ? 'bg-gradient-to-r from-brand-accent to-brand-primary text-white shadow-lg' : 'text-gray-500 hover:text-gray-300'" class="flex-1 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all duration-300">
                            Teacher
                        </button>
                    </div>
                    <p class="text-[8px] text-brand-accent/60 font-medium italic tracking-tight" x-show="role === 'teacher'">* Direct access for coaching professionals.</p>
                    <p class="text-[8px] text-brand-accent/60 font-medium italic tracking-tight" x-show="role === 'syndicate'">* For investment & portfolio management.</p>
                </div>

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" :value="role">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-brand-accent uppercase tracking-[0.2em] ml-3">Legal Name</label>
                            <input type="text" name="name" placeholder="Johnathan Doe" class="w-full bg-brand-dark/50 border border-brand-border rounded-full px-5 py-3 text-white placeholder:text-gray-700 focus:border-brand-accent outline-none transition-all shadow-inner font-medium text-xs" required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-brand-accent uppercase tracking-[0.2em] ml-3">Email ID</label>
                            <input type="email" name="email" placeholder="john@example.com" class="w-full bg-brand-dark/50 border border-brand-border rounded-full px-5 py-3 text-white placeholder:text-gray-700 focus:border-brand-accent outline-none transition-all shadow-inner font-medium text-xs" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-brand-accent uppercase tracking-[0.2em] ml-3">Access Key</label>
                            <input type="password" name="password" placeholder="••••••••" class="w-full bg-brand-dark/50 border border-brand-border rounded-full px-5 py-3 text-white placeholder:text-gray-700 focus:border-brand-accent outline-none transition-all shadow-inner font-medium text-xs" required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-[9px] font-black text-brand-accent uppercase tracking-[0.2em] ml-3">Confirm Key</label>
                            <input type="password" name="password_confirmation" placeholder="••••••••" class="w-full bg-brand-dark/50 border border-brand-border rounded-full px-5 py-3 text-white placeholder:text-gray-700 focus:border-brand-accent outline-none transition-all shadow-inner font-medium text-xs" required>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-brand-accent to-emerald-600 text-white font-black py-4 rounded-full text-xs uppercase tracking-widest hover:scale-[1.02] active:scale-95 transition-all shadow-[0_10px_30px_rgba(16,185,129,0.3)]">
                            Confirm Registration <i class="fas fa-chevron-right ml-1"></i>
                        </button>
                    </div>

                    <div class="text-center pt-2">
                        <a href="{{ route('login') }}" class="text-[9px] font-bold text-gray-500 hover:text-white transition-colors uppercase tracking-widest">
                            Back to Terminal Login
                        </a>
                    </div>
                </form>
            </div>
            
            <p class="text-center mt-8 text-[8px] text-gray-700 font-medium px-12 italic">Secure verification required for all new syndicate members.</p>
        </div>
    </div>
</x-frontend.layout>
