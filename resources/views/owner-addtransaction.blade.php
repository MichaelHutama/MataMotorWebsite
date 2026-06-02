<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor — Create Invoice</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'mm-navy': '#15395c',
            'mm-hover-navy': '#1c4974'
          },
          fontFamily: {
            didact: ['"Didact Gothic"', 'sans-serif'],
            century: ['"Century Gothic"', 'sans-serif'],
            inter: ['"Inter"', 'sans-serif']
          }
        }
      }
    }
  </script>
  <style>
    .font-century { font-family: 'Century Gothic', sans-serif; }
    .font-didact { font-family: 'Didact Gothic', sans-serif; }
    .font-inter { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 font-century text-gray-800">
  @include('layouts.navbarowner')
  @include('layouts.modals')
  @include('layouts.modalowner')
  @include('layouts.modalcustomer')

  @php
    $mode = request()->query('mode', 'sparepart sales & service'); // sparepart sales & service, sparepart, service
    
    // DUMMY REPOSITORIES DATA
    $customers = [
      ['id' => 'CUST-01', 'name' => 'Ahmad Subarjo', 'phone' => '08123456789'],
      ['id' => 'CUST-02', 'name' => 'Siti Aminah', 'phone' => '08776543210'],
      ['id' => 'CUST-03', 'name' => 'Budi Setiadi', 'phone' => '08991122334']
    ];

    // Dummy Vehicles mapped by Customer ID
    $vehicles = [
      'CUST-01' => [
        ['type' => 'Honda Vario 150', 'plate' => 'B 1234 ABC'],
        ['type' => 'Yamaha NMAX', 'plate' => 'B 4321 ZXC']
      ],
      'CUST-02' => [
        ['type' => 'Yamaha Aerox', 'plate' => 'D 5678 DEF']
      ],
      'CUST-03' => [
        ['type' => 'Honda Beat', 'plate' => 'F 9999 GHI']
      ]
    ];

    $services = [
      ['id' => 'SV-01', 'name' => 'Full Engine Tuning', 'price' => 200000, 'icon' => 'https://cdn-icons-png.flaticon.com/512/1995/1995470.png'],
      ['id' => 'SV-02', 'name' => 'Light CVT Service', 'price' => 85000, 'icon' => 'https://cdn-icons-png.flaticon.com/512/1995/1995470.png'],
      ['id' => 'SV-03', 'name' => 'General Wheel Balancing', 'price' => 50000, 'icon' => 'https://cdn-icons-png.flaticon.com/512/1995/1995470.png']
    ];

    $spareparts = [
      ['id' => 'SP-01', 'name' => 'Brake Pad Front', 'stock' => 12, 'price' => 125000, 'category_id' => 'brake', 'category_name' => 'Brake System', 'image' => 'https://via.placeholder.com/150'],
      ['id' => 'SP-02', 'name' => 'Engine Oil Motul 1L', 'stock' => 20, 'price' => 150000, 'category_id' => 'engine', 'category_name' => 'Engine Parts', 'image' => 'https://via.placeholder.com/150'],
      ['id' => 'SP-03', 'name' => 'Tubeless Tire Maxxis', 'stock' => 5, 'price' => 320000, 'category_id' => 'tires', 'category_name' => 'Tires', 'image' => 'https://via.placeholder.com/150'],
      ['id' => 'SP-04', 'name' => 'NGK Spark Plug', 'stock' => 50, 'price' => 35000, 'category_id' => 'electric', 'category_name' => 'Electrical Parts', 'image' => 'https://via.placeholder.com/150']
    ];
  @endphp

  <div class="max-w-6xl mx-auto p-8">
    
    <div class="flex items-center justify-between mb-8 border-b border-gray-200 pb-5">
      <div class="flex items-center gap-4">
        <div>
          <h1 class="font-century text-3xl font-black text-mm-navy">Add Transaction</h1>
          <p class="text-sm text-gray-600 mt-0.5">Type: <span class="capitalize text-blue-600">{{ $mode }}</span></p>
        </div>
      </div>
      
      <div class="flex items-center gap-3 font-century text-sm">
        <label class="text-gray-500">Link to ongoing Transaction ID:</label>
        <input type="text" placeholder="e.g., TX-1001" class="w-32 h-[38px] border border-gray-300 rounded-lg px-3 outline-none focus:border-mm-navy bg-white uppercase font-century font-bold text-xs">
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
      
      <div class="lg:col-span-2 space-y-6">
        
        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-100">
          <div class="flex justify-between items-center mb-4">
            <h3 class="font-century font-bold text-gray-900 text-[16px] tracking-widest uppercase">Customer Information</h3>
            <button type="button" onclick="openAddCustomerModal()" class="text-blue-600 text-sm font-medium font-century hover:underline">+ Add New Customer</button>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
            <div id="customerSelectionWrapper">
              <label class="block text-xs text-gray-400 mb-1 font-century uppercase">Select Customer (ID / Name)</label>
              <div class="relative cursor-pointer" onclick="openSearchCustomerModal()">
                <input type="text" id="selectedCustomerInput" readonly placeholder="Click to search from database" class="w-full h-[42px] border border-gray-300 rounded-xl pl-4 pr-10 outline-none bg-gray-50 cursor-pointer font-medium text-sm text-gray-800">
                <span class="absolute right-3.5 top-3.5 text-gray-400">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
              </div>
            </div>

            <div class="flex items-center h-[42px]">
              <label class="relative flex items-center gap-2 cursor-pointer select-none">
                <input type="checkbox" id="walkInCheckbox" onchange="toggleWalkInOption(this)" class="w-4 h-4 rounded text-mm-navy focus:ring-0">
                <span class="text-sm font-medium text-gray-600">NULL Customer</span>
              </label>
            </div>
          </div>
        </div>

        @if($mode === 'sparepart sales & service' || $mode === 'service')
        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-100">
          <div class="flex justify-between items-center mb-4 border-b border-gray-50 pb-3">
            <h3 class="font-century font-bold text-gray-900 text-[16px] uppercase tracking-widest">Service Details Assignment</h3>
            <button type="button" onclick="addVehicle()" class="bg-gray-100 hover:bg-gray-200 text-mm-navy px-4 py-1.5 rounded-full font-century font-bold text-xs tracking-wide transition-all">+ Add New Vehicle</button>
          </div>
          
          <div class="mb-6">
            <label class="block text-xs text-gray-400 mb-1 font-century uppercase">SEARCH CUSTOMER'S VEHICLE</label>
            <div class="relative">
              <select id="assignedVehicleSelect" onmousedown="checkCustomerSelected(event)" class="w-full h-[42px] border border-gray-300 rounded-xl px-4 outline-none bg-white text-sm font-medium text-gray-700 appearance-none focus:border-mm-navy cursor-pointer">
                <option value="">Select customer's vehicle...</option>
              </select>
              <span class="absolute right-3.5 top-3.5 text-gray-400 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
              </span>
            </div>
          </div>

          <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden max-w-4xl mx-auto">
            <div class="overflow-x-auto">
              <table class="w-full text-left border-collapse">
                <thead>
                  <tr class="bg-gray-50 text-gray-400 text-[12px] uppercase tracking-wider border-b border-gray-100 font-century text-center">
                    <th class="px-6 py-4 font-semibold w-16">Pick</th>
                    <th class="px-6 py-4 font-semibold w-24">Icon</th>
                    <th class="px-6 py-4 font-semibold w-24">ID</th>
                    <th class="px-6 py-4 font-semibold">Service Name</th>
                    <th class="px-6 py-4 font-semibold w-28">Price</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-[15px] text-gray-700 font-century" id="serviceTableBody">
                  @foreach($services as $sv)
                  <tr class="service-item hover:bg-gray-50/70 transition-colors">
                    <td class="px-6 py-4 text-center">
                      <input type="checkbox" class="service-checkbox w-4 h-4 rounded text-mm-navy focus:ring-0" 
                             data-price="{{ $sv['price'] }}" data-name="{{ $sv['name'] }}" 
                             onchange="handleServiceSelection(this); updateSummaryPricing()">
                    </td>
                    <td class="px-6 py-4">
                      <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center mx-auto shadow-sm">
                        <img src="{{ $sv['icon'] }}" class="w-6 h-6 object-contain opacity-75" alt="icon">
                      </div>
                    </td>
                    <td class="px-6 py-4 text-black font-century text-xs text-center">{{ $sv['id'] }}</td>
                    <td class="px-6 py-4 font-bold text-black text-xs font-century sv-name text-center">{{ $sv['name'] }}</td>
                    <td class="px-6 py-4 font-bold text-[#e67e22] text-xs text-center font-century">Rp {{ number_format($sv['price'], 0, ',', '.') }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        @endif

        @if($mode === 'sparepart sales & service' || $mode === 'sparepart')
        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-100">
          <h3 class="font-century font-bold text-gray-900 text-[16px] mb-4 uppercase tracking-widest">Select Sparepart Inventories</h3>
          
          <div class="flex gap-2 mb-4 overflow-x-auto pb-2">
            <button type="button" class="px-4 py-1.5 rounded-full border border-mm-navy bg-mm-navy text-xs font-bold text-white transition-all part-filter-btn" onclick="filterSparepartCat('all', this)">All</button>
            <button type="button" class="px-4 py-1.5 rounded-full border border-gray-300 text-xs font-bold text-gray-600 hover:bg-gray-50 transition-all part-filter-btn" onclick="filterSparepartCat('brake', this)">Brake System</button>
            <button type="button" class="px-4 py-1.5 rounded-full border border-gray-300 text-xs font-bold text-gray-600 hover:bg-gray-50 transition-all part-filter-btn" onclick="filterSparepartCat('engine', this)">Engine Parts</button>
            <button type="button" class="px-4 py-1.5 rounded-full border border-gray-300 text-xs font-bold text-gray-600 hover:bg-gray-50 transition-all part-filter-btn" onclick="filterSparepartCat('tires', this)">Tires</button>
            <button type="button" class="px-4 py-1.5 rounded-full border border-gray-300 text-xs font-bold text-gray-600 hover:bg-gray-50 transition-all part-filter-btn" onclick="filterSparepartCat('electric', this)">Electrical Parts</button>
          </div>

          <div class="border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm">
            <div class="overflow-x-auto">
              <table class="w-full text-left border-collapse">
                <thead>
                  <tr class="bg-gray-50 text-gray-400 text-[12px] uppercase tracking-wider border-b border-gray-100 font-century text-center">
                    <th class="px-6 py-4 font-semibold w-16">Pick</th>
                    <th class="px-6 py-4 font-semibold w-24">Image</th>
                    <th class="px-6 py-4 font-semibold w-24">ID</th>
                    <th class="px-6 py-4 font-semibold">Spare Part Name</th>
                    <th class="px-6 py-4 font-semibold">Category</th>
                    <th class="px-6 py-4 font-semibold w-24">Stock</th>
                    <th class="px-6 py-4 font-semibold w-28">Price</th>
                    <th class="px-6 py-4 font-semibold w-36 text-center">Qty Input</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-[15px] text-gray-700 font-century" id="sparepartTableBody">
                  @foreach($spareparts as $sp)
                  <tr class="sparepart-item hover:bg-gray-50/70 transition-colors cursor-pointer" data-category="{{ $sp['category_id'] }}">
                    <td class="px-6 py-4 text-center" onclick="event.stopPropagation()">
                      <input type="checkbox" id="chk_{{ $sp['id'] }}" data-price="{{ $sp['price'] }}" data-name="{{ $sp['name'] }}" data-target="qty_{{ $sp['id'] }}" onchange="togglePartRow(this)" class="part-checkbox w-4 h-4 rounded text-mm-navy focus:ring-0">
                    </td>
                    <td class="px-6 py-4" onclick="openDescriptionModal({{ json_encode($sp) }}, event)">
                      <img src="{{ $sp['image'] }}" class="w-12 h-12 object-cover rounded-xl border border-gray-200 shadow-sm mx-auto" alt="part">
                    </td>
                    <td class="px-6 py-4 text-black font-century text-xs text-center">{{ $sp['id'] }}</td>
                    <td class="px-6 py-4 font-bold text-black text-xs font-century sp-name text-center">{{ $sp['name'] }}</td>
                    <td class="px-6 py-4 text-black font-century text-xs text-center">{{ $sp['category_name'] }}</td>
                    <td class="px-6 py-4 font-century text-center">
                      @if($sp['stock'] <= 6)
                        <span class="px-3 py-1 rounded-full text-xs font-bold text-red-600 font-century">
                          {{ $sp['stock'] }}
                        </span>
                      @else
                        <span class="px-3 py-1 rounded-full text-xs font-bold text-black font-century">
                          {{ $sp['stock'] }}
                        </span>
                      @endif
                    </td>
                    <td class="px-6 py-4 font-bold text-[#e67e22] text-xs text-center font-century">Rp {{ number_format($sp['price'], 0, ',', '.') }}</td>
                    <td class="px-6 py-4" onclick="event.stopPropagation()">
                      <div class="flex items-center bg-gray-50 p-1 rounded-xl border border-gray-200 h-8 w-fit mx-auto opacity-50 pointer-events-none transition-all" id="counter_wrapper_{{ $sp['id'] }}">
                        <button type="button" onclick="adjustQtyCounter('qty_{{ $sp['id'] }}', -1)" class="w-6 h-6 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 active:scale-90 transition-all font-bold text-sm">-</button>
                        <input type="number" id="qty_{{ $sp['id'] }}" value="1" min="1" max="{{ $sp['stock'] }}" readonly class="part-qty-input w-8 bg-transparent text-center font-black text-mm-navy border-none text-xs focus:ring-0" onchange="updateSummaryPricing()">
                        <button type="button" onclick="adjustQtyCounter('qty_{{ $sp['id'] }}', 1)" class="w-6 h-6 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 active:scale-90 transition-all font-bold text-sm">+</button>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        @endif

      </div>

      <div id="priceSummaryContainer" class="w-full">
         </div>

    </div>

    <div class="mt-8 flex justify-end gap-4 max-w-md ml-auto">
      <a href="{{ route('owner-transaction') }}" class="w-full text-center border border-gray-300 hover:bg-gray-50 text-gray-600 font-bold py-3 px-4 rounded-[24px] transition-all uppercase text-[14px]">Cancel</a>
      <button type="button" onclick="submitCreateInvoice()" class="w-full bg-mm-navy hover:bg-mm-hover-navy text-white font-bold py-3 px-4 rounded-[24px] shadow-sm tracking-wide transition-all uppercase text-[14px]">Add</button>
    </div>

  </div>

  <script>
    const customersRepo = @json($customers);
    const vehiclesRepo = @json($vehicles);
    let selectedCustomerId = null;

    // ALERTS & VEHICLE SELECTION
    function checkCustomerSelected(event) {
      if (!selectedCustomerId && !document.getElementById('walkInCheckbox').checked) {
        event.preventDefault();
        Swal.fire({
          icon: 'warning',
          title: 'Select Customer First!',
          text: 'Please select a customer from the database before choosing a vehicle.',
          confirmButtonColor: '#15395c',
          customClass: { popup: '!rounded-[24px]' }
        });
      }
    }

    function populateVehiclesDropdown(custId) {
      const vehicleSelect = document.getElementById('assignedVehicleSelect');
      if (!vehicleSelect) return;
      
      vehicleSelect.innerHTML = '<option value="">Select customer\'s vehicle...</option>';
      
      if (vehiclesRepo[custId]) {
        vehiclesRepo[custId].forEach(v => {
          let opt = document.createElement('option');
          opt.value = `${v.type} - ${v.plate}`;
          opt.textContent = `${v.type} (${v.plate})`;
          vehicleSelect.appendChild(opt);
        });
      } else {
         let opt = document.createElement('option');
         opt.value = "";
         opt.textContent = "No registered vehicles found.";
         vehicleSelect.appendChild(opt);
      }
    }

    // TOGGLE WALK-IN SYSTEM CHECKBOX RULES
    function toggleWalkInOption(cb) {
      const sw = document.getElementById('customerSelectionWrapper');
      const selectedInput = document.getElementById('selectedCustomerInput');
      const vehicleSelect = document.getElementById('assignedVehicleSelect');

      if(cb.checked) {
        sw.classList.add('opacity-40', 'pointer-events-none');
        selectedInput.value = "NULL";
        selectedCustomerId = "NULL";
        
        if(vehicleSelect) {
            vehicleSelect.innerHTML = '<option value="">Walk-in (Unregistered Vehicle)</option>';
        }
      } else {
        sw.classList.remove('opacity-40', 'pointer-events-none');
        selectedInput.value = "";
        selectedCustomerId = null;

        if(vehicleSelect) {
            vehicleSelect.innerHTML = '<option value="">Select customer\'s vehicle...</option>';
        }
      }
    }

    // QUANTITY COUNTER ADJUSTMENT (Style Owner Catalog Counter)
    function adjustQtyCounter(inputId, amount) {
      const input = document.getElementById(inputId);
      if (input) {
        let current = parseInt(input.value) || 1;
        let min = parseInt(input.getAttribute('min')) || 1;
        let max = parseInt(input.getAttribute('max')) || 99;
        let nv = current + amount;
        if(nv >= min && nv <= max) {
          input.value = nv;
          updateSummaryPricing();
        }
      }
    }

    function togglePartRow(checkbox) {
      const wrapperId = 'counter_wrapper_' + checkbox.getAttribute('data-target').split('_')[1];
      const wrapper = document.getElementById(wrapperId);
      if(checkbox.checked) {
        wrapper.classList.remove('opacity-50', 'pointer-events-none');
      } else {
        wrapper.classList.add('opacity-50', 'pointer-events-none');
      }
      updateSummaryPricing();
    }

    // ONLY ONE SERVICE SELECTED
    function handleServiceSelection(checkbox) {
      const allServiceCheckboxes = document.querySelectorAll('.service-checkbox');
      if (checkbox.checked) {
        allServiceCheckboxes.forEach(chk => {
          if (chk !== checkbox) chk.checked = false;
        });
      }
    }

    // CATEGORY FILTER SPAREPART
    function filterSparepartCat(catId, btnEl) {
      // Update styling buttons
      document.querySelectorAll('.part-filter-btn').forEach(btn => {
        btn.classList.remove('bg-mm-navy', 'text-white', 'border-mm-navy');
        btn.classList.add('bg-transparent', 'text-gray-600', 'border-gray-300');
      });
      btnEl.classList.remove('bg-transparent', 'text-gray-600', 'border-gray-300');
      btnEl.classList.add('bg-mm-navy', 'text-white', 'border-mm-navy');

      // Filter Rows
      const rows = document.querySelectorAll('.sparepart-item');
      rows.forEach(row => {
        if (catId === 'all' || row.getAttribute('data-category') === catId) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }

    // SEARCH BASE CUSTOMER PROFILE MODAL
    function openSearchCustomerModal() {
      let rowsHtml = '';
      customersRepo.forEach(cust => {
        rowsHtml += `
          <tr class="hover:bg-gray-50 cursor-pointer select-cust-row font-century text-center transition-all" onclick="selectCustomerFromModal('${cust.id}', '${cust.name}')">
            <td class="px-4 py-2.5 text-gray-400 text-xs">${cust.id}</td>
            <td class="px-4 py-2.5 font-bold text-gray-900">${cust.name}</td>
            <td class="px-4 py-2.5 text-gray-500">${cust.phone}</td>
          </tr>`;
      });

      Swal.fire({
        title: '<span class="font-century text-[24px] font-bold text-black pt-2 block">Search Customer</span>',
        html: `
          <div class="text-left font-century pt-2 px-8 pb-4 space-y-3">
            <div class="relative">
              <input type="text" id="modalCustSearchQuery" onkeyup="filterModalCustomerTable()" placeholder="Type Customer ID or Name..." class="w-full h-[38px] border border-gray-300 rounded-lg pl-9 pr-4 outline-none text-sm focus:border-mm-navy bg-white"/>
              <span class="absolute left-3 top-3 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
              </span>
            </div>
            <div class="border border-gray-200 rounded-xl overflow-hidden bg-white max-h-[180px] overflow-y-auto">
              <table class="w-full text-left border-collapse text-xs">
                <thead class="bg-gray-50 text-gray-400 font-century text-center font-bold uppercase">
                  <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Phone</th>
                  </tr>
                </thead>
                <tbody id="modalCustomerTableBody" class="divide-y divide-gray-100 text-gray-700">${rowsHtml}</tbody>
              </table>
            </div>
          </div>
        `,
        showConfirmButton: false,
        width: 450,
        customClass: { popup: '!rounded-[24px] !p-0 !overflow-hidden', htmlContainer: '!m-0 !p-0' }
      });
    }

    function filterModalCustomerTable() {
      const query = document.getElementById('modalCustSearchQuery').value.toLowerCase();
      document.querySelectorAll('.select-cust-row').forEach(row => {
        const id = row.cells[0].textContent.toLowerCase();
        const name = row.cells[1].textContent.toLowerCase();
        row.style.display = (id.includes(query) || name.includes(query)) ? '' : 'none';
      });
    }

    function selectCustomerFromModal(id, name) {
      document.getElementById('selectedCustomerInput').value = `${name} (${id})`;
      selectedCustomerId = id;
      populateVehiclesDropdown(id);
      Swal.close();
    }

    // CREATE NEW CLIENT ACCOUNT MODAL
    function openAddCustomerModal() {
      Swal.fire({
        title: '<span class="font-century text-[28px] font-bold text-black pt-2 block">Add New Customer</span>',
        html: `
          <div class="space-y-3.5 text-left font-didact pt-2 px-8 pb-4 text-sm">
            <div>
              <label class="block mb-1 text-gray-600">Full Name</label>
              <input type="text" id="newCustName" class="w-full h-[40px] border border-gray-300 rounded-xl px-3 outline-none focus:border-mm-navy bg-white"/>
            </div>
            <div>
              <label class="block mb-1 text-gray-600">Email</label>
              <input type="email" id="newCustEmail" class="w-full h-[40px] border border-gray-300 rounded-xl px-3 outline-none focus:border-mm-navy bg-white"/>
            </div>
            <div>
              <label class="block mb-1 text-gray-600">Address</label>
              <input type="text" id="newCustAddress" class="w-full h-[40px] border border-gray-300 rounded-xl px-3 outline-none focus:border-mm-navy bg-white"/>
            </div>
            <div class="grid grid-cols-2 gap-3">
              <div>
                <label class="block mb-1 text-gray-600">Password</label>
                <input type="password" id="newCustPassword" class="w-full h-[40px] border border-gray-300 rounded-xl px-3 outline-none focus:border-mm-navy bg-white"/>
              </div>
              <div>
                <label class="block mb-1 text-gray-600">Phone Number</label>
                <input type="text" id="newCustPhone" class="w-full h-[40px] border border-gray-300 rounded-xl px-3 outline-none focus:border-mm-navy bg-white"/>
              </div>
            </div>
          </div>
        `,
        showConfirmButton: false,
        width: 440,
        footer: `
          <div class="mb-6 flex justify-end gap-3 w-full px-8 font-century">
            <button type="button" onclick="Swal.close()" class="rounded-[30px] border border-gray-300 px-5 py-2 text-xs font-bold text-gray-500">Cancel</button>
            <button type="button" onclick="showSuccessModal('Success add customer')" class="rounded-[30px] bg-mm-navy px-5 py-2 text-xs font-bold text-white hover:bg-mm-hover-navy">Add</button>
          </div>
        `,
        customClass: { popup: '!rounded-[24px] !p-0 !overflow-hidden', htmlContainer: '!m-0 !p-0' }
      });
    }

    // REALTIME BILLING CALCULATION VALUE MATRICES Engine (HTML Format Permintaan)
    function updateSummaryPricing() {
      let activeItems = [];
      
      // Calculate Service
      const serviceCheckboxes = document.querySelectorAll('.service-checkbox');
      serviceCheckboxes.forEach(chk => {
        if(chk.checked) {
          const price = parseFloat(chk.getAttribute('data-price')) || 0;
          const name = chk.getAttribute('data-name');
          activeItems.push({
            name: name,
            price: price.toString(),
            qty: 1
          });
        }
      });

      // Calculate Spareparts
      const partCheckboxes = document.querySelectorAll('.part-checkbox');
      partCheckboxes.forEach(chk => {
        if(chk.checked) {
          const price = parseFloat(chk.getAttribute('data-price')) || 0;
          const name = chk.getAttribute('data-name');
          const qtyInputId = chk.getAttribute('data-target');
          const qty = parseInt(document.getElementById(qtyInputId).value) || 1;
          
          activeItems.push({
            name: name,
            price: (price * qty).toString(),
            qty: qty
          });
        }
      });

      const transaction = {
        items: activeItems,
        delivery: false
      };

      renderSummary(transaction);
    }

    function renderSummary(transaction) {
      const container = document.getElementById('priceSummaryContainer');
      if(!container) return;

      container.innerHTML = `
        <div class="w-full">
            ${(() => {
                const subtotalVal = transaction.items.reduce((acc, item) => acc + parseFloat(item.price.replace(/\./g, '')), 0);
                const deliveryVal = transaction.delivery ? 15000 : 0;
                const grandTotal = subtotalVal + deliveryVal;
                
                const fmt = (val) => new Intl.NumberFormat('id-ID').format(val);
                
                const itemsHtml = transaction.items.length === 0 ? '<div class="text-sm text-gray-400 text-center font-century">No items selected</div>' : transaction.items.map(item => `
                    <div class="flex justify-between items-start gap-4">
                        <div class="flex gap-2 font-century">
                            <span class="text-mm-navy font-bold text-sm min-w-[20px]">${item.qty}x</span>
                            <span class="text-sm font-medium text-gray-700 leading-tight">${item.name}</span>
                        </div>
                        <span class="text-sm font-bold font-century text-gray-900 whitespace-nowrap">IDR ${fmt(item.price)}</span>
                    </div>
                `).join('');

                return `
                    <div class="w-full max-w-md bg-gray-50 rounded-[32px] p-8 space-y-6 border border-black flex flex-col items-center mx-auto">
                        <h2 class="text-xl font-bold text-gray-900 font-century uppercase tracking-widest border-b border-gray-100 pb-2 w-full text-center">Price Summary</h2>
                        
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
                                <span class="text-2xl font-black text-mm-navy font-century tracking-tighter">IDR ${fmt(grandTotal)}</span>
                            </div>
                        </div>
                    </div>
                `;
            })()}
        </div>
      `;
    }

    function submitCreateInvoice() {
      // Validate Vehicle 
      const vehicleSelect = document.getElementById('assignedVehicleSelect');
      const walkInChecked = document.getElementById('walkInCheckbox').checked;
      
      if(vehicleSelect && vehicleSelect.value === '' && !walkInChecked) {
        Swal.fire({
          icon: 'error',
          title: 'Missing Vehicle Assignment',
          text: 'Please make sure customer and their vehicle is assigned before confirming transaction.',
          confirmButtonColor: '#15395c',
          customClass: { popup: '!rounded-[20px]' }
        });
        return;
      }

      showSuccessModal('Transaction added successfully!');
      window.setTimeout(() => {
        window.location.href = "{{ route('owner-transaction') }}";
      }, 1500);
    }

    // Initialize Empty Summary on Page Load
    document.addEventListener('DOMContentLoaded', () => {
      updateSummaryPricing();
    });

  </script>
</body>
</html>