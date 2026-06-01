<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor - Owner Dashboard</title>
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
    $performance = [
        'revenue' => ['amount' => '5.235.000', 'change' => '+5.6%', 'trend' => 'up'],
        'transactions' => ['total' => 10, 'services' => 6, 'sales' => 4],
        'bookings' => ['count' => 8]
    ];

    $ongoingServices = [
        ['id' => 'SVC-90122', 'plate' => 'B 2334 XV', 'vehicle' => 'Vario', 'type' => 'Oil & Filter', 'mechanic' => 'Agus', 'status' => 'Processing'],
        ['id' => 'SVC-90125', 'plate' => 'D 1122 ABC', 'vehicle' => 'Beat', 'type' => 'Full Service', 'mechanic' => 'Budi', 'status' => 'Processing'],
        ['id' => 'SVC-90128', 'plate' => 'F 4455 DEF', 'vehicle' => 'NMAX', 'type' => 'Tire Change', 'mechanic' => 'Agus', 'status' => 'Pending'],
    ];

    $requests = [
        [
            'id' => 'REQ-20260225-01',
            'service_id' => 'SVC-90122',
            'service_type' => 'Oil & Filter',
            'mechanic' => 'Anto',
            'items' => 'Shell Advance Scooter + Filter',
            'status' => 'Pending'
        ],
        [
            'id' => 'REQ-20260225-02',
            'service_id' => 'SVC-90125',
            'service_type' => 'Full Service',
            'mechanic' => 'Agus',
            'items' => 'Brake Pad Set',
            'status' => 'Pending'
        ]
    ];

    $topProducts = [
        ['name' => 'MPX 2 Engine Oil', 'sold' => 42, 'price' => '58k', 'image' => 'https://via.placeholder.com/60'],
        ['name' => 'V-Belt Kit Vario', 'sold' => 28, 'price' => '185k', 'image' => 'https://via.placeholder.com/60'],
        ['name' => 'Brake Pad Beat', 'sold' => 15, 'price' => '45k', 'image' => 'https://via.placeholder.com/60'],
    ];

    $lowStock = [
        ['id' => 'OIL-433', 'name' => 'Castrol Magnatec', 'left' => 3, 'percent' => 20, 'image' => 'https://via.placeholder.com/60'],
        ['name' => 'Brake Fluid Dot 4', 'id' => 'FL-09', 'left' => 1, 'percent' => 10, 'image' => 'https://via.placeholder.com/60'],
    ];
  @endphp

@include('layouts.navbarowner')
@include('layouts.modals')
@include('layouts.modalowner')

<!-- Header Section (Sync with Customer/Mechanic style) -->
<x-header
  title="Owner Page"
  image="{{ asset('images/backgroundhome.png') }}"/>

<main class="flex-1 max-w-screen-2xl mx-auto w-full px-20 md:px-40 py-10">

  <!-- Action Buttons -->
  <div class="flex justify-end gap-3 mb-8">
    <button class="bg-mm-navy text-white px-6 py-2.5 rounded-full font-bold text-sm tracking-widest hover:bg-mm-blue transition-all shadow-lg flex items-center gap-2">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
      Add Transaction
    </button>
    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-full font-bold text-sm tracking-widest transition-all shadow-lg flex items-center gap-2">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
      Logout
    </button>
  </div>
  
  <!-- Daily Performance -->
  <div class="mb-12">
    <div class="flex items-center gap-4 mb-8">
      <h3 class="text-2xl font-black text-mm-navy uppercase tracking-widest font-century">Daily Performance</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <!-- Revenue Card -->
      <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 p-8 flex flex-col relative overflow-hidden group hover:shadow-xl transition-all">
        <div class="flex items-center gap-3 mb-6">
          <span class="p-2 bg-orange-50 text-orange-500 rounded-lg">💵</span>
          <h4 class="font-bold text-gray-500 uppercase tracking-widest text-base font-inter">Total Revenue</h4>
        </div>
        <div class="flex flex-col">
          <span class="text-sm font-black text-mm-navy/40 font-century">IDR</span>
          <span class="text-5xl font-black text-mm-navy font-century">{{ $performance['revenue']['amount'] }}</span>
        </div>
        <div class="mt-8 pt-6 border-t border-gray-50 flex items-center gap-2 text-green-500 font-bold text-base">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/></svg>
          {{ $performance['revenue']['change'] }} <span class="text-gray-400 font-medium">from yesterday</span>
        </div>
      </div>

      <!-- Transaction Card -->
      <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 p-8 flex flex-col relative overflow-hidden group hover:shadow-xl transition-all">
        <div class="flex items-center gap-3 mb-6">
          <span class="p-2 bg-blue-50 text-blue-500 rounded-lg">📝</span>
          <h4 class="font-bold text-gray-500 uppercase tracking-widest text-base font-inter">Transactions</h4>
        </div>
        <div class="flex items-baseline gap-3 mb-4">
          <span class="text-6xl font-black text-mm-navy font-century">{{ $performance['transactions']['total'] }}</span>
          <span class="text-lg font-bold text-gray-400 uppercase tracking-widest">Transactions</span>
        </div>
        <div class="mt-auto grid grid-cols-2 gap-4 pt-6 border-t border-gray-50">
          <div class="bg-gray-50 rounded-2xl p-4 text-center">
            <p class="text-2xl font-black text-mm-navy font-century">{{ $performance['transactions']['services'] }}</p>
            <p class="text-sm uppercase font-bold text-gray-400 tracking-wide">Services</p>
          </div>
          <div class="bg-gray-50 rounded-2xl p-4 text-center">
            <p class="text-2xl font-black text-mm-navy font-century">{{ $performance['transactions']['sales'] }}</p>
            <p class="text-sm uppercase font-bold text-gray-400 tracking-wide">Sales</p>
          </div>
        </div>
      </div>

      <!-- Booking Card -->
      <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 p-8 flex flex-col items-center justify-center text-center relative group hover:shadow-xl transition-all">
        <div class="mb-4">
          <div class="p-4 bg-purple-50 text-purple-600 rounded-full inline-block">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          </div>
        </div>
        <h4 class="font-bold text-gray-400 uppercase tracking-widest text-xs font-inter mb-2">Pending Bookings</h4>
        <span class="text-7xl font-black text-mm-navy font-century mb-4">{{ $performance['bookings']['count'] }}</span>
        <x-action-button 
          text="Review Queue" 
          class="w-full py-4 bg-mm-navy text-white rounded-full font-bold text-xs uppercase font-inter tracking-widest hover:bg-[#1c4974] transition-all shadow-md"
        />
      </div>

    </div>
  </div>

