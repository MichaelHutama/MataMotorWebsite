<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor - Mechanic History</title>
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
    $services = [
        [
            'id' => 'SRV-20260520-01',
            'service_id' => 'SVC-90122',
            'customer' => [
                'id' => 'CUST-001',
                'name' => 'Budi Santoso',
                'image' => 'https://i.pravatar.cc/150?u=CUST-001'
            ],
            'type' => 'Oil and Filter Replacement',
            'date' => '20 May 2026',
            'time' => '15:20 WIB',
            'vehicle' => 'B 4545 XXX - Suzuki GSX R150',
            'status' => 'Success',
            'status_color' => 'bg-green-500',
            'price' => '33.000',
            'image' => 'images/servicecategory/Icon Oil Service.webp',
            'category' => 'Oil Service',
            'mechanics' => [
                ['id' => 'MECH-01', 'name' => 'Rian Hidayat'],
                ['id' => 'MECH-02', 'name' => 'Agus Santoso']
            ],
            'requested_spareparts' => [
                ['name' => 'Shell Advance Scooter Matic', 'qty' => 1, 'price' => '45.000'],
                ['name' => 'Oil Filter Avanza', 'qty' => 1, 'price' => '35.000']
            ],
            'review' => [
                'rating' => 5,
                'comment' => 'Pengerjaan sangat rapi dan cepat. Mesin jadi lebih halus.'
            ]
        ],
        [
            'id' => 'SRV-20260522-05',
            'service_id' => 'SVC-90123',
            'customer' => [
                'id' => 'CUST-005',
                'name' => 'Andi Wijaya',
                'image' => 'https://i.pravatar.cc/150?u=CUST-005'
            ],
            'type' => 'Full Tune Up',
            'date' => '22 May 2026',
            'time' => '14:15 WIB',
            'vehicle' => 'B 1234 ABC - Honda Vario 150',
            'status' => 'Success',
            'status_color' => 'bg-green-500',
            'price' => '85.000',
            'image' => 'images/servicecategory/Icon Tune Up.webp',
            'category' => 'Tune Up',
            'mechanics' => [
                ['id' => 'MECH-01', 'name' => 'Rian Hidayat']
            ],
            'requested_spareparts' => [],
            'review' => null
        ],
        [
            'id' => 'SRV-20260524-10',
            'service_id' => 'SVC-90124',
            'customer' => [
                'id' => 'CUST-010',
                'name' => 'Siti Aminah',
                'image' => 'https://i.pravatar.cc/150?u=CUST-010'
            ],
            'type' => 'CVT Cleaning & Greasing',
            'date' => '24 May 2026',
            'time' => '11:00 WIB',
            'vehicle' => 'B 9988 XYZ - Yamaha NMAX',
            'status' => 'Cancelled',
            'status_color' => 'bg-red-500',
            'price' => '120.000',
            'image' => 'images/servicecategory/Icon Machine Service.webp',
            'category' => 'Machine Service',
            'mechanics' => [
                ['id' => 'MECH-03', 'name' => 'Joko Susilo']
            ],
            'requested_spareparts' => [
                ['name' => 'V-Belt Kit NMAX', 'qty' => 1, 'price' => '150.000']
            ],
            'review' => [
                'rating' => 4,
                'comment' => 'Cukup memuaskan, tarikan motor jadi enteng lagi.'
            ]
        ]
    ];

    $sparepartsData = [
      ['id' => 'SP-4101', 'name' => 'Shell Advance Scooter Matic 10W-30', 'category' => 'Oil and Fluid', 'stock' => 14, 'price' => '45.000', 'img' => 'https://images.unsplash.com/photo-1635848600713-731383794178?q=80&w=100'],
      ['id' => 'SP-4102', 'name' => 'Federal Oil Matic 10W-40 0.8L', 'category' => 'Oil and Fluid', 'stock' => 25, 'price' => '42.000', 'img' => 'https://images.unsplash.com/photo-1629739947384-247a1656b9f8?q=80&w=100'],
      ['id' => 'SP-4201', 'name' => 'Brake Pad Set Front NMAX', 'category' => 'Brake System', 'stock' => 8, 'price' => '75.000', 'img' => 'https://images.unsplash.com/photo-1578844251758-2f71da64c96f?q=80&w=100'],
      ['id' => 'SP-4301', 'name' => 'V-Belt Kit Honda Vario 125', 'category' => 'Engine Parts', 'stock' => 5, 'price' => '185.000', 'img' => 'https://images.unsplash.com/photo-1625047509168-a7026f36de04?q=80&w=100'],
      ['id' => 'SP-4401', 'name' => 'Spark Plug NGK CR7E', 'category' => 'Engine Parts', 'stock' => 30, 'price' => '15.000', 'img' => 'https://images.unsplash.com/photo-1618335829837-2286fb274c5b?q=80&w=100']
    ];
  @endphp

  @include('layouts.navbarmechanic')
  @include('layouts.modals')

  <!-- HEADER -->
  <x-header 
    title="Service History" 
    image="images/backgroundbooking.webp" 
  />

  <main class="max-w-7xl mx-auto py-12 px-4 md:px-8 w-full flex-1">
    <div class="flex flex-col lg:flex-row gap-8">
      
      <!-- Sidebar Categories -->
      <aside class="w-full lg:w-64 shrink-0">
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
          <div class="px-5 py-4 border-b border-gray-100">
            <h3 class="text-base font-bold text-gray-700 font-century uppercase tracking-widest">Service Categories</h3>
          </div>
          <div class="p-2 space-y-1">
            <button onclick="filterByCategory('all', this)" class="category-btn w-full font-century text-left px-4 py-2.5 rounded-lg bg-gray-100 text-mm-navy font-bold text-sm transition-colors">All Services</button>
            <button onclick="filterByCategory('Oil Service', this)" class="category-btn w-full font-century text-left px-4 py-2.5 rounded-lg hover:bg-gray-50 text-gray-500 font-medium text-sm transition-colors">Oil Service</button>
            <button onclick="filterByCategory('Tune Up', this)" class="category-btn w-full font-century text-left px-4 py-2.5 rounded-lg hover:bg-gray-50 text-gray-500 font-medium text-sm transition-colors">Tune Up</button>
            <button onclick="filterByCategory('Machine Service', this)" class="category-btn w-full font-century text-left px-4 py-2.5 rounded-lg hover:bg-gray-50 text-gray-500 font-medium text-sm transition-colors">Machine Service</button>
          </div>
        </div>
      </aside>

      <!-- Main Content -->
      <div class="flex-1 space-y-6">
        
        <!-- Search and Filters -->
        <div class="space-y-4">
          <div class="flex flex-col md:flex-row gap-4 text-left">
            <div class="relative flex-1">
              <input type="text" id="searchInput" placeholder="Search service ID or vehicle..." class="w-full pl-5 pr-12 py-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-mm-navy/10 outline-none text-sm font-medium font-didact">
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
            <button onclick="filterByStatus('all', this)" class="status-btn px-5 py-2 rounded-full border border-mm-navy bg-blue-50 text-mm-navy text-sm font-didact font-bold">All Status</button>
            <button onclick="filterByStatus('Success', this)" class="status-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-didact hover:border-mm-navy transition-colors">Success</button>
            <button onclick="filterByStatus('Processing', this)" class="status-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-didact hover:border-mm-navy transition-colors">Processing</button>
            <button onclick="filterByStatus('Cancelled', this)" class="status-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-didact hover:border-mm-navy transition-colors">Cancelled</button>
          </div>
        </div>

        <!-- Service Cards -->
        <div class="space-y-6" id="serviceCardsContainer">
          @foreach($services as $service)
            <div data-category="{{ $service['category'] }}" 
                 data-status="{{ $service['status'] }}"
                 data-date="{{ date('Y-m-d', strtotime($service['date'])) }}"
                 data-search="{{ strtolower($service['service_id'] . ' ' . $service['vehicle'] . ' ' . $service['customer']['name']) }}"
                 onclick='showServiceDetail(@json($service))' 
                 class="service-card group bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-all cursor-pointer text-left">
              
              <!-- Header Row -->
              <div class="px-6 py-3 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                <div class="flex items-center gap-3">
                  <img src="images/repairing-icon.webp" class="h-4 w-4 object-contain" alt="Service">
                  <span class="text-sm font-medium text-black font-century tracking-wider">{{ $service['service_id'] }}</span>
                  <div class="w-1.5 h-1.5 rounded-full bg-gray-300"></div>
                  <span class="text-sm font-medium text-[#15395c] font-century">{{ $service['type'] }}</span>
                  <div class="w-1.5 h-1.5 rounded-full bg-gray-300"></div>
                  <span class="text-sm font-medium text-[#924e24] font-century">{{ $service['date'] }}</span>
                </div>
                <span class="px-3 py-1 {{ $service['status_color'] }} text-white text-[10px] font-black uppercase rounded-md tracking-wider">
                  {{ $service['status'] }}
                </span>
              </div>

              <!-- Body Items -->
              <div class="px-6 py-5 flex items-center justify-between">
                <div class="flex items-center gap-4">
                  <div class="w-14 h-14 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-50 transition-colors">
                    <img src="{{ $service['image'] }}" class="h-10 w-10 object-contain opacity-80" alt="{{ $service['type'] }}">
                  </div>
                  <div>
                    <p class="font-bold text-gray-800 text-lg font-albert">{{ $service['vehicle'] }}</p>
                    <div class="flex items-center gap-2 mt-1">
                      <div class="w-2 h-2 rounded-full bg-green-500"></div>
                      <p class="text-sm text-gray-500 font-medium font-century">Customer: <span class="text-mm-navy font-bold">{{ $service['customer']['name'] }}</span></p>
                    </div>
                  </div>
                </div>
                <p class="font-bold text-[#e67e22] text-xl font-albert uppercase tracking-tighter">IDR {{ $service['price'] }}</p>
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
    const sparepartsData = @json($sparepartsData);

    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#dateRangeBtn", {
            mode: "range",
            dateFormat: "Y-m-d",
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    startDate = selectedDates[0];
                    endDate = selectedDates[1];
                    const startFmt = instance.formatDate(startDate, "d M Y");
                    const endFmt = instance.formatDate(endDate, "d M Y");
                    document.getElementById('dateRangeLabel').textContent = `${startFmt} - ${endFmt}`;
                } else if (selectedDates.length === 0) {
                    startDate = null;
                    endDate = null;
                    document.getElementById('dateRangeLabel').textContent = "Select Date Range";
                }
                applyFilters();
            }
        });

        document.getElementById('searchInput').addEventListener('input', applyFilters);
    });

    function applyFilters() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const cards = document.querySelectorAll('.service-card');
        
        cards.forEach(card => {
            const category = card.getAttribute('data-category');
            const status = card.getAttribute('data-status');
            const dateStr = card.getAttribute('data-date');
            const cardDate = new Date(dateStr);
            const searchContent = card.getAttribute('data-search');

            let categoryMatch = (currentCategory === 'all' || category === currentCategory);
            let statusMatch = (currentStatus === 'all' || status === currentStatus);
            let searchMatch = searchContent.includes(searchTerm);
            let dateMatch = true;

            if (startDate && endDate) {
                const checkDate = new Date(cardDate.getFullYear(), cardDate.getMonth(), cardDate.getDate());
                const sDate = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate());
                const eDate = new Date(endDate.getFullYear(), endDate.getMonth(), endDate.getDate());
                dateMatch = checkDate >= sDate && checkDate <= eDate;
            }

            if (categoryMatch && statusMatch && searchMatch && dateMatch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function filterByStatus(status, btn) {
        currentStatus = status;
        document.querySelectorAll('.status-btn').forEach(el => {
            el.classList.remove('border-mm-navy', 'bg-blue-50', 'text-mm-navy', 'font-bold');
            el.classList.add('border-gray-300', 'bg-white', 'text-gray-500');
        });
        btn.classList.add('border-mm-navy', 'bg-blue-50', 'text-mm-navy', 'font-bold');
        btn.classList.remove('border-gray-300', 'bg-white', 'text-gray-500');
        applyFilters();
    }

    function filterByCategory(category, btn) {
        currentCategory = category;
        document.querySelectorAll('.category-btn').forEach(el => {
            el.classList.remove('bg-gray-100', 'text-mm-navy', 'font-bold');
            el.classList.add('hover:bg-gray-50', 'text-gray-500', 'font-medium');
        });
        btn.classList.add('bg-gray-100', 'text-mm-navy', 'font-bold');
        btn.classList.remove('hover:bg-gray-50', 'text-gray-500', 'font-medium');
        applyFilters();
    }

    function showServiceDetail(service) {
        let reviewHtml = '';
        if (service.status === 'Success' && service.review) {
            reviewHtml = `
                <div class="mt-6 p-4 bg-yellow-50 rounded-2xl border border-yellow-100">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs font-black uppercase text-yellow-700 tracking-widest font-century">Customer Review</span>
                        <div class="flex gap-0.5 text-yellow-400">
                            ${'★'.repeat(service.review.rating)}${'☆'.repeat(5-service.review.rating)}
                        </div>
                    </div>
                    <p class="text-sm text-gray-700 italic font-medium">"${service.review.comment}"</p>
                </div>
            `;
        }

        let sparepartsHtml = '';
        if (service.requested_spareparts && service.requested_spareparts.length > 0) {
            sparepartsHtml = `
                <div class="mt-8">
                    <p class="text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] font-century mb-4">Spareparts Used (Requested)</p>
                    <div class="space-y-3">
                        ${service.requested_spareparts.map(sp => `
                            <div class="flex items-center justify-between p-3 bg-blue-50/50 rounded-xl border border-blue-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-sm border border-gray-100">
                                        <svg class="w-4 h-4 text-mm-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-800 font-albert">${sp.name}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs font-black text-mm-navy font-century">${sp.qty} Unit</p>
                                    <p class="text-[10px] text-gray-400 font-bold font-century">IDR ${sp.price}</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
        }

        let mechanicsHtml = `
            <div class="mt-8 pt-6 border-t border-gray-100">
                <p class="text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] font-century mb-4">Assigned Mechanics</p>
                <div class="grid grid-cols-2 gap-3">
                    ${service.mechanics.map(m => `
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="w-10 h-10 rounded-full bg-mm-navy flex items-center justify-center text-white font-bold text-xs">
                                ${m.name.split(' ').map(n=>n[0]).join('')}
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-900 font-albert">${m.name}</p>
                                <p class="text-[10px] text-gray-400 font-bold font-century">ID: ${m.id}</p>
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;

        Swal.fire({
            width: '600px',
            padding: '2rem',
            showConfirmButton: false,
            showCloseButton: true,
            html: `
                <div class="text-left font-didact">
                    <div class="flex items-center gap-3 mb-6">
                        <h2 class="text-2xl font-black text-mm-navy font-century uppercase tracking-tight">Service Detail</h2>
                        <span class="px-3 py-1 ${service.status_color} text-white text-[10px] font-black uppercase rounded-md tracking-wider">
                            ${service.status}
                        </span>
                    </div>
                    
                    <!-- Customer & Transaction Info -->
                    <div class="flex items-start justify-between mb-8 pb-6 border-b border-gray-100">
                        <div class="flex items-center gap-4">
                            <img src="${service.customer.image}" class="w-14 h-14 rounded-full border-2 border-white shadow-md object-cover">
                            <div>
                                <p class="text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] font-century mb-0.5">Customer</p>
                                <p class="text-lg font-bold text-gray-900 font-albert">${service.customer.name}</p>
                                <p class="text-xs font-bold text-mm-navy font-century uppercase opacity-60">ID: ${service.customer.id}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] font-century mb-0.5">Date & ID</p>
                            <p class="text-sm font-bold text-gray-900 font-albert">${service.date}</p>
                            <p class="text-xs font-bold text-mm-navy font-century">${service.service_id}</p>
                        </div>
                    </div>

                    <!-- Service Item -->
                    <div class="space-y-4">
                        <p class="text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] font-century mb-2">Work Performed</p>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm">
                                    <img src="${service.image}" class="h-8 w-8 object-contain">
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 font-albert">${service.type}</p>
                                    <p class="text-xs text-mm-navy font-medium font-century">${service.vehicle}</p>
                                </div>
                            </div>
                            <p class="font-bold text-mm-navy font-albert">IDR ${service.price}</p>
                        </div>
                    </div>

                    <!-- Spareparts Section -->
                    ${sparepartsHtml}

                    <!-- Mechanics Section -->
                    ${mechanicsHtml}

                    <!-- Review Section -->
                    ${reviewHtml}
                </div>
            `
        });
    }

    // Modal Qty Controls (Hanya untuk referensi/jika dibutuhkan di modal lain, di history sudah tidak ada tombol request)
    function incrementQtyModal(id, stock) {
        const input = document.getElementById(`qty-${id}`);
        if (input && parseInt(input.value) < stock) {
            input.value = parseInt(input.value) + 1;
        } else {
            Swal.showValidationMessage('Maximum stock reached');
            setTimeout(() => Swal.resetValidationMessage(), 1500);
        }
    }

    function decrementQtyModal(id) {
        const input = document.getElementById(`qty-${id}`);
        if (input && parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
  </script>

  @include('layouts.footer')

</body>
</html>