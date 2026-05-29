<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Motor</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Carlito:wght@400;700&display=swap" rel="stylesheet">
    
</head>

<body class="bg-[#e5e7eb] min-h-screen flex flex-col">

    @include('layouts.navbarcustomer')
    @include('layouts.modals')

    <!--HEADER-->
    <div 
        class="relative bg-gray-800 h-64 flex items-center justify-center bg-cover bg-center" 
        style="
            background-image:
                linear-gradient(
                    rgba(0, 0, 0, 0.6),
                    rgba(0, 0, 0, 0.6)
                ),
                url('{{ asset('images/backgroundhome.png') }}');
        "
    >
        <h1 style="font-family: 'Century Gothic', sans-serif;" class="text-white text-3xl md:text-5xl font-bold tracking-wide italic">
            Welcome to Mata Motor
        </h1>
    </div>


    <main class="max-w-6xl mx-auto px-4 mt-8 space-y-10" style="font-family: 'Albert Sans', sans-serif;">
        
        <!--CARD BOOKING-->
        <div>
            <h2 class="text-2xl font-bold text-[#1e5eb8] mb-4">Your Booking</h2>
            
            <div class="bg-white rounded-xl border border-gray-400 shadow-[0_5px_12px_rgba(0,0,0,0.15)] pt-10 pb-8 px-6 max-w-md mx-auto text-center flex flex-col items-center justify-center">
                
                <img src="{{ asset('images/Clock.png') }}" alt="Clock Icon" class="w-28 h-28 object-contain mb-5">
                
                <h3 class="text-3xl md:text-4xl font-bold text-black tracking-tight mb-2">
                    CUCI-22
                </h3>
                
                <p class="text-black text-sm md:text-base font-normal mb-5 tracking-wide">
                    <span class="font-bold">Waiting.</span> 2 queues left for your turn.
                </p>
                
                <button onclick="modalBookingDetails()" class="bg-[#0a4f96] hover:bg-[#073b70] text-white font-medium py-2.5 px-11 rounded-lg text-base tracking-wide transition-colors duration-200" style="font-family: 'Albert Sans', sans-serif;">
                    View Details
                </button>
                
            </div>
        </div>

        <hr>

        <!--CARD SPAREPARTS-->
        <div>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-[#1e5eb8]">Popular Spare Parts</h2>
                <a href="{{ route('products') }}" class="text-[#1e5eb8] font-bold text-base bg-transparent hover:underline">
                    See All Spareparts
                </a>
            </div>

            {{-- SIMULASI DATA DATABASE (DUMMY DATA) --}}
            @php
                $products = [
                    [
                        'name' => 'Filter Oli Mesin Toyota Avanza',
                        'price' => 45000,
                        'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=400'
                    ],
                    [
                        'name' => 'Kampas Rem Depan Honda Beat',
                        'price' => 65000,
                        'image' => 'https://images.unsplash.com/photo-1485965120184-e220f721d03e?q=80&w=400'
                    ],
                    [
                        'name' => 'Busi NGK Motor Yamaha',
                        'price' => 28000,
                        'image' => 'https://images.unsplash.com/photo-1622445262461-c3b8213226a6?q=80&w=400'
                    ],
                    [
                        'name' => 'Kampas Kopling Yamaha Vixion',
                        'price' => 95000,
                        'image' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?q=80&w=400'
                    ],
                ];
            @endphp

            {{-- Pengecekan Kondisi IF Sebelum Melakukan Loop Data Database --}}
            @if(isset($products) && count($products) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    {{-- Proses Loop Card Product --}}
                    @foreach($products as $product)
                        <a href="{{ route('productdetail') }}" class="bg-white rounded-xl shadow-[0_5px_15px_rgba(0,0,0,0.08)] border border-gray-200 overflow-hidden flex flex-col transition-all hover:shadow-[0_8px_25px_rgba(0,0,0,0.12)] hover:scale-[1.015] block">
                            <div class="relative bg-gradient-to-br from-[#f1fcf5] to-[#e8f7ec] h-48 flex items-center justify-center p-6">
                                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="h-36 w-auto object-contain">

                                <div class="absolute bottom-0 right-0 w-8 h-8 bg-[#6da543] flex items-center justify-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="h-2 w-full bg-[#616161]"></div>

                            <div class="p-4 flex flex-col flex-grow text-left font-century">
                                <h4 class="text-sm font-semibold text-gray-800 line-clamp-2 leading-snug font-century mb-1">
                                    {{ $product['name'] }}
                                </h4>
                                <p class="text-2xl font-extrabold text-[#1e5eb8] tracking-tight">
                                    IDR {{ number_format($product['price'], 0, ',', '.') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white p-8 rounded-lg shadow-sm text-center border border-gray-200 w-full">
                    <p class="text-gray-500 text-sm">Belum ada spare part populer saat ini.</p>
                </div>
            @endif
        </div>

        <hr class="border-gray-300">
        
    </main>



    @include('layouts.footer')
</body>
</html>