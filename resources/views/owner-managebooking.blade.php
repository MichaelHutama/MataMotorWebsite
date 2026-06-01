<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MATA MOTOR - Booking Management</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Inter:wght@400;500;600;700;800;900&family=Albert+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<body class="bg-[#f3f4f6] min-h-screen flex flex-col font-didact text-gray-800">

  @php
    $bookings = [
        [
            'id' => 'Q-OLI-15-260716',
            'code' => 'Q-OLI-15-260716',
            'type' => 'Oil and Filter Replacement',
            'customer' => 'Mulyono',
            'customer_code' => 'C-532',
            'plate' => 'B 2023 GGF',
            'vehicle_name' => 'Yamaha NMAX',
            'description' => 'Request Oli Castrol Power1 10W-40 dan filter oli original',
            'booking_time' => '26 July 2026; 16.30',
            'icon' => 'images/servicecategory/Icon Oil Service.webp',
            'status' => 'pending' 
        ],
        [
            'id' => 'Q-TUN-12-260717',
            'code' => 'Q-TUN-12-260717',
            'type' => 'Full Tune Up',
            'customer' => 'Budi',
            'customer_code' => 'C-104',
            'plate' => 'B 1234 ABC',
            'vehicle_name' => 'Honda Vario 150',
            'description' => 'Tarikan motor kurang responsif, tolong bersihkan throttle body',
            'booking_time' => '27 July 2026; 10.00',
            'icon' => 'images/servicecategory/Icon Tune Up.png',
            'status' => 'pending'
        ],
        [
            'id' => 'Q-CVT-08-260718',
            'code' => 'Q-CVT-08-260718',
            'type' => 'CVT Cleaning & Greasing',
            'customer' => 'Slamet',
            'customer_code' => 'C-215',
            'plate' => 'B 5678 XYZ',
            'vehicle_name' => 'Honda Beat',
            'description' => 'Ada bunyi berdecit di bagian CVT saat akselerasi awal',
            'booking_time' => '28 July 2026; 08.30',
            'icon' => 'images/servicecategory/Icon CVT.webp',
            'status' => 'pending'
        ],
        [
            'id' => 'Q-BRA-21-260719',
            'code' => 'Q-BRA-21-260719',
            'type' => 'Brake System Service',
            'customer' => 'Ani',
            'customer_code' => 'C-089',
            'plate' => 'B 9012 DEF',
            'vehicle_name' => 'Suzuki GSX-R150',
            'description' => 'Minta ganti kampas rem depan belakang dan kuras minyak rem',
            'booking_time' => '29 July 2026; 13.00',
            'icon' => 'images/servicecategory/Icon Brake Service.png',
            'status' => 'pending'
        ],
    ];
  @endphp

  @include('layouts.navbarowner')
  @include('layouts.modals')
  @include('layouts.modalowner')

  <x-header 
    title="Booking Management" 
    image="{{ asset('images/backgroundownermechanic.jpg') }}"
    />

  <main class="flex-1 max-w-screen-2xl mx-auto w-full px-20 md:px-40 py-10">
    
    <div class="flex items-center justify-between mb-10">
      <h3 class="text-2xl font-black text-mm-navy uppercase tracking-widest font-century">Booking to be Confirmed</h3>
    </div>

    <!-- Booking Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
      @foreach($bookings as $booking)
        <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-8 flex flex-col items-center group hover:shadow-xl transition-all relative overflow-hidden">
          
          <!-- Clickable Content Area (Opens details modal) -->
          <div class="w-full flex flex-col items-center cursor-pointer relative z-10" 
               onclick="showBookingDetail('{{ $booking['code'] }}', '{{ $booking['type'] }}', '{{ $booking['vehicle_name'] }} ({{ $booking['plate'] }})', '{{ $booking['booking_time'] }}', '{{ $booking['description'] }}', null, '{{ $booking['customer'] }}', '{{ $booking['customer_code'] }}')">
            <!-- Decoration -->
            <div class="absolute -top-12 -right-12 w-24 h-24 bg-gray-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            
            <x-booking-card-content :booking="$booking" :hideStatus="true" />
          </div>

          <!-- Actions Area (Completely separate from card onclick) -->
          <div class="mt-5 flex gap-3 w-full relative z-20">
            <button onclick="confirmModal('Confirm Reject', 'Are you sure you want to reject this booking?', 'REJECT', 'CANCEL', 'warning', function() { showSuccessModal('Booking rejected'); })" 
                    class="font-century flex-1 py-3 rounded-2xl border-2 bg-red-500 text-white font-bold text-xs uppercase tracking-widest hover:bg-red-700 hover:text-white transition-all">
              Reject
            </button>
            <button onclick='showConfirmBookingAlert(@json($booking))' 
                    class="font-century flex-1 py-3 rounded-2xl bg-mm-navy text-white font-bold text-xs uppercase tracking-widest hover:bg-[#1c4974] transition-all shadow-lg shadow-mm-navy/20">
              Confirm
            </button>
          </div>
        </div>
      @endforeach
    </div>

  </main>

