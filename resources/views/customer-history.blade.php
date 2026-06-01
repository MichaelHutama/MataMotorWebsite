<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor - History</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Inter:wght@400;500;600;700;800&family=Albert+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <style>
    .flatpickr-calendar { border-radius: 16px !important; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1) !important; border: 1px solid #e5e7eb !important; }
    .flatpickr-day.selected { background: #15395c !important; border-color: #15395c !important; }
    .flatpickr-day:hover { background: #f3f4f6 !important; }
  </style>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'mm-navy': '#15395c',
            'mm-blue': '#1e5eb8',
          },
          fontFamily: {
            'didact': ['"Didact Gothic"', 'sans-serif'],
            'inter': ['Inter', 'sans-serif'],
            'century': ['"Century Gothic"', 'AppleGothic', 'sans-serif'],
            'albert': ['"Albert Sans"', 'sans-serif'],
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col font-didact text-gray-800">

  @php
    $calculateGrandTotal = function($transaction) {
        $total = 0;
        foreach($transaction['items'] as $item) {
            $price = (float)str_replace('.', '', $item['price']);
            $total += $price;
        }
        
        // Add delivery fee if applicable (dummy 15.000)
        if (isset($transaction['delivery'])) {
            $total += 15000;
        }
        
        return number_format($total, 0, ',', '.');
    };

    $transactions = [
        [
            'id' => 'TRX-20260520-65',
            'type' => 'Sparepart Sales & Vehicle Service',
            'date' => '20 May 2026',
            'time' => '15.20 WIB',
            'paid_time' => '16.00 WIB',
            'payment' => [
                'method' => 'QRIS',
                'channel' => 'GOPAY',
                'status' => 'Paid'
            ],
            'total' => '101.500',
            'items' => [
                [
                    'item_id' => 'SRV-90122',
                    'name' => 'Oil and Filter Replacement',
                    'category' => 'Vehicle Service',
                    'status' => 'Success',
                    'status_color' => 'bg-green-500',
                    'desc' => 'B 4545 XXX - Suzuki GSX R150',
                    'price' => '33.000',
                    'image' => 'images/servicecategory/Icon Oil Service.webp'
                ],
                [
                    'item_id' => 'SPR-50129',
                    'name' => 'Shell Advance Scooter Matic',
                    'category' => 'Sparepart Sales',
                    'status' => 'Delivered',
                    'status_color' => 'bg-green-500',
                    'desc' => '1 pcs',
                    'price' => '68.500',
                    'image' => 'https://images.unsplash.com/photo-1622445262461-c3b8213226a6?q=80&w=100'
                ]
            ]
        ],
        [
            'id' => 'TRX-20260521-12',
            'type' => 'Sparepart Sales',
            'date' => '21 May 2026',
            'time' => '10.30 WIB',
            'paid_time' => '11.00 WIB',
            'payment' => [
                'method' => 'Bank Transfer',
                'channel' => 'BCA Virtual Account',
                'status' => 'Paid'
            ],
            'delivery' => [
                'receiver' => 'Andi Wijaya',
                'address' => 'Apartment Green Bay Tower C, Jakarta Utara',
                'method' => 'JNE Reguler',
                'notes' => 'Lantai 5, Unit A'
            ],
            'total' => '150.000',
            'items' => [
                [
                    'item_id' => 'SPR-50130',
                    'name' => 'NGK Iridium Spark Plug',
                    'category' => 'Sparepart Sales',
                    'status' => 'Delivering',
                    'status_color' => 'bg-blue-500',
                    'desc' => '2 pcs',
                    'price' => '150.000',
                    'image' => 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?q=80&w=100'
                ]
            ]
        ],
        [
            'id' => 'TRX-20260522-05',
            'type' => 'Vehicle Service',
            'date' => '22 May 2026',
            'time' => '14.15 WIB',
            'paid_time' => '15.00 WIB',
            'payment' => [
                'method' => 'E-Wallet',
                'channel' => 'OVO',
                'status' => 'Paid'
            ],
            'total' => '85.000',
            'items' => [
                [
                    'item_id' => 'SRV-90123',
                    'name' => 'Full Tune Up',
                    'category' => 'Vehicle Service',
                    'status' => 'Processing',
                    'status_color' => 'bg-yellow-500',
                    'desc' => 'B 1234 ABC - Honda Vario 150',
                    'price' => '85.000',
                    'image' => 'images/servicecategory/Icon Tune Up.webp'
                ]
            ]
        ],
        [
            'id' => 'TRX-20260523-99',
            'type' => 'Sparepart Sales',
            'date' => '23 May 2026',
            'time' => '09.45 WIB',
            'paid_time' => '10.00 WIB',
            'payment' => [
                'method' => 'QRIS',
                'channel' => 'ShopeePay',
                'status' => 'Paid'
            ],
            'total' => '245.000',
            'items' => [
                [
                    'item_id' => 'SPR-50131',
                    'name' => 'Yamalube Super Sport 1L',
                    'category' => 'Sparepart Sales',
                    'status' => 'Success',
                    'status_color' => 'bg-green-500',
                    'desc' => '1 pcs',
                    'price' => '95.000',
                    'image' => 'https://images.unsplash.com/photo-1599256629825-4265e1d2d0b6?q=80&w=100'
                ],
                [
                    'item_id' => 'SPR-50132',
                    'name' => 'Brake Pad Set (Front)',
                    'category' => 'Sparepart Sales',
                    'status' => 'Success',
                    'status_color' => 'bg-green-500',
                    'desc' => '1 pcs',
                    'price' => '150.000',
                    'image' => 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?q=80&w=100'
                ]
            ]
        ],
        [
            'id' => 'TRX-20260524-10',
            'type' => 'Vehicle Service',
            'date' => '24 May 2026',
            'time' => '11.00 WIB',
            'paid_time' => '-',
            'payment' => [
                'method' => 'Bank Transfer',
                'channel' => 'Mandiri Virtual Account',
                'status' => 'Cancelled'
            ],
            'total' => '120.000',
            'items' => [
                [
                    'item_id' => 'SRV-90124',
                    'name' => 'CVT Cleaning & Greasing',
                    'category' => 'Vehicle Service',
                    'status' => 'Cancelled',
                    'status_color' => 'bg-red-500',
                    'desc' => 'B 9988 XYZ - Yamaha NMAX',
                    'price' => '120.000',
                    'image' => 'images/servicecategory/Icon Machine Service.webp'
                ]
            ]
        ],
        [
            'id' => 'TRX-20260525-01',
            'type' => 'Sparepart Sales',
            'date' => '25 May 2026',
            'time' => '14.00 WIB',
            'paid_time' => '14.15 WIB',
            'payment' => [
                'method' => 'E-Wallet',
                'channel' => 'DANA',
                'status' => 'Paid'
            ],
            'delivery' => [
                'receiver' => 'Budi Santoso',
                'address' => 'Jl. Merdeka No. 123, Jakarta Selatan',
                'method' => 'GrabExpress',
                'notes' => 'Pagar warna hitam, titip di sekuriti.'
            ],
            'total' => '215.000',
            'items' => [
                [
                    'item_id' => 'SPR-50133',
                    'name' => 'Bando V-Belt Kit',
                    'category' => 'Sparepart Sales',
                    'status' => 'Success',
                    'status_color' => 'bg-green-500',
                    'desc' => '1 pcs',
                    'price' => '195.000',
                    'image' => 'https://images.unsplash.com/photo-1599256629825-4265e1d2d0b6?q=80&w=100'
                ]
            ]
        ]
    ];
  @endphp

  @include('layouts.navbarcustomer')
  @include('layouts.modals')
  @include('layouts.modalcustomer')

  <!-- HEADER -->
  <x-header 
    title="History" 
    image="images/backgroundbooking.webp" 
  />

  <main class="max-w-7xl mx-auto py-12 px-4 md:px-8 w-full flex-1">
    <div class="flex flex-col lg:flex-row gap-8">
      
      <!-- Sidebar Categories -->
      <aside class="w-full lg:w-64 shrink-0">
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
          <div class="px-5 py-4 border-b border-gray-100">
            <h3 class="text-base font-bold text-gray-700 font-century">Categories</h3>
          </div>
          <div class="p-2 space-y-1">
            <button onclick="filterByCategory('all', this)" class="category-btn w-full font-century text-left px-4 py-2.5 rounded-lg bg-gray-100 text-mm-navy font-bold text-sm transition-colors">All</button>
            <button onclick="filterByCategory('Vehicle Service', this)" class="category-btn w-full font-century text-left px-4 py-2.5 rounded-lg hover:bg-gray-50 text-gray-500 font-medium text-sm transition-colors">Vehicle Service</button>
            <button onclick="filterByCategory('Sparepart Sales', this)" class="category-btn w-full font-century text-left px-4 py-2.5 rounded-lg hover:bg-gray-50 text-gray-500 font-medium text-sm transition-colors">Sparepart Sales</button>
          </div>
        </div>
      </aside>

      <!-- Main Content -->
      <div class="flex-1 space-y-6">
        
        <!-- Search and Filters -->
        <div class="space-y-4">
          <div class="flex flex-col md:flex-row gap-4 text-left">
            <div class="relative flex-1">
              <input type="text" placeholder="Search your transaction here..." class="w-full pl-5 pr-12 py-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-mm-navy/10 outline-none text-sm font-medium font-didact">
              
            </div>
            <div class="relative">
              <button id="dateRangeBtn" class="flex items-center gap-2 px-5 py-3 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mm-navy" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span id="dateRangeLabel" class="text-sm font-bold text-mm-navy font-albert">Select Date Range</span>
              </button>
            </div>
          </div>

          <!-- Status Tabs -->
          <div class="flex flex-wrap gap-2 pt-2">
            <button onclick="filterByStatus('all', this)" class="status-btn px-5 py-2 rounded-full border border-mm-navy bg-blue-50 text-mm-navy text-sm font-didact">All</button>
            <button data-status="Pending" onclick="filterByStatus('Pending', this)" class="status-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-didact hover:border-mm-navy transition-colors">Pending</button>
            <button data-status="Processing" onclick="filterByStatus('Processing', this)" class="status-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-didact hover:border-mm-navy transition-colors">Processing</button>
            <button data-status="Success" onclick="filterByStatus('Success', this)" class="status-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-didact hover:border-mm-navy transition-colors">Success</button>
            <button data-status="Received" onclick="filterByStatus('Received', this)" class="status-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-didact hover:border-mm-navy transition-colors">Received</button>
            <button data-status="Delivering" onclick="filterByStatus('Delivering', this)" class="status-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-didact hover:border-mm-navy transition-colors">Delivering</button>
            <button data-status="Ready for Pickup" onclick="filterByStatus('Ready for Pickup', this)" class="status-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-didact hover:border-mm-navy transition-colors">Ready for Pickup</button>
            <button data-status="Cancelled" onclick="filterByStatus('Cancelled', this)" class="status-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-didact hover:border-mm-navy transition-colors">Cancelled</button>
          </div>
        </div>

        <!-- Transaction Cards -->
        <div class="space-y-6">
          @foreach($transactions as $transaction)
            <div data-category="{{ $transaction['type'] }}" 
                 data-date="{{ date('Y-m-d', strtotime($transaction['date'])) }}"
                 onclick="showTransactionDetail({{ json_encode($transaction) }})" 
                 class="transaction-card group bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-all cursor-pointer text-left">
              
              <!-- Header Row -->
              <div class="px-6 py-3 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                <div class="flex items-center gap-3">
                  <div class="flex items-center gap-1.5">
                    @if(str_contains($transaction['type'], 'Vehicle Service'))
                      <img src="images/repairing-icon.webp" class="h-4 w-4 object-contain" alt="Service" title="Vehicle Service">
                    @endif
                    @if(str_contains($transaction['type'], 'Sparepart Sales'))
                      <img src="images/cart-line-icon.webp" class="h-4 w-4 object-contain" alt="Sparepart" title="Sparepart Sales">
                    @endif
                  </div>
                  <span class="card-title-id text-sm font-medium text-black font-century tracking-wider" data-original-id="{{ $transaction['id'] }}">
                    {{ $transaction['id'] }}
                  </span>
                  <div class="w-1.5 h-1.5 rounded-full bg-gray-300"></div>
                  <span class="text-sm font-medium text-[#15395c] font-century">{{ $transaction['type'] }}</span>
                  <div class="w-1.5 h-1.5 rounded-full bg-gray-300"></div>
                  <span class="text-sm font-medium text-[#924e24] font-century">{{ $transaction['date'] }}</span>
                </div>
              </div>

              <!-- Body Items -->
              <div class="px-6 py-5 space-y-6">
                @foreach($transaction['items'] as $item)
                  <div class="transaction-item flex items-center justify-between" data-item-category="{{ $item['category'] }}" data-item-id="{{ $item['item_id'] }}">
                    <div class="flex items-center gap-4">
                      <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-50 transition-colors">
                        <img src="{{ $item['image'] }}" class="h-8 w-8 object-contain opacity-80" alt="{{ $item['name'] }}">
                      </div>
                      <div>
                        <div class="flex items-center gap-3">
                          <p class="font-bold text-gray-800 text-[15px] font-albert">
                            {{ $item['name'] }}
                          </p>
                          <span class="px-3 py-1 {{ $item['status_color'] }} text-white text-[10px] font-black uppercase rounded-md tracking-wider">
                            {{ $item['status'] }}
                          </span>
                        </div>
                        <p class="text-sm text-[#15395c] font-medium font-century">{{ $item['desc'] }}</p>
                      </div>
                    </div>
                    <p class="font-bold text-[#e67e22] text-lg font-albert uppercase tracking-tighter">IDR {{ $item['price'] }}</p>
                  </div>
                @endforeach
              </div>

              <!-- Total Row -->
              <div class="px-6 py-4 bg-gray-50/30 border-t border-gray-100 flex items-center justify-between">
                <span class="text-[15px] font-bold text-mm-navy font-albert uppercase tracking-wide">Total</span>
                <span class="text-2xl font-black text-[#e67e22] font-albert tracking-tighter">IDR {{ $calculateGrandTotal($transaction) }}</span>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </main>

  <script>
    let currentCategory = 'all';
    let currentStatus = 'all';
    let startDate = null;
    let endDate = null;

    // Dummy review storage for demo
    const userReviews = {
        'TRX-20260523-99': {
            rating: 5,
            comment: "Pelayanan sangat cepat dan teknisinya sangat ahli. Sparepart original!"
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#dateRangeBtn", {
            mode: "range",
            dateFormat: "Y-m-d",
            altInput: false,
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    startDate = selectedDates[0];
                    endDate = selectedDates[1];
                    const startFmt = instance.formatDate(startDate, "d M Y");
                    const endFmt = instance.formatDate(endDate, "d M Y");
                    document.getElementById('dateRangeLabel').textContent = `${startFmt} - ${endFmt}`;
                    applyFilters();
                } else if (selectedDates.length === 0) {
                    startDate = null;
                    endDate = null;
                    document.getElementById('dateRangeLabel').textContent = "Select Date Range";
                    applyFilters();
                }
            }
        });
    });

    function applyFilters() {
        const cards = document.querySelectorAll('.transaction-card');
        cards.forEach(card => {
            const titleEl = card.querySelector('.card-title-id');
            const items = card.querySelectorAll('.transaction-item');
            const cardDateStr = card.getAttribute('data-date');
            const cardDate = new Date(cardDateStr);
            
            // 1. Date filter
            let dateMatch = true;
            if (startDate && endDate) {
                const checkDate = new Date(cardDate.getFullYear(), cardDate.getMonth(), cardDate.getDate());
                const sDate = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate());
                const eDate = new Date(endDate.getFullYear(), endDate.getMonth(), endDate.getDate());
                dateMatch = checkDate >= sDate && checkDate <= eDate;
            }

            let hasVisibleItems = false;
            let firstVisibleItemId = '';

            // 2. Category & Status multi-filter logic for items
            items.forEach(item => {
                const itemCategory = item.getAttribute('data-item-category');
                const itemStatus = item.querySelector('span[class*="text-white"]').textContent.trim();
                
                const categoryMatch = (currentCategory === 'all' || itemCategory === currentCategory);
                const statusMatch = (currentStatus === 'all' || itemStatus === currentStatus || 
                                    (currentStatus === 'Delivering' && itemStatus === 'In Delivery')); // normalize naming

                if (categoryMatch && statusMatch) {
                    item.style.display = 'flex';
                    if (!firstVisibleItemId) firstVisibleItemId = item.getAttribute('data-item-id');
                    hasVisibleItems = true;
                } else {
                    item.style.display = 'none';
                }
            });

            // 3. Final card visibility
            if (hasVisibleItems && dateMatch) {
                card.style.display = 'block';
                if (currentCategory !== 'all') {
                    titleEl.textContent = firstVisibleItemId;
                } else {
                    titleEl.textContent = titleEl.getAttribute('data-original-id');
                }
            } else {
                card.style.display = 'none';
            }
        });
    }

    function filterByStatus(status, btn) {
        currentStatus = status;
        // Update status button styles
        document.querySelectorAll('.status-btn').forEach(el => {
            el.classList.remove('border-mm-navy', 'bg-blue-50', 'text-mm-navy');
            el.classList.add('border-gray-300', 'bg-white', 'text-gray-500');
        });
        
        btn.classList.add('border-mm-navy', 'bg-blue-50', 'text-mm-navy');
        btn.classList.remove('border-gray-300', 'bg-white', 'text-gray-500');

        applyFilters();
    }

    function filterByCategory(category, btn) {
        currentCategory = category;

        // Hide/Show relevant status buttons
        const statusBtns = document.querySelectorAll('.status-btn[data-status]');
        statusBtns.forEach(sBtn => {
            const statusLabel = sBtn.getAttribute('data-status');
            
            if (category === 'Vehicle Service') {
                // Service doesn't have Delivery-related statuses
                if (statusLabel === 'Delivering' || statusLabel === 'Received') {
                    sBtn.style.display = 'none';
                    if (currentStatus === statusLabel) filterByStatus('all', document.querySelector('.status-btn:first-child'));
                } else {
                    sBtn.style.display = 'inline-block';
                }
            } else if (category === 'Sparepart Sales') {
                // Sparepart has everything
                sBtn.style.display = 'inline-block';
            } else {
                // 'All' shows everything
                sBtn.style.display = 'inline-block';
            }
        });

        // Update button styles
        document.querySelectorAll('.category-btn').forEach(el => {
            el.classList.remove('bg-gray-100', 'text-mm-navy', 'font-bold');
            el.classList.add('hover:bg-gray-50', 'text-gray-500', 'font-medium');
        });
        
        btn.classList.add('bg-gray-100', 'text-mm-navy', 'font-bold');
        btn.classList.remove('hover:bg-gray-50', 'text-gray-500', 'font-medium');

        applyFilters();
    }

    function openReviewModal(transaction) {
        const trxId = transaction.id;
        let currentRating = 0;
        
        Swal.fire({
            html: `
                <div class="w-[410px] max-w-full bg-white px-2 pt-2 pb-2" style="font-family: 'Didact Gothic', sans-serif;">
                    <div class="text-center mb-4" style="font-family: 'Century Gothic', sans-serif;">
                        <h2 class="text-[34px] leading-none font-bold text-black">Add Review</h2>
                    </div>

                    <div class="space-y-6 text-[15px] text-black text-left">
                        
                        <div class="flex justify-center gap-2 mb-2" id="star-container">
                            ${[1, 2, 3, 4, 5].map(i => `
                                <button onclick="setRating(${i})" class="star-btn transition-transform hover:scale-110" data-value="${i}">
                                    <svg class="w-10 h-10 text-gray-200" fill="currentColor" viewBox="0 0 20 20" id="star-${i}">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                            `).join('')}
                        </div>

                        <div>
                            <label class="block mb-2 font-normal text-left">Comment (Optional)</label>
                            <textarea id="review-comment" class="w-full mb-2 p-4 bg-white border border-gray-500 rounded-[10px] focus:border-[#15395c] outline-none min-h-[120px] text-[15px] text-black placeholder:text-gray-400" placeholder="Tell us about your experience..."></textarea>
                        </div>
                    </div>

                    <div class="mt-8 mb-8 flex items-center justify-center gap-8" style="font-family: 'Century Gothic', sans-serif;">
                        <button onclick="Swal.close()" class="w-[140px] h-[44px] rounded-full border border-[#15395c] text-[16px] font-bold text-[#15395c] transition-colors hover:bg-[#f0f4f8]">
                            Cancel
                        </button>
                        <button onclick="Swal.clickConfirm()" class="w-[140px] h-[44px] rounded-full bg-[#15395c] text-[16px] font-bold text-white transition-colors hover:bg-[#1c4974]">
                            Add
                        </button>
                    </div>
                </div>
            `,
            showConfirmButton: false,
            showCancelButton: false,
            buttonsStyling: false,
            customClass: {
                popup: '!rounded-[24px] !p-0 !overflow-hidden !w-auto',
            },
            didOpen: () => {
                window.setRating = (val) => {
                    currentRating = val;
                    for (let i = 1; i <= 5; i++) {
                        const star = document.getElementById(`star-${i}`);
                        if (i <= val) {
                            star.classList.remove('text-gray-200');
                            star.classList.add('text-orange-400');
                        } else {
                            star.classList.remove('text-orange-400');
                            star.classList.add('text-gray-200');
                        }
                    }
                };
            },
            preConfirm: () => {
                const comment = document.getElementById('review-comment').value;
                if (currentRating === 0) {
                    Swal.showValidationMessage('Please select a rating');
                    return false;
                }
                return { rating: currentRating, comment: comment || "-" };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                userReviews[trxId] = result.value;
                if (window.showSuccessModal) {
                    showSuccessModal('Review added').then(() => {
                        showTransactionDetail(transaction);
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: '<h2 class="text-xl font-bold text-mm-navy font-century uppercase">Review Submitted!</h2>',
                        text: 'Thank you for your feedback.',
                        confirmButtonText: 'CONTINUE',
                        buttonsStyling: false,
                        customClass: {
                            popup: '!rounded-[32px] !p-8',
                            confirmButton: 'px-10 py-3 bg-mm-navy text-white rounded-full font-bold text-xs tracking-widest hover:bg-[#1c4974] transition-all shadow-lg'
                        }
                    }).then(() => {
                        showTransactionDetail(transaction);
                    });
                }
            } else if (result.dismiss === Swal.DismissReason.cancel || result.dismiss === Swal.DismissReason.backdrop) {
                showTransactionDetail(transaction);
            }
        });
    }

    function showTransactionDetail(transaction) {
        let sectionsHtml = '';
        
        // Group items by category to create sections
        const serviceItems = transaction.items.filter(item => item.category === 'Vehicle Service');
        const sparepartItems = transaction.items.filter(item => item.category === 'Sparepart Sales');

        if (serviceItems.length > 0) {
            sectionsHtml += `
            <div class="py-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-[#15395c] font-inter uppercase tracking-widest border-b border-gray-50 mb-4">Vehicle Service</h3>
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-1 space-y-4">
                        ${serviceItems.map(item => `
                            <div class="flex items-start gap-4">
                                <img src="${item.image}" class="h-6 w-6 object-contain mt-1 opacity-70" alt="">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <p class="font-bold text-gray-800 font-albert text-sm">${item.name}</p>
                                        <span class="px-2 py-0.5 ${item.status_color} text-white text-[9px] font-black uppercase rounded tracking-wider">${item.status}</span>
                                    </div>
                                    <div class="grid grid-cols-[auto_1fr] gap-x-8 gap-y-1 text-[12px] items-center font-century">
                                        <span class="text-gray-400 font-medium tracking-wide">Service ID</span>
                                        <span class="font-bold text-black border-l border-gray-100 pl-4">${item.item_id}</span>
                                        
                                        <span class="text-gray-400 font-medium tracking-wide">Vehicle</span>
                                        <span class="font-bold text-black border-l border-gray-100 pl-4">${item.desc}</span>
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                        <div class="flex justify-center pt-2">
                            ${(() => {
                                const review = userReviews[transaction.id];
                                if (review) {
                                    return `
                                        <div class="space-y-1 font-century w-full mt-4 bg-gray-50/50 p-4 rounded-2xl border border-gray-100">
                                            <h3 class="text-[12px] font-bold text-gray-400 font-inter tracking-widest border-b border-gray-50 mb-3 uppercase">Your Review</h3>
                                            <div class="grid grid-cols-[auto_1fr] gap-x-8 gap-y-2 text-[12px] items-center">
                                                <span class="text-gray-400 tracking-wide">Rating</span>
                                                <div class="flex text-orange-400 border-l border-gray-100 pl-4">
                                                    ${Array(5).fill(0).map((_, i) => `
                                                        <svg class="w-3.5 h-3.5 ${i < review.rating ? 'fill-current' : 'text-gray-200'}" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    `).join('')}
                                                </div>

                                                <span class="text-gray-400 font-medium tracking-wide">Comment</span>
                                                <span class="font-bold text-black border-l border-gray-100 pl-4 italic">"${review.comment}"</span>
                                            </div>
                                        </div>
                                    `;
                                } else if (serviceItems.every(s => s.status === 'Success')) {
                                    return `
                                        <button onclick='openReviewModal(${JSON.stringify(transaction).replace(/'/g, "&apos;")})' class="px-8 py-2 bg-mm-navy hover:bg-[#1c4974] text-white text-sm font-bold rounded-full shadow-md transition-all tracking-widest font-inter">
                                            Add Review
                                        </button>
                                    `;
                                } else {
                                    return `
                                         <div class="mt-4 p-3 bg-gray-50 rounded-xl border border-gray-100 text-center w-full">
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest font-century">Review available after service is completed</p>
                                        </div>
                                    `;
                                }
                            })()}
                        </div>
                    </div>
                </div>
            </div>`;
        }

        if (sparepartItems.length > 0) {
            sectionsHtml += `
            <div class="py-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-[#15395c] font-inter uppercase tracking-widest border-b border-gray-50 mb-4">Sparepart Sales</h3>
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-1 space-y-4">
                        ${sparepartItems.map(item => `
                            <div class="flex items-start gap-4">
                                <img src="${item.image}" class="h-10 w-10 object-contain rounded-lg shadow-sm" alt="">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <p class="font-bold text-gray-800 font-albert text-sm">${item.name}</p>
                                        <span class="px-2 py-0.5 ${item.status_color} text-white text-[9px] font-black uppercase rounded tracking-wider">${item.status}</span>
                                    </div>
                                    <div class="grid grid-cols-[auto_1fr] gap-x-8 gap-y-1 text-[12px] items-center font-century">
                                        <span class="text-gray-400 font-medium tracking-wide">Sales ID</span>
                                        <span class="font-bold text-black border-l border-gray-100 pl-4">${item.item_id}</span>
                                        
                                        <span class="text-gray-400 font-medium tracking-wide">Quantity</span>
                                        <span class="font-bold text-black border-l border-gray-100 pl-4">1</span>
                                        
                                        <span class="text-gray-400 font-medium tracking-wide">Fulfillment</span>
                                        <span class="font-bold text-black border-l border-gray-100 pl-4">${transaction.delivery ? 'Delivery' : 'Pick-up At Store'}</span>
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </div>`;
        }

        let deliveryHtml = '';
        if (transaction.delivery) {
            deliveryHtml = `
            <div class="space-y-1 font-century">
                <h3 class="text-lg font-bold text-[#15395c] font-inter tracking-widest border-b border-gray-50 mb-3 uppercase">Delivery Detail</h3>
                <div class="grid grid-cols-[auto_1fr] gap-x-8 gap-y-2 text-[12px] text-sm items-center">
                    <span class="text-gray-400 tracking-wide">Receiver</span>
                    <span class="font-bold text-black border-l border-gray-100 pl-4">${transaction.delivery.receiver}</span>

                    <span class="text-gray-400 font-medium tracking-wide">Address</span>
                    <span class="font-bold text-black border-l border-gray-100 pl-4">${transaction.delivery.address}</span>

                    <span class="text-gray-400 font-medium tracking-wide">Method</span>
                    <span class="font-bold text-black border-l border-gray-100 pl-4">${transaction.delivery.method}</span>

                    <span class="text-gray-400 font-medium tracking-wide">Notes</span>
                    <span class="font-bold text-black border-l border-gray-100 pl-4 italic">"${transaction.delivery.notes}"</span>
                </div>
            </div>`;
        }

        Swal.fire({
            showCloseButton: true,
            html: `
                <div class="text-left font-didact p-4">
                    <div class="flex items-center gap-3 mb-6">
                        <h2 class="text-2xl font-black text-black font-century uppercase tracking-tight text-center">Transaction Detail</h2>
                    </div>

                    <div class="space-y-1 mb-8 pb-4 border-b border-gray-100">
                        <div class="grid grid-cols-[auto_1fr] gap-x-8 gap-y-1 text-[12px] items-center font-century">
                            <span class="text-gray-400 font-medium tracking-wide">Transaction ID</span>
                            <span class="font-bold text-black border-l border-gray-100 pl-4">${transaction.id}</span>
                            
                            <span class="text-gray-400 font-medium tracking-wide">Date & Time</span>
                            <span class="font-bold text-black border-l border-gray-100 pl-4">${transaction.date}, ${transaction.time}</span>
                        </div>
                    </div>
                </div>

                <div class="text-left px-4">
                    ${sectionsHtml}
                    
                    <div class="py-8 grid grid-cols-1 md:grid-cols-2 gap-8 items-start px-4">
                        <div class="space-y-8">
                            <!-- Payment Detail -->
                            <div class="space-y-1 font-century">
                                <h3 class="text-lg font-bold text-[#15395c] font-inter tracking-widest border-b border-gray-50 mb-3 uppercase">Payment Detail</h3>
                                <div class="grid grid-cols-[auto_1fr] gap-x-8 gap-y-2 text-[12px] text-sm items-center">
                                    <span class="text-gray-400 tracking-wide">Status</span>
                                    <span class="font-bold text-black border-l border-gray-100 pl-4">${transaction.payment.status}</span>

                                    <span class="text-gray-400 font-medium tracking-wide">Method</span>
                                    <span class="font-bold text-black border-l border-gray-100 pl-4">${transaction.payment.method} (${transaction.payment.channel})</span>

                                    <span class="text-gray-400 font-medium tracking-wide">Time</span>
                                    <span class="font-bold text-black whitespace-nowrap border-l border-gray-100 pl-4">${transaction.paid_time !== '-' ? transaction.date + ', ' + transaction.paid_time : '-'}</span>
                                </div>
                            </div>

                            <!-- Delivery Detail (Optional) -->
                            ${deliveryHtml}
                        </div>

                        <!-- Price Summary -->
                        <div class="w-full">
                            ${(() => {
                                const subtotalVal = transaction.items.reduce((acc, item) => acc + parseFloat(item.price.replace(/\./g, '')), 0);
                                const deliveryVal = transaction.delivery ? 15000 : 0;
                                const grandTotal = subtotalVal + deliveryVal;
                                
                                const fmt = (val) => new Intl.NumberFormat('id-ID').format(val);
                                
                                const itemsHtml = transaction.items.map(item => `
                                    <div class="flex justify-between items-start gap-4">
                                        <div class="flex gap-2 font-century">
                                            <span class="text-mm-navy font-bold text-sm min-w-[20px]">1x</span>
                                            <span class="text-sm font-medium text-gray-700 leading-tight">${item.name}</span>
                                        </div>
                                        <span class="text-sm font-bold font-century text-gray-900 whitespace-nowrap">IDR ${item.price}</span>
                                    </div>
                                `).join('');

                                return `
                                    <div class="w-full max-w-md bg-gray-50 rounded-[32px] p-8 space-y-6 border border-gray-100 flex flex-col items-center mx-auto">
                                        <h2 class="text-lg font-bold text-gray-900 font-inter uppercase tracking-widest border-b border-gray-100 pb-2 w-full text-center">Price Summary</h2>
                                        
                                        <div class="w-full space-y-4 font-inter">
                                            ${itemsHtml}
                                            
                                            <div class="pt-6 border-t border-dashed border-gray-300 space-y-3">
                                                <div class="flex justify-between text-sm font-bold text-gray-400 uppercase tracking-widest">
                                                    <span>Subtotal</span>
                                                    <span class="font-century text-gray-900">IDR ${fmt(subtotalVal)}</span>
                                                </div>
                                                ${transaction.delivery ? `
                                                <div class="flex justify-between text-sm font-bold text-gray-400 uppercase tracking-widest">
                                                    <span>Delivery</span>
                                                    <span class="font-century text-gray-900">IDR ${fmt(deliveryVal)}</span>
                                                </div>` : ''}
                                            </div>

                                            <div class="pt-6 border-t border-gray-200 flex justify-between items-center">
                                                <span class="text-sm font-bold text-gray-900 uppercase tracking-widest">Total Amount</span>
                                                <span class="text-2xl font-black text-mm-navy font-inter tracking-tighter">IDR ${fmt(grandTotal)}</span>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            })()}
                        </div>
                    </div>
                </div>
            `,
            showConfirmButton: false,
            showCloseButton: true,
            width: 850,
            customClass: {
                popup: '!rounded-[32px] !p-8',
                htmlContainer: '!m-0 !p-0'
            }
        });
    }
  </script>
</body>
</html>
