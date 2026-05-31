<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor - Product Detail</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            'didact': ['"Didact Gothic"', 'sans-serif'],
            'inter': ['Inter', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <script src="{{ asset('js/app-utils.js') }}"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-didact">

  @if(request()->is('mechanic-*'))
      @include('layouts.navbarmechanic')
  @else
      @include('layouts.navbarcustomer')
  @endif
  @include('layouts.modals')

  @php
    $product = [
      'id' => 'SP-56',
      'name' => 'Filter Oli Mesin Toyota Avanza',
      'stock' => 2,
      'price' => 45000,
      'image' => 'images/backgroundaboutus.jpg',
      'description' => [
          'Filter oli mobil Toyota Avanza merupakan komponen penting dalam sistem pelumasan mesin yang berfungsi menyaring kotoran, partikel logam, dan residu pembakaran dari oli mesin.',
          'Dengan menggunakan filter oli yang berkualitas, performa mesin Toyota Avanza dapat tetap optimal, lebih halus, dan memiliki usia pakai yang lebih panjang.',
          'Filter oli ini dirancang khusus agar sesuai dengan spesifikasi mesin Toyota Avanza, sehingga mampu memberikan perlindungan maksimal terhadap komponen internal mesin.',
          ' ',
          '<strong>Features:</strong>',
          '• Kompatibel dengan Toyota Avanza (serta beberapa model sejenis).',
          '• Material berkualitas tahan panas dan tekanan.',
          '• Meningkatkan umur pakai mesin jika rutin diganti.',
          ' ',
          '<strong>Specs:</strong>',
          '• Material: Serat sintetis',
          '• Diameter: 60 mm'
      ]
    ];
  @endphp

  <main class="max-w-7xl mx-auto p-4 md:p-8">
    <div class="grid lg:grid-cols-3 gap-8 ">
      
      <!-- Left: Product Image & Info -->
      <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
          <div class="md:flex">
            <!-- Image Section -->
            <div class="md:w-1/2 bg-gray-50 flex items-center justify-center p-6 lg:p-10">
              <div class="aspect-square w-full rounded-xl overflow-hidden shadow-inner bg-white border border-gray-100">
                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
              </div>
            </div>
            
            <!-- Basic Info Section -->
            <div class="md:w-1/2 p-6 md:p-8 flex flex-col justify-center">
              <div class="space-y-4">
                <h1 class="text-3xl font-bold text-gray-900 leading-tight font-inter tracking-tight">{{ $product['name'] }}</h1>
                <div class="flex items-baseline gap-2">
                  <span class="text-4xl font-extrabold text-[#15395c] font-inter">IDR {{ number_format($product['price'],0,',','.') }}</span>
                </div>
                <div class="pt-6 border-t border-gray-100 grid grid-cols-2 gap-4 mt-4">
                  <div>
                    <p class="text-gray-400 font-bold uppercase text-xs tracking-widest mb-1">Product ID</p>
                    <p class="text-xl font-black text-black uppercase">{{ $product['id'] }}</p>
                  </div>
                  <div>
                    <p class="text-gray-400 font-bold uppercase text-xs tracking-widest mb-1">Stock Available</p>
                    <p class="text-xl font-black text-black">{{ $product['stock'] }} units</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Description Box -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
          <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2 uppercase tracking-wider border-b border-gray-50 pb-4">
            <svg class="w-5 h-5 text-[#15395c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
            Description
          </h2>
          <div class="max-w-none text-gray-600 space-y-4 leading-relaxed text-[15px]">
            @foreach($product['description'] as $line)
              <p>{!! $line !!}</p>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Right: Purchase Sidebar -->
      <div class="lg:col-span-1">
        <div class="sticky top-8 space-y-6">
          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
            @if(request()->is('mechanic-*'))
                <div class="text-center py-6">
                    <div class="mb-4 flex justify-center">
                        <div class="p-3 bg-blue-50 rounded-full text-mm-navy">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 font-inter uppercase tracking-widest leading-tight">Staff View Only</h3>
                    <p class="text-xs text-gray-500 font-medium leading-relaxed px-2">Buying products is restricted to customers. Staff can view stock and pricing for reference.</p>
                </div>
            @else
            <h3 class="text-base font-bold text-gray-900 mb-6 font-inter uppercase tracking-widest border-b border-gray-50 pb-4">Order Summary</h3>
            
            <div class="space-y-6">
              <!-- Quantity Control -->
              <div class="space-y-3">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] font-inter">Quantity</label>
                <div class="flex items-center justify-between bg-gray-50 p-1.5 rounded-xl border border-gray-100">
                  <button id="btn-minus" type="button" class="w-10 h-10 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 hover:bg-gray-100 active:scale-90 transition-all cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></path></svg>
                  </button>
                  <input id="qty" type="number" value="1" min="1" max="{{ $product['stock'] }}" class="w-16 bg-transparent text-center font-bold text-gray-900 focus:outline-none font-inter text-lg [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                  <button id="btn-plus" type="button" class="w-10 h-10 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 hover:bg-gray-100 active:scale-90 transition-all cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                  </button>
                </div>
              </div>

              <!-- Price Summary -->
              <div class="pt-6 border-t border-gray-100 space-y-4">
                <div class="flex justify-between items-center text-xs uppercase tracking-widest font-medium text-gray-400 font-inter">
                  <span>Unit Price</span>
                  <span>IDR {{ number_format($product['price'],0,',','.') }}</span>
                </div>
                <div class="flex justify-between items-center bg-[#15395c]/5 p-4 rounded-xl border border-[#15395c]/10">
                  <span class="font-bold text-[#15395c] uppercase text-xs tracking-widest font-inter">Total Payable</span>
                  <span id="total-price" class="text-2xl font-black text-[#15395c] font-inter tracking-tight">IDR {{ number_format($product['price'],0,',','.') }}</span>
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="space-y-3 pt-2">
                @include('components.action-button', [
                    'id' => 'add-to-cart',
                    'text' => 'ADD TO CART',
                    'type' => 'button',
                    'class' => 'w-full py-4 bg-[#15395c] hover:bg-[#1c4974] text-white font-bold rounded-full shadow-lg shadow-blue-900/10 transition-all flex items-center justify-center gap-2 text-xs tracking-[0.2em] font-inter'
                ])
                
                @include('components.action-button', [
                    'id' => 'buy-now',
                    'text' => 'BUY NOW',
                    'type' => 'button',
                    'class' => 'w-full py-4 bg-white border-2 border-[#15395c] text-[#15395c] font-bold rounded-full hover:bg-gray-50 transition-all text-xs tracking-[0.2em] font-inter'
                ])
              </div>
            </div>
            @endif

            
          </div>
        </div>
      </div>
    </div>
  </main>


    @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const basePrice = {{ $product['price'] }};
      const maxStock = {{ $product['stock'] }}; 
      const qtyInput = document.getElementById('qty');
      const totalPriceEl = document.getElementById('total-price');
      const addBtn = document.getElementById('add-to-cart');
      const buyBtn = document.getElementById('buy-now');

      if (qtyInput && totalPriceEl && addBtn && buyBtn) {
          // Fungsi pembantu untuk memunculkan Toast Peringatan
          function showStockWarning() {
              Swal.fire({
                  toast: true,
                  position: 'top-end',
                  icon: 'warning',
                  title: 'Kuantitas disesuaikan dengan stok tersedia',
                  showConfirmButton: false,
                  timer: 2000
              });
          }

          // Initialize global quantity control
          window.MataMotor.initQuantityControl('qty', 'btn-minus', 'btn-plus', function(newQty) {
              // Biarkan fungsi eksternal mengupdate harga secara normal
              const total = basePrice * newQty;
              totalPriceEl.textContent = window.MataMotor.formatIDR(total);
          });

          // SOLUSI: Pasang listener 'click' langsung pada tombol plus untuk mengecek kondisi SEBELUM/SAAT diklik
          document.getElementById('btn-plus').addEventListener('click', function() {
              // Jika nilai input sebelum/saat diklik sudah mencapai batas maksimal stok
              if (parseInt(qtyInput.value) >= maxStock) {
                  showStockWarning();
              }
          });

          // Pengaman ekstra saat user mengetik manual lewat keyboard (di luar kontrol tombol +/-)
          qtyInput.addEventListener('input', function() {
              let val = parseInt(qtyInput.value) || 1;
              if (val > maxStock) {
                  qtyInput.value = maxStock;
                  const total = basePrice * maxStock;
                  totalPriceEl.textContent = window.MataMotor.formatIDR(total);
                  showStockWarning();
              }
          });

          qtyInput.addEventListener('blur', function() {
              let val = parseInt(qtyInput.value) || 1;
              if (val > maxStock) {
                  qtyInput.value = maxStock;
                  const total = basePrice * maxStock;
                  totalPriceEl.textContent = window.MataMotor.formatIDR(total);
                  showStockWarning();
              }
          });

          // Actions
          addBtn.addEventListener('click', function() {
              const qty = qtyInput.value;
              showSuccessModal('You have added ' + qty + ' units to your cart.');
          });

          buyBtn.addEventListener('click', function() {
              window.location.href = "{{ route('customer-checkout') }}?id={{ $product['id'] }}&qty=" + qtyInput.value;
          });
      }
    });
  </script>
</body>
</html>