<!-- Quick Management -->
<div class="mb-10">
  <div class="flex items-center gap-4 mb-8">
    <h3 class="text-2xl font-black text-mm-navy uppercase tracking-widest font-century">Quick Management</h3>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
    
    <!-- Left Column: Ongoing -->
    <div class="space-y-6">
      <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 p-8">
        <div class="flex justify-between items-center mb-8 border-b border-gray-50 pb-6">
          <div class="flex items-center gap-3">
            <span class="text-xl">🔧</span>
            <h4 class="text-lg font-black text-mm-navy uppercase tracking-wide font-century">Ongoing Service</h4>
          </div>
        </div>
        
        <div class="space-y-4">
          @foreach($ongoingServices as $index => $service)
            <div class="flex items-center justify-between p-5 bg-gray-50 rounded-2xl border border-gray-100 group hover:border-mm-navy/20 transition-all">
              <div class="flex items-center gap-4">
                
                <div>
                  <p class="font-black text-mm-navy uppercase text-sm font-century leading-tight">{{ $service['id'] }} - {{ $service['type'] }}</p>
                  <p class="text-xs text-gray-400 uppercase tracking-widest font-inter">
                    {{ $service['plate'] }} • {{ $service['vehicle'] }} • {{ $service['mechanic'] }}
                  </p>
                </div>
              </div>
              <span class="px-3 py-1 @if($service['status'] === 'Processing') bg-yellow-50 text-yellow-600 @elseif($service['status'] === 'Finished') bg-green-50 text-green-600 @else bg-gray-100 text-gray-500 @endif text-[9px] font-black uppercase rounded-md tracking-wider">
                {{ $service['status'] }}
              </span>
            </div>
          @endforeach
        </div>
      </div>

      <!-- Sparepart Request -->
      <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 p-8">
        <div class="flex items-center gap-3 mb-8 border-b border-gray-50 pb-6">
           <span class="text-xl">🛒</span>
           <h4 class="text-lg font-black text-mm-navy uppercase tracking-wide font-century">Sparepart Request</h4>
        </div>

        <div class="space-y-4">
          @foreach($requests as $request)
            <div class="flex items-center justify-between p-5 bg-gray-50 rounded-2xl border border-gray-100 group hover:border-mm-navy/20 transition-all cursor-pointer"
                onclick="openRequestSparepart('{{ $request['service_id'] }}')">
              <div class="flex items-center gap-4">
                  <div class="h-10 w-10 bg-mm-navy/5 rounded-full flex items-center justify-center text-mm-navy">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                  </div>
                  <div>
                    <p class="font-black text-mm-navy uppercase text-sm font-century leading-tight">{{ $request['service_id'] }} - <span class="capitalize">{{ $request['service_type'] }}</span></p>
                    <p class="text-sm  text-gray-400 font-century capitalize tracking-tight">Requested by <span class="font-bold">{{ $request['mechanic'] }}</span></p>
                  </div>
              </div>
              
              <div class="flex gap-2">
                <button onclick="approveSparepart(event,'{{ $request['service_id'] }}')" class="w-8 h-8 flex items-center justify-center bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </button>
                <button onclick="rejectSparepart(event,'{{ $request['service_id'] }}')" class="w-8 h-8 flex items-center justify-center bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="space-y-6">
      <!-- Stock Alert -->
      <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 p-8">
        <div class="flex justify-between items-center mb-8 border-b border-gray-50 pb-6">
          <div class="flex items-center gap-3">
            <span class="text-xl text-red-500">⚠️</span>
            <h4 class="text-lg font-black text-mm-navy uppercase tracking-wide font-century">Stock Alert</h4>
          </div>
        </div>
        
        <div class="space-y-4">
          @foreach($lowStock as $item)
            <div class="flex items-center gap-4 p-4 bg-red-50/50 rounded-2xl border border-red-100">
              <div class="h-12 w-12 bg-white rounded-xl shadow-sm flex items-center justify-center overflow-hidden">
                @if(isset($item['image']))
                  <img src="{{ $item['image'] }}" class="w-full h-full object-cover">
                @else
                  📦
                @endif
              </div>
              <div class="flex-1">
                  <p class="font-bold text-mm-navy font-inter text-sm">{{ $item['name'] }}</p>
                  <p class="text-xs text-gray-400 font-inter uppercase tracking-widest">{{ $item['id'] }}</p>
              </div>
              <div class="text-right">
                  <p class="text-sm font-black text-red-500 uppercase">{{ $item['left'] }} Left</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>


    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function approveSparepart(e, serviceId) {
  e.stopPropagation();
  showSuccessModal('Request Approved');
}