</body>
</html>



<script>
window.selectedMechanics = [];

function showConfirmBookingAlert(booking) {
  // Reset selection
  window.selectedMechanics = [];

  // Data Dummy Mekanik
  const mechanics = [
    { id: "MEC-1", name: "Supriadi" },
    { id: "MEC-2", name: "Ahmad Dani" },
    { id: "MEC-3", name: "Budi Santoso" },
    { id: "MEC-4", name: "Budi Santoso" },
    { id: "MEC-5", name: "Budi Santoso" },
    { id: "MEC-6", name: "Budi Santoso" },
    { id: "MEC-7", name: "Budi Santoso" },
    { id: "MEC-8", name: "Budi Santoso" },
    { id: "MEC-9", name: "Budi Santoso" },
    { id: "MEC-10", name: "Budi Santoso" },
  ];

  // Generate item dropdown kustom
  let dropdownItemsHtml = '';
  mechanics.forEach(mec => {
    dropdownItemsHtml += `
      <div class="flex items-center justify-between p-4 hover:bg-neutral-50 cursor-pointer transition-colors border-b border-neutral-100 last:border-0 text-left"
           onclick="selectMechanic('${mec.id}', '${mec.name}')">
        <div class="font-['Didact_Gothic'] text-[15px] text-neutral-800 select-none">
          <strong class="font-bold text-mm-navy">${mec.id}</strong> - <span class="italic text-neutral-500">${mec.name}</span>
        </div>
        <input type="checkbox" id="check-${mec.id}" class="w-5 h-5 rounded border-gray-300 cursor-pointer" 
               style="accent-color:#15395c;" onclick="event.stopPropagation(); selectMechanic('${mec.id}', '${mec.name}')">
      </div>
    `;
  });

  // HANYA MENAMPILKAN JUDUL, DROPDOWN, DAN TOMBOL
  const contentHtml = `
    <div class="p-2">
      <div class="text-center mb-6" 
           style="font-family:'Century Gothic'; font-weight:bold; font-size:36px; color:#000000; line-height: 1.2;">
        Assign Mechanic
      </div>

      <div class="mb-6 text-left relative" style="font-family:'Didact Gothic'; font-size:15px; color:#000000;">
        <label class="block mb-2">Choose Mechanics</label>
        <div id="customSelectTrigger" 
             class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white cursor-pointer flex justify-between items-center select-none"
             style="font-size:15px;"
             onclick="toggleCustomDropdown()">
          <span id="selectedMechanicText" class="text-neutral-400">Choose your Mechanic...</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-neutral-400 transition-transform duration-200" id="dropdownArrow">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </div>

        <input type="hidden" id="hiddenMechanicInput" value="">

        <div id="customDropdownMenu" 
             class="hidden absolute z-50 left-0 right-0 mt-1 bg-white border border-gray-200 rounded-xl shadow-xl max-h-[200px] overflow-y-auto">
          ${dropdownItemsHtml}
        </div>
      </div>

      <div id="errorValMessage" class="text-red-500 text-base mb-1 hidden text-left" style="font-family:'Century Gothic';"></div>

      <div class="flex justify-center space-x-4 mt-6">
        <button class="w-32 py-2.5 rounded-full border border-mm-navy text-mm-navy font-bold text-lg font-didact transition-all hover:bg-gray-50"
                onclick="Swal.close()">Cancel</button>
        <button class="w-32 py-2.5 rounded-full bg-mm-navy text-white font-bold text-lg font-didact shadow-lg hover:bg-opacity-90 transition-all"
                onclick="submitAssign()">Add</button>
      </div>
    </div>
  `;

  Swal.fire({
    html: contentHtml,
    showConfirmButton: false,
    showCancelButton: false,
    width: '450px', // DIUBAH: Dari 70% menjadi 450px agar ukuran modal pas (tidak terlalu lebar)
    customClass: {
      popup: "rounded-[20px] p-6 shadow-2xl"
    },
    didOpen: () => {
      document.addEventListener('click', closeDropdownOutside);
    },
    willClose: () => {
      document.removeEventListener('click', closeDropdownOutside);
    }
  });
}

