<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor — Transaction Management</title>
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
            'mm-hover-navy': '#1c4974',
            'mm-bg': '#f3f4f6'
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

  @include('layouts.navbarowner')
  @include('layouts.modals')
  @include('layouts.modalowner')

  <x-header title="Transaction Management" image="{{ asset('images/backgroundownertransaction.jpg') }}"/>

  @php
    // DUMMY DATA TRANSAKSI
    $transactions = [
        [
            'id' => 'TX-1001',
            'date' => '2026-06-01',
            'customer_id' => 'CUST-01',
            'customer_name' => 'Ahmad Subarjo',
            'type' => 'Both', 
            'status' => 'Processing',
            'spareparts' => [
                ['name' => 'Brake Pad Front', 'qty' => 1, 'price' => 125000],
                ['name' => 'Engine Oil Motul 1L', 'qty' => 1, 'price' => 150000]
            ],
            'services' => [
                ['name' => 'Full Engine Tuning', 'price' => 200000]
            ],
            'vehicle' => 'Honda Vario 150 (B 1234 ABC)',
            'delivery' => false, // Dipaksa false karena mengandung Service
            'review' => 'Pelayanan servis mesin sangat memuaskan!'
        ],
        [
            'id' => 'TX-1002',
            'date' => '2026-06-01',
            'customer_id' => 'CUST-02',
            'customer_name' => 'Siti Aminah',
            'type' => 'Sparepart',
            'status' => 'Delivering',
            'spareparts' => [
                ['name' => 'Tubeless Tire Maxxis', 'qty' => 2, 'price' => 320000]
            ],
            'services' => [],
            'vehicle' => '',
            'delivery' => true, // BERHASIL: Delivery aktif khusus untuk Sparepart Sales
            'review' => null
        ],
        [
            'id' => 'TX-1003',
            'date' => '2026-05-30',
            'customer_id' => 'CUST-03',
            'customer_name' => 'Budi Setiadi',
            'type' => 'Service',
            'status' => 'Success',
            'spareparts' => [],
            'services' => [
                ['name' => 'Light CVT Service', 'price' => 85000]
            ],
            'vehicle' => 'Yamaha NMax 155 (F 5678 XYZ)',
            'delivery' => false, // Dipaksa false karena Service murni
            'review' => 'Mekanik ramah, pengerjaan cepat bener.'
        ]
    ];
  @endphp

  <div class="flex min-h-screen">
    <main class="flex-1 p-8 max-w-7xl mx-auto">
      
      <div class="flex justify-between items-center mb-8">
        <div></div>
        <div class="relative inline-block text-left">
          <button type="button" onclick="toggleAddMenu()" class="bg-mm-navy hover:bg-mm-hover-navy text-white px-6 py-3 rounded-[24px] font-century font-bold text-[15px] shadow-md flex items-center gap-2 transition-all">
            <span>+ Add New Transaction</span>
          </button>
          <div id="addTransactionDropdown" class="hidden absolute right-0 mt-2 w-56 rounded-xl bg-white shadow-lg border border-gray-100 z-50 py-1 font-century text-sm">
            <a href="{{ route('owner-addtransaction', ['mode' => 'both']) }}" class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50">Sparepart Sales & Service</a>
            <a href="{{ route('owner-addtransaction', ['mode' => 'sparepart']) }}" class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50">Sparepart Sales</a>
            <a href="{{ route('owner-addtransaction', ['mode' => 'service']) }}" class="block px-4 py-2.5 text-gray-700 hover:bg-gray-50">Service Only</a>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-100 mb-6 flex flex-col gap-4">
        <div class="flex flex-wrap items-center justify-between gap-4">
          <div class="flex gap-4 border-b border-gray-100 pb-2 flex-1 min-w-[300px]">
            <button type="button" onclick="filterByCategory('All', this)" class="category-tab pb-2 border-b-2 border-blue-600 text-blue-600 px-2 font-bold font-century text-sm transition-all">All Types</button>
            <button type="button" onclick="filterByCategory('Sparepart', this)" class="category-tab pb-2 border-b-2 border-transparent text-gray-400 px-2 font-century text-sm hover:text-mm-navy transition-all">Sparepart Sales</button>
            <button type="button" onclick="filterByCategory('Service', this)" class="category-tab pb-2 border-b-2 border-transparent text-gray-400 px-2 font-century text-sm hover:text-mm-navy transition-all">Services</button>
          </div>

          <div class="relative w-80">
            <input type="text" id="txSearch" placeholder="Search ID or Customer..." class="w-full h-[42px] pl-10 pr-4 bg-gray-50 border border-gray-200 rounded-xl outline-none text-sm focus:border-mm-navy focus:bg-white transition-all"/>
            <span class="absolute left-3.5 top-3.5 text-gray-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
          </div>
        </div>

        <div class="flex flex-wrap gap-2 pt-2">
          <button type="button" onclick="filterByStatus('All', this)" class="status-filter-btn bg-mm-navy text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider font-century transition-all">All Status</button>
          <button type="button" onclick="filterByStatus('Pending', this)" class="status-filter-btn bg-gray-100 text-gray-500 hover:bg-amber-50 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider font-century transition-all">Pending</button>
          <button type="button" onclick="filterByStatus('Processing', this)" class="status-filter-btn bg-gray-100 text-gray-500 hover:bg-blue-50 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider font-century transition-all">Processing</button>
          <button type="button" onclick="filterByStatus('Delivering', this)" class="status-filter-btn bg-gray-100 text-gray-500 hover:bg-amber-50 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider font-century transition-all">Delivering</button>
          <button type="button" onclick="filterByStatus('Ready For Pickup', this)" class="status-filter-btn bg-gray-100 text-gray-500 hover:bg-purple-50 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider font-century transition-all">Ready For Pickup</button>
          <button type="button" onclick="filterByStatus('Success', this)" class="status-filter-btn bg-gray-100 text-gray-500 hover:bg-green-50 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider font-century transition-all">Success</button>
          <button type="button" onclick="filterByStatus('Cancelled', this)" class="status-filter-btn bg-gray-100 text-gray-500 hover:bg-red-50 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider font-century transition-all">Cancelled</button>
        </div>
      </div>

      <div class="bg-white rounded-[24px] overflow-hidden border border-gray-200 shadow-sm">
        <table class="w-full text-left border-collapse font-didact text-[14px]">
          <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-400 font-century text-[13px] font-bold uppercase tracking-wider">
              <th class="px-6 py-4 w-28">ID</th>
              <th class="px-6 py-4">Date</th>
              <th class="px-6 py-4">Customer Name</th>
              <th class="px-6 py-4">Transaction Type</th>
              <th class="px-6 py-4 text-center">Status</th>
              <th class="px-6 py-4 text-center w-28">Action</th>
            </tr>
          </thead>
          <tbody id="transactionTableBody" class="divide-y divide-gray-100 text-gray-700">
            @foreach($transactions as $tx)
              <tr class="transaction-row hover:bg-gray-50 transition-all cursor-pointer" 
                  data-type="{{ $tx['type'] }}" 
                  data-status="{{ $tx['status'] }}"
                  data-tx-json="{{ json_encode($tx) }}"
                  onclick="handleRowClick(this, event)">
                <td class="px-6 py-4 font-mono font-bold text-gray-900">{{ $tx['id'] }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $tx['date'] }}</td>
                <td class="px-6 py-4 font-medium text-gray-900 search-name">{{ $tx['customer_name'] }}</td>
                <td class="px-6 py-4">
                  <span class="px-3 py-1 rounded-lg text-xs font-bold bg-slate-100 text-slate-700 font-century">{{ $tx['type'] }}</span>
                </td>
                <td class="px-6 py-4 text-center">
                  @php
                    $statusClass = match($tx['status']) {
                      'Pending' => 'bg-amber-50 text-amber-600 border border-amber-200',
                      'Processing' => 'bg-blue-50 text-blue-600 border border-blue-200',
                      'Delivering' => 'bg-amber-100 text-amber-700 border border-amber-400',
                      'Ready For Pickup' => 'bg-purple-50 text-purple-600 border border-purple-200',
                      'Success' => 'bg-green-50 text-green-600 border border-green-200',
                      'Cancelled' => 'bg-red-50 text-red-600 border border-red-200',
                      default => 'bg-gray-50 text-gray-600'
                    };
                  @endphp
                  <span class="px-4 py-1.5 rounded-full text-xs font-black uppercase font-century tracking-wide {{ $statusClass }}">
                    {{ $tx['status'] }}
                  </span>
                </td>
                <td class="px-6 py-4 text-center" onclick="event.stopPropagation();">
                  <button type="button" onclick="changeStatus('{{ $tx['id'] }}', '{{ $tx['status'] }}', '{{ $tx['type'] }}', {{ ($tx['type'] === 'Sparepart' && $tx['delivery']) ? 'true' : 'false' }})" class="text-blue-600 hover:text-blue-800 font-medium font-century text-[13px] underline">
                    Edit Status
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </main>
  </div>

  <script>
    let currentCategory = 'All';
    let currentStatus = 'All';

    function fmt(val) {
        return Number(val).toLocaleString('id-ID');
    }

     KakaoTalk
    function handleRowClick(rowElement, event) {
        try {
            const rawJson = rowElement.getAttribute('data-tx-json');
            const txData = JSON.parse(rawJson);
            openTransactionDetail(txData, event);
        } catch (e) {
            console.error("Gagal melakukan parsing data transaksi:", e);
        }
    }

    function toggleAddMenu() {
      const menu = document.getElementById('addTransactionDropdown');
      menu.classList.toggle('hidden');
    }

    window.addEventListener('click', function(e) {
      if (!e.target.closest('#addTransactionDropdown') && !e.target.innerHTML.includes('+ Add New Transaction')) {
        const dropdown = document.getElementById('addTransactionDropdown');
        if(dropdown) dropdown.classList.add('hidden');
      }
    });

    function filterByCategory(type, element) {
      currentCategory = type;
      document.querySelectorAll('.category-tab').forEach(btn => {
        btn.className = "category-tab pb-2 border-b-2 border-transparent text-gray-400 px-2 font-century text-sm hover:text-mm-navy transition-all";
      });
      element.className = "category-tab pb-2 border-b-2 border-blue-600 text-blue-600 px-2 font-bold font-century text-sm transition-all";
      runFilterEngine();
    }

    function filterByStatus(status, element) {
      currentStatus = status;
      document.querySelectorAll('.status-filter-btn').forEach(btn => {
        btn.className = "status-filter-btn bg-gray-100 text-gray-500 hover:bg-gray-50 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider font-century transition-all";
      });
      element.className = "status-filter-btn bg-mm-navy text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider font-century transition-all";
      runFilterEngine();
    }

    function runFilterEngine() {
      const kw = document.getElementById('txSearch').value.toLowerCase();
      
      document.querySelectorAll('.transaction-row').forEach(row => {
        const id = row.querySelector('td').textContent.toLowerCase();
        const name = row.querySelector('.search-name').textContent.toLowerCase();
        const type = row.getAttribute('data-type');
        const status = row.getAttribute('data-status');

        const matchCategory = (currentCategory === 'All' || type === currentCategory || type === 'Both');
        const matchStatus = (currentStatus === 'All' || status === currentStatus);
        const matchKeyword = (id.includes(kw) || name.includes(kw));

        if (matchCategory && matchStatus && matchKeyword) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }

    document.getElementById('txSearch').addEventListener('keyup', runFilterEngine);

    // KUNCI UTAMA: Pilihan status 'Delivering' HANYA muncul jika bertipe Sparepart & memiliki pengantaran (delivery)
    function changeStatus(id, currentStatus, type, isSparepartDelivery) {
        let options = {
            'Pending': 'Pending',
            'On Progress': 'On Progress'
        };

        if (type === 'Sparepart' && isSparepartDelivery) {
            options['Delivering'] = 'Delivering';
        }

        options['Ready For Pickup'] = 'Ready For Pickup';
        options['Success'] = 'Success';
        options['Cancelled'] = 'Cancelled';

        Swal.fire({
            title: 'Update Status',
            text: `Change status for transaction ${id}`,
            input: 'select',
            inputOptions: options,
            inputValue: currentStatus,
            showCancelButton: true,
            confirmButtonColor: '#15395c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Update'
        }).then((result) => {
            if (result.isConfirmed && result.value !== currentStatus) {
                Swal.fire({
                    icon: 'success',
                    title: 'Status Updated',
                    text: `Transaction ${id} is now ${result.value}`,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            }
        });
    }

    function openTransactionDetail(tx, event) {
        let sectionsHtml = '';
        let mappedItems = [];
        
        if (tx.services && tx.services.length > 0) {
            tx.services.forEach(sv => {
                mappedItems.push({
                    category: 'Vehicle Service',
                    name: sv.name,
                    item_id: tx.id + '-SV',
                    desc: tx.vehicle ? tx.vehicle : 'Walk-in Customer Vehicle',
                    price: Number(sv.price).toLocaleString('id-ID'),
                    status: tx.status,
                    status_color: tx.status === 'Success' ? 'bg-green-600' : (tx.status === 'Delivering' ? 'bg-amber-500' : 'bg-blue-600'),
                    image: 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png'
                });
            });
        }
        
        if (tx.spareparts && tx.spareparts.length > 0) {
            tx.spareparts.forEach(sp => {
                mappedItems.push({
                    category: 'Sparepart Sales',
                    name: sp.name,
                    item_id: tx.id + '-SP',
                    price: Number(sp.price * sp.qty).toLocaleString('id-ID'),
                    status: tx.status,
                    status_color: tx.status === 'Success' ? 'bg-green-600' : (tx.status === 'Delivering' ? 'bg-amber-500' : 'bg-blue-600'),
                    image: 'https://cdn-icons-png.flaticon.com/512/2316/2316041.png'
                });
            });
        }

        // AMAN: Validasi ketat, delivery object hanya dibangun jika tipe murni Sparepart sales saja
        const isEligibleForDelivery = (tx.type === 'Sparepart' && tx.delivery === true);

        const transactionReplica = {
            id: tx.id,
            date: tx.date,
            time: '10:00',
            delivery: isEligibleForDelivery ? {
                receiver: tx.customer_name,
                address: 'Jl. Raya Motor No. 45, Blok C, Jakarta Selatan',
                method: 'Mata Motor Courier Service',
                notes: 'Kirim paket sparepart, harap ketuk pagar rumah.'
            } : null,
            payment: {
                status: tx.status === 'Success' ? 'SUCCESS' : 'PENDING',
                method: 'Bank Transfer',
                channel: 'BVA'
            },
            paid_time: tx.status === 'Success' ? '10:05 WIB' : '-',
            items: mappedItems
        };

        const serviceItems = transactionReplica.items.filter(item => item.category === 'Vehicle Service');
        const sparepartItems = transactionReplica.items.filter(item => item.category === 'Sparepart Sales');

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
                                        <span class="text-gray-400 font-medium tracking-wide">Fulfillment</span>
                                        <span class="font-bold text-black border-l border-gray-100 pl-4">${transactionReplica.delivery ? 'Delivery' : 'Pick-up At Store'}</span>
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </div>`;
        }

        let deliveryHtml = '';
        if (transactionReplica.delivery) {
            deliveryHtml = `
            <div class="space-y-1 font-century mt-6">
                <h3 class="text-lg font-bold text-[#15395c] font-inter tracking-widest border-b border-gray-50 mb-3 uppercase">Delivery Detail</h3>
                <div class="grid grid-cols-[auto_1fr] gap-x-8 gap-y-2 text-[12px] items-center">
                    <span class="text-gray-400 tracking-wide">Receiver</span>
                    <span class="font-bold text-black border-l border-gray-100 pl-4">${transactionReplica.delivery.receiver}</span>

                    <span class="text-gray-400 font-medium tracking-wide">Address</span>
                    <span class="font-bold text-black border-l border-gray-100 pl-4">${transactionReplica.delivery.address}</span>

                    <span class="text-gray-400 font-medium tracking-wide">Method</span>
                    <span class="font-bold text-black border-l border-gray-100 pl-4">${transactionReplica.delivery.method}</span>

                    <span class="text-gray-400 font-medium tracking-wide">Notes</span>
                    <span class="font-bold text-black border-l border-gray-100 pl-4 italic">"${transactionReplica.delivery.notes}"</span>
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
                            <span class="font-bold text-black border-l border-gray-100 pl-4">${transactionReplica.id}</span>
                            
                            <span class="text-gray-400 font-medium tracking-wide">Customer Account</span>
                            <span class="font-bold text-black border-l border-gray-100 pl-4">${tx.customer_name} (${tx.customer_id})</span>

                            <span class="text-gray-400 font-medium tracking-wide">Date & Time</span>
                            <span class="font-bold text-black border-l border-gray-100 pl-4">${transactionReplica.date}, ${transactionReplica.time} WIB</span>
                        </div>
                    </div>
                </div>

                <div class="text-left px-4">
                    ${sectionsHtml}
                    
                    <div class="py-8 grid grid-cols-1 md:grid-cols-2 gap-8 items-start px-4">
                        <div class="space-y-8">
                            <div class="space-y-1 font-century">
                                <h3 class="text-lg font-bold text-[#15395c] font-inter tracking-widest border-b border-gray-50 mb-3 uppercase">Payment Detail</h3>
                                <div class="grid grid-cols-[auto_1fr] gap-x-8 gap-y-2 text-[12px] items-center">
                                    <span class="text-gray-400 tracking-wide">Status</span>
                                    <span class="font-bold text-black border-l border-gray-100 pl-4">${transactionReplica.payment.status}</span>

                                    <span class="text-gray-400 font-medium tracking-wide">Method</span>
                                    <span class="font-bold text-black border-l border-gray-100 pl-4">${transactionReplica.payment.method} (${transactionReplica.payment.channel})</span>

                                    <span class="text-gray-400 font-medium tracking-wide">Time</span>
                                    <span class="font-bold text-black whitespace-nowrap border-l border-gray-100 pl-4">${transactionReplica.paid_time}</span>
                                </div>
                            </div>

                            ${deliveryHtml}
                        </div>

                        <div class="w-full">
                            ${(() => {
                                const subtotalVal = transactionReplica.items.reduce((acc, item) => acc + parseFloat(item.price.replace(/\./g, '')), 0);
                                const deliveryVal = transactionReplica.delivery ? 15000 : 0;
                                const grandTotal = subtotalVal + deliveryVal;
                                
                                const itemsHtml = transactionReplica.items.map(item => `
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
                                                ${transactionReplica.delivery ? `
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