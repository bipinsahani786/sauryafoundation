<x-frontend.layout>
    <x-slot name="title">Become a Partner | Get Involved</x-slot>

    <!-- Header -->
    <div class="pt-32 pb-16 bg-teal-50">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-black text-gray-900 mb-4 tracking-tight">Become a Partner</h1>
            <p class="text-gray-600 text-lg">Collaborate with us to create sustainable and long-term impact.</p>
        </div>
    </div>

    <!-- Form Section -->
    <div class="py-16 bg-white">
        <div class="max-w-2xl mx-auto px-4">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 p-8 md:p-12">
                <form action="{{ route('involved.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="partner">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">First Name *</label>
                            <input type="text" name="first_name" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors" placeholder="John">
                            @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Last Name *</label>
                            <input type="text" name="last_name" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors" placeholder="Doe">
                            @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email Address *</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors" placeholder="john@example.com">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Phone Number *</label>
                        <input type="text" name="phone" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors" placeholder="+1 234 567 8900">
                        @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Partnership Proposal *</label>
                        <textarea name="message" rows="4" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors" placeholder="Tell us how you would like to collaborate..."></textarea>
                        @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-4 px-8 rounded-xl transition-colors text-lg">
                        Submit Proposal
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-frontend.layout>
