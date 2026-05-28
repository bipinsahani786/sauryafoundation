<x-frontend.layout>
    @php
        $heroImage = isset($settings['involved_hero_image']) ? asset('storage/' . $settings['involved_hero_image']) : 'https://images.unsplash.com/photo-1593113580332-ceb4b882269a?q=80&w=2000&auto=format&fit=crop';
    @endphp

    <!-- Hero Section with Parallax -->
    <div class="relative h-[60vh] md:h-[70vh] w-full flex items-center justify-start overflow-hidden group">
        <!-- Parallax Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-transform duration-1000 group-hover:scale-105"
             style="background-image: url('{{ $heroImage }}'); background-attachment: fixed;">
        </div>
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#031533]/90 via-[#031533]/60 to-transparent"></div>
        
        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full mt-16 md:mt-24">
            <div class="max-w-xl" data-aos="fade-right">
                <h1 class="text-4xl md:text-5xl lg:text-7xl font-black text-white leading-tight mb-4 tracking-tight drop-shadow-xl">
                    Get Involved<br>
                    <span class="text-green-500">Be the Change</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-8 font-medium max-w-lg drop-shadow-md leading-relaxed">
                    Your time, skills and support can help create a better tomorrow for communities in need.
                </p>
            </div>
        </div>
    </div>

    <!-- Many Ways to Get Involved -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-black text-[#031533] mb-4">Many Ways to Get Involved</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Join us in our mission to empower, educate and elevate lives.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Volunteer -->
                <div class="bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all text-center group flex flex-col h-full" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-20 h-20 mx-auto bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-green-600 group-hover:text-white transition-all">
                        <i class="far fa-user text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Volunteer</h3>
                    <p class="text-sm text-gray-600 mb-8 flex-grow">Give your time and skills to make a real impact in our community programs.</p>
                    <a href="{{ route('involved.volunteer') }}" class="inline-block w-full py-3 px-6 border-2 border-green-600 text-green-600 font-bold rounded-full hover:bg-green-600 hover:text-white transition-colors text-sm uppercase tracking-widest">Join as Volunteer</a>
                </div>

                <!-- Internship -->
                <div class="bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all text-center group flex flex-col h-full" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-20 h-20 mx-auto bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-green-600 group-hover:text-white transition-all">
                        <i class="fas fa-graduation-cap text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Internship Opportunities</h3>
                    <p class="text-sm text-gray-600 mb-8 flex-grow">Learn, grow and gain valuable experience while serving the community.</p>
                    <a href="{{ route('involved.internship') }}" class="inline-block w-full py-3 px-6 border-2 border-green-600 text-green-600 font-bold rounded-full hover:bg-green-600 hover:text-white transition-colors text-sm uppercase tracking-widest">Apply for Internship</a>
                </div>

                <!-- Partner -->
                <div class="bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all text-center group flex flex-col h-full" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-20 h-20 mx-auto bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-green-600 group-hover:text-white transition-all">
                        <i class="far fa-handshake text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Become a Partner</h3>
                    <p class="text-sm text-gray-600 mb-8 flex-grow">Collaborate with us to create sustainable and long-term impact.</p>
                    <a href="{{ route('involved.partner') }}" class="inline-block w-full py-3 px-6 border-2 border-green-600 text-green-600 font-bold rounded-full hover:bg-green-600 hover:text-white transition-colors text-sm uppercase tracking-widest">Partner With Us</a>
                </div>


            </div>
        </div>
    </div>

    <!-- Volunteer With Us Section -->
    <div class="py-20 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <!-- Text Content -->
                <div class="w-full lg:w-1/2" data-aos="fade-right">
                    <h2 class="text-3xl md:text-4xl font-black text-[#031533] mb-4">Volunteer With Us</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed">Be a part of our team of changemakers and contribute towards meaningful causes.</p>
                    
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-start gap-3">
                            <i class="far fa-check-circle text-green-500 text-xl mt-0.5"></i>
                            <span class="text-gray-700 font-medium">Work on real ground projects</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="far fa-check-circle text-green-500 text-xl mt-0.5"></i>
                            <span class="text-gray-700 font-medium">Build leadership and soft skills</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="far fa-check-circle text-green-500 text-xl mt-0.5"></i>
                            <span class="text-gray-700 font-medium">Meet like-minded people</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="far fa-check-circle text-green-500 text-xl mt-0.5"></i>
                            <span class="text-gray-700 font-medium">Make a difference in communities</span>
                        </li>
                    </ul>
                    
                    <a href="{{ route('involved.volunteer') }}" class="inline-flex px-8 py-3 bg-green-600 text-white font-bold rounded-full hover:bg-green-700 transition-colors items-center gap-2">
                        Register as Volunteer <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </div>
                
                <!-- Image Content -->
                <div class="w-full lg:w-1/2" data-aos="fade-left">
                    <div class="relative group rounded-[2.5rem] overflow-hidden shadow-2xl">
                        <div class="absolute inset-0 bg-green-600/10 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                        <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?q=80&w=1200&auto=format&fit=crop" alt="Volunteers" class="w-full h-[500px] object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Internship Opportunities Section -->
    <div class="py-20 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row-reverse items-center gap-16">
                <!-- Text Content -->
                <div class="w-full lg:w-1/2" data-aos="fade-left">
                    <h2 class="text-3xl md:text-4xl font-black text-[#031533] mb-4">Internship Opportunities</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed">Our internship program offers hands-on experience in the development sector and helps you grow your skills.</p>
                    
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-start gap-3">
                            <i class="far fa-check-circle text-green-500 text-xl mt-0.5"></i>
                            <span class="text-gray-700 font-medium">Flexible duration</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="far fa-check-circle text-green-500 text-xl mt-0.5"></i>
                            <span class="text-gray-700 font-medium">Mentorship and guidance</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="far fa-check-circle text-green-500 text-xl mt-0.5"></i>
                            <span class="text-gray-700 font-medium">Certificate of completion</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="far fa-check-circle text-green-500 text-xl mt-0.5"></i>
                            <span class="text-gray-700 font-medium">Exposure to live projects</span>
                        </li>
                    </ul>
                    
                    <a href="{{ route('involved.internship') }}" class="inline-flex px-8 py-3 bg-green-600 text-white font-bold rounded-full hover:bg-green-700 transition-colors items-center gap-2">
                        Apply Now <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </div>
                
                <!-- Image Content -->
                <div class="w-full lg:w-1/2" data-aos="fade-right">
                    <div class="relative group rounded-[2.5rem] overflow-hidden shadow-2xl">
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1200&auto=format&fit=crop" alt="Interns" class="w-full h-[500px] object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Banner / Make a Difference Today -->
    <div class="pb-20 pt-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-blue-50 rounded-[3rem] overflow-hidden flex flex-col md:flex-row items-center relative" data-aos="zoom-in" data-aos-duration="800">
                
                <!-- Content Area -->
                <div class="w-full md:w-3/5 p-10 md:p-16 z-10">
                    <h2 class="text-3xl font-black text-[#031533] mb-3">Make a Difference Today</h2>
                    <p class="text-gray-600 mb-10">Every action counts. Join us and be a part of the change.</p>
                    
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                        <div>
                            <div class="text-3xl text-blue-500 mb-2"><i class="fas fa-users"></i></div>
                            <h4 class="text-2xl font-black text-[#031533] mb-1">500+</h4>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Volunteers</p>
                        </div>
                        <div>
                            <div class="text-3xl text-green-500 mb-2"><i class="fas fa-graduation-cap"></i></div>
                            <h4 class="text-2xl font-black text-[#031533] mb-1">120+</h4>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Interns</p>
                        </div>
                        <div>
                            <div class="text-3xl text-teal-500 mb-2"><i class="far fa-handshake"></i></div>
                            <h4 class="text-2xl font-black text-[#031533] mb-1">50+</h4>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Partners</p>
                        </div>
                        <div>
                            <div class="text-3xl text-red-400 mb-2"><i class="fas fa-hand-holding-heart"></i></div>
                            <h4 class="text-2xl font-black text-[#031533] mb-1">100+</h4>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Campaigns</p>
                        </div>
                    </div>
                </div>
                
                <!-- Image Area -->
                <div class="w-full md:w-2/5 h-64 md:h-auto absolute md:relative right-0 bottom-0 opacity-20 md:opacity-100 z-0">
                    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=800&auto=format&fit=crop" alt="Smiling Children" class="w-full h-full object-cover rounded-tl-[10rem] md:rounded-l-[10rem] rounded-br-[3rem]">
                </div>
            </div>
        </div>
    </div>

</x-frontend.layout>