// 1. Fungsi Buka/Tutup List Dropdown
function toggleCustomDropdown() {
  const menu = document.getElementById('customDropdownMenu');
  const arrow = document.getElementById('dropdownArrow');
  
  if (menu.classList.contains('hidden')) {
    menu.classList.remove('hidden');
    arrow.classList.add('rotate-180');
  } else {
    menu.classList.add('hidden');
    arrow.classList.remove('rotate-180');
  }
}

// 2. Fungsi Ketika Salah Satu Mekanik Dipilih (Multi Selection)
function selectMechanic(id, name) {
  const checkbox = document.getElementById(`check-${id}`);
  
  // Mencegah error jika target klik bukan langsung di checkbox
  if (window.event && window.event.target !== checkbox) {
    checkbox.checked = !checkbox.checked;
  }
  
  const index = window.selectedMechanics.findIndex(m => m.id === id);
  if (checkbox.checked) {
    if (index === -1) {
      window.selectedMechanics.push({ id, name });
    }
  } else {
    if (index > -1) {
      window.selectedMechanics.splice(index, 1);
    }
  }
  
  // Update teks pemicu dropdown (hanya menampilkan nama yang dipisah koma)
  const triggerText = document.getElementById('selectedMechanicText');
  if (window.selectedMechanics.length > 0) {
    triggerText.innerText = window.selectedMechanics.map(m => m.name).join(', ');
    triggerText.classList.remove('italic', 'text-neutral-400');
    triggerText.classList.add('text-neutral-800');
    document.getElementById('hiddenMechanicInput').value = window.selectedMechanics.map(m => m.id).join(',');
  } else {
    triggerText.innerText = 'Choose your Mechanic...';
    triggerText.classList.add('italic', 'text-neutral-400');
    triggerText.classList.remove('text-neutral-800');
    document.getElementById('hiddenMechanicInput').value = '';
  }
}

// 3. Fungsi Pengaman untuk Menutup Dropdown jika klik di luar area
function closeDropdownOutside(e) {
  const menu = document.getElementById('customDropdownMenu');
  const arrow = document.getElementById('dropdownArrow');
  const trigger = document.getElementById('customSelectTrigger');
  
  if (menu && !menu.contains(e.target) && trigger && !trigger.contains(e.target)) {
    menu.classList.add('hidden');
    arrow.classList.remove('rotate-180');
  }
}

// 4. Submit Assignment
function submitAssign() {
  const selectedValue = document.getElementById('hiddenMechanicInput').value;
  const errorValMessage = document.getElementById('errorValMessage');
  
  if (!selectedValue) {
    if (errorValMessage) {
      errorValMessage.textContent = 'Please select at least one mechanic first!';
      errorValMessage.classList.remove('hidden');
    }
    return;
  }
  
  if (errorValMessage) {
    errorValMessage.classList.add('hidden');
  }

  Swal.close();
  setTimeout(() => {
    showSuccessModal("Booking confirmed!");
  }, 200);
}
</script>

</body>
</html>
