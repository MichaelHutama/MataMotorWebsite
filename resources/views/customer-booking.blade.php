<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor - Service Booking</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Inter:wght@400;500;600;700;800&family=Albert+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            'albert': ['"Albert Sans"', 'sans-serif'],
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col font-didact text-gray-800">

  @include('layouts.navbarcustomer')
  @include('layouts.modals')
  @include('layouts.modalcustomer')

  @php
    $bookings = [
        [
            'id' => 1,
            'code' => 'OLI-15-260716',
            'type' => 'Oil & Filter Replacement',
            'vehicle' => 'B 2023 GGF — Yamaha XX',
            'status' => 'pending', // pending, waiting, processing, finished, cancelled
            'time' => '26 July 2026; 16.30',
            'notes' => 'Request Oli Castrol'
        ],
        [
            'id' => 2,
            'code' => 'WSH-02-270816',
            'type' => 'Wash and Detailing',
            'vehicle' => 'B 2024 ABC — Honda Vario',
            'status' => 'waiting',
            'queue' => 3,
            'time' => '27 Aug 2026; 10.00',
            'notes' => 'Extra clean on engine area'
        ],
        [
            'id' => 3,
            'code' => 'SPR-09-281016',
            'type' => 'Emergency Service',
            'vehicle' => 'B 2025 ZZZ — Toyota Avanza',
            'status' => 'processing',
            'time' => '28 Oct 2026; 14.00',
            'notes' => 'Tire burst on highway'
        ],
        [
            'id' => 4,
            'code' => 'OLI-10-291116',
            'type' => 'Tire Service',
            'vehicle' => 'B 2023 GGF — Yamaha XX',
            'status' => 'finished',
            'time' => '29 Nov 2026; 09.00',
            'notes' => 'Regular tire check'
        ],
    ];
  @endphp

  <!-- Section Header -->
    <!--HEADER-->
    <x-header 
        title="Service Booking" 
        image="images/backgroundbooking.webp" 
    />

  <!-- Main -->
  <main class="max-w-7xl mx-auto py-12 px-4 md:px-8 w-full flex-1">

    <!-- Add Booking Icon -->
    <div class="flex flex-col items-center mb-12">
      <div id="addBookingBtn" 
           class="w-20 h-20 rounded-full bg-mm-navy flex items-center justify-center shadow-xl shadow-blue-900/20 cursor-pointer hover:scale-105 transition-all text-white border-4">
        <span class="text-4xl font-bold">+</span>
      </div>
      <p class="mt-3 text-[#15395c] font-bold tracking-widest text-lg font-century">Add Booking</p>
    </div>

    <!-- Ongoing Booking -->
    <div class="mb-16">
        <div class="flex justify-between items-end mb-8 border-b border-gray-100 pb-4">
            <h2 class="text-2xl font-black text-mm-navy font-inter tracking-wide uppercase">Ongoing Booking</h2>
            <button onclick="toggleHistory()" id="historyToggleBtn" class="text-sm font-semibold text-[#2159e7] tracking-widest hover:underline">Show Booking History</button>
        </div>

        <!-- Booking Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @php $hasOngoing = false; @endphp
            @foreach($bookings as $booking)
                @if(in_array($booking['status'], ['pending', 'waiting', 'processing']))
                @php $hasOngoing = true; @endphp
                <div onclick="showBookingDetail('{{ $booking['code'] }}', '{{ $booking['type'] }}', '{{ $booking['vehicle'] }}', '{{ $booking['time'] }}', '{{ $booking['notes'] }}', '{{ $booking['status'] }}')"
                    class="bg-white rounded-4xl shadow-sm border border-gray-100 p-8 text-center space-y-6 cursor-pointer hover:shadow-xl hover:shadow-blue-900/5 transition-all group relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 left-0 w-full h-1 bg-mm-navy scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                    
                    @include('components.booking-card-content', ['booking' => $booking])
                </div>
                @endif
            @endforeach

            @if(!$hasOngoing)
                <div class="col-span-full py-12 text-center bg-white rounded-[32px] border border-dashed border-gray-200">
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-xs italic">No ongoing bookings found.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Booking History Section (Hidden by Default) -->
    <div id="historySection" class="hidden animate-in fade-in slide-in-from-bottom-4 duration-500">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 border-b border-gray-100 pb-4 gap-4">
            <div class="space-y-4 w-full md:w-auto">
                <h2 class="text-2xl font-black text-mm-navy font-inter tracking-tight uppercase">Booking History</h2>
                <div class="relative inline-block w-full md:w-64">
                    <select id="statusFilter" onchange="filterHistory()" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-xs font-bold uppercase tracking-widest text-mm-navy focus:ring-2 focus:ring-mm-navy/10 focus:border-mm-navy outline-none appearance-none cursor-pointer">
                        <option value="all">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="waiting">Waiting</option>
                        <option value="processing">Processing</option>
                        <option value="finished">Finished</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- History Cards -->
        <div id="historyCardsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @php $hasHistory = false; @endphp
            @foreach($bookings as $booking)
                @php $hasHistory = true; @endphp
                <div data-status="{{ $booking['status'] }}"
                     onclick="showBookingDetail('{{ $booking['code'] }}', '{{ $booking['type'] }}', '{{ $booking['vehicle'] }}', '{{ $booking['time'] }}', '{{ $booking['notes'] }}', '{{ $booking['status'] }}')"
                     class="history-card bg-white rounded-[32px] shadow-sm border border-gray-100 p-8 text-center space-y-6 cursor-pointer hover:shadow-xl hover:shadow-blue-900/5 transition-all group relative overflow-hidden flex flex-col justify-between opacity-80 hover:opacity-100">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gray-200 group-hover:bg-mm-navy scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                    
                    @include('components.booking-card-content', ['booking' => $booking])
                </div>
            @endforeach

            @if(!$hasHistory)
                <div class="col-span-full py-12 text-center">
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] italic">No booking history available.</p>
                </div>
            @endif
        </div>
    </div>
  </main>

  <!-- Script SweetAlert2 -->
  <script>
    function toggleHistory() {
        const historySection = document.getElementById('historySection');
        const toggleBtn = document.getElementById('historyToggleBtn');
        
        if (historySection.classList.contains('hidden')) {
            historySection.classList.remove('hidden');
            toggleBtn.innerText = 'Hide Booking History';
            // Scroll smooth to history
            historySection.scrollIntoView({ behavior: 'smooth' });
        } else {
            historySection.classList.add('hidden');
            toggleBtn.innerText = 'Show Booking History';
        }
    }

    function filterHistory() {
        const filterValue = document.getElementById('statusFilter').value;
        const cards = document.querySelectorAll('.history-card');
        
        cards.forEach(card => {
            if (filterValue === 'all' || card.getAttribute('data-status') === filterValue) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function confirmCancel(code) {
        confirmDelete('Booking', `Are you sure you want to cancel booking ${code}? This action cannot be undone.`);
    }

    function handleBookingSubmit() {
        Swal.close();
        if (typeof showSuccessModal === 'function') {
            showSuccessModal('Booking Added Successfully!');
        }
    }

    // Popup Add Booking
    document.getElementById("addBookingBtn").addEventListener("click", () => {
      Swal.fire({
        title: '<span class="font-century text-[34px] leading-none font-bold text-black pt-8">Add Booking</span>',
        html: `
          <div class="space-y-5 text-[15px] text-black text-left font-didact pt-4 px-8 pb-4">
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="font-normal text-left">Vehicle</label>
                    <button type="button" id="addNewVehicleBtn" class="text-[12px] font-bold text-mm-navy hover:underline">+ Add New Vehicle</button>
                </div>
                <div class="relative">
                    <input id="vehicleInput" type="hidden" value="">
                    <button type="button" id="vehicleButton" class="flex h-[42px] w-full items-center justify-between rounded-[10px] border border-gray-500 bg-white px-4 text-left text-[15px] text-gray-500 outline-none transition-colors hover:border-mm-navy focus:border-mm-navy focus:ring-1 focus:ring-mm-navy">
                        <span id="vehicleLabel">Choose your Vehicle</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="vehicleMenu" class="absolute left-0 top-full z-20 mt-2 hidden w-full overflow-hidden rounded-[14px] border border-gray-200 bg-white shadow-[0_12px_30px_rgba(0,0,0,0.12)]">
                        <button type="button" data-vehicle-option="B 2026 ABC — Honda Vario 150" class="block w-full px-4 py-3 text-left text-[15px] text-gray-700 transition-colors hover:bg-[#eef4fb] hover:text-[#15395c]">B 2026 ABC — Honda Vario 150</button>
                        <button type="button" data-vehicle-option="B 3433 NNN — Avanza Toyota" class="block w-full px-4 py-3 text-left text-[15px] text-gray-700 transition-colors hover:bg-[#eef4fb] hover:text-[#15395c]">B 3433 NNN — Avanza Toyota</button>
                    </div>
                </div>
            </div>

            <div>
                <label class="block mb-2 font-normal text-left">Service Type</label>
                <div class="relative">
                    <input id="serviceTypeInput" type="hidden" value="">
                    <button type="button" id="serviceTypeButton" class="flex h-[42px] w-full items-center justify-between rounded-[10px] border border-gray-500 bg-white px-4 text-left text-[15px] text-gray-500 outline-none transition-colors hover:border-mm-navy focus:border-mm-navy focus:ring-1 focus:ring-mm-navy">
                        <span id="serviceTypeLabel">Choose service type</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="serviceTypeMenu" class="absolute left-0 top-full z-20 mt-2 hidden w-full overflow-hidden rounded-[14px] border border-gray-200 bg-white shadow-[0_12px_30px_rgba(0,0,0,0.12)]">
                        <button type="button" data-service-option="Oil & Filter Replacement" class="block w-full px-4 py-3 text-left text-[15px] text-gray-700 transition-colors hover:bg-[#eef4fb] hover:text-[#15395c]">Oil & Filter Replacement</button>
                        <button type="button" data-service-option="Tune Up" class="block w-full px-4 py-3 text-left text-[15px] text-gray-700 transition-colors hover:bg-[#eef4fb] hover:text-[#15395c]">Tune Up</button>
                        <button type="button" data-service-option="Machine Service" class="block w-full px-4 py-3 text-left text-[15px] text-gray-700 transition-colors hover:bg-[#eef4fb] hover:text-[#15395c]">Machine Service</button>
                        <button type="button" data-service-option="Wash & Detailing" class="block w-full px-4 py-3 text-left text-[15px] text-gray-700 transition-colors hover:bg-[#eef4fb] hover:text-[#15395c]">Wash & Detailing</button>
                    </div>
                </div>
            </div>

            <div>
                <label class="block mb-2 font-normal text-left">Description</label>
                <textarea id="bookingNotes" class="w-full resize-none rounded-[10px] border border-gray-500 px-4 py-2 text-[15px] text-black outline-none focus:border-mm-navy focus:ring-1 focus:ring-mm-navy bg-white" rows="3" placeholder="Example: Request Spare Part for service"></textarea>
            </div>

            <div>
                <label class="block mb-2 font-normal text-left">Booking Time</label>
                <div class="flex space-x-3">
                    <input id="bookingDate" type="date" class="h-[42px] w-1/2 rounded-[10px] border border-gray-500 px-4 text-[15px] text-black outline-none focus:border-mm-navy focus:ring-1 focus:ring-mm-navy bg-white">
                    <input id="bookingTime" type="time" class="h-[42px] w-1/2 rounded-[10px] border border-gray-500 px-4 text-[15px] text-black outline-none focus:border-mm-navy focus:ring-1 focus:ring-mm-navy bg-white">
                </div>
            </div>
          </div>
        `,
        showConfirmButton: false,
        showCancelButton: false,
        width: 410,
        padding: 0,
        background: '#ffffff',
        heightAuto: false,
        allowOutsideClick: false,
        footer: `
          <div class="mb-10 flex items-center justify-center gap-8 w-full px-10" style="font-family: 'Century Gothic', sans-serif;">
            <button type="button" onclick="Swal.close()" class="min-w-[128px] rounded-[30px] border-2 border-[#15395c] px-6 py-2.5 text-[15px] font-bold text-[#15395c] transition-colors hover:bg-[#f4f7fb]">Cancel</button>
            <button type="button" onclick="handleBookingSubmit()" class="min-w-[128px] rounded-[30px] bg-[#15395c] px-6 py-2.5 text-[15px] font-bold text-white transition-colors hover:bg-[#1c4974]">Add</button>
          </div>
        `,
        customClass: {
          popup: '!rounded-[30px] !p-0 !overflow-hidden',
          htmlContainer: '!m-0 !p-0'
        },
        didOpen: () => {
            const addBtn = document.getElementById('addNewVehicleBtn');
            const vehicleButton = document.getElementById('vehicleButton');
            const vehicleMenu = document.getElementById('vehicleMenu');
            const vehicleLabel = document.getElementById('vehicleLabel');
            const vehicleInput = document.getElementById('vehicleInput');
            const vehicleOptions = document.querySelectorAll('[data-vehicle-option]');

            const serviceButton = document.getElementById('serviceTypeButton');
            const serviceMenu = document.getElementById('serviceTypeMenu');
            const serviceLabel = document.getElementById('serviceTypeLabel');
            const serviceInput = document.getElementById('serviceTypeInput');
            const serviceOptions = document.querySelectorAll('[data-service-option]');

            // Logic Drodown Vehicle
            if (vehicleButton && vehicleMenu) {
                vehicleButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    serviceMenu.classList.add('hidden'); // Tutup yang lain
                    vehicleMenu.classList.toggle('hidden');
                });
            }

            vehicleOptions.forEach(opt => {
                opt.addEventListener('click', () => {
                    const val = opt.getAttribute('data-vehicle-option');
                    vehicleInput.value = val;
                    vehicleLabel.textContent = val;
                    vehicleLabel.classList.remove('text-gray-500');
                    vehicleLabel.classList.add('text-black');
                    vehicleMenu.classList.add('hidden');
                });
            });

            // Logic Dropdown Service
            if (serviceButton && serviceMenu) {
                serviceButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    vehicleMenu.classList.add('hidden'); // Tutup yang lain
                    serviceMenu.classList.toggle('hidden');
                });
            }

            serviceOptions.forEach(opt => {
                opt.addEventListener('click', () => {
                    const val = opt.getAttribute('data-service-option');
                    serviceInput.value = val;
                    serviceLabel.textContent = val;
                    serviceLabel.classList.remove('text-gray-500');
                    serviceLabel.classList.add('text-black');
                    serviceMenu.classList.add('hidden');
                });
            });

            // Klik di luar tutup semua menu
            document.addEventListener('click', () => {
                vehicleMenu?.classList.add('hidden');
                serviceMenu?.classList.add('hidden');
            });

            if (addBtn) {
                addBtn.addEventListener('click', () => {
                    // Simpan state form saat ini
                    const currentForm = {
                        vehicle: vehicleInput.value,
                        vehicleText: vehicleLabel.textContent,
                        serviceType: serviceInput.value,
                        serviceText: serviceLabel.textContent,
                        notes: document.getElementById('bookingNotes').value,
                        date: document.getElementById('bookingDate').value,
                        time: document.getElementById('bookingTime').value
                    };
                    sessionStorage.setItem('pending_booking', JSON.stringify(currentForm));

                    if (typeof addVehicle === 'function') {
                        Swal.close(); 
                        addVehicle();
                        
                        // Deteksi kapan modal add vehicle ditutup
                        const checkClosed = setInterval(() => {
                            if (!Swal.isVisible()) {
                                clearInterval(checkClosed);
                                // Munculkan kembali modal add booking
                                document.getElementById("addBookingBtn").click();
                                
                                // Restore data
                                setTimeout(() => {
                                    const saved = JSON.parse(sessionStorage.getItem('pending_booking'));
                                    if (saved) {
                                        vehicleInput.value = saved.vehicle;
                                        vehicleLabel.textContent = saved.vehicleText;
                                        if(saved.vehicle) {
                                            vehicleLabel.classList.remove('text-gray-500');
                                            vehicleLabel.classList.add('text-black');
                                        }

                                        serviceInput.value = saved.serviceType;
                                        serviceLabel.textContent = saved.serviceText;
                                        if(saved.serviceType) {
                                            serviceLabel.classList.remove('text-gray-500');
                                            serviceLabel.classList.add('text-black');
                                        }

                                        document.getElementById('bookingNotes').value = saved.notes;
                                        document.getElementById('bookingDate').value = saved.date;
                                        document.getElementById('bookingTime').value = saved.time;
                                        sessionStorage.removeItem('pending_booking');
                                    }
                                }, 100);
                            }
                        }, 500);
                    }
                });
            }
        }
      });
    });
  </script>

</body>
</html>
