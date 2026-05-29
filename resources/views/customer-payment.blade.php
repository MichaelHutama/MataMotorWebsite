<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor - Payment</title>
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
  @include('layouts.modals')
  @include('layouts.modalcustomer')

  @php
    $paymentItems = [
        ['qty' => 2, 'name' => 'Filter Oli Mesin Toyota Avanza', 'price' => 45000],
        ['qty' => 1, 'name' => 'Kampas Rem Depan Avanza', 'price' => 125000],
    ];

    $subtotal = 0;
    foreach($paymentItems as $item) {
        $subtotal += $item['price'] * $item['qty'];
    }

    $deliveryFee = 20000;
    $taxRate = 0.11; // 11% Tax
    $taxAmount = $subtotal * $taxRate;
    $grandTotal = $subtotal + $deliveryFee + $taxAmount;
  @endphp

    <!-- HEADER -->
    <x-header 
        title="Payment" 
        image="images/backgroundpayment.webp" 
    />

  <!-- Main Content -->
  <main class="max-w-5xl mx-auto py-16 px-4 md:px-8 w-full flex-1 flex flex-col items-center">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-24 mb-16 w-full">
      
      <div class="flex justify-center md:justify-end">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 w-full max-w-sm h-fit space-y-6">
          <h2 class="text-sm font-bold text-gray-900 font-inter uppercase tracking-widest border-b border-gray-50 pb-4">Price Summary</h2>
          
          <div class="space-y-4 font-inter">
            @foreach($paymentItems as $item)
            <div class="flex justify-between items-start gap-4">
              <div class="flex gap-2 text-xs font-bold">
                <span class="text-orange-600">{{ $item['qty'] }}x</span>
                <span class="text-gray-900 uppercase">{{ $item['name'] }}</span>
              </div>
              <span class="text-gray-900 font-bold text-sm">{{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
            </div>
            @endforeach

            <div class="space-y-3 pt-4 border-t border-gray-50">
              <div class="flex justify-between text-xs font-bold text-gray-400 uppercase tracking-wider">
                <span>Subtotal</span>
                <span class="text-gray-900">{{ number_format($subtotal, 0, ',', '.') }}</span>
              </div>
              <div class="flex justify-between text-xs font-bold text-gray-400 uppercase tracking-wider">
                <span>Delivery</span>
                <span class="text-gray-900">{{ number_format($deliveryFee, 0, ',', '.') }}</span>
              </div>
              <div class="flex justify-between text-xs font-bold text-gray-400 uppercase tracking-wider">
                <span>Tax (11%)</span>
                <span class="text-gray-900">{{ number_format($taxAmount, 0, ',', '.') }}</span>
              </div>
            </div>

            <div class="pt-6 border-t border-gray-100">
              <div class="flex flex-col gap-1">
                <span class="text-[10px] text-gray-400 uppercase tracking-[0.2em] font-bold">Total Payable</span>
                <span class="text-3xl font-black text-mm-navy font-inter tracking-tight">IDR {{ number_format($grandTotal, 0, ',', '.') }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex justify-start">
        <div class="w-full max-w-sm bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6">
          <h2 class="text-sm font-bold text-gray-900 font-inter uppercase tracking-widest border-b border-gray-50 pb-4">Payment Method</h2>
          
          <div class="space-y-4 font-inter">
            
            <div class="space-y-3">
              <label class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50 border-2 border-transparent has-[:checked]:border-mm-navy has-[:checked]:bg-white transition-all cursor-pointer group">
                <input type="radio" name="payment_method" value="qris" class="w-4 h-4 text-mm-navy focus:ring-mm-navy border-gray-300">
                <div class="flex-1">
                  <span class="block text-xs font-bold text-gray-900 uppercase">QRIS</span>
                </div>
              </label>

              <!-- QRIS Code Display -->
              <div id="qris-display" class="hidden mt-2 p-4 bg-white border border-gray-100 rounded-2xl flex flex-col items-center gap-3 transition-all duration-300">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Scan QR Code Below</p>
                <img src="{{ asset('images/kodeqris.jpg') }}" alt="QRIS Code" class="w-48 h-48 object-contain shadow-sm rounded-lg">
                <p class="text-xs font-bold text-mm-navy uppercase">Mata Motor Official</p>
              </div>
            </div>

            <div class="space-y-3">
              <label class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50 border-2 border-transparent has-[:checked]:border-mm-navy has-[:checked]:bg-white transition-all cursor-pointer group">
                <input type="radio" name="payment_method" value="transfer" checked class="w-4 h-4 text-mm-navy focus:ring-mm-navy border-gray-300">
                <div class="flex-1">
                  <span class="block text-xs font-bold text-gray-900 uppercase">Bank Transfer</span>
                </div>
              </label>
              
              <div id="bank-options-container" class="hidden grid grid-cols-3 gap-3 pl-4 transition-all duration-300">
                <div class="bank-option h-12 bg-white border-2 border-transparent rounded-xl flex items-center justify-center p-2 cursor-pointer hover:bg-gray-50 transition-all shadow-sm border-gray-100 data-[selected=true]:border-mm-navy" data-bank="bca">
                  <img src="{{ asset('images/BCA.png') }}" alt="BCA" class="w-full h-full object-contain">
                </div>
                <div class="bank-option h-12 bg-white border-2 border-transparent rounded-xl flex items-center justify-center p-2 cursor-pointer hover:bg-gray-50 transition-all shadow-sm border-gray-100 data-[selected=true]:border-mm-navy" data-bank="mandiri">
                  <img src="{{ asset('images/Mandiri.png') }}" alt="Mandiri" class="w-full h-full object-contain">
                </div>
                <div class="bank-option h-12 bg-white border-2 border-transparent rounded-xl flex items-center justify-center p-2 cursor-pointer hover:bg-gray-50 transition-all shadow-sm border-gray-100 data-[selected=true]:border-mm-navy" data-bank="bri">
                  <img src="{{ asset('images/BRI.png') }}" alt="BRI" class="w-full h-full object-contain">
                </div>
              </div>

              <!-- Bank Account Display -->
              <div id="bank-display" class="hidden mt-2 p-5 bg-mm-navy/5 border border-mm-navy/10 rounded-2xl space-y-3 transition-all duration-300">
                <div class="flex items-center justify-between">
                  <img id="selected-bank-logo" src="" alt="Bank Logo" class="h-6 object-contain">
                  <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Virtual Account</span>
                </div>
                <div class="space-y-1">
                  <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Account Number</p>
                  <div class="flex items-center justify-between bg-white px-4 py-3 rounded-xl border border-gray-100 italic">
                    <span id="account-number" class="text-mm-navy font-black tracking-widest text-lg font-inter">883012345678</span>
                    <button class="text-mm-navy hover:text-[#1c4974]">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 012-2v-8a2 2 0 01-2-2h-8a2 2 0 01-2 2v8a2 2 0 012 2z"></path></svg>
                    </button>
                  </div>
                </div>
                <p class="text-[10px] text-gray-400 font-bold text-center uppercase tracking-widest pt-2">A/N Mata Motor Indonesia</p>
              </div>
            </div>

            <label class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50 border-2 border-transparent has-[:checked]:border-mm-navy has-[:checked]:bg-white transition-all cursor-pointer group">
              <input type="radio" name="payment_method" value="cod" class="w-4 h-4 text-mm-navy focus:ring-mm-navy border-gray-300">
              <div class="flex-1 text-xs font-bold text-gray-900 uppercase">Cash on Delivery (COD)</div>
            </label>

          </div>
        </div>
      </div>
    </div>

    <div class="flex justify-center w-full pb-8">
      @include('components.action-button', [
          'id' => 'pay-now-btn',
          'text' => 'COMPLETE PAYMENT',
          'type' => 'button',
          'class' => 'w-full max-w-sm py-4 bg-mm-navy hover:bg-[#1c4974] text-white font-bold rounded-full shadow-lg shadow-blue-900/10 transition-all flex items-center justify-center gap-2 text-xs tracking-[0.2em] font-inter uppercase'
      ])
    </div>

  </main>

  @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const bankOptions = document.querySelectorAll('.bank-option');
        const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
        const payBtn = document.getElementById('pay-now-btn');
        const qrisDisplay = document.getElementById('qris-display');
        const bankOptionsContainer = document.getElementById('bank-options-container');
        const bankDisplay = document.getElementById('bank-display');
        const selectedBankLogo = document.getElementById('selected-bank-logo');
        const accountNumber = document.getElementById('account-number');

        const bankData = {
            bca: { logo: "{{ asset('images/BCA.png') }}", acc: "8830 1234 5678" },
            mandiri: { logo: "{{ asset('images/Mandiri.png') }}", acc: "123 000 7890 123" },
            bri: { logo: "{{ asset('images/BRI.png') }}", acc: "0012 01 000123 50 1" }
        };

        function updateDisplay() {
            const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;
            
            // Toggle QRIS
            if (selectedMethod === 'qris') {
                qrisDisplay.classList.remove('hidden');
            } else {
                qrisDisplay.classList.add('hidden');
            }

            // Toggle Bank Options
            if (selectedMethod === 'transfer') {
                bankOptionsContainer.classList.remove('hidden');
                
                // Toggle Bank Detail Display
                const activeBank = document.querySelector('.bank-option[data-selected="true"]');
                if (activeBank) {
                    const data = bankData[activeBank.dataset.bank];
                    selectedBankLogo.src = data.logo;
                    accountNumber.textContent = data.acc;
                    bankDisplay.classList.remove('hidden');
                } else {
                    bankDisplay.classList.add('hidden');
                }
            } else {
                bankOptionsContainer.classList.add('hidden');
                bankDisplay.classList.add('hidden');
            }
        }

        // Handle Payment Method Changes
        paymentRadios.forEach(radio => {
            radio.addEventListener('change', updateDisplay);
        });

        // Handle Bank Selection
        bankOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Deselect others
                bankOptions.forEach(opt => {
                    opt.classList.remove('border-mm-navy');
                    opt.classList.add('border-gray-100');
                    opt.dataset.selected = 'false';
                });
                
                // Select this one
                this.classList.remove('border-gray-100');
                this.classList.add('border-mm-navy');
                this.dataset.selected = 'true';

                // Automatically switch radio to 'transfer' if bank clicked
                document.querySelector('input[value="transfer"]').checked = true;
                updateDisplay();
            });
        });

        // Initial check
        updateDisplay();

        // Pay Button Action
        payBtn.addEventListener('click', function() {
            const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;
            let methodLabel = selectedMethod.toUpperCase();
            
            if (selectedMethod === 'transfer') {
                const selectedBank = document.querySelector('.bank-option[data-selected="true"]');
                if (!selectedBank) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Select Bank',
                        text: 'Please choose a bank for transfer method.',
                        confirmButtonColor: '#15395c'
                    });
                    return;
                }
                methodLabel = 'Bank Transfer (' + selectedBank.dataset.bank.toUpperCase() + ')';
            }

            Swal.fire({
                title: '<span class="font-inter uppercase font-black text-mm-navy">Confirm Payment?</span>',
                html: `<p class="font-didact text-gray-500">You are about to pay using <b>${methodLabel}</b>. Please ensure your balance is sufficient.</p>`,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'YES, PAY NOW',
                cancelButtonText: 'CANCEL',
                buttonsStyling: false,
                customClass: {
                    popup: '!rounded-3xl !p-8',
                    confirmButton: 'bg-mm-navy text-white px-8 py-3 rounded-xl font-bold font-inter text-xs tracking-widest hover:bg-[#1c4974] transition-all mr-3',
                    cancelButton: 'bg-gray-100 text-gray-400 px-8 py-3 rounded-xl font-bold font-inter text-xs tracking-widest hover:bg-gray-200 transition-all'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'PAYMENT SUCCESS!',
                        text: 'Thank you for your purchase. We are processing your order.',
                        icon: 'success',
                        confirmButtonColor: '#15395c'
                    }).then(() => {
                        window.location.href = "{{ url('/') }}";
                    });
                }
            });
        });
    });
  </script>
</body>
</html>
