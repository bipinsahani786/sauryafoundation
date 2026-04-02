@props(['sectors'])

<form action="{{ route('apply') }}" method="POST" class="space-y-6">
    @csrf
    
    <!-- Join As Selection -->
    <div class="space-y-4">
        <label class="block text-xs font-black text-brand-primary uppercase tracking-[0.2em] ml-1">Join Us As</label>
        <div class="grid grid-cols-3 gap-2">
            <label class="has-[:checked]:bg-brand-primary has-[:checked]:text-white transition-all cursor-pointer bg-brand-dark/50 border border-brand-border p-2 md:p-4 rounded-xl md:rounded-2xl block text-center">
                <input type="radio" name="type" value="Member" class="hidden" checked>
                <div class="font-bold text-[10px] md:text-xs uppercase tracking-widest">Member</div>
            </label>
            <label class="has-[:checked]:bg-brand-primary has-[:checked]:text-white transition-all cursor-pointer bg-brand-dark/50 border border-brand-border p-2 md:p-4 rounded-xl md:rounded-2xl block text-center">
                <input type="radio" name="type" value="Volunteer" class="hidden">
                <div class="font-bold text-[10px] md:text-xs uppercase tracking-widest">Volunteer</div>
            </label>
            <label class="has-[:checked]:bg-brand-primary has-[:checked]:text-white transition-all cursor-pointer bg-brand-dark/50 border border-brand-border p-2 md:p-4 rounded-xl md:rounded-2xl block text-center">
                <input type="radio" name="type" value="Syndicate" class="hidden">
                <div class="font-bold text-[10px] md:text-xs uppercase tracking-widest">Syndicate</div>
            </label>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="space-y-2">
            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Full Name</label>
            <input type="text" name="name" placeholder="Rahul Sharma" class="w-full bg-brand-dark/50 border border-brand-border rounded-2xl px-6 py-4 text-white focus:border-brand-primary outline-none transition-all" required>
        </div>
        <div class="space-y-2">
            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Contact Number</label>
            <input type="tel" name="phone" placeholder="+91 XXXX XXXX" class="w-full bg-brand-dark/50 border border-brand-border rounded-2xl px-6 py-4 text-white focus:border-brand-primary outline-none transition-all" required>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="space-y-2">
            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Email Address</label>
            <input type="email" name="email" placeholder="rahul@example.com" class="w-full bg-brand-dark/50 border border-brand-border rounded-2xl px-6 py-4 text-white focus:border-brand-primary outline-none transition-all" required>
        </div>
        <div class="space-y-2">
            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">City / Location</label>
            <input type="text" name="city" placeholder="New Delhi" class="w-full bg-brand-dark/50 border border-brand-border rounded-2xl px-6 py-4 text-white focus:border-brand-primary outline-none transition-all">
        </div>
    </div>

    <div class="space-y-2">
        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Primary Sector of Interest</label>
        <select name="sector" class="w-full bg-brand-dark/80 border border-brand-border rounded-2xl px-6 py-4 text-white focus:border-brand-primary outline-none transition-all appearance-none" required>
            <option value="" disabled selected>Select a Sector</option>
            @foreach($sectors as $sector)
                <option value="{{ $sector->title }}">{{ $sector->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="pt-4">
        <button type="submit" class="w-full bg-brand-primary text-white font-black py-5 rounded-2xl text-lg hover:scale-[1.02] active:scale-95 transition-all shadow-[0_20px_40px_rgba(37,99,235,0.2)]">
            Send Application <i class="fas fa-arrow-right ml-2 text-sm"></i>
        </button>
        <p class="text-center text-gray-600 text-[10px] mt-4 uppercase tracking-[0.2em]">Secure Data Encryption Enabled</p>
    </div>
</form>
