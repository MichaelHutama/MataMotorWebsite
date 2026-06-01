<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor — Create Invoice</title>
  <script src="https://cdn.tailwindcss.com\"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com\">
  <link rel="preconnect" href="https://fonts.gstatic.com\" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap\" rel="stylesheet">
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
            century: ['"Century Gothic"', 'sans-serif']
          }
        }
      }
    }
  </script>
  <style>
    .font-century { font-family: 'Century Gothic', sans-serif; }
    .font-didact { font-family: 'Didact Gothic', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 font-didact text-gray-800">

  @php
    $mode = request()->query('mode', 'both'); // both, sparepart, service
    
    // DUMMY REPOSITORIES DATA
    $customers = [
      ['id' => 'CUST-01', 'name' => 'Ahmad Subarjo', 'phone' => '08123456789'],
      ['id' => 'CUST-02', 'name' => 'Siti Aminah', 'phone' => '08776543210'],
      ['id' => 'CUST-03', 'name' => 'Budi Setiadi', 'phone' => '08991122334']
    ];

    $spareparts_repo = [
      ['id' => 'SP-01', 'name' => 'Brake Pad Front', 'stock' => 12, 'price' => 125000, 'category' => 'Brake System'],
      ['id' => 'SP-02', 'name' => 'Engine Oil Motul 1L', 'stock' => 20, 'price' => 150000, 'category' => 'Engine Parts'],
      ['id' => 'SP-03', 'name' => 'Tubeless Tire Maxxis', 'stock' => 6, 'price' => 320000, 'category' => 'Tires'],
      ['id' => 'SP-04', 'name' => 'NGK Spark Plug', 'stock' => 50, 'price' => 350000, 'category' => 'Electrical Parts']
    ];
  @endphp

  <div class="max-w-6xl mx-auto p-8">
    
    <div class="flex items-center justify-between mb-8 border-b border-gray-200 pb-5">
      <div class="flex items-center gap-4">
        <a href="{{ route('owner-transaction') }}" class="w-10 h-10 border border-gray-300 rounded-full flex items-center justify-center bg-white shadow-sm text-gray-600 hover:bg-gray-50 font-bold transition-all">&larr;</a>
        <div>
          <h1 class="font-century text-2xl font-black text-mm-navy">Create New Transaction Invoice</h1>
          <p class="text-xs text-gray-400 mt-0.5">Mode: <span class="uppercase font-bold text-blue-600">{{ $mode }}</span></p>
        </div>
      </div>
      
      <div class="flex items-center gap-3 font-century text-sm">
        <label class="text-gray-500">Link to Transaction ID:</label>
        <input type="text" placeholder="e.g., TX-1001" class="w-32 h-[38px] border border-gray-300 rounded-lg px-3 outline-none focus:border-mm-navy bg-white uppercase font-mono font-bold text-xs">
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
      
      <div class="lg:col-span-2 space-y-6">
        
        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-100">
          <div class="flex justify-between items-center mb-4">
            <h3 class="font-century font-bold text-gray-900 text-[16px]">Customer Information</h3>
            <button type="button" onclick="openAddCustomerModal()" class="text-blue-600 text-sm font-medium font-century hover:underline">+ Add New Customer Account</button>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
            <div id="customerSelectionWrapper">
              <label class="block text-xs text-gray-400 mb-1 font-century uppercase">Select Customer (ID / Name)</label>
              <div class="relative cursor-pointer" onclick="openSearchCustomerModal()">
                <input type="text" id="selectedCustomerInput" readonly placeholder="Click to search client base..." class="w-full h-[42px] border border-gray-300 rounded-xl pl-4 pr-10 outline-none bg-gray-50 cursor-pointer font-medium text-sm text-gray-800">
                <span class="absolute right-3.5 top-3.5 text-gray-400">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
              </div>
            </div>

            <div class="flex items-center h-[42px]">
              <label class="relative flex items-center gap-2 cursor-pointer select-none">
                <input type="checkbox" id="walkInCheckbox" onchange="toggleWalkInOption(this)" class="w-4 h-4 rounded text-mm-navy focus:ring-0">
                <span class="text-sm font-medium text-gray-600">Anonymous Walk-In Transaction (No Customer Profile)</span>
              </label>
            </div>
          </div>
        </div>

        @if($mode === 'both' || $mode === 'service')
        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-100">
          <div class="flex justify-between items-center mb-4 border-b border-gray-50 pb-3">
            <h3 class="font-century font-bold text-gray-900 text-[16px]">Service Details Assignment</h3>
            <button type="button" onclick="addVehicle()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-1.5 rounded-full font-century font-bold text-xs tracking-wide transition-all">+ Assign Vehicle</button>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
              <label class="block text-xs text-gray-400 mb-1 font-century uppercase">Vehicle Profile Details</label>
              <input type="text" id="assignedVehicleInfo" readonly placeholder="No vehicle assigned yet" class="w-full h-[42px] border border-gray-200 rounded-xl px-4 outline-none bg-gray-50 text-sm font-bold text-gray-700">
            </div>
            <div>
              <label class="block text-xs text-gray-400 mb-1 font-century uppercase">Service Package Item</label>
              <select id="serviceItemSelect" onchange="updateSummaryPricing()" class="w-full h-[42px] border border-gray-300 rounded-xl px-3 bg-white outline-none focus:border-mm-navy font-medium text-sm">
                <option value="0" data-price="0">-- Select Workshop Service Plan --</option>
                <option value="SV-01" data-price="200000">Full Engine Tuning (IDR 200,000)</option>
                <option value="SV-02" data-price="85000">Light CVT Service (IDR 85,000)</option>
                <option value="SV-03" data-price="50000">General Wheel Balancing (IDR 50,000)</option>
              </select>
            </div>
          </div>
        </div>
        @endif

        @if($mode === 'both' || $mode === 'sparepart')
        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-100">
          <h3 class="font-century font-bold text-gray-900 text-[16px] mb-4">Select Sparepart Inventories</h3>
          
          <div class="border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm">
            <table class="w-full text-left border-collapse text-[13px] font-didact">
              <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-400 font-century font-bold text-[11px] uppercase tracking-wider">
                  <th class="px-4 py-3 text-center w-12">Pick</th>
                  <th class="px-4 py-3">Part Details</th>
                  <th class="px-4 py-3">Category</th>
                  <th class="px-4 py-3">Unit Price</th>
                  <th class="px-4 py-3 text-center w-36">Quantity Input</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100 text-gray-700">
                @foreach($spareparts_repo as $index => $part)
                <tr class="sparepart-item" data-category="{{ $part['category'] }}">
                  <td class="px-4 py-3 text-center">
                    <input type="checkbox" id="chk_{{ $part['id'] }}" data-price="{{ $part['price'] }}" data-target="qty_{{ $part['id'] }}" onchange="togglePartRow(this)" class="part-checkbox w-4 h-4 rounded text-mm-navy focus:ring-0">
                  </td>
                  <td class="px-4 py-3">
                    <div class="font-bold text-gray-900 sp-name">{{ $part['name'] }}</div>
                    <div class="text-[11px] text-gray-400">ID: {{ $part['id'] }} | Stock: {{ $part['stock'] }}</div>
                  </td>
                  <td class="px-4 py-3">
                    <span class="px-2 py-0.5 rounded text-[11px] bg-slate-100 font-bold text-gray-500">{{ $part['category'] }}</span>
                  </td>
                  <td class="px-4 py-3 font-century font-medium">IDR {{ number_format($part['price'], 0, ',', '.') }}</td>
                  
                  <td class="px-4 py-3 text-center">
                    <div class="flex items-center bg-gray-50 p-1 rounded-xl border border-gray-200 h-8 w-fit mx-auto opacity-50 pointer-events-none transition-all" id="counter_wrapper_{{ $part['id'] }}">
                      <button type="button" onclick="adjustQtyCounter('qty_{{ $part['id'] }}', -1)" class="w-6 h-6 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 active:scale-90 transition-all font-bold text-sm">-</button>
                      <input type="number" id="qty_{{ $part['id'] }}" value="1" min="1" max="{{ $part['stock'] }}" readonly onchange="updateSummaryPricing()" class="part-qty-input w-8 bg-transparent text-center font-black text-mm-navy border-none text-xs focus:ring-0">
                      <button type="button" onclick="adjustQtyCounter('qty_{{ $part['id'] }}', 1)" class="w-6 h-6 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 active:scale-90 transition-all font-bold text-sm">+</button>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @endif

      </div>

      <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-100 font-century">
        <h3 class="font-bold text-gray-900 text-[16px] mb-4 uppercase tracking-wider text-xs text-gray-400">Price Billing Invoice</h3>
        
        <div class="space-y-3 mb-6 border-b border-dashed border-gray-200 pb-4 text-sm text-gray-600">
          <div class="flex justify-between">
            <span>Sparepart Sales</span>
            <span id="summarySparepartBill">IDR 0</span>
          </div>
          <div class="flex justify-between">
            <span>Service Base</span>
            <span id="summaryServiceBill">IDR 0</span>
          </div>
        </div>

        <div class="pt-2 flex justify-between items-center mb-8">
          <span class="text-xs font-bold text-gray-900 uppercase tracking-widest">Grand Total</span>
          <span class="text-xl font-black text-mm-navy tracking-tighter" id="summaryGrandTotal">IDR 0</span>
        </div>

        <div class="space-y-3 font-century text-[14px]">
          <button type="button" onclick="submitCreateInvoice()" class="w-full bg-mm-navy hover:bg-mm-hover-navy text-white font-bold py-3 px-4 rounded-[24px] shadow-sm tracking-wide transition-all">Create & Print Invoice</button>
          <a href="{{ route('owner-transaction') }}" class="block w-full text-center border border-gray-300 hover:bg-gray-50 text-gray-600 font-bold py-2.5 px-4 rounded-[24px] transition-all">Cancel</a>
        </div>
      </div>

    </div>
  </div>

  <script>
    const customersRepo = @json($customers);

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

    // TOGGLE WALK-IN SYSTEM CHECKBOX RULES
    function toggleWalkInOption(cb) {
      const sw = document.getElementById('customerSelectionWrapper');
      const selectedInput = document.getElementById('selectedCustomerInput');
      if(cb.checked) {
        sw.classList.add('opacity-40', 'pointer-events-none');
        selectedInput.value = "Anonymous Walk-In Customer";
      } else {
        sw.classList.remove('opacity-40', 'pointer-events-none');
        selectedInput.value = "";
      }
    }

    // VEHICLE ATTACHMENT ACTION HANDLER SYSTEM
    function addVehicle() {
      Swal.fire({
        title: '<span class="font-century text-[24px] font-bold text-black pt-6 block">Assign Vehicle</span>',
        html: `
          <div class="space-y-4 text-left font-didact pt-2 px-8 pb-4">
            <div>
              <label class="block mb-1 text-xs text-gray-500 uppercase">Vehicle Name & Model</label>
              <input type="text" id="modalVName" placeholder="e.g., Honda Vario 150" class="w-full h-[40px] border border-gray-300 rounded-xl px-3 outline-none focus:border-mm-navy text-sm bg-white"/>
            </div>
            <div>
              <label class="block mb-1 text-xs text-gray-500 uppercase">License Plate Number</label>
              <input type="text" id="modalVPlate" placeholder="e.g., B 1234 ABC" class="w-full h-[40px] border border-gray-300 rounded-xl px-3 outline-none focus:border-mm-navy text-sm bg-white uppercase"/>
            </div>
          </div>
        `,
        showConfirmButton: false,
        width: 380,
        footer: `
          <div class="mb-6 flex justify-end gap-3 w-full px-8 font-century">
            <button type="button" onclick="Swal.close()" class="rounded-[30px] border border-gray-300 px-5 py-2 text-xs font-bold text-gray-500">Cancel</button>
            <button type="button" onclick="saveAssignedVehicle()" class="rounded-[30px] bg-mm-navy px-5 py-2 text-xs font-bold text-white">Attach</button>
          </div>
        `,
        customClass: { popup: '!rounded-[24px] !p-0 !overflow-hidden', htmlContainer: '!m-0 !p-0' }
      });
    }

    function saveAssignedVehicle() {
      const model = document.getElementById('modalVName').value;
      const plate = document.getElementById('modalVPlate').value;
      if(!model || !plate) return;
      document.getElementById('assignedVehicleInfo').value = `${model} (${plate.toUpperCase()})`;
      Swal.close();
    }

    // SEARCH BASE CUSTOMER PROFILE MODAL
    function openSearchCustomerModal() {
      let rowsHtml = '';
      customersRepo.forEach(cust => {
        rowsHtml += `
          <tr class="hover:bg-gray-50 cursor-pointer select-cust-row transition-all" onclick="selectCustomerFromModal('${cust.id}', '${cust.name}')">
            <td class="px-4 py-2.5 font-mono text-gray-400 text-xs">${cust.id}</td>
            <td class="px-4 py-2.5 font-bold text-gray-900">${cust.name}</td>
            <td class="px-4 py-2.5 text-gray-500">${cust.phone}</td>
          </tr>`;
      });

      Swal.fire({
        title: '<span class="font-century text-[24px] font-bold text-black pt-6 block">Search Customer Directory</span>',
        html: `
          <div class="text-left font-didact pt-2 px-8 pb-4 space-y-3">
            <div class="relative">
              <input type="text" id="modalCustSearchQuery" onkeyup="filterModalCustomerTable()" placeholder="Type Customer ID or Name..." class="w-full h-[38px] border border-gray-300 rounded-lg pl-9 pr-4 outline-none text-sm focus:border-mm-navy bg-white"/>
              <span class="absolute left-3 top-3 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
              </span>
            </div>
            <div class="border border-gray-200 rounded-xl overflow-hidden bg-white max-h-[180px] overflow-y-auto">
              <table class="w-full text-left border-collapse text-xs">
                <thead class="bg-gray-50 text-gray-400 font-century font-bold uppercase">
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
      Swal.close();
    }

    // CREATE NEW CLIENT ACCOUNT MODAL
    function openAddCustomerModal() {
      Swal.fire({
        title: '<span class="font-century text-[28px] font-bold text-black pt-6 block">Add New Customer Account</span>',
        html: `
          <div class="space-y-3.5 text-left font-didact pt-2 px-8 pb-4 text-sm">
            <div>
              <label class="block mb-1 text-gray-600">Full Name</label>
              <input type="text" id="newCustName" class="w-full h-[40px] border border-gray-300 rounded-xl px-3 outline-none focus:border-mm-navy bg-white"/>
            </div>
            <div>
              <label class="block mb-1 text-gray-600">Email Address</label>
              <input type="email" id="newCustEmail" class="w-full h-[40px] border border-gray-300 rounded-xl px-3 outline-none focus:border-mm-navy bg-white"/>
            </div>
            <div>
              <label class="block mb-1 text-gray-600">Home Address</label>
              <input type="text" id="newCustAddress" class="w-full h-[40px] border border-gray-300 rounded-xl px-3 outline-none focus:border-mm-navy bg-white"/>
            </div>
            <div class="grid grid-cols-2 gap-3">
              <div>
                <label class="block mb-1 text-gray-600">Password</label>
                <input type="password" id="newCustPassword" class="w-full h-[40px] border border-gray-300 rounded-xl px-3 outline-none focus:border-mm-navy bg-white"/>
              </div>
              <div>
                <label class="block mb-1 text-gray-600">Telephone Line</label>
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
            <button type="button" onclick="submitCreateCustomerProfile()" class="rounded-[30px] bg-mm-navy px-5 py-2 text-xs font-bold text-white hover:bg-mm-hover-navy">Register Account</button>
          </div>
        `,
        customClass: { popup: '!rounded-[24px] !p-0 !overflow-hidden', htmlContainer: '!m-0 !p-0' }
      });
    }

    function submitCreateCustomerProfile() {
      const name = document.getElementById('newCustName').value;
      if(!name) return;
      document.getElementById('selectedCustomerInput').value = `${name} (NEW-ACCOUNT)`;
      Swal.close();
      Swal.fire({ icon: 'success', title: 'Registered!', text: 'New account registered inside database.', timer: 1200, showConfirmButton: false });
    }

    // REALTIME BILLING CALCULATION VALUE MATRICES Engine
    function updateSummaryPricing() {
      let sparepartTotal = 0;
      let serviceTotal = 0;

      // Hitung Sparepart jika elemen eksis di halaman
      const checkboxes = document.querySelectorAll('.part-checkbox');
      checkboxes.forEach(chk => {
        if(chk.checked) {
          const price = parseFloat(chk.getAttribute('data-price')) || 0;
          const qtyInputId = chk.getAttribute('data-target');
          const qty = parseFloat(document.getElementById(qtyInputId).value) || 1;
          sparepartTotal += (price * qty);
        }
      });

      // Hitung Service jika elemen eksis di halaman
      const svSelect = document.getElementById('serviceItemSelect');
      if(svSelect) {
        const activeOption = svSelect.options[svSelect.selectedIndex];
        serviceTotal = parseFloat(activeOption.getAttribute('data-price')) || 0;
      }

      let grandTotal = sparepartTotal + serviceTotal;

      // Sinkronisasikan teks isi Summary Box Kanan
      if(document.getElementById('summarySparepartBill')) {
        document.getElementById('summarySparepartBill').textContent = `IDR ${sparepartTotal.toLocaleString('id-ID')}`;
      }
      if(document.getElementById('summaryServiceBill')) {
        document.getElementById('summaryServiceBill').textContent = `IDR ${serviceTotal.toLocaleString('id-ID')}`;
      }
      document.getElementById('summaryGrandTotal').textContent = `IDR ${grandTotal.toLocaleString('id-ID')}`;
    }

    function submitCreateInvoice() {
      Swal.fire({
        icon: 'success',
        title: '<span class="font-century text-xl font-bold">Success</span>',
        text: 'New transaction bill created and synced successfully.',
        timer: 1500,
        showConfirmButton: false,
        customClass: { popup: '!rounded-[20px]' }
      }).then(() => {
        window.location.href = "{{ route('owner-transaction') }}";
      });
    }
  </script>
</body>
</html>