<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Motor Mechanic Work System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Carlito:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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
                        'albert': ['"Albert Sans"', 'sans-serif'],
                        'century': ['"Century Gothic"', 'AppleGothic', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#e5e7eb] min-h-screen flex flex-col font-didact text-gray-800">

 <!-- Navbar -->
  @include('layouts.navbarmechanic')
  @include('layouts.modals')
  @include('layouts.modalmechanic')

<script>

const sparepartsData = [
  { id: 'SP-4101', name: 'Shell Advance Scooter Matic 10W-30', category: 'Oil and Fluid', stock: 14, price: '45.000', img: 'https://images.unsplash.com/photo-1635848600713-731383794178?q=80&w=100' },
  { id: 'SP-4102', name: 'Federal Oil Matic 10W-40 0.8L', category: 'Oil and Fluid', stock: 25, price: '42.000', img: 'https://images.unsplash.com/photo-1629739947384-247a1656b9f8?q=80&w=100' },
  { id: 'SP-4201', name: 'Brake Pad Set Front NMAX', category: 'Brake System', stock: 8, price: '75.000', img: 'https://images.unsplash.com/photo-1578844251758-2f71da64c96f?q=80&w=100' },
  { id: 'SP-4301', name: 'V-Belt Kit Honda Vario 125', category: 'Engine Parts', stock: 5, price: '185.000', img: 'https://images.unsplash.com/photo-1625047509168-a7026f36de04?q=80&w=100' },
  { id: 'SP-4401', name: 'Spark Plug NGK CR7E', category: 'Engine Parts', stock: 30, price: '15.000', img: 'https://images.unsplash.com/photo-1618335829837-2286fb274c5b?q=80&w=100' }
];

function incrementQty(id) {
    const input = document.getElementById(`qty-${id}`);
    const item = sparepartsData.find(s => s.id === id);
    if (input && item) {
        const currentVal = parseInt(input.value);
        if (currentVal < item.stock) {
            input.value = currentVal + 1;
        } else {
            // Optional: Feedback when stock limit reached
            console.log('Stock limit reached for ' + item.name);
        }
    }
}

function decrementQty(id) {
    const input = document.getElementById(`qty-${id}`);
    if (input && parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}


function filterSparepart(category, btn) {
    // Reset all buttons
    document.querySelectorAll('.sparepart-filter-btn').forEach(b => {
        b.classList.remove('border-mm-navy', 'bg-blue-50', 'text-mm-navy', 'font-bold');
        b.classList.add('border-gray-300', 'bg-white', 'text-gray-500', 'font-medium');
    });
    
    // Active current button
    btn.classList.remove('border-gray-300', 'bg-white', 'text-gray-500', 'font-medium');
    btn.classList.add('border-mm-navy', 'bg-blue-50', 'text-mm-navy', 'font-bold');
    
    console.log('Filtering by:', category);
}

function changePage(page) {
    // Reset all pagination buttons
    document.querySelectorAll('.pagination-btn').forEach(b => {
        b.classList.remove('bg-[#15395C]', 'text-white');
        b.classList.add('bg-white', 'text-gray-500');
    });
    
    // Set active button
    const activeBtn = document.querySelector(`.pagination-btn[data-page="${page}"]`);
    if (activeBtn) {
        activeBtn.classList.remove('bg-white', 'text-gray-500');
        activeBtn.classList.add('bg-[#15395C]', 'text-white');
    }
    
    console.log('Changing to page:', page);
}

function openRequestSparepart(serviceId) {
  Swal.fire({
    width: '1000px',
    title: '<span class="font-century font-extrabold font-black text-[#15395C] text-3xl">Request Sparepart</span>',
    html: `
      <div class="text-left px-2" style="font-family: 'Didact Gothic', sans-serif;">
        <!-- Service ID -->
        <p class="text-sm mb-6 text-center text-black font-century">
            <span class="text-mm-navy">Service ID:</span> ${serviceId}
        </p>

        <!-- Choose Sparepart -->
        <p class="text-mm-navy font-black mb-4 text-lg uppercase tracking-widest font-century">Choose Sparepart</p>
        <div class="relative mb-6">
            <input type="text" placeholder="Search sparepart name or ID..." class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-mm-navy focus:border-mm-navy outline-none text-sm transition-all font-century text-mm-navy">
            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <!-- Filter box -->
        <div class="flex flex-wrap gap-2 mb-8">
            <button onclick="filterSparepart('all', this)" class="sparepart-filter-btn px-5 py-2 rounded-full border border-mm-navy bg-blue-50 text-mm-navy text-sm font-bold transition-all shadow-sm">All</button>
            <button onclick="filterSparepart('Oil and Fluid', this)" class="sparepart-filter-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-medium hover:border-mm-navy transition-all">Oil and Fluid</button>
            <button onclick="filterSparepart('Engine Parts', this)" class="sparepart-filter-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-medium hover:border-mm-navy transition-all">Engine Parts</button>
            <button onclick="filterSparepart('Brake System', this)" class="sparepart-filter-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-medium hover:border-mm-navy transition-all">Brake System</button>
            <button onclick="filterSparepart('Others', this)" class="sparepart-filter-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-medium hover:border-mm-navy transition-all">Others</button>
        </div>

        <!-- Items segment -->
        <div class="border border-gray-100 rounded-[24px] overflow-hidden shadow-sm bg-white">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-gray-50/80 text-[10px] font-black uppercase tracking-widest text-mm-navy/60 border-b border-gray-100/50 text-center font-century">
                <th class="px-4 py-4 text-center">Select</th>
                <th class="px-4 py-4 text-center">Image</th>
                <th class="px-4 py-4 text-center">ID</th>
                <th class="px-6 py-4">Name</th>
                <th class="px-4 py-4 text-center">Category</th>
                <th class="px-4 py-4 text-center">Stock</th>
                <th class="px-4 py-4 text-center">Price</th>
                <th class="px-4 py-4 text-center">Amount</th>
              </tr>
            </thead>
            <tbody>
              ${sparepartsData.map((item) => `
              <tr class="text-sm border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition-colors font-century">
                <!-- Checkbox -->
                <td class="px-4 py-4 text-center">
                  <input type="checkbox" class="w-5 h-5 rounded-lg border-gray-300 text-mm-navy focus:ring-mm-navy cursor-pointer transition-all">
                </td>
                <!-- Image -->
                <td class="px-4 py-4">
                  <div class="flex justify-center">
                    <div class="w-12 h-12 bg-white rounded-xl overflow-hidden flex items-center justify-center p-1 border border-gray-100 shadow-sm">
                      <img src="${item.img}" class="object-cover h-10 w-10 rounded-lg">
                    </div>
                  </div>
                </td>
                <!-- ID -->
                <td class="px-4 py-4 text-center text-black text-xs">${item.id}</td>
                <!-- Name -->
                <td class="px-6 py-4 font-black text-center text-mm-navy leading-tight text-xs">${item.name}</td>
                <!-- Category -->
                <td class="px-4 py-4 text-center text-black text-xs">${item.category}
                </td>
                <!-- Stock -->
                <td class="px-4 py-4 text-center text-gray-500 text-xs">${item.stock}</td>
                <!-- Price -->
                <td class="px-4 py-4 text-center font-black text-[#e67e22] text-xs">${item.price}</td>
                <!-- Amount -->
                <td class="px-4 py-4">
                  <div class="flex justify-center">
                    <div class="flex items-center bg-gray-50 p-1 rounded-xl border border-gray-100 h-9">
                      <button onclick="decrementQty('${item.id}')" class="w-7 h-7 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 hover:bg-gray-100 active:scale-90 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="#15395c" stroke-width="3">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                        </svg>
                      </button>
                      <input type="number" id="qty-${item.id}" value="1" min="1" max="${item.stock}" readonly class="w-10 bg-transparent text-center font-black text-mm-navy focus:outline-none focus:ring-0 border-none text-xs [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                      <button onclick="incrementQty('${item.id}')" class="w-7 h-7 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 hover:bg-gray-100 active:scale-90 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="#15395c" stroke-width="3">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                      </button>
                    </div>
                  </div>
                </td>
              </tr>`).join('')}
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center gap-2 mt-6 mb-4">
          <button class="px-2 py-1 border rounded cursor-pointer hover:bg-gray-200 text-gray-400">‹</button>
          <button onclick="changePage(1)" data-page="1" class="pagination-btn px-3 py-1 border rounded bg-[#15395C] text-white font-bold transition-all">1</button>
          <button onclick="changePage(2)" data-page="2" class="pagination-btn px-3 py-1 border rounded bg-white text-gray-500 hover:bg-gray-100 transition-all">2</button>
          <button onclick="changePage(3)" data-page="3" class="pagination-btn px-3 py-1 border rounded bg-white text-gray-500 hover:bg-gray-100 transition-all">3</button>
          <button onclick="changePage(4)" data-page="4" class="pagination-btn px-3 py-1 border rounded bg-white text-gray-500 hover:bg-gray-100 transition-all">4</button>
          <button onclick="changePage(5)" data-page="5" class="pagination-btn px-3 py-1 border rounded bg-white text-gray-500 hover:bg-gray-100 transition-all">5</button>
          <button class="px-2 py-1 border rounded cursor-pointer hover:bg-gray-200 text-gray-400">›</button>
        </div>

        <!-- Notes -->
        <p class="text-sm font-semibold mb-1 text-mm-navy uppercase tracking-widest text-[10px]">Notes (Optional)</p>
        <textarea placeholder="Example: 2026" class="w-full border-2 border-gray-100 bg-gray-50 italic px-4 py-3 mb-4 rounded-2xl h-24 focus:ring-mm-navy focus:border-mm-navy outline-none text-sm font-medium"></textarea>

        <!-- Buttons -->
        <div class="flex justify-center gap-6 mt-8">
          <button onclick="Swal.close()" class="px-10 py-3 border-2 border-mm-navy text-mm-navy font-black rounded-xl hover:bg-gray-50 transition-colors uppercase text-sm tracking-widest">Cancel</button>
          <button id="addBtn" class="px-10 py-3 bg-mm-navy text-white font-black rounded-xl hover:bg-[#1c4974] transition-colors shadow-lg shadow-mm-navy/20 uppercase text-sm tracking-widest">Add Request</button>
        </div>
      </div>
    `,
    showConfirmButton: false,
    showCloseButton: true,
    didOpen: () => {
        const addBtn = document.getElementById('addBtn');
        if (addBtn) {
            addBtn.addEventListener('click', () => {
                showSuccessModal("Your sparepart request has been submitted successfully.");
            });
        }
    }
  });
}
</script>
  
    <!-- Header bawah navbar -->
    <!-- HEADER -->
    <x-header 
        title="Mechanic Page" 
        image="images/backgroundmechanichome.webp" 
    />


<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 mt-8 grid grid-cols-3 gap-8 mb-12" style="font-family: 'Albert Sans', sans-serif;">

<!-- Daily Performance (kiri) -->
<aside class="col-span-1">
  <div class="w-full">
    <!-- Judul di luar kotak -->
    <h3 class="text-xl font-bold text-[#15395C] font-inter uppercase tracking-widest border-b mb-6">Daily Performance</h3>
    
    <!-- Isi kotak -->
    <div class="bg-white shadow-[0_5px_15px_rgba(0,0,0,0.08)] rounded-[10px] p-8 border border-gray-100">
      <!-- Header dengan icon notes -->
      <div class="flex items-center space-x-3 mb-4">
        <span class="text-2xl">📝</span>
        <span class="text-lg font-semibold text-yellow-700">Service Count</span>
      </div>

      <!-- Angka Assigned -->
      <div class="mb-4">
        <span class="text-4xl font-bold text-gray-900">2</span>
        <span class="text-lg text-gray-600">/ 6 Assigned</span>
      </div>

      <!-- Garis pembatas -->
      <hr class="border-gray-300 mb-4">

      <!-- Completed & Processing -->
      <div class="flex space-x-6 text-base">
        <p class="text-gray-700"><span class="font-bold text-green-600">1</span> Completed</p>
        <p class="text-gray-700"><span class="font-bold text-blue-600">2</span> Processing</p>
      </div>
    </div>
  </div>
</aside>

  <!-- Ongoing Service (kanan) -->
  <section class="col-span-2">
    <!-- Judul di luar kotak -->
    <h3 class="text-xl font-bold text-[#15395C] font-inter uppercase tracking-widest border-b mb-6">Ongoing Service</h3>
      
      @php
          $getServiceIconLocal = function($type) {
              $type = strtolower($type);
              if (str_contains($type, 'oil')) {
                  return '<img src="images/servicecategory/Icon Oil Service.webp" alt="Oil Service" class="h-8 w-8">';
              }
              if (str_contains($type, 'tune up')) {
                  return '<img src="images/servicecategory/Icon Tune Up.png" alt="Tune Up" class="h-8 w-8">';
              }
              if (str_contains($type, 'machine')) {
                  return '<img src="images/servicecategory/Icon Machine Service.webp" alt="Machine Service" class="h-8 w-8">';
              }
              if (str_contains($type, 'brake')) {
                  return '<img src="images/servicecategory/Icon Brake Service.png" alt="Brake Service" class="h-8 w-8">';
              }
              if (str_contains($type, 'conditioner')) {
                  return '<img src="images/servicecategory/Icon AC Service.webp" alt="Conditioner Service" class="h-8 w-8">';
              }
              if (str_contains($type, 'spooring')) {
                  return '<img src="images/servicecategory/Icon Spooring.png" alt="Spooring" class="h-8 w-8">';
              }
              if (str_contains($type, 'transmission')) {
                  return '<img src="images/servicecategory/Icon Transmission Service.png" alt="Transmission Service" class="h-8 w-8">';
              }
              if (str_contains($type, 'body repair')) {
                  return '<img src="images/servicecategory/Icon Body Repair and Printing.png" alt="Body Repair" class="h-8 w-8">';
              }
              if (str_contains($type, 'wash')) {
                  return '<img src="images/servicecategory/Icon Car Wash.png" alt="Wash and Detailing" class="h-8 w-8">';
              }
              if (str_contains($type, 'tire')) {
                  return '<img src="images/servicecategory/Icon Tire Service.png" alt="Tire Service" class="h-8 w-8">';
              }
              if (str_contains($type, 'emergency')) {
                  return '<img src="images/servicecategory/Icon Emergency Service.png" alt="Emergency Service" class="h-8 w-8">';
              }
              return '<img src="images/servicecategory/Icon Default.png" alt="Default Service" class="h-8 w-8">';
          };

          $ongoingServices = [
              [
                  'id' => 'T-20260531-001',
                  'service_code' => 'SVC-WM-01',
                  'date' => '31 May 2026',
                  'type' => 'Wash and Detailing',
                  'icon' => 'wash',
                  'vehicle' => 'F 234 XSG — Yamaha NMAX',
                  'status' => 'processing',
                  'request' => null
              ],
              [
                  'id' => 'T-20260531-002',
                  'service_code' => 'SVC-OR-05',
                  'date' => '31 May 2026',
                  'type' => 'Oil and Filter Replacement',
                  'icon' => 'oil',
                  'vehicle' => 'B 1234 XYZ — Honda Beat',
                  'status' => 'pending',
                  'request' => [
                      'status' => 'approved',
                      'item' => 'Shell Advance Scooter Matic',
                      'qty' => 1,
                      'price' => 30000,
                      'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=100'
                  ]
              ],
              [
                  'id' => 'T-20260531-003',
                  'service_code' => 'SVC-MS-02',
                  'date' => '31 May 2026',
                  'type' => 'Machine Service',
                  'icon' => 'machine',
                  'vehicle' => 'AD 5566 BD — Suzuki GSX',
                  'status' => 'pending',
                  'request' => [
                      'status' => 'waiting',
                      'item' => 'Busi NGK Iridium',
                      'qty' => 1,
                      'price' => 85000,
                      'image' => 'https://images.unsplash.com/photo-1622445262461-c3b8213226a6?q=80&w=100'
                  ]
              ]
          ];
      @endphp

      @foreach($ongoingServices as $service)
      <div class="bg-white shadow-[0_5px_15px_rgba(0,0,0,0.08)] rounded-[10px] overflow-hidden border border-gray-100 mb-8">
        <!-- Header card -->
        <div class="flex items-center justify-between px-8 py-6 font-century border-b border-gray-100 bg-gray-50/50">
          <div class="flex items-center space-x-4">
            <div class="bg-mm-navy/10 p-2 rounded-xl text-mm-navy">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs  text-black uppercase tracking-widest">{{ $service['id'] }} | {{ $service['service_code'] }}</p>
                <div class="flex items-center gap-2">
                    <span class="font-black text-mm-navy">Vehicle Service</span>
                    <span class="text-sm text-[#924e24]">• {{ $service['date'] }}</span>
                </div>
            </div>
          </div>
          <button onclick="openRequestSparepart('{{ $service['id'] }}')" class="flex items-center gap-2 bg-[#2159e7] hover:bg-[#1a48c2] text-white font-bold px-5 py-3 rounded-full transition-all shadow-md text-xs tracking-[0.15em] font-century uppercase">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span>Request Sparepart</span>
          </button>
        </div>

        <!-- Body card -->
        <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between gap-x-12 font-century">
          <div class="flex items-center space-x-6">
            <div class="h-16 w-16 bg-mm-navy/5 rounded-2xl flex items-center justify-center">
                {!! $getServiceIconLocal($service['type']) !!}
            </div>
            <div>
              <p class="text-xl font-black text-mm-navy">{{ $service['type'] }}</p>
              <p class="text-black font-medium tracking-tight">{{ $service['vehicle'] }}</p>
            </div>
          </div>
          <div class="flex items-center gap-8 font-didact">
              <span class="px-3 py-1 {{ $service['status'] == 'processing' ? 'bg-yellow-500' : 'bg-gray-500' }} text-white text-[10px] font-black uppercase rounded-md tracking-wider">
                  {{ $service['status'] }}          
              </span>
              @if($service['status'] == 'processing')
                  <button class="bg-[#28a745] hover:bg-[#218838] text-white font-bold px-8 py-3 rounded-full transition-all shadow-md text-xs tracking-[0.15em] font-inter uppercase">Finish</button>
              @else
                  <button class="bg-mm-navy hover:bg-[#1c4974] text-white font-bold px-8 py-3 rounded-full transition-all shadow-md text-xs tracking-[0.15em] font-inter uppercase">Start Service</button>
              @endif
          </div>
        </div>

        <!-- Sparepart Request Section -->
        @if($service['request'])
        <div class="px-8 py-6 bg-gray-50/50 font-century">
          <div class="flex items-center justify-between gap-x-8 mb-4">
            <p class="font-black text-mm-navy">Sparepart Request</p>
            <span class="px-4 py-1.5 {{ $service['request']['status'] == 'approved' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }} font-bold rounded-full text-xs uppercase letter-spacing-wide">
                {{ $service['request']['status'] }}
            </span>
          </div>
          <div class="bg-white p-4 rounded-2xl border border-gray-100 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-gray-50 rounded-xl overflow-hidden flex items-center justify-center border border-gray-100">
                    <img src="{{ $service['request']['image'] }}" alt="Sparepart" class="object-contain h-10 w-10">
                </div>
                <div>
                  <p class=" text-sm font-bold text-gray-900">{{ $service['request']['qty'] }}x {{ $service['request']['item'] }}</p>
                  <p class="text-sm font-bold text-[#e67e22]">IDR {{ number_format($service['request']['price'], 0, ',', '.') }}</p>
                </div>
            </div>
          </div>
        </div>
        @endif
      </div>
      @endforeach

  </section>
</main>
</body>


</html>
