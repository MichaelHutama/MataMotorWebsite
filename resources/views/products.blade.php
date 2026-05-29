<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor - Products</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body, input, button, select, textarea {
      font-family: 'Didact Gothic', sans-serif !important;
    }
    .font-century {
      font-family: 'Century Gothic', sans-serif !important;
    }
  </style>
</head>
<body class="bg-white min-h-screen flex flex-col">

    @include('layouts.navbarcustomer')

    <!--HEADER-->
    <x-header 
        title="Spareparts" 
        image="images/backgroundproducts.jpg" 
    />

    <!-- Main Content Container matching the screenshot width and design -->
    <div class="max-w-[1400px] mx-auto w-full px-6 py-10 flex-grow">
      
      <!-- Top Search Bar Section (full width) -->
      <div class="w-full mb-6">
        <input type="text" placeholder="Search in Mata Motor"
          class="w-full px-4 py-3 border border-gray-300 rounded shadow-sm focus:ring-1 focus:ring-[#15395c] focus:border-[#15395c] focus:outline-none text-base">
      </div>

      <!-- Content Grid: Sidebar + Products Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 items-start">
        
        <!-- Sidebar Categories (Left 1-column) -->
        <aside class="bg-white rounded-lg border border-gray-300 shadow-sm overflow-hidden sticky top-24 h-fit">
          <div class="p-5">
            <h2 class="text-lg font-bold text-gray-700 font-century">Categories</h2>
          </div>
          <hr class="border-gray-300">
          <ul class="p-4 space-y-2 text-sm text-gray-600 font-century">
            <li>
              <a href="#" class="bg-gray-100 font-semibold text-gray-800 rounded px-4 py-2.5 block">
                All Spare Parts
              </a>
            </li>
            <li><a href="#" class="hover:bg-gray-50 rounded px-4 py-2.5 block transition-colors">Engine Parts</a></li>
            <li><a href="#" class="hover:bg-gray-50 rounded px-4 py-2.5 block transition-colors">Brake System</a></li>
            <li><a href="#" class="hover:bg-gray-50 rounded px-4 py-2.5 block transition-colors">Electrical Parts</a></li>
            <li><a href="#" class="hover:bg-gray-50 rounded px-4 py-2.5 block transition-colors">Suspension Parts</a></li>
            <li><a href="#" class="hover:bg-gray-50 rounded px-4 py-2.5 block transition-colors">Cooling System</a></li>
            <li><a href="#" class="hover:bg-gray-50 rounded px-4 py-2.5 block transition-colors">Fuel System</a></li>
            <li><a href="#" class="hover:bg-gray-50 rounded px-4 py-2.5 block transition-colors">Transmission System</a></li>
            <li><a href="#" class="hover:bg-gray-50 rounded px-4 py-2.5 block transition-colors">Wheel and Tire</a></li>
            <li><a href="#" class="hover:bg-gray-50 rounded px-4 py-2.5 block transition-colors">Body and Accessories</a></li>
            <li><a href="#" class="hover:bg-gray-50 rounded px-4 py-2.5 block transition-colors">Oil and Fluid</a></li>
            <li><a href="#" class="hover:bg-gray-50 rounded px-4 py-2.5 block transition-colors">Others</a></li>
          </ul>
        </aside>

        <!-- Products Grid Section (Right 4-columns) -->
        <main class="lg:col-span-4">
          
          @php
            $products = [
              [
                'name' => 'Filter Oli Mesin Toyota Avanza',
                'price' => 'IDR 45.000',
                'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=400'
              ],
              [
                'name' => 'Filter Oli Mesin Toyota Avanza',
                'price' => 'IDR 45.000',
                'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=400'
              ],
              [
                'name' => 'Filter Oli Mesin Toyota Avanza',
                'price' => 'IDR 45.000',
                'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=400'
              ],
              [
                'name' => 'Filter Oli Mesin Toyota Avanza',
                'price' => 'IDR 45.000',
                'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=400'
              ],
              [
                'name' => 'Filter Oli Mesin Toyota Avanza',
                'price' => 'IDR 45.000',
                'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=400'
              ],
              [
                'name' => 'Filter Oli Mesin Toyota Avanza',
                'price' => 'IDR 45.000',
                'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=400'
              ],
              [
                'name' => 'Filter Oli Mesin Toyota Avanza',
                'price' => 'IDR 45.000',
                'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=400'
              ],
              [
                'name' => 'Filter Oli Mesin Toyota Avanza',
                'price' => 'IDR 45.000',
                'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=400'
              ]
            ];
          @endphp

          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
              <!-- Product Card -->
              <a href="{{ route('productdetail') }}" class="bg-white rounded-xl shadow-[0_5px_15px_rgba(0,0,0,0.08)] border border-gray-200 overflow-hidden flex flex-col transition-all hover:shadow-[0_8px_25px_rgba(0,0,0,0.12)] hover:scale-[1.015] block">
                
                <!-- Image Container with soft gradient background -->
                <div class="relative bg-gradient-to-br from-[#f1fcf5] to-[#e8f7ec] h-48 flex items-center justify-center p-6">
                  <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="h-36 w-auto object-contain">
                  
                  <!-- Green bottom-right shopping bag icon -->
                  <div class="absolute bottom-0 right-0 w-8 h-8 bg-[#6da543] flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                  </div>
                </div>

                <!-- Dark Grey Divider Strip -->
                <div class="h-2 w-full bg-[#616161]"></div>

                <!-- Product Info Area -->
                <div class="p-4 flex flex-col flex-grow text-left font-century">
                  <h4 class="text-sm font-semibold text-gray-800 line-clamp-2 leading-snug font-century mb-1">
                    {{ $product['name'] }}
                  </h4>
                  <p class="text-2xl font-extrabold text-[#1e5eb8] tracking-tight">
                    {{ $product['price'] }}
                  </p>
                </div>

              </a>
            @endforeach
          </div>

          <!-- Pagination Section -->
          <div class="flex items-center justify-center space-x-2 mt-12 pb-6">
            <!-- Previous Button -->
            <a href="#" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-colors flex items-center gap-1 font-medium">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
              Prev
            </a>

            <!-- Page Numbers -->
            <a href="#" class="w-10 h-10 flex items-center justify-center bg-[#15395c] text-white rounded-lg font-bold shadow-sm">1</a>
            <a href="#" class="w-10 h-10 flex items-center justify-center border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg font-bold transition-colors">2</a>
            <a href="#" class="w-10 h-10 flex items-center justify-center border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg font-bold transition-colors">3</a>
            
            <span class="px-2 text-gray-400">...</span>
            
            <a href="#" class="w-10 h-10 flex items-center justify-center border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg font-bold transition-colors">10</a>

            <!-- Next Button -->
            <a href="#" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-colors flex items-center gap-1 font-medium">
              Next
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </div>

        </main>
      </div>

    </div>

    @include('layouts.footer')
</body>
</html>
