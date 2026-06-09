<div class="admit-card-container relative pb-10">

    <!-- Print Button (Only show if not bulk printing) -->
    @if(!isset($isBulkPrint) || !$isBulkPrint)
    <div class="absolute top-4 right-4 z-50 no-print">
        <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
            <i class="fas fa-print mr-2"></i> Print Admit Card
        </button>
    </div>
    @endif

    <div class="inner-border">
        
        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between mb-4">
            
            @if($admitCard->header_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($admitCard->header_image))
                <div class="w-full h-auto flex justify-center">
                    <img src="{{ asset('storage/' . $admitCard->header_image) }}" class="w-full object-contain" alt="Header">
                </div>
            @elseif(isset($siteSettings['admit_card_header']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($siteSettings['admit_card_header']))
                <div class="w-full h-auto flex justify-center">
                    <img src="{{ asset('storage/' . $siteSettings['admit_card_header']) }}" class="w-full object-contain" alt="Header">
                </div>
            @else
            <!-- Logo area (SVG approximation of the complex logo) -->
            <div class="w-48 h-48 flex-shrink-0 flex items-center justify-center relative">
                <svg viewBox="0 0 200 200" class="w-full h-full">
                    <!-- Outer Ring -->
                    <circle cx="100" cy="100" r="95" fill="none" stroke="#15793f" stroke-width="4"/>
                    <!-- Inner Ring -->
                    <circle cx="100" cy="100" r="88" fill="none" stroke="#0f305c" stroke-width="2" stroke-dasharray="2,2"/>
                    
                    <!-- Circular Text -->
                    <path id="text-path-top-{{ $admitCard->id }}" d="M 30,100 A 70,70 0 0,1 170,100" fill="none" />
                    <text font-family="Poppins" font-weight="bold" font-size="12" fill="#0f305c" letter-spacing="1">
                        <textPath href="#text-path-top-{{ $admitCard->id }}" startOffset="50%" text-anchor="middle">SHAURYA NARAYAN</textPath>
                    </text>
                    <path id="text-path-bottom-{{ $admitCard->id }}" d="M 165,110 A 65,65 0 0,1 35,110" fill="none" />
                    <text font-family="Poppins" font-weight="bold" font-size="12" fill="#0f305c" letter-spacing="2">
                        <textPath href="#text-path-bottom-{{ $admitCard->id }}" startOffset="50%" text-anchor="middle">FOUNDATION</textPath>
                    </text>

                    <!-- Center Elements -->
                    <!-- Sprout/Hands base -->
                    <path d="M 80,150 Q 100,160 120,150 Q 110,130 100,130 Q 90,130 80,150 Z" fill="#15793f"/>
                    <!-- Figures -->
                    <circle cx="100" cy="90" r="12" fill="#0f305c"/> <!-- Center Head -->
                    <path d="M 85,125 Q 100,100 115,125 L 120,140 L 80,140 Z" fill="#0f305c"/> <!-- Center Body -->
                    
                    <circle cx="70" cy="105" r="8" fill="#15793f"/> <!-- Left Head -->
                    <path d="M 60,135 Q 70,115 85,125 L 80,140 L 55,140 Z" fill="#15793f"/> <!-- Left Body -->
                    
                    <circle cx="130" cy="105" r="8" fill="#5b9bd5"/> <!-- Right Head (Light Blue) -->
                    <path d="M 140,135 Q 130,115 115,125 L 120,140 L 145,140 Z" fill="#5b9bd5"/> <!-- Right Body -->

                    <!-- Book Top -->
                    <path d="M 80,55 L 100,65 L 120,55 L 120,45 L 100,55 L 80,45 Z" fill="#0f305c"/>
                    <!-- Up Arrows -->
                    <path d="M 100,40 L 95,50 L 105,50 Z" fill="#15793f"/>
                    <path d="M 100,25 L 90,40 L 110,40 Z" fill="#15793f"/>
                    
                    <!-- Side Gears (Abstract) -->
                    <path d="M 25,90 L 35,90 L 35,110 L 25,110 Z" fill="#0f305c"/>
                    <path d="M 175,90 L 165,90 L 165,110 L 175,110 Z" fill="#0f305c"/>
                </svg>
            </div>

            <!-- Main Title -->
            <div class="flex-grow flex flex-col items-center justify-center text-center px-4 pt-4">
                <h1 class="color-dark-blue font-black text-4xl md:text-[2.7rem] leading-none tracking-tight">{{ explode(' ', $siteSettings['site_name'] ?? 'SHAURYA NARAYAN')[0] }} {{ explode(' ', $siteSettings['site_name'] ?? 'SHAURYA NARAYAN')[1] ?? '' }}</h1>
                <h2 class="color-primary-green font-black text-5xl md:text-[3.5rem] leading-tight tracking-wide">{{ explode(' ', $siteSettings['site_name'] ?? 'SHAURYA NARAYAN FOUNDATION')[2] ?? 'FOUNDATION' }}</h2>
                <p class="hindi-text font-bold text-gray-800 text-sm mt-1">
                    (कंपनी अधिनियम, 2013 के अंतर्गत पंजीकृत संस्था)
                </p>
            </div>

            <!-- Right Side Graphics -->
            <div class="flex flex-col items-end w-[320px] flex-shrink-0 relative h-[160px]">
                <!-- Two Men Placeholder (using SVG for reliable rendering without external links) -->
                <div class="absolute right-0 bottom-[-20px] w-48 h-36 z-0 flex items-end justify-end overflow-hidden">
                   <!-- Abstract suits/men silhouette -->
                   <svg viewBox="0 0 200 150" class="w-full h-full opacity-90">
                        <!-- Man 1 -->
                        <path d="M 50,150 L 50,80 Q 50,60 70,60 L 90,60 Q 110,60 110,80 L 110,150 Z" fill="#1e293b"/>
                        <polygon points="70,60 90,60 80,100" fill="#f8fafc"/> <!-- Shirt -->
                        <polygon points="78,70 82,70 80,110" fill="#0f305c"/> <!-- Tie -->
                        <circle cx="80" cy="45" r="20" fill="#fcd34d"/> <!-- Head -->
                        <path d="M 60,35 Q 80,20 100,35 Q 90,45 80,35 Z" fill="#1e293b"/> <!-- Hair -->
                        <path d="M 65,45 L 95,45" stroke="#1e293b" stroke-width="2"/> <!-- Glasses -->
                        
                        <!-- Man 2 (Bald) -->
                        <path d="M 110,150 L 110,70 Q 110,50 135,50 L 165,50 Q 190,50 190,70 L 190,150 Z" fill="#0f172a"/>
                        <polygon points="135,50 165,50 150,90" fill="#f8fafc"/> <!-- Shirt -->
                        <polygon points="148,60 152,60 150,100" fill="#0f305c"/> <!-- Tie -->
                        <circle cx="150" cy="35" r="22" fill="#fcd34d"/> <!-- Head -->
                        <path d="M 150,55 L 140,40 L 160,40 Z" fill="#0f305c"/> <!-- Beard tint -->
                   </svg>
                </div>

                <div class="flex flex-col items-end z-10 w-full space-y-2 mt-2">
                    <div class="banner-top text-center w-[85%] mr-12">
                        <span class="text-white font-bold text-sm tracking-wider uppercase block leading-tight">Exam</span>
                        <span class="text-white font-black text-[0.9rem] tracking-wider uppercase block leading-tight truncate px-2" title="{{ $admitCard->exam_name }}">{{ Str::limit($admitCard->exam_name, 25) }}</span>
                        <div class="bg-white text-dark-blue font-bold text-sm mx-auto mt-1 px-4 py-0.5 rounded-full inline-block border-2 border-[#0f305c]">
                            <span class="color-dark-blue">— {{ $admitCard->exam_date->format('Y') }} —</span>
                        </div>
                    </div>
                    <div class="banner-bottom text-center w-[95%] mr-4 mt-2 shadow-sm">
                        <span class="text-white font-black text-2xl tracking-widest uppercase">ADMIT CARD</span>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- INFO BAR -->
        <div class="grid grid-cols-4 border-y-2 border-[#94a3b8] py-2 mb-4 bg-white relative z-20">
            <!-- Item 1 -->
            <div class="flex items-center justify-center gap-3 border-r border-[#94a3b8]">
                <i class="fa-solid fa-calendar-days text-3xl color-primary-green"></i>
                <div class="flex flex-col">
                    <span class="color-dark-blue font-bold text-xs">EXAM DATE</span>
                    <span class="text-red-700 font-black text-sm">{{ strtoupper($admitCard->exam_date->format('d F Y')) }}</span>
                    <span class="color-dark-blue font-bold text-xs">({{ strtoupper($admitCard->exam_date->format('l')) }})</span>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="flex items-center justify-center gap-3 border-r border-[#94a3b8]">
                <i class="fa-regular fa-clock text-4xl color-dark-blue"></i>
                <div class="flex flex-col">
                    <span class="color-dark-blue font-bold text-xs">EXAM TIME</span>
                    <span class="text-red-700 font-black text-[0.95rem]">STARTS AT</span>
                    <span class="text-red-700 font-black text-[0.95rem]">{{ $admitCard->exam_date->format('h:i A') }}</span>
                </div>
            </div>
            <!-- Item 3 -->
            <div class="flex items-center justify-center gap-3 border-r border-[#94a3b8]">
                <i class="fa-regular fa-alarm-clock text-4xl color-orange"></i>
                <div class="flex flex-col">
                    <span class="color-dark-blue font-bold text-xs">LAST ENTRY</span>
                    <span class="text-red-700 font-black text-[1.1rem]">{{ $admitCard->exam_date->subMinutes(30)->format('h:i A') }}</span>
                </div>
            </div>
            <!-- Item 4 -->
            <div class="flex items-center justify-center gap-3">
                <div class="w-10 h-10 rounded-full border-2 border-primary-green flex items-center justify-center">
                    <i class="fa-solid fa-phone color-primary-green text-xl transform -rotate-90"></i>
                </div>
                <div class="flex flex-col">
                    <span class="color-primary-green font-bold text-[0.7rem]">HELPLINE NUMBER</span>
                    <span class="color-dark-blue font-black text-lg tracking-wide">{{ $siteSettings['site_phone'] ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT AREA -->
        <div class="grid grid-cols-[1.6fr_1fr] gap-4 items-stretch">
            
            <!-- LEFT COLUMN: STUDENT DETAILS -->
            <div class="border-[1.5px] border-[#94a3b8] rounded-xl relative pt-6 pb-4 px-4 flex gap-4 h-full mt-3">
                <!-- Title Badge -->
                <div class="absolute -top-4 left-20 bg-primary-green text-white px-8 py-1 rounded-full border-2 border-white font-bold text-sm uppercase shadow-sm">
                    Student Details
                </div>

                <!-- Form Fields -->
                <div class="flex-grow flex flex-col justify-between pt-2">
                    <!-- Row 1 -->
                    <div class="grid grid-cols-[30px_140px_10px_1fr] items-center text-[0.9rem] mb-2">
                        <i class="fa-solid fa-user text-[#0f305c] text-lg text-center"></i>
                        <span class="color-dark-blue font-bold">Student Name</span>
                        <span class="font-bold">:</span>
                        <div class="border-b-[1.5px] border-gray-400 h-5 w-full text-black font-bold">{{ strtoupper($admitCard->user->name) }}</div>
                    </div>
                    <!-- Row 2 -->
                    <div class="grid grid-cols-[30px_140px_10px_1fr] items-center text-[0.9rem] mb-2">
                        <i class="fa-solid fa-graduation-cap text-[#15793f] text-lg text-center"></i>
                        <span class="color-primary-green font-bold">Class</span>
                        <span class="font-bold">:</span>
                        <div class="border-b-[1.5px] border-gray-400 h-5 w-full text-black font-bold">{{ strtoupper($admitCard->student_class ?? 'N/A') }}</div>
                    </div>
                    <!-- Row 3 -->
                    <div class="grid grid-cols-[30px_140px_10px_1fr] items-center text-[0.9rem] mb-2">
                        <i class="fa-regular fa-id-card text-[#6b21a8] text-lg text-center"></i>
                        <span class="text-[#6b21a8] font-bold">Roll Number</span>
                        <span class="font-bold">:</span>
                        <div class="border-b-[1.5px] border-gray-400 h-5 w-full text-black font-bold tracking-widest">{{ $admitCard->roll_no }}</div>
                    </div>
                    <!-- Row 4 -->
                    <div class="grid grid-cols-[30px_140px_10px_1fr] items-center text-[0.9rem] mb-2">
                        <i class="fa-solid fa-user-tie text-[#a16207] text-lg text-center"></i>
                        <span class="text-[#a16207] font-bold">Father's Name</span>
                        <span class="font-bold">:</span>
                        <div class="border-b-[1.5px] border-gray-400 h-5 w-full text-black font-bold">{{ strtoupper($admitCard->user->father_name ?? 'N/A') }}</div>
                    </div>
                    <!-- Row 5 -->
                    <div class="grid grid-cols-[30px_140px_10px_1fr] items-center text-[0.9rem] mb-2">
                        <i class="fa-solid fa-school text-[#0f305c] text-lg text-center"></i>
                        <span class="color-dark-blue font-bold">School Name</span>
                        <span class="font-bold">:</span>
                        <div class="border-b-[1.5px] border-gray-400 h-5 w-full text-black font-bold truncate" title="{{ strtoupper($admitCard->user->school_name ?? 'N/A') }}">{{ strtoupper($admitCard->user->school_name ?? 'N/A') }}</div>
                    </div>
                    <!-- Row 6 -->
                    <div class="grid grid-cols-[30px_140px_10px_1fr] items-center text-[0.9rem]">
                        <i class="fa-solid fa-mobile-screen-button text-[#15793f] text-xl text-center"></i>
                        <span class="color-primary-green font-bold">Mobile Number</span>
                        <span class="font-bold">:</span>
                        <div class="border-b-[1.5px] border-gray-400 h-5 w-full text-black font-bold">{{ $admitCard->user->phone ?? 'N/A' }}</div>
                    </div>
                </div>

                <!-- Photo Box -->
                <div class="w-[140px] flex-shrink-0 flex flex-col justify-end mt-[-10px]">
                    <div class="photo-box bg-white rounded flex flex-col items-center pt-2 relative overflow-hidden h-[180px]">
                        @if($admitCard->user && $admitCard->user->profile_photo_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($admitCard->user->profile_photo_path))
                            <img src="{{ asset('storage/' . $admitCard->user->profile_photo_path) }}" class="w-full h-full object-cover pb-6">
                        @else
                            <!-- Silhouette -->
                            <svg viewBox="0 0 100 120" class="w-[85%] h-auto opacity-40 mt-4">
                                <path d="M 50,60 C 65,60 75,50 75,35 C 75,15 65,5 50,5 C 35,5 25,15 25,35 C 25,50 35,60 50,60 Z" fill="#64748b"/>
                                <path d="M 10,120 C 10,90 25,70 50,70 C 75,70 90,90 90,120 Z" fill="#64748b"/>
                            </svg>
                        @endif
                        <!-- Text overlay -->
                        <div class="bg-[#0f305c] text-white text-[0.7rem] font-bold text-center w-full py-1.5 absolute bottom-0 z-10">
                            PASSPORT SIZE<br>PHOTOGRAPH
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: CENTRE & INSTRUCTIONS -->
            <div class="flex flex-col gap-4 h-full mt-3">
                
                <!-- Examination Centre -->
                <div class="border-[1.5px] border-[#94a3b8] rounded-xl relative pt-6 pb-2 px-3 flex-1">
                     <div class="absolute -top-3.5 left-1/2 transform -translate-x-1/2 bg-primary-green text-white px-6 py-0.5 rounded-full border-2 border-white font-bold text-[0.7rem] uppercase shadow-sm whitespace-nowrap">
                        Examination Centre
                    </div>
                    
                    <div class="flex items-start gap-3 mt-1">
                        <!-- Icon -->
                        <div class="relative w-12 h-12 flex-shrink-0">
                            <i class="fa-solid fa-location-dot text-red-600 text-3xl absolute top-0 left-1/2 transform -translate-x-1/2 z-10 drop-shadow-md"></i>
                            <div class="w-10 h-8 bg-blue-100 border border-blue-300 absolute bottom-0 left-1/2 transform -translate-x-1/2 flex items-end justify-center rounded-sm">
                                <div class="w-full flex justify-between px-1 mb-1">
                                    <div class="w-1.5 h-1.5 bg-blue-800"></div>
                                    <div class="w-1.5 h-1.5 bg-blue-800"></div>
                                    <div class="w-1.5 h-1.5 bg-blue-800"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Text -->
                        <div class="flex flex-col text-center w-full pr-4">
                            <span class="color-dark-blue font-black text-sm uppercase tracking-wide truncate" title="{{ $admitCard->exam_center }}">{{ Str::limit($admitCard->exam_center, 30) }}</span>
                            <span class="text-black font-bold text-[0.7rem] leading-tight mt-0.5" style="white-space: pre-line;">
                                {{ $admitCard->exam_center }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Important Instructions -->
                <div class="border-[1.5px] border-[#94a3b8] rounded-xl relative pt-6 pb-2 px-3 bg-[#f8fafc] flex-[2]">
                    <div class="absolute -top-3.5 left-1/2 transform -translate-x-1/2 bg-dark-blue text-white px-6 py-0.5 rounded-full border-2 border-white font-bold text-[0.7rem] uppercase shadow-sm whitespace-nowrap">
                        Important Instructions
                    </div>

                    @if($admitCard->instructions)
                        <div class="text-[0.7rem] leading-snug font-bold text-gray-800 whitespace-pre-line px-2">{{ $admitCard->instructions }}</div>
                    @else
                        <ol class="custom-counter hindi-text font-bold">
                            <li>सभी विद्यार्थियों को परीक्षा केंद्र पर समय से पूर्व उपस्थित होना अनिवार्य है।</li>
                            <li><span class="font-black text-black poppins-font">{{ $admitCard->exam_date->subMinutes(30)->format('h:i A') }}</span> के बाद किसी भी परीक्षार्थी को प्रवेश नहीं दिया जाएगा।</li>
                            <li>परीक्षा का समय <span class="font-black text-black poppins-font">{{ $admitCard->exam_date->format('h:i A') }}</span> से प्रारंभ होगा।</li>
                            <li>सभी विद्यार्थियों को अपने साथ लाना अनिवार्य है -</li>
                        </ol>
                        
                        <!-- Requirement Icons Block -->
                        <div class="flex items-center justify-center gap-2 mt-1 mb-2 pl-6">
                            <!-- ID Box -->
                            <div class="flex items-center gap-1 border border-gray-300 bg-white rounded px-1 py-1">
                                <i class="fa-solid fa-address-card text-blue-500 text-xl"></i>
                                <div class="flex flex-col text-[0.55rem] font-bold leading-tight">
                                    <span class="hindi-text">पहचान पत्र</span>
                                    <span class="text-gray-600">(ID Proof)</span>
                                </div>
                            </div>
                            <span class="text-red-500 font-bold text-lg">+</span>
                            <!-- Photo Box -->
                            <div class="flex items-center gap-1 border border-gray-300 bg-white rounded px-1 py-1">
                                <i class="fa-solid fa-user text-green-600 text-xl"></i>
                                <div class="flex flex-col text-[0.55rem] font-bold leading-tight hindi-text">
                                    <span>एक पासपोर्ट</span>
                                    <span>साइज फोटो</span>
                                </div>
                            </div>
                            <span class="text-red-500 font-bold text-lg">+</span>
                            <!-- Admit Card Box -->
                            <div class="flex items-center gap-1 border border-gray-300 bg-white rounded px-1 py-1">
                                <i class="fa-regular fa-clipboard text-red-500 text-xl"></i>
                                <div class="flex flex-col text-[0.55rem] font-bold leading-tight hindi-text">
                                    <span class="mt-1">यह एडमिट कार्ड</span>
                                </div>
                            </div>
                        </div>

                        <ol class="custom-counter hindi-text font-bold" start="5">
                            <li style="counter-set: my-counter 4;">परीक्षा केंद्र में अनुशासन बनाए रखें।</li>
                        </ol>
                    @endif
                </div>
            </div>
        </div>

        <!-- FOOTER SECTION -->
        <div class="mt-8 flex justify-between items-end px-4">
            <!-- Left Sig -->
            <div class="flex flex-col gap-1 w-48">
                <div class="flex items-center gap-2 color-dark-blue font-bold text-[0.7rem]">
                    <i class="fa-solid fa-pen-nib text-sm"></i>
                    <span>Candidate Signature</span>
                </div>
                <div class="border-b-[1.5px] border-dotted border-[#0f305c] w-full"></div>
            </div>

            <!-- Center Slogan -->
            <div class="flex flex-col items-center text-center">
                <span class="color-primary-green font-bold text-[0.8rem] tracking-wide mb-1">{{ $siteSettings['site_name'] ?? 'SHAURYA NARAYAN FOUNDATION' }}</span>
                <div class="flex items-center gap-2 text-[#0f305c]">
                    <!-- Ornamental flourish -->
                    <svg width="30" height="10" viewBox="0 0 30 10">
                        <path d="M0,5 Q5,0 15,5 Q25,10 30,5" fill="none" stroke="currentColor" stroke-width="1"/>
                        <circle cx="15" cy="5" r="1.5" fill="currentColor"/>
                    </svg>
                    <span class="hindi-text font-bold text-sm tracking-wide">शिक्षा, संस्कार और समाज का समग्र विकास</span>
                    <svg width="30" height="10" viewBox="0 0 30 10">
                        <path d="M0,5 Q5,10 15,5 Q25,0 30,5" fill="none" stroke="currentColor" stroke-width="1"/>
                        <circle cx="15" cy="5" r="1.5" fill="currentColor"/>
                    </svg>
                </div>
            </div>

            <!-- Right Sig -->
            <div class="flex flex-col gap-1 w-48 items-end">
                <div class="flex items-center gap-2 color-dark-blue font-bold text-[0.7rem] w-full justify-start">
                    <i class="fa-solid fa-pen-nib text-sm transform -scale-x-100"></i>
                    <span>Authorized Signatory</span>
                </div>
                <div class="border-b-[1.5px] border-dotted border-[#0f305c] w-full"></div>
            </div>
        </div>
    </div>
    
    <!-- Cut Line -->
    <div class="absolute bottom-2 left-0 w-full flex items-center gap-2 px-4 no-print">
        <i class="fa-solid fa-scissors text-gray-700 text-lg"></i>
        <div class="w-full border-t-2 border-dashed border-gray-600"></div>
    </div>

</div>
