@php
$siteSettings = \App\Models\Setting::pluck('value', 'key')->toArray();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulk Print Admit Cards</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
            overflow-x: auto;
            text-align: center;
        }
        .main-wrapper {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            min-width: 100%;
        }
        .hindi-text {
            font-family: 'Noto Sans Devanagari', sans-serif;
        }
        /* Custom Colors based on image */
        .color-dark-blue { color: #0f305c; }
        .bg-dark-blue { background-color: #0f305c; }
        .color-primary-green { color: #15793f; }
        .bg-primary-green { background-color: #15793f; }
        .border-primary-green { border-color: #15793f; }
        .color-orange { color: #e67e22; }
        
        /* Dashed Box for Photo */
        .photo-box {
            border: 1px dashed #6b7280;
        }

        /* Ribbon Shapes using SVG backgrounds for precision */
        .banner-top {
            background-image: url("data:image/svg+xml,%3Csvg preserveAspectRatio='none' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolygon fill='%230f305c' points='10,0 100,0 100,100 0,100' /%3E%3C/svg%3E");
            background-size: 100% 100%;
            padding: 8px 20px 8px 30px;
        }
        .banner-bottom {
            background-image: url("data:image/svg+xml,%3Csvg preserveAspectRatio='none' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolygon fill='%230f305c' points='10,50 0,0 100,0 90,50 100,100 0,100' /%3E%3C/svg%3E");
            background-size: 100% 100%;
            padding: 6px 30px;
        }

        /* Numbered List Styling */
        ol.custom-counter {
            list-style: none;
            counter-reset: my-counter;
            padding-left: 0;
        }
        ol.custom-counter li {
            counter-increment: my-counter;
            position: relative;
            padding-left: 1.8rem;
            margin-bottom: 0.5rem;
            font-size: 0.7rem;
            line-height: 1.2;
            color: #1f2937;
        }
        ol.custom-counter li::before {
            content: counter(my-counter);
            position: absolute;
            left: 0;
            top: 0;
            width: 1.2rem;
            height: 1.2rem;
            background-color: #0f305c; /* Dark Blue */
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            font-weight: bold;
        }
        ol.custom-counter li:nth-child(2)::before,
        ol.custom-counter li:nth-child(5)::before {
            background-color: #15793f; /* Green for 2 and 5 */
        }
        ol.custom-counter li:nth-child(4)::before {
            background-color: #dc2626; /* Red for 4 */
        }
        ol.custom-counter li:nth-child(3)::before {
            background-color: #7e22ce; /* Purple for 3 */
        }

        .admit-card-container {
            width: 100%;
            min-width: 850px;
            max-width: 1050px;
            background-color: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-radius: 16px;
            overflow: hidden;
            border: 2px solid #94a3b8; /* Outer light border */
        }
        .inner-border {
            border: 2px solid #15793f; /* Inner green border */
            border-radius: 12px;
            margin: 10px;
            padding: 15px;
            position: relative;
        }

        .page-break-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
        }

        @media print {
            body, html {
                background-color: white;
                padding: 0;
                margin: 0;
                display: block !important;
            }
            .main-wrapper {
                display: block !important; /* Critical: Flexbox breaks page-break-after completely */
            }
            .admit-card-container {
                box-shadow: none;
                border: none;
                width: 100%;
                max-width: 100%;
                margin: 0;
            }
            .page-break-wrapper {
                margin-bottom: 0;
                display: block !important;
            }
            .no-print {
                display: none !important;
            }
        }
        .card-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
        }
        @media print {
            @page {
                size: A4 portrait;
                margin: 10mm; /* User requested 10mm margin to match physical reference */
            }
            body, html {
                margin: 0 !important;
                padding: 0 !important;
                display: block !important;
                background-color: white !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .main-wrapper {
                display: block !important; /* Critical to allow page breaks */
            }
            /* USER'S REQUESTED EXACT LAYOUT */
            .a4-page {
                width: 190mm !important;
                height: 277mm !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: space-between !important;
                margin: 0 auto !important;
                page-break-after: always !important;
                position: relative !important;
            }
            .card-wrapper {
                width: 100% !important;
                height: 48% !important;
                box-sizing: border-box !important;
                page-break-inside: avoid !important;
                display: flex !important;
                justify-content: center !important;
            }
            /* Bridge to prevent the fixed-pixel Tailwind card from overflowing the mm container */
            .card-scaler {
                width: 980px !important; /* Stretched horizontally */
                height: 720px !important;
                transform: scale(0.72) !important; /* Reverted to 0.72 as per physical print reference */
                transform-origin: top center !important;
            }
            .cut-line-print {
                position: absolute !important;
                top: 50% !important;
                left: 50% !important;
                transform: translate(-50%, -50%) !important;
                width: 80% !important;
                height: 10px !important;
            }
            .admit-card-container {
                min-width: 980px !important;
                width: 980px !important;
                max-width: 980px !important;
            }
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    <!-- Global Print Button -->
    <div class="fixed top-4 right-4 z-50 no-print">
        <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg flex items-center gap-2">
            <i class="fas fa-print"></i> Print All {{ count($admitCards) }} Cards
        </button>
    </div>

    <div class="min-w-[850px] print-wrapper-reset w-full print:block mt-8 print:mt-0">
        @php $chunks = $admitCards->chunk(2); @endphp
        
        @foreach($chunks as $chunk)
            <!-- 1 Physical A4 Page (2 Cards) -->
            <div class="a4-page">
                @foreach($chunk as $admitCard)
                    <div class="card-wrapper">
                        <div class="card-scaler">
                            @include('backend.admin.admit_cards._print_card', ['admitCard' => $admitCard, 'isBulkPrint' => true])
                        </div>
                    </div>
                @endforeach
                
                @if(count($chunk) > 1)
                    <!-- Cut Line between the 2 students on this page -->
                    <div class="cut-line-print flex items-center gap-2">
                        <i class="fa-solid fa-scissors text-gray-700 text-lg"></i>
                        <div class="w-full border-t-[3px] border-dashed border-gray-500"></div>
                        <span class="text-xs text-gray-400 font-bold uppercase tracking-widest whitespace-nowrap">Cut Here</span>
                    </div>
                @endif
            </div>
            
            @if(!$loop->last)
                <!-- 100% Bulletproof Hard Page Break -->
                <div style="page-break-after: always; break-after: page; display: block; height: 0;"></div>
            @endif
        @endforeach
    </div>

    @if(count($admitCards) === 0)
        <div class="flex flex-col items-center justify-center h-[50vh] text-slate-500">
            <i class="fas fa-id-card-alt text-6xl mb-4 text-slate-300"></i>
            <h2 class="text-2xl font-bold">No Admit Cards Found</h2>
            <p>There are no admit cards matching your current filter criteria to print.</p>
        </div>
    @endif

</div>
</body>
</html>
