<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MATA MOTOR - Mechanic Management</title>
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
    // --- 1. PROSES DATA UTAMA MEKANIK (DUMMY DATA) ---
  $mechanics = [
    [
      'id' => 'MEC-1', 
      'name' => 'Supriadi', 
      'phone' => '+62 883 4343 55443', 
      'password' => 'supri1234',
      'status' => 'Active', 
      'rating' => '5 / 5',
      'specializations' => ['Oil and Filter Replacement', 'Machine Service', 'Air Conditioner Service', 'Wash and Detailing'],
      'assignments' => [
        ['service' => 'Wash and Detailing', 'code1' => 'T-20251123-2', 'code2' => 'CUCI-20260635-1', 'plate' => 'F 2234 XSG', 'vehicle' => 'Yamaha NMAX'],
        ['service' => 'Tune Up', 'code1' => 'T-20251124-1', 'code2' => 'TUN-20260636-2', 'plate' => 'B 1234 ABC', 'vehicle' => 'Honda Vario']
      ]
    ],
    [
      'id' => 'MEC-2', 
      'name' => 'Mulyono', 
      'phone' => '+62 812 3456 7890', 
      'password' => 'mulyono2026',
      'status' => 'Active', 
      'rating' => '4.8 / 5',
      'specializations' => ['Brake Service', 'Spooring', 'Transmission Service', 'Tire Service'],
      'assignments' => [
        ['service' => 'Brake Service', 'code1' => 'T-20251125-3', 'code2' => 'BRK-20260637-1', 'plate' => 'D 9988 ZYX', 'vehicle' => 'Suzuki Ertiga']
      ]
    ],
    [
      'id' => 'MEC-3', 
      'name' => 'Slamet', 
      'phone' => '+62 856 7890 1234', 
      'password' => 'slametjaya',
      'status' => 'On Leave', 
      'rating' => '4.5 / 5',
      'specializations' => ['Body Repair and Painting', 'Emergency Service'],
      'assignments' => []
    ],
  ];

    // --- 2. PROSES HITUNG COUNT SECARA DINAMIS ---
    // Hitung total seluruh mekanik yang ada di array
    $totalMechanics = count($mechanics);

    // Hitung mekanik yang statusnya bernilai 'Active'
    $activeMechanics = count(array_filter($mechanics, function($m) {
        return $m['status'] === 'Active';
    }));

    // Hitung mekanik yang sedang ada service (array assignments tidak kosong)
    $onWorkMechanics = count(array_filter($mechanics, function($m) {
        return !empty($m['assignments']);
    }));

    // --- 3. MASUKKAN VARIABEL HITUNGAN KE STATS ---
  $stats = [
    ['label' => 'Total Mechanic', 'value' => $totalMechanics, 'color' => 'blue'],
    ['label' => 'Active Mechanic', 'value' => $activeMechanics, 'color' => 'green'],
    ['label' => 'On Work', 'value' => $onWorkMechanics, 'color' => 'orange'],
  ];

    // --- 4. DATA DAFTAR SPESIALISASI ---
  $specializations = [
    'Oil and Filter Replacement', 'Tune Up', 'Machine Service', 'Brake Service', 
    'Air Conditioner Service', 'Spooring', 'Transmission Service', 
    'Body Repair and Painting', 'Wash and Detailing', 'Tire Service', 'Emergency Service'
  ];
 @endphp

  @include('layouts.navbarowner')
  @include('layouts.modals')
  @include('layouts.modalowner')

  <x-header title="Mechanic Management" image="{{ asset('images/backgroundownermechanic.jpg') }}" />

  <main class="flex-1 max-w-screen-2xl mx-auto w-full px-4 md:px-8 py-10">
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
      @foreach($stats as $stat)
        <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 p-8 flex flex-col items-center justify-center text-center group hover:shadow-xl transition-all">
          <h4 class="font-bold text-gray-400 uppercase tracking-widest text-xs font-inter mb-2">{{ $stat['label'] }}</h4>
          <span class="text-6xl font-black text-mm-navy font-century">
            {{ $stat['value'] }}
          </span>
        </div>
      @endforeach
    </div>

    <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 p-6 mb-8">
      <div class="flex flex-col lg:flex-row gap-6 justify-between items-center">
        <div class="flex flex-col md:flex-row items-center gap-6 w-full lg:w-auto">
          <div class="relative w-full md:w-96">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" placeholder="Search mechanics..." 
                   class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-mm-navy focus:bg-white transition-all outline-none font-medium text-sm">
          </div>

          <div class="flex flex-wrap gap-3 p-1.5 w-full md:w-fit">
            <button data-status="all" onclick="filterByStatus('all', this)" 
                    class="status-btn px-5 py-2 rounded-full border border-mm-navy bg-mm-navy text-white text-sm font-didact transition-colors">
              All Status
            </button>
            
            <button data-status="Active" onclick="filterByStatus('Active', this)" 
                    class="status-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-didact hover:border-mm-navy transition-colors">
              Active
            </button>
            
            <button data-status="On Leave" onclick="filterByStatus('On Leave', this)" 
                    class="status-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-500 text-sm font-didact hover:border-mm-navy transition-colors">
              On Leave
            </button>
          </div>
        </div>

        <x-action-button 
          text="+ Add New Mechanic" 
          onclick="openAddMechanic()"
          class="w-full lg:w-auto py-3.5 px-8 bg-mm-navy text-white font-century rounded-2xl font-bold text-sm uppercase tracking-widest hover:bg-[#1c4974] transition-all shadow-lg"
        />
      </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8 items-start">
      
      <aside class="w-full lg:w-80 shrink-0 sticky top-6">
        <div class="bg-white rounded-[32px] border border-gray-100 shadow-sm p-2 overflow-hidden">
          <div class="px-6 py-5 border-b border-gray-50 flex items-center gap-2">
            <h3 class="text-sm font-black tracking-widest text-black font-century uppercase">Specialization</h3>
          </div>
          <div class="p-3 space-y-1 max-h-[600px] overflow-y-auto">
            <button onclick="filterBySpecialization('all', this)" class="spec-btn w-full font-century text-left px-5 py-3.5 rounded-2xl bg-gray-100 text-mm-navy text-sm transition-all border border-transparent shadow-sm">
              All Specializations
            </button>
            
            @foreach($specializations as $spec)
              <button onclick="filterBySpecialization('{{ $spec }}', this)" class="spec-btn w-full font-century text-left px-5 py-3.5 rounded-2xl text-gray-800 text-sm transition-all border border-transparent hover:bg-gray-50 hover:text-mm-navy">
                {{ $spec }}
              </button>
            @endforeach
          </div>
        </div>
      </aside>

      <div class="flex-1 w-full">
        <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 p-2 overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full border-collapse">
              <thead>
                <tr class="bg-gray-50/80 text-[10px] font-black uppercase tracking-widest text-mm-navy/60 border-b border-gray-100/50 text-center font-century">
                  <th class="px-6 py-5 text-center">ID</th>
                  <th class="px-6 py-5 text-center">Name</th>
                  <th class="px-6 py-5 text-center">Phone</th>
                  <th class="px-6 py-5 text-center">Status</th>
                  <th class="px-6 py-5 text-center">Rating</th>
                  <th class="px-6 py-5 text-center">Action</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-50">
                @foreach($mechanics as $mechanic)
                  <tr class="text-sm border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition-colors group cursor-pointer font-century" 
                      data-mechanic="{{ json_encode($mechanic) }}"
                      onclick="showMechanicPopup(JSON.parse(this.getAttribute('data-mechanic')))">
                    <td class="px-6 py-4 text-center">
                      <span class="text-black uppercase text-xs px-2 py-1 rounded-md">{{ $mechanic['id'] }}</span>
                    </td>
                    <td class="px-6 py-4 text-center text-xs font-black text-black">
                      {{ $mechanic['name'] }}
                    </td>
                    <td class="px-6 py-4 text-center text-xs font-medium text-black">
                      {{ $mechanic['phone'] }}
                    </td>
                    <td class="px-6 py-4 text-center">
                      <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest
                        {{ $mechanic['status'] === 'Active' ? 'bg-green-100 text-green-600' : 'bg-orange-100 text-orange-600' }}">
                        {{ $mechanic['status'] }}
                      </span>
                    </td>
                    <td class="px-6 py-4 text-center text-xs">
                      <div class="flex items-center justify-center gap-1">
                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="font-black text-mm-blue">{{ explode(' ', $mechanic['rating'])[0] }}</span>
                      </div>
                    </td>
                    <td class="px-6 py-4" onclick="event.stopPropagation()">
                      <div class="flex justify-center gap-2">
                        <button onclick="openEditMechanic(JSON.parse(this.closest('tr').getAttribute('data-mechanic')))" 
                                class="p-2 text-mm-blue hover:bg-blue-50 rounded-lg transition-all">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/></svg>
                        </button>
                        <button onclick="confirmDeleteMechanic('{{ $mechanic['id'] }}', '{{ $mechanic['name'] }}')" 
                                class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </main>


  <script>
    const allSpecializations = @json($specializations);

    function showMechanicPopup(mechanic) {
      let specsHtml = mechanic.specializations.map(spec => `
        <span class="px-2.5 py-1 bg-gray-50 text-gray-700 border border-gray-200 rounded-full text-[12px]" style="font-family:'Century Gothic';">
          ${spec}
        </span>
      `).join('');

      let assignmentsHtml = '';
      if(mechanic.assignments.length > 0) {
        assignmentsHtml = mechanic.assignments.map(task => `
          <div class="border border-gray-200 bg-gray-50 rounded-[12px] p-3 text-left mb-2">
            <div class="flex flex-col gap-1 text-[13px]" style="font-family:'Century Gothic';">
              <div class="font-bold text-gray-900 border-b border-gray-200 pb-1">${task.service}</div>
              <div class="text-gray-500 text-[11px] flex justify-between pt-0.5">
                <span>${task.code1}</span>
                <span>${task.code2}</span>
              </div>
              <div class="flex justify-between items-center pt-1">
                <span class="text-mm-navy font-bold">${task.plate}</span>
                <span class="text-gray-900 font-medium">${task.vehicle}</span>
              </div>
            </div>
          </div>
        `).join('');
      } else {
        assignmentsHtml = `<div class="text-gray-400 italic text-[13px] text-center py-2">Tidak ada tugas / Sedang Cuti</div>`;
      }

      let statusColor = mechanic.status === 'Active' ? '#09A721' : '#d97706';

      Swal.fire({
        title: '<span class="font-century text-[34px] leading-none font-bold text-black pt-2 block">Mechanic Detail</span>',
        html: `
          <div class="space-y-3 text-[14px] text-black pt-4 px-8 pb-4" style="font-family:'Century Gothic';">
            <div class="flex justify-between items-center">
              <span class="text-gray-500">Name</span>
              <span class="font-bold text-right">${mechanic.name}</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-gray-500">Number</span>
              <span class="font-bold text-right">${mechanic.phone}</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-gray-500">Password</span>
              <span class="font-bold flex items-center">
                <span class="pwd-text" data-pw="${mechanic.password}">********</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="inline h-4 w-4 cursor-pointer ml-1.5 text-gray-500 hover:text-mm-navy" fill="none" viewBox="0 0 24 24" stroke="currentColor" onclick="togglePassword(this)">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
              </span>
            </div>
            <div class="flex justify-between items-center mb-2">
              <span class="text-gray-500">Status</span>
              <span class="font-bold" style="color:${statusColor};">${mechanic.status}</span>
            </div>
            <hr class="border-t border-gray-100 my-2"/>
            <div class="text-left font-bold text-mm-navy text-[14px] mb-1">Specialization</div>
            <div class="flex flex-wrap gap-1.5 justify-start mb-3">
              ${specsHtml}
            </div>
            <div class="flex justify-between items-center border-t border-b border-gray-100 py-2 my-2">
              <span class="font-bold text-mm-navy">Rating Accumulation</span>
              <span class="font-bold text-black text-[16px]">${mechanic.rating}</span>
            </div>
            <div class="text-left font-bold text-mm-navy text-[14px] mb-1">Ongoing Assignment</div>
            <div class="max-h-[160px] overflow-y-auto pr-1">
              ${assignmentsHtml}
            </div>
          </div>
        `,
        showConfirmButton: false,
        showCloseButton: false,
        width: 410,
        padding: 0,
        background: '#ffffff',
        customClass: {
          popup: '!rounded-[30px] !p-0 !overflow-hidden',
          htmlContainer: '!m-0 !p-0'
        }
      });
    }
    function togglePassword(icon) {
      const span = icon.previousElementSibling;
      if (span.textContent === '********') {
        span.textContent = span.getAttribute('data-pw');
      } else {
        span.textContent = '********';
      }
    }

    function openAddMechanic() {
      let specOptions = allSpecializations.map(s => `
        <label class="flex items-center gap-2.5 cursor-pointer text-[14px] py-1 hover:text-mm-navy">
          <input type="checkbox" class="w-4 h-4 rounded border-gray-400 text-mm-navy focus:ring-mm-navy"/> ${s}
        </label>
      `).join('');

      Swal.fire({
        title: '<span class="font-century text-[34px] leading-none font-bold text-black pt-8 block">Add Mechanic</span>',
        html: `
          <div class="space-y-4 text-[15px] text-black text-left font-didact pt-4 px-8 pb-4">
            <div>
              <label class="block mb-1.5 font-normal text-left text-gray-700">Name</label>
              <input type="text" class="h-[42px] w-full border border-gray-500 rounded-[10px] px-4 text-[15px] bg-white outline-none focus:border-mm-navy focus:ring-1 focus:ring-mm-navy" placeholder="Enter full name"/>
            </div>
            <div>
              <label class="block mb-1.5 font-normal text-left text-gray-700">Password</label>
              <input type="password" class="h-[42px] w-full border border-gray-500 rounded-[10px] px-4 text-[15px] bg-white outline-none focus:border-mm-navy focus:ring-1 focus:ring-mm-navy" placeholder="Enter password"/>
            </div>
            <div>
              <label class="block mb-1.5 font-bold text-left text-mm-navy">Specialization</label>
              <div class="border border-gray-400 rounded-[10px] p-3 space-y-1 max-h-[150px] overflow-y-auto bg-white">
                ${specOptions}
              </div>
            </div>
          </div>
        `,
        showConfirmButton: false,
        width: 410,
        padding: 0,
        background: '#ffffff',
        footer: `
          <div class="mb-10 flex items-center justify-center gap-6 w-full px-8" style="font-family: 'Century Gothic', sans-serif;">
            <button type="button" onclick="Swal.close()" class="min-w-[128px] rounded-[30px] border-2 border-[#15395c] px-6 py-2.5 text-[15px] font-bold text-[#15395c] transition-colors hover:bg-[#f4f7fb]">Cancel</button>
            <button type="button" onclick="addMechanic()" class="min-w-[128px] rounded-[30px] bg-[#15395c] px-6 py-2.5 text-[15px] font-bold text-white transition-colors hover:bg-[#1c4974]">Add</button>
          </div>
        `,
        customClass: {
          popup: '!rounded-[30px] !p-0 !overflow-hidden',
          htmlContainer: '!m-0 !p-0'
        }
      });
    }

    function addMechanic() {
      showSuccessModal("Mechanic added");
    }

    function openEditMechanic(mechanic) {
      let specOptions = allSpecializations.map(s => {
        let isChecked = mechanic.specializations.includes(s) ? 'checked' : '';
        return `
          <label class="flex items-center gap-2.5 cursor-pointer text-[14px] py-1 hover:text-mm-navy">
            <input type="checkbox" ${isChecked} class="w-4 h-4 rounded border-gray-400 text-mm-navy focus:ring-mm-navy"/> ${s}
          </label>
        `;
      }).join('');

      let isStatusActive = mechanic.status === 'Active' ? 'checked' : '';
      let isStatusLeave = mechanic.status === 'On Leave' ? 'checked' : '';

      Swal.fire({
        title: '<span class="font-century text-[34px] leading-none font-bold text-black pt-8 block">Edit Mechanic</span>',
        html: `
          <div class="space-y-4 text-[15px] text-black text-left font-didact pt-4 px-8 pb-4">
            <div>
              <label class="block mb-1.5 font-normal text-left text-gray-700">Name</label>
              <input type="text" class="h-[42px] w-full border border-gray-500 rounded-[10px] px-4 text-[15px] bg-white outline-none focus:border-mm-navy focus:ring-1 focus:ring-mm-navy" value="${mechanic.name}"/>
            </div>
            <div>
              <label class="block mb-1.5 font-normal text-left text-gray-700">Password</label>
              <input type="password" class="h-[42px] w-full border border-gray-500 rounded-[10px] px-4 text-[15px] bg-white outline-none focus:border-mm-navy focus:ring-1 focus:ring-mm-navy" placeholder="Leave blank if unchanged"/>
            </div>
            <div>
              <label class="block mb-1.5 font-bold text-left text-mm-navy">Specialization</label>
              <div class="border border-gray-400 rounded-[10px] p-3 space-y-1 max-h-[130px] overflow-y-auto bg-white">
                ${specOptions}
              </div>
            </div>
            <div>
              <label class="block mb-1.5 font-bold text-left text-mm-navy">Status</label>
              <div class="flex gap-6 items-center pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-[15px]"><input type="radio" name="status" ${isStatusActive} class="w-4 h-4 border-gray-400 text-mm-navy focus:ring-mm-navy"/> Active</label>
                <label class="flex items-center gap-2 cursor-pointer text-[15px]"><input type="radio" name="status" ${isStatusLeave} class="w-4 h-4 border-gray-400 text-mm-navy focus:ring-mm-navy"/> On Leave</label>
              </div>
            </div>
          </div>
        `,
        showConfirmButton: false,
        width: 410,
        padding: 0,
        background: '#ffffff',
        footer: `
          <div class="mb-10 flex items-center justify-center gap-6 w-full px-8" style="font-family: 'Century Gothic', sans-serif;">
            <button type="button" onclick="Swal.close()" class="min-w-[128px] rounded-[30px] border-2 border-[#15395c] px-6 py-2.5 text-[15px] font-bold text-[#15395c] transition-colors hover:bg-[#f4f7fb]">Cancel</button>
            <button type="button" onclick="saveMechanic()" class="min-w-[128px] rounded-[30px] bg-[#15395c] px-6 py-2.5 text-[15px] font-bold text-white transition-colors hover:bg-[#1c4974]">Save</button>
          </div>
        `,
        customClass: {
          popup: '!rounded-[30px] !p-0 !overflow-hidden',
          htmlContainer: '!m-0 !p-0'
        }
      });
    }

    function saveMechanic() {
      showSuccessModal("Mechanic updated successfully");
    }

    function confirmDeleteMechanic(mechanicId, mechanicName) {
      Swal.fire({
        title: '<span class="font-century text-[34px] leading-none font-bold text-black pt-8 block">Confirmation</span>',
        html: `
          <div class="space-y-4 text-center font-didact pt-4 px-8 pb-4 text-black">
            <div class="text-[15px] text-gray-600 leading-relaxed">
              Please enter your password to proceed with deleting mechanic <strong>${mechanicName}</strong>.
            </div>
            <div>
              <input type="password" id="deletePassword" class="h-[42px] w-full border border-gray-500 rounded-[10px] px-4 text-[15px] text-center bg-white outline-none focus:border-mm-navy focus:ring-1 focus:ring-mm-navy" placeholder="Enter admin password" />
            </div>
          </div>
        `,
        showConfirmButton: false,
        width: 410,
        padding: 0,
        background: '#ffffff',
        footer: `
          <div class="mb-10 flex items-center justify-center gap-6 w-full px-8" style="font-family: 'Century Gothic', sans-serif;">
            <button type="button" onclick="Swal.close()" class="min-w-[128px] rounded-[30px] border-2 border-[#15395c] px-6 py-2.5 text-[15px] font-bold text-[#15395c] transition-colors hover:bg-[#f4f7fb]">Cancel</button>
            <button type="button" onclick="openDeleteMechanic('${mechanicId}', '${mechanicName}')" class="min-w-[128px] rounded-[30px] bg-[#15395c] px-6 py-2.5 text-[15px] font-bold text-white transition-colors hover:bg-[#1c4974]">Continue</button>
          </div>
        `,
        customClass: {
          popup: '!rounded-[30px] !p-0 !overflow-hidden',
          htmlContainer: '!m-0 !p-0'
        }
      });
    }

    function openDeleteMechanic(mechanicId, mechanicName) {
      // Ambil input password dari step pertama
      const passwordInput = document.getElementById('deletePassword')?.value;
      
      // (Opsional) Anda bisa menambahkan validasi password kosong di sini jika diperlukan

      confirmDelete("Mechanic", "Delete " + mechanicName);
    }

    function deleteMechanicSuccess(mechanicId, mechanicName) {
      showSuccessModal(`Mechanic ${mechanicName} berhasil dihapus`);
    }

    // --- FUNGSI FILTER BERHASIL DIPERBAIKI ---
    // Variabel global untuk menyimpan status filter yang sedang aktif
    let currentSpecialization = 'all';
    let currentStatus = 'all';

