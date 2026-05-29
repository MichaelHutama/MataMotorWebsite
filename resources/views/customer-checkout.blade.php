<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor - Checkout</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'mm-navy': '#15395c',
          },
          fontFamily: {
            'didact': ['"Didact Gothic"', 'sans-serif'],
            'inter': ['Inter', 'sans-serif'],
            'century': ['"Century Gothic"', 'AppleGothic', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <script src="{{ asset('js/app-utils.js') }}"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col font-didact text-gray-800">

  @include('layouts.navbarcustomer')

  @php
    $checkoutItems = [
        [
            'id' => 1,
            'name' => 'Filter Oli Mesin Toyota Avanza',
            'price' => 45000,
            'qty' => 2,
            'img' => 'images/backgroundaboutus.jpg'
        ]
    ];
    
    $subtotal = 0;
    foreach($checkoutItems as $item) {
        $subtotal += $item['price'] * $item['qty'];
    }
  @endphp

    <!-- HEADER -->
    <x-header 
        title="Check Out" 
        image="images/backgroundcheckout.jpg" 
    />

  <main class="max-w-7xl mx-auto py-10 px-4 md:px-8 grid grid-cols-1 lg:grid-cols-3 gap-10 flex-1 w-full items-start">
    
    <!-- LEFT SIDE: Items & Subtotal -->
    <div class="lg:col-span-2 space-y-8">
      <div>
        <h2 class="text-lg font-bold text-gray-900 font-inter uppercase tracking-widest mb-6 border-b border-gray-100 pb-4">Your Products</h2>
        
        <div class="space-y-4">
          @foreach($checkoutItems as $item)
          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6 flex items-center gap-6 transition-all hover:shadow-md">
            <div class="w-24 h-24 bg-gray-50 rounded-xl overflow-hidden shadow-inner border border-gray-100 flex-shrink-0">
              <img src="{{ asset($item['img']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
            </div>
            
            <div class="flex-1 flex flex-col md:flex-row md:items-center justify-between gap-4">
              <div class="space-y-1">
                <h4 class="font-bold text-gray-900 font-inter text-xl leading-tight">{{ $item['name'] }}</h4>
                <p class="font-xs text-gray-400 uppercase tracking-wider">Price: <span class="text-gray-900 font-bold">IDR {{ number_format($item['price'], 0, ',', '.') }}</span></p>
                <p class="font-xs text-orange-600 font-black tracking-tight">QTY: {{ $item['qty'] }}</p>
              </div>
              
              <div class="text-left md:text-right">
                <span class="text-2xl font-black text-mm-navy font-inter tracking-tight">
                  IDR {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                </span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <div class="flex justify-between items-center py-6 border-t border-gray-200">
        <span class="text-2xl font-bold text-gray-900 font-inter uppercase tracking-widest">Subtotal</span>
        <span class="text-3xl font-black text-gray-900 font-inter tracking-tighter text-right">IDR {{ number_format($subtotal, 0, ',', '.') }}</span>
      </div>
    </div>

    <!-- RIGHT SIDE: Checkout Form -->
    <div class="lg:col-span-1">
      <div class="lg:sticky lg:top-32 bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-8 h-fit">
        
        <!-- Fulfillment Form -->
        <div class="space-y-4">
          <h2 class="text-2xl font-bold text-gray-900 font-century tracking-widest border-b border-gray-50 pb-4 text-center mr-auto">Fulfillment Form</h2>
          
          <div class="space-y-4">
            <div class="space-y-2">
              <div class="flex justify-between items-center">
                <label class="text-sm  text-gray-800 tracking-widest font-didact">Recipient's Name</label>
                <button type="button" class="text-[10px] text-[#2159e7] uppercase font-didact hover:underline font-bold tracking-wider">Same with Profile</button>
              </div>
              <input type="text" placeholder="Enter full name" class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-mm-navy/10 font-inter text-sm text-gray-900 placeholder:text-gray-300 transition-all">
            </div>

            <div class="space-y-2">
              <label class="text-sm  text-gray-800 tracking-widest font-didact">Recipient's Phone</label>
              <input type="tel" placeholder="08xxxxxxxxxx" class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-mm-navy/10 font-inter text-sm text-gray-900 placeholder:text-gray-300 transition-all">
            </div>

            <div class="space-y-2">
              <label class="text-sm  text-gray-800 tracking-widest font-didact">Address</label>
              <textarea rows="3" placeholder="Enter complete address..." class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-mm-navy/10 font-inter text-sm text-gray-900 placeholder:text-gray-300 transition-all resize-none"></textarea>
            </div>

            <div class="space-y-2">
              <label class="text-sm  text-gray-800 tracking-widest font-didact">Notes (Optional)</label>
              <textarea rows="2" placeholder="Instructions/Notes..." class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-mm-navy/10 font-inter text-sm text-gray-900 placeholder:text-gray-300 transition-all resize-none"></textarea>
            </div>
          </div>
        </div>

        <!-- Fulfillment Method -->
        <div class="space-y-4 pt-4 border-t border-gray-50">
          <h2 class="text-sm  text-gray-800 tracking-widest font-didact">Fulfillment Method</h2>
          
          <div class="space-y-3">
            <label class="flex items-center gap-3 p-4 rounded-2xl bg-gray-50 border-2 border-transparent has-[:checked]:border-mm-navy has-[:checked]:bg-white transition-all cursor-pointer group">
              <input type="radio" name="fulfillment" value="pickup" class="w-4 h-4 text-mm-navy focus:ring-mm-navy border-gray-300">
              <div class="flex-1">
                <span class="block text-sm font-bold text-gray-900 font-inter uppercase">Pick-up Store</span>
                <span class="block text-[12px] text-gray-800 mt-1 leading-tight">Komplek Mutiara Taman Palem, Blok H2 No.6, Cengkareng Timur, Jakarta Barat
                </span>
              </div>
              <span class="text-xs font-bold text-green-600">FREE</span>
            </label>

            <div class="space-y-3">
              <label class="flex items-center gap-3 p-4 rounded-2xl bg-gray-50 border-2 border-transparent has-[:checked]:border-mm-navy has-[:checked]:bg-white transition-all cursor-pointer group">
                <input type="radio" name="fulfillment" value="delivery" checked class="w-4 h-4 text-mm-navy focus:ring-mm-navy border-gray-300">
                <div class="flex-1">
                  <span class="block text-sm font-bold text-gray-900 font-inter uppercase">Delivery</span>
                  <span class="block text-[12px] text-gray-800 mt-1 leading-tight">Choose courier below</span>
                </div>
              </label>

              <div id="courier-options" class="pl-4 space-y-3 border-l-2 border-gray-100/50 mt-2">
                <label class="flex items-center justify-between group cursor-pointer">
                  <div class="flex items-center gap-2">
                    <input type="radio" name="courier" value="20000" checked class="w-3 h-3 text-mm-navy focus:ring-mm-navy border-gray-300">
                    <span class="text-[12px] font-bold text-gray-500 group-has-[:checked]:text-mm-navy transition-colors font-inter uppercase">Instant</span>
                  </div>
                  <span class="text-[12px] font-bold text-gray-800">IDR 20.000</span>
                </label>
                <label class="flex items-center justify-between group cursor-pointer">
                  <div class="flex items-center gap-2">
                    <input type="radio" name="courier" value="15000" class="w-3 h-3 text-mm-navy focus:ring-mm-navy border-gray-300">
                    <span class="text-[12px] font-bold text-gray-500 group-has-[:checked]:text-mm-navy transition-colors font-inter uppercase">Same Day</span>
                  </div>
                  <span class="text-[12px] font-bold text-gray-800">IDR 15.000</span>
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="pt-6 border-t border-gray-100">
            <div class="flex flex-col gap-1">
                <span class="text-normal text-gray-400 uppercase tracking-[0.2em] font-bold">Total Payable</span>
                <span id="grand-total" class="text-3xl font-black font-inter text-[#15395c] tracking-tight">IDR {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="pt-4 flex justify-center">
            @include('components.action-button', [
                'id' => 'place-order-btn',
                'text' => 'CONTINUE',
                'type' => 'button',
                'onclick' => "window.location.href='".route('customer-payment')."'",
                'class' => 'w-full py-4 bg-mm-navy hover:bg-[#1c4974] text-white font-bold rounded-full shadow-lg shadow-blue-900/10 transition-all flex items-center justify-center gap-2 text-xs tracking-[0.2em] font-inter uppercase'
            ])
        </div>

      </div>
    </div>
  </main>

  @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutTotal = document.getElementById('checkout-total');
        const shippingDisplay = document.getElementById('shipping-cost-display');
        const courierOptions = document.getElementById('courier-options');
        const fulfillmentRadios = document.querySelectorAll('input[name="fulfillment"]');
        const courierRadios = document.querySelectorAll('input[name="courier"]');
        const subtotal = parseInt(checkoutTotal.dataset.subtotal);

        function updateTotal() {
            let shipping = 0;
            const selectedFulfillment = document.querySelector('input[name="fulfillment"]:checked').value;
            
            if (selectedFulfillment === 'delivery') {
                courierOptions.classList.remove('hidden');
                shipping = parseInt(document.querySelector('input[name="courier"]:checked').value);
                if (shippingDisplay) shippingDisplay.textContent = window.MataMotor.formatIDR(shipping);
            } else {
                courierOptions.classList.add('hidden');
                if (shippingDisplay) shippingDisplay.textContent = 'FREE';
            }

            const grandTotal = subtotal + shipping;
            checkoutTotal.textContent = window.MataMotor.formatIDR(grandTotal);
        }

        fulfillmentRadios.forEach(r => r.addEventListener('change', updateTotal));
        courierRadios.forEach(r => r.addEventListener('change', updateTotal));

        // Initial update
        updateTotal();

        // Place Order Logic
        document.getElementById('place-order-btn').addEventListener('click', function() {
            Swal.fire({
                title: '<span class="font-inter uppercase font-black text-mm-navy">Confirm Order?</span>',
                html: '<p class="font-didact text-gray-500">Please double check your shipping address and contact info before proceeding.</p>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'YES, PROCESS IT',
                cancelButtonText: 'NOT YET',
                buttonsStyling: false,
                customClass: {
                    popup: '!rounded-3xl !p-8',
                    confirmButton: 'bg-mm-navy text-white px-8 py-3 rounded-xl font-bold font-inter text-xs tracking-widest hover:bg-[#1c4974] transition-all mr-3',
                    cancelButton: 'bg-gray-100 text-gray-400 px-8 py-3 rounded-xl font-bold font-inter text-xs tracking-widest hover:bg-gray-200 transition-all'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'SUCCESS!',
                        text: 'Your order has been placed successfully.',
                        icon: 'success',
                        confirmButtonText: 'VIEW MY ORDERS'
                    });
                }
            });
        });
    });
  </script>
</body>
</html>