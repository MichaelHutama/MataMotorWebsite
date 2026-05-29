<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor - Shopping Cart</title>
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
<body class="bg-gray-50 min-h-screen flex flex-col font-didact">
    @include('layouts.navbarcustomer')
    @include('layouts.modals')

    <!-- HEADER -->
    <x-header 
        title="Shopping Cart" 
        image="images/backgroundcart.png" 
    />

  <!-- Main Layout -->
  <main class="max-w-7xl mx-auto py-10 px-4 md:px-8 grid grid-cols-1 lg:grid-cols-3 gap-10 flex-1 w-full">

    <!-- LEFT SIDE: Cart Items -->
    <div class="lg:col-span-2 space-y-6">
      <!-- Toolbar -->
      <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <input type="checkbox" id="selectAll" class="w-5 h-5 rounded border-gray-300 text-[#15395c] focus:ring-[#15395c] cursor-pointer">
          <label for="selectAll" class="font-bold text-gray-700 uppercase text-sm tracking-widest cursor-pointer">Select All Items</label>
        </div>
        <button onclick="confirmDelete('Item', 'Are you sure you want to clear your cart?')" class="text-red-500 hover:text-red-600 font-bold text-sm uppercase tracking-widest transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Delete all
        </button>
      </div>

      <!-- Items List -->
      <div class="space-y-4">
        @php
            $cartItems = [
                ['id' => 1, 'name' => 'Filter Oli Mesin Toyota Avanza', 'price' => 45000, 'qty' => 1, 'img' => 'images/backgroundaboutus.jpg', 'stock' => 10],
                ['id' => 2, 'name' => 'Busi Iridium Denso', 'price' => 95000, 'qty' => 4, 'img' => 'images/backgroundaboutus.jpg', 'stock' => 20],
                ['id' => 3, 'name' => 'Kampas Rem Depan Avanza', 'price' => 125000, 'qty' => 1, 'img' => 'images/backgroundaboutus.jpg', 'stock' => 5],
            ];
        @endphp

        @foreach($cartItems as $item)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6 flex flex-col md:flex-row items-center gap-6 transition-all hover:shadow-md">
          <div class="flex items-center gap-4 w-full md:w-auto">
            <input type="checkbox" class="w-5 h-5 rounded border-gray-300 text-[#15395c] focus:ring-[#15395c] cursor-pointer">
            <div class="w-24 h-24 bg-gray-50 rounded-xl overflow-hidden shadow-inner border border-gray-100 flex-shrink-0">
               <img src="{{ asset($item['img']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
            </div>
          </div>
          
          <div class="flex-1 flex flex-col md:flex-row justify-between w-full gap-4">
            <div class="space-y-1">
              <h4 class="font-bold text-gray-900 font-inter text-lg leading-tight">{{ $item['name'] }}</h4>
              <p class="text-[#15395c] font-black font-inter text-xl">IDR {{ number_format($item['price'],0,',','.') }}</p>
              <p class="text-sm text-gray-400 font-didact uppercase">Stock: <span class="font-bold">{{ $item['stock'] }} units</span></p>
            </div>

            <div class="flex items-center gap-6 self-end md:self-center">
                <!-- Quantity Control -->
                <div class="flex items-center bg-gray-50 p-1.5 rounded-xl border border-gray-100 h-10">
                    <button class="btn-minus w-8 h-8 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 hover:bg-gray-100 active:scale-90 transition-all">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></path></svg>
                    </button>
                    <input type="number" value="{{ $item['qty'] }}" min="1" max="{{ $item['stock'] }}" class="qty-input w-12 bg-transparent text-center font-bold text-gray-900 focus:outline-none font-inter [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                    <button class="btn-plus w-8 h-8 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 hover:bg-gray-100 active:scale-90 transition-all">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
                <button onclick="confirmDelete('Item', 'Remove this part from cart?')" class="text-gray-300 hover:text-red-500 transition-colors" id="delete-item-{{ $item['id'] }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- RIGHT SIDE: Summary Box -->
    <div class="lg:col-span-1">
      <div class="lg:top-32 bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-4 h-fit">
        <h3 class="text-base font-bold text-gray-900 font-inter uppercase tracking-widest border-b border-gray-50 pb-2">Shopping Summary</h3>
        
        <div class="space-y-3 font-inter">
            <div class="pt-4 border-t border-gray-100">
                <div class="flex flex-col gap-1">
                    <span class="text-xs text-gray-400 uppercase tracking-[0.2em] font-bold">Total Payable</span>
                    <span id="grand-total" class="text-3xl font-black text-[#15395c] tracking-tight">IDR 0</span>
                </div>
            </div>
        </div>

        <div class="space-y-3">
            @include('components.action-button', [
                    'id' => 'checkout-btn',
                    'text' => 'PROCEED TO CHECKOUT',
                    'type' => 'button',
                    'class' => 'w-full py-4 bg-[#15395c] hover:bg-[#1c4974] text-white font-bold rounded-full shadow-lg shadow-blue-900/10 transition-all flex items-center justify-center gap-2 text-xs tracking-[0.2em] font-inter',
                    'onclick' => "window.location.href='".route('customer-checkout')."'"
                ])
            
            @include('components.action-button', [
                    'id' => 'continue-btn',
                    'text' => 'CONTINUE SHOPPING',
                    'type' => 'button',
                    'class' => 'w-full py-4 bg-white border-2 border-[#15395c] text-[#15395c] font-bold rounded-full hover:bg-gray-50 transition-all text-xs tracking-[0.2em] font-inter',
                    'onclick' => "window.location.href='".route('products')."'"
                ])
        </div>
      </div>
    </div>

  </main>
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const itemCheckboxes = document.querySelectorAll('.qty-input').length > 0 ? document.querySelectorAll('input[type="checkbox"]:not(#selectAll)') : [];
            const grandTotalEl = document.getElementById('grand-total');
            const deleteButtons = document.querySelectorAll('[id^="delete-item-"]');

            function updateSummary() {
                let total = 0;
                let count = 0;
                
                document.querySelectorAll('input[type="checkbox"]:not(#selectAll):checked').forEach(checkbox => {
                    const container = checkbox.closest('.bg-white');
                    const priceText = container.querySelector('.font-black').textContent.replace(/[^\d]/g, '');
                    const qty = parseInt(container.querySelector('.qty-input').value);
                    total += parseInt(priceText) * qty;
                    count++;
                });

                grandTotalEl.textContent = window.MataMotor.formatIDR(total);
                
                // Toggle checkout button
                if (count > 0) {
                    checkoutBtn.style.opacity = '1';
                    checkoutBtn.style.pointerEvents = 'auto';
                } else {
                    checkoutBtn.style.opacity = '0.5';
                    checkoutBtn.style.pointerEvents = 'none';
                }
            }

            // Init Checkboxes
            if(selectAll) {
                selectAll.addEventListener('change', function() {
                    document.querySelectorAll('input[type="checkbox"]:not(#selectAll)').forEach(cb => {
                        cb.checked = selectAll.checked;
                    });
                    updateSummary();
                });
            }

            // Init Item Controls
            document.querySelectorAll('.bg-white.rounded-2xl.shadow-sm.border').forEach((container, index) => {
                const input = container.querySelector('.qty-input');
                const minusBtn = container.querySelector('.btn-minus');
                const plusBtn = container.querySelector('.btn-plus');
                const checkbox = container.querySelector('input[type="checkbox"]');

                if (!input || !minusBtn || !plusBtn) return;

                // Re-use logic for quantity
                minusBtn.addEventListener('click', () => {
                    let val = parseInt(input.value);
                    if (val > 1) {
                        input.value = val - 1;
                        updateSummary();
                    }
                });

                plusBtn.addEventListener('click', () => {
                    let val = parseInt(input.value);
                    let max = parseInt(input.max) || 999;
                    if (val < max) {
                        input.value = val + 1;
                        updateSummary();
                    }
                });

                input.addEventListener('change', () => {
                    let val = parseInt(input.value) || 1;
                    let max = parseInt(input.max) || 999;
                    input.value = Math.max(1, Math.min(max, val));
                    updateSummary();
                });

                checkbox.addEventListener('change', updateSummary);
            });

           
            updateSummary();
        });
    </script>
</body>
    @include('layouts.footer')
</body>
</html>