// 1. Fungsi Filter Berdasarkan Specialization
    function filterBySpecialization(specialization, buttonElement) {
      // Ubah style semua tombol specialization kembali ke normal/tidak aktif
      document.querySelectorAll('.spec-btn').forEach(btn => {
        btn.classList.remove('bg-gray-100', 'text-mm-navy', 'font-black', 'shadow-sm', 'text-gray-400');
        btn.classList.add('text-gray-800', 'hover:bg-gray-50', 'hover:text-mm-navy');
        // Menghapus 'font-bold' jika ada agar kembali ke berat font normal
        btn.classList.remove('font-bold'); 
      });

      // Berikan style aktif (font-black / bold tebal) HANYA pada elemen yang sedang diklik
      buttonElement.classList.remove('text-gray-800', 'hover:bg-gray-50', 'hover:text-mm-navy');
      buttonElement.classList.add('bg-gray-100', 'text-mm-navy', 'font-black', 'shadow-sm');

      // Simpan pilihan dan jalankan applyFilter
      currentSpecialization = specialization;
      applyFilter();
    }

    // 2. Fungsi Filter Berdasarkan Status
    function filterByStatus(status, buttonElement) {
      // Reset semua tombol status ke kondisi tidak aktif (Border abu-abu, background putih, teks abu-abu)
      document.querySelectorAll('.status-btn').forEach(btn => {
        btn.classList.remove('border-mm-navy', 'bg-mm-navy', 'text-white');
        btn.classList.add('border-gray-300', 'bg-white', 'text-gray-500', 'hover:border-mm-navy');
      });

      // Berikan style aktif ke tombol yang sedang diklik (Border navy, background navy, teks putih)
      buttonElement.classList.remove('border-gray-300', 'bg-white', 'text-gray-500', 'hover:border-mm-navy');
      buttonElement.classList.add('border-mm-navy', 'bg-mm-navy', 'text-white');

      // Simpan pilihan status saat ini dan jalankan gabungan filter
      currentStatus = status;
      applyFilter();
    }

    // 3. Fungsi Utama untuk Memproses Kombinasi Kedua Filter
    function applyFilter() {
      const rows = document.querySelectorAll('tbody tr');

      rows.forEach(row => {
        const dataAttr = row.getAttribute('data-mechanic');
        if (!dataAttr) return;

        try {
          const mechanicData = JSON.parse(dataAttr);
          
          // Kondisi 1: Cek Filter Specialization
          const matchSpecialization = (currentSpecialization === 'all') || 
            (mechanicData.specializations && mechanicData.specializations.includes(currentSpecialization));
            
          // Kondisi 2: Cek Filter Status
          const matchStatus = (currentStatus === 'all') || 
            (mechanicData.status === currentStatus);

          // Tampilkan baris jika lolos KEDUA filter tersebut
          if (matchSpecialization && matchStatus) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        } catch (e) {
          console.error("Gagal memproses kombinasi filter:", e);
        }
      });
    }
  </script>
</body>
</html>