@props(['sectors'])

<form action="{{ route('apply') }}" method="POST" class="space-y-6">
    @csrf
    
    <!-- Join As Selection -->
    <div class="space-y-4">
        <label class="block text-xs font-black text-indigo-600 uppercase tracking-[0.2em] ml-1">Join Us As</label>
        <div class="grid grid-cols-3 gap-2">
            <label class="has-[:checked]:bg-indigo-600 has-[:checked]:text-white has-[:checked]:border-indigo-600 transition-all cursor-pointer bg-white text-slate-600 border border-slate-200 p-2 md:p-4 rounded-xl md:rounded-2xl block text-center shadow-sm hover:border-indigo-200 hover:bg-slate-50">
                <input type="radio" name="type" value="Member" class="hidden" checked>
                <div class="font-bold text-[10px] md:text-xs uppercase tracking-widest">Member</div>
            </label>
            <label class="has-[:checked]:bg-indigo-600 has-[:checked]:text-white has-[:checked]:border-indigo-600 transition-all cursor-pointer bg-white text-slate-600 border border-slate-200 p-2 md:p-4 rounded-xl md:rounded-2xl block text-center shadow-sm hover:border-indigo-200 hover:bg-slate-50">
                <input type="radio" name="type" value="Volunteer" class="hidden">
                <div class="font-bold text-[10px] md:text-xs uppercase tracking-widest">Volunteer</div>
            </label>
            <label class="has-[:checked]:bg-indigo-600 has-[:checked]:text-white has-[:checked]:border-indigo-600 transition-all cursor-pointer bg-white text-slate-600 border border-slate-200 p-2 md:p-4 rounded-xl md:rounded-2xl block text-center shadow-sm hover:border-indigo-200 hover:bg-slate-50">
                <input type="radio" name="type" value="Syndicate" class="hidden">
                <div class="font-bold text-[10px] md:text-xs uppercase tracking-widest">Syndicate</div>
            </label>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="space-y-2">
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Full Name</label>
            <input type="text" name="name" placeholder="Rahul Sharma" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder:text-slate-400" required>
        </div>
        <div class="space-y-2">
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Contact Number</label>
            <input type="tel" name="phone" placeholder="+91 XXXX XXXX" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder:text-slate-400" required>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="space-y-2">
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Email Address</label>
            <input type="email" name="email" placeholder="rahul@example.com" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder:text-slate-400" required>
        </div>
        <div class="space-y-2">
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">City / Location</label>
            <input type="text" name="city" placeholder="New Delhi" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder:text-slate-400">
        </div>
    </div>

    <div class="space-y-2">
        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Primary Sector of Interest</label>
        <select name="sector" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all appearance-none" required>
            <option value="" disabled selected>Select a Sector</option>
            @foreach($sectors as $sector)
                <option value="{{ $sector->title }}">{{ $sector->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="pt-4">
        <button type="submit" class="w-full bg-indigo-600 text-white font-black uppercase tracking-[0.1em] py-5 rounded-2xl text-base hover:bg-indigo-700 hover:scale-[1.02] active:scale-95 transition-all shadow-lg shadow-indigo-200">
            Send Application <i class="fas fa-arrow-right ml-2 text-sm"></i>
        </button>
        <p class="text-center text-slate-400 text-[9px] mt-4 uppercase font-bold tracking-[0.2em]"><i class="fas fa-lock mr-1"></i> Secure Data Encryption Enabled</p>
    </div>
</form>