function rejectSparepart(e, serviceId) {
  e.stopPropagation();
  confirmModal(
    'Reject Request',
    'Are you sure you want to reject sparepart request for ' + serviceId + '?',
    'REJECT',
    'Cancel',
    'warning',
    function() {
      showSuccessModal('Request Rejected');
    }
  );
}
</script>


<script>
function openRequestSparepart(serviceId) {
  Swal.fire({
    width: '450px',
    html: `
        <div class="bg-white" style="font-family: 'Century Gothic', sans-serif;">
            <!-- Header -->
            <div class="mb-6 pb-4 border-b border-gray-100 flex justify-between items-start">
                <div class="left">
                    <h2 class="text-2xl font-black text-mm-navy text-center font-century uppercase leading-none mb-1">Request Detail</h2>
                </div>
                <div class="flex flex-col items-end gap-1">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em] font-century">${serviceId}</p>
                <span class="text-xs text-gray-400 century">25 Feb 2026 • 15:20</span>
                </div>
            </div>

            <!-- Mechanic Info -->
            <div class="flex items-center gap-4 mb-6 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                <div class="h-10 w-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-mm-navy">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="text-left font-century">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Mechanic</p>
                    <p class="font-black text-mm-navy">Anto</p>
                </div>
            </div>

            <!-- Spareparts List -->
            <div class="space-y-4 mb-6 text-left">
                <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] font-inter border-b border-gray-50 pb-2">Requested Items</h3>
                
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-center  overflow-hidden">
                        <img src="https://via.placeholder.com/40" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 font-century">
                        <div class="flex justify-between items-start">
                            <p class="font-bold text-mm-navy text-sm leading-tight">Shell Advance Scooter Matic</p>
                            <p class="font-black text-mm-navy text-xs">IDR 30.000</p>
                        </div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">1x Items</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-center overflow-hidden">
                        <img src="https://via.placeholder.com/40" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 font-century">
                        <div class="flex justify-between items-start">
                            <p class="font-bold text-mm-navy text-sm leading-tight">Brake Fluid Dot 4</p>
                            <p class="font-black text-mm-navy text-xs">IDR 15.000</p>
                        </div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">1x Items</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 mt-6">
                <button onclick="Swal.close()" class="py-3.5 border border-mm-navy/20 rounded-3xl text-sm font-black uppercase tracking-widest text-mm-navy hover:bg-gray-50 transition-all">
                    Close
                </button>
                <button onclick="approveSparepart(event, '${serviceId}')" class="py-3.5 bg-mm-navy text-white rounded-3xl text-sm font-black uppercase tracking-widest hover:bg-[#1c4974] transition-all shadow-lg shadow-mm-navy/20">
                    Approve Now
                </button>
            </div>
        </div>
    `,
    showConfirmButton: false,
    customClass: {
      popup: '!rounded-[32px] !p-8',
    }
  });
}
</script>





</body>
</html>