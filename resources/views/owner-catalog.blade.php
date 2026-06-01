<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor — Catalog Management</title>
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
    /* Mengubah warna overlay SweetAlert agar abu-abu transparan elegan */
    .swal2-backdrop-show { background: rgba(0, 0, 0, 0.4) !important; }
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
  </style>
</head>
<body class="bg-mm-bg min-h-screen flex flex-col font-didact text-gray-800">

  @php
    // --- 1. DUMMY DATA SPAREPART & CATEGORIES ---
    $categories = [
        ['id' => 'SPC-1', 'name' => 'All Spare Parts'],
        ['id' => 'SPC-2', 'name' => 'Engine Parts'],
        ['id' => 'SPC-3', 'name' => 'Brake System'],
        ['id' => 'SPC-4', 'name' => 'Electrical Parts'],
        ['id' => 'SPC-5', 'name' => 'Suspension Parts'],
        ['id' => 'SPC-6', 'name' => 'Cooling System'],
        ['id' => 'SPC-7', 'name' => 'Fuel System'],
        ['id' => 'SPC-8', 'name' => 'Transmission System'],
        ['id' => 'SPC-9', 'name' => 'Wheel and Tire']
    ];

    $spareparts = [
        [
            'id' => 'SP-433', 
            'name' => 'Filter Oli Mesin Toyota Avanza', 
            'category_id' => 'SPC-2', 
            'category_name' => 'Oil and Filter', 
            'stock' => 14, 
            'price' => 45000, 
            'image' => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=150&auto=format&fit=crop',
            'description' => 'Filter oli mobil Toyota Avanza merupakan komponen penting dalam sistem pelumasan mesin yang berfungsi menyaring kotoran, partikel logam, dan residu pembakaran dari oli mesin. Dengan menggunakan filter oli yang berkualitas, performa mesin Toyota Avanza dapat tetap optimal, lebih halus, dan memiliki umur pakai yang lebih panjang. Filter oli ini dirancang khusus agar sesuai dengan spesifikasi mesin Toyota Avanza, sehingga mampu memberikan perlindungan maksimal terhadap komponen internal mesin.'
        ],
        [
            'id' => 'SP-434', 
            'name' => 'Brake Pad Depan Honda Vario', 
            'category_id' => 'SPC-3', 
            'category_name' => 'Brake System', 
            'stock' => 4, // Low stock indicator (< 6)
            'price' => 65000, 
            'image' => 'https://images.unsplash.com/photo-1485965120184-e220f721d03e?q=80&w=150&auto=format&fit=crop',
            'description' => 'Kampas rem depan berkualitas tinggi untuk Honda Vario. Memberikan cengkraman pengereman yang pakem dan tahan panas.'
        ],
        [
            'id' => 'SP-435', 
            'name' => 'Aki GS Astra MF GTZ6V', 
            'category_id' => 'SPC-4', 
            'category_name' => 'Electrical Parts', 
            'stock' => 20, 
            'price' => 285000, 
            'image' => 'https://images.unsplash.com/photo-1558441719-ff34b0524a24?q=80&w=150&auto=format&fit=crop',
            'description' => 'Aki kering bebas perawatan (Maintenance Free) cocok untuk motor matic dengan sistem kelistrikan injeksi modern.'
        ]
    ];

    // --- 2. DUMMY DATA SERVICES ---
    $services = [
        ['id' => 'SC-1', 'name' => 'Oil and Filter Replacement', 'price' => 30000, 'icon' => 'https://cdn-icons-png.flaticon.com/512/3014/3014166.png'],
        ['id' => 'SC-2', 'name' => 'Tune Up Motor Bebek/Matik', 'price' => 45000, 'icon' => 'https://cdn-icons-png.flaticon.com/512/3014/3014166.png'],
        ['id' => 'SC-3', 'name' => 'Machine Service Overhaul', 'price' => 350000, 'icon' => 'https://cdn-icons-png.flaticon.com/512/3014/3014166.png'],
        ['id' => 'SC-4', 'name' => 'Wash & Detailing Premium', 'price' => 50000, 'icon' => 'https://cdn-icons-png.flaticon.com/512/3014/3014166.png'],
        ['id' => 'SC-5', 'name' => 'Brake Service Check', 'price' => 20000, 'icon' => 'https://cdn-icons-png.flaticon.com/512/3014/3014166.png']
    ];

    // --- 3. HITUNG STATS ---
    $totalSpareparts = count($spareparts); 
    $lowStockCount = count(array_filter($spareparts, function($sp) { return $sp['stock'] <= 6; }));
    $totalServices = count($services);
  @endphp

  @include('layouts.navbarowner')
  @include('layouts.modals')
  @include('layouts.modalowner')

  <x-header
    title="Catalog Management"
    image="{{asset('images/backgroundownermechanic.jpg')}}"/>  


  <main class="flex-1 max-w-7xl w-full mx-auto p-6 space-y-6">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white rounded-xl border border-gray-200 p-5 text-center shadow-sm">
        <h3 class="text-gray-600 tracking-wide text-[16px] font-bold font-century uppercase">Total Spare Part</h3>
        <p class="text-4xl font-bold text-mm-navy mt-1 font-century">{{ $totalSpareparts }}</p>
      </div>
      <div class="bg-white rounded-xl border border-gray-200 p-5 text-center shadow-sm">
        <h3 class="text-gray-600 tracking-wide text-[16px] font-bold font-century uppercase">Low Stock</h3>
        <p class="text-4xl font-bold text-red-600 mt-1 font-century">{{ $lowStockCount }}</p>
      </div>
      <div class="bg-white rounded-xl border border-gray-200 p-5 text-center shadow-sm">
        <h3 class="text-gray-600 tracking-wide text-[16px] font-bold font-century uppercase">Total Service</h3>
        <p class="text-4xl font-bold text-mm-navy mt-1 font-century">{{ $totalServices }}</p>
      </div>
    </div>

    <div class="relative w-full md:w-[500px]">
      <input type="text" id="catalogSearch" onkeyup="searchCatalog()" placeholder="Search sparepart or service here..." 
            class="w-full h-[42px] pl-4 pr-10 rounded-xl border border-gray-300 text-[15px] outline-none focus:border-mm-navy focus:ring-1 focus:ring-mm-navy bg-white transition-all"/>
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-3 top-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    </div>

      <div class="flex gap-8 border-b border-gray-200 text-lg font-century font-bold">
        <button id="tab-sparepart" onclick="switchTab('sparepart')" class="pb-2 border-b-2 border-blue-600 text-blue-600 px-2 transition-all">Sparepart</button>
        <button id="tab-service" onclick="switchTab('service')" class="pb-2 border-b-2 border-transparent text-gray-400 px-2 hover:text-mm-navy transition-all">Service</button>
      </div>
    </div>

    <div id="content-sparepart" class="grid grid-cols-1 md:grid-cols-4 gap-6 transition-all duration-300">
      <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm h-fit">
        <div class="p-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
          <span class="font-bold text-gray-700 text-[15px] font-century">Categories</span>
          <button onclick="openManageCategories()" class="text-gray-400 hover:text-mm-navy transition-colors" title="Manage Categories">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
          </button>
        </div>
        <div class="divide-y divide-gray-100 max-h-[380px] overflow-y-auto font-century">
          @foreach($categories as $index => $cat)
            <button onclick="filterByCategory('{{ $cat['id'] }}', this)" 
                    class="category-row block w-full text-left px-4 py-3 text-[14px] font-century transition-all {{ $index === 0 ? 'bg-gray-100 font-bold text-mm-navy' : 'text-gray-500 hover:bg-gray-50 hover:text-mm-navy' }}">
              {{ $cat['name'] }}
            </button>
          @endforeach
        </div>
      </div>

      <div class="md:col-span-3 space-y-4">
        <div class="flex justify-end">
          <button onclick="openAddSparepart()" class="bg-mm-navy hover:bg-mm-hover-navy text-white px-5 py-2 rounded-xl text-xs font-medium font-century uppercase font-bold tracking-widest flex items-center gap-2 shadow-sm transition-colors">
            <span class="text-lg font-bold">+</span> Add New Sparepart
          </button>
        </div>
        
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
              <thead>
                <tr class="bg-gray-50 text-gray-400 text-[12px] uppercase tracking-wider border-b border-gray-100 font-century text-center">
                  <th class="px-6 py-4 font-semibold w-24">Image</th>
                  <th class="px-6 py-4 font-semibold w-24">ID</th>
                  <th class="px-6 py-4 font-semibold">Spare Part Name</th>
                  <th class="px-6 py-4 font-semibold">Category</th>
                  <th class="px-6 py-4 font-semibold w-24">Stock</th>
                  <th class="px-6 py-4 font-semibold w-28">Price</th>
                  <th class="px-6 py-4 font-semibold w-24 text-center">Action</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100 text-[15px] text-gray-700 font-century" id="sparepartTableBody">
                @foreach($spareparts as $sp)
                <tr class="sparepart-item hover:bg-gray-50/70 transition-colors cursor-pointer" data-category="{{ $sp['category_id'] }}" onclick="openDescriptionModal({{ json_encode($sp) }}, event)">
                  <td class="px-6 py-4">
                    <img src="{{ $sp['image'] }}" class="w-12 h-12 object-cover rounded-xl border border-gray-200 shadow-sm" alt="part">
                  </td>
                  <td class="px-6 py-4 text-black font-century text-xs text-center">{{ $sp['id'] }}</td>
                  <td class="px-6 py-4 font-bold text-black text-xs font-century sp-name text-center">{{ $sp['name'] }}</td>
                  <td class="px-6 py-4 text-black font-century text-xs text-center">{{ $sp['category_name'] }}</td>
                  <td class="px-6 py-4 font-century text-center">
                    @if($sp['stock'] <= 6)
                      <span class="px-3 py-1 rounded-full text-xs font-bold  text-red-600 font-century">
                        {{ $sp['stock'] }}
                      </span>
                    @else
                      <span class="px-3 py-1 rounded-full text-xs font-bold  text-black font-century">
                        {{ $sp['stock'] }}
                      </span>
                    @endif
                  </td>
                  <td class="px-6 py-4 font-bold text-[#e67e22] text-xs text-center font-century">Rp {{ number_format($sp['price'], 0, ',', '.') }}</td>
                  <td class="px-6 py-4" onclick="event.stopPropagation()">
                    <div class="flex justify-center gap-2">
                      <button onclick="openEditSparepart({{ json_encode($sp) }})" 
                              class="p-2 text-mm-blue hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/>
                        </svg>
                      </button>
                      <button onclick="deleteSparepart('{{ $sp['id'] }}', '{{ $sp['name'] }}')" 
                              class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all" title="Delete">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
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

    <div id="content-service" class="hidden space-y-4 transition-all duration-300">
          <div class="flex justify-end max-w-4xl mx-auto">
            <button onclick="openAddService()" class="bg-mm-navy hover:bg-mm-hover-navy text-white px-5 py-2 rounded-xl text-[15px] font-medium font-century flex items-center gap-2 shadow-sm transition-colors">
              <span class="text-lg font-bold">+</span> Add New Service
            </button>
          </div>

          <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden max-w-4xl mx-auto">
            <div class="overflow-x-auto">
              <table class="w-full text-left border-collapse">
                <thead>
                  <tr class="bg-gray-50 text-gray-400 text-[12px] uppercase tracking-wider border-b border-gray-100 font-century text-center">
                    <th class="px-6 py-4 font-semibold w-24">Icon</th>
                    <th class="px-6 py-4 font-semibold w-24">ID</th>
                    <th class="px-6 py-4 font-semibold">Service Name</th>
                    <th class="px-6 py-4 font-semibold w-28">Price</th>
                    <th class="px-6 py-4 font-semibold w-24 text-center">Action</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-[15px] text-gray-700 font-century" id="serviceTableBody">
                  @foreach($services as $sv)
                  <tr class="service-item hover:bg-gray-50/70 transition-colors">
                    <td class="px-6 py-4">
                      <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center mx-auto shadow-sm">
                        <img src="{{ $sv['icon'] }}" class="w-6 h-6 object-contain opacity-75" alt="icon">
                      </div>
                    </td>
                    <td class="px-6 py-4 text-black font-century text-xs text-center">{{ $sv['id'] }}</td>
                    <td class="px-6 py-4 font-bold text-black text-xs font-century sv-name text-center">{{ $sv['name'] }}</td>
                    <td class="px-6 py-4 font-bold text-[#e67e22] text-xs text-center font-century">Rp {{ number_format($sv['price'], 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                      <div class="flex justify-center gap-2">
                        <button onclick="openEditService({{ json_encode($sv) }})" 
                                class="p-2 text-mm-blue hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/>
                          </svg>
                        </button>
                        <button onclick="deleteService('{{ $sv['id'] }}', '{{ $sv['name'] }}')" 
                                class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all" title="Delete">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                          </svg>
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

  </main>

  <script>
// ================= GLOBAL STATES & VARIABLES =================
    let temporaryDescription = "";
    let activeTab = 'sparepart';     // Menandai tab yang sedang aktif
    let currentCategoryId = 'SPC-1'; // Menandai kategori aktif (Default: SPC-1 / All Spare Parts)

    // ================= SWEETALERT POPUP MODAL ARCHITECTURE =================

    // A. MODAL TAMBAH SPAREPART
    function openAddSparepart() {
      Swal.fire({
        title: '<span class="font-century text-[32px] font-bold text-black pt-6 block">Add Sparepart</span>',
        html: `
          <div class="space-y-4 text-[15px] text-black text-left font-didact pt-2 px-8 pb-4">
            <div>
              <label class="block mb-1 text-gray-600">Category</label>
              <select id="spCategory" class="w-full h-[42px] border border-gray-300 rounded-xl px-3 bg-white outline-none focus:border-mm-navy">
                <option value="Engine Parts">Engine Parts</option>
                <option value="Brake System">Brake System</option>
                <option value="Electrical Parts">Electrical Parts</option>
              </select>
            </div>
            <div>
              <label class="block mb-1 text-gray-600">Name</label>
              <input type="text" id="spName" class="w-full h-[42px] border border-gray-300 rounded-xl px-4 outline-none focus:border-mm-navy bg-white"/>
            </div>
            <div class="flex items-center justify-between gap-4">
              <div>
                <label class="block mb-1 text-gray-600">Stock</label>
                <div class="flex items-center bg-gray-50 p-1 rounded-xl border border-gray-100 h-9 w-fit">
                  <button type="button" onclick="adjustStock(-1)" class="w-7 h-7 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 hover:bg-gray-100 active:scale-90 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="#15395c" stroke-width="3">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                    </svg>
                  </button>
                  <input type="number" id="stockInput" value="0" min="0" readonly class="w-10 bg-transparent text-center font-black text-mm-navy focus:outline-none focus:ring-0 border-none text-xs [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                  <button type="button" onclick="adjustStock(1)" class="w-7 h-7 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 hover:bg-gray-100 active:scale-90 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="#15395c" stroke-width="3">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="text-center pr-6">
                <label class="block mb-1 text-gray-600">Image</label>
                <button type="button" class="text-gray-500 hover:text-mm-navy flex flex-col items-center mx-auto">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                </button>
              </div>
            </div>
            <div>
              <label class="block mb-1 text-gray-600">Price</label>
              <input type="number" id="spPrice" class="w-full h-[42px] border border-gray-300 rounded-xl px-4 outline-none focus:border-mm-navy bg-white" placeholder="Rp"/>
            </div>
            <div class="pt-1">
              <button type="button" onclick="openTextareaDescription('add', null, temporaryDescription)" class="text-blue-600 font-medium hover:underline text-[15px]">Add Description</button>
            </div>
          </div>
        `,
        showConfirmButton: false,
        width: 410,
        background: '#ffffff',
        footer: `
          <div class="mb-8 flex items-center justify-center gap-6 w-full px-8" style="font-family: 'Century Gothic';">
            <button type="button" onclick="temporaryDescription=''; Swal.close()" class="min-w-[120px] rounded-[30px] border-2 border-mm-navy px-5 py-2 text-[15px] font-bold text-mm-navy hover:bg-gray-50">Cancel</button>
            <button type="button" onclick="submitAddSparepart()" class="min-w-[120px] rounded-[30px] bg-mm-navy px-5 py-2 text-[15px] font-bold text-white hover:bg-mm-hover-navy">Add</button>
          </div>
        `,
        customClass: { popup: '!rounded-[30px] !p-0 !overflow-hidden', htmlContainer: '!m-0 !p-0' }
      });
    }

    // B. MODAL EDIT SPAREPART
    function openEditSparepart(sp) {
      if (temporaryDescription === "") {
        temporaryDescription = sp.description || "";
      }

      Swal.fire({
        title: '<span class="font-century text-[32px] font-bold text-black pt-6 block">Edit Sparepart</span>',
        html: `
          <div class="space-y-4 text-[15px] text-black text-left font-didact pt-2 px-8 pb-4">
            <div>
              <label class="block mb-1 text-gray-600">Category</label>
              <select id="editSpCategory" class="w-full h-[42px] border border-gray-300 rounded-xl px-3 bg-white outline-none focus:border-mm-navy">
                <option value="SPC-2" ${sp.category_id === 'SPC-2' ? 'selected' : ''}>Engine Parts</option>
                <option value="SPC-3" ${sp.category_id === 'SPC-3' ? 'selected' : ''}>Brake System</option>
                <option value="SPC-4" ${sp.category_id === 'SPC-4' ? 'selected' : ''}>Electrical Parts</option>
              </select>
            </div>
            <div>
              <label class="block mb-1 text-gray-600">Name</label>
              <input type="text" id="editSpName" value="${sp.name}" class="w-full h-[42px] border border-gray-300 rounded-xl px-4 outline-none focus:border-mm-navy bg-white"/>
            </div>
            <div class="flex items-center justify-between gap-4">
              <div>
                <label class="block mb-1 text-gray-600">Stock</label>
                <div class="flex items-center bg-gray-50 p-1 rounded-xl border border-gray-100 h-9 w-fit">
                  <button type="button" onclick="adjustStock(-1)" class="w-7 h-7 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 hover:bg-gray-100 active:scale-90 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="#15395c" stroke-width="3">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                    </svg>
                  </button>
                  <input type="number" id="stockInput" value="${sp.stock}" min="0" readonly class="w-10 bg-transparent text-center font-black text-mm-navy focus:outline-none focus:ring-0 border-none text-xs [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                  <button type="button" onclick="adjustStock(1)" class="w-7 h-7 flex items-center justify-center bg-white rounded-lg shadow-sm border border-gray-200 text-gray-600 hover:bg-gray-100 active:scale-90 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="#15395c" stroke-width="3">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="text-center pr-6">
                <label class="block mb-1 text-gray-600">Update Image</label>
                <button type="button" class="text-gray-500 hover:text-mm-navy flex flex-col items-center mx-auto">
                  <img src="${sp.image}" class="w-8 h-8 object-cover rounded-md border mb-1"/>
                </button>
              </div>
            </div>
            <div>
              <label class="block mb-1 text-gray-600">Price</label>
              <input type="number" id="editSpPrice" value="${sp.price}" class="w-full h-[42px] border border-gray-300 rounded-xl px-4 outline-none focus:border-mm-navy bg-white"/>
            </div>
            <div class="pt-1">
              <button type="button" onclick="openTextareaDescription('edit', '${window.btoa(JSON.stringify(sp))}', temporaryDescription)" class="text-blue-600 font-medium hover:underline text-[15px]">Edit Description</button>
            </div>
          </div>
        `,
        showConfirmButton: false,
        width: 410,
        background: '#ffffff',
        footer: `
          <div class="mb-8 flex items-center justify-center gap-6 w-full px-8" style="font-family: 'Century Gothic';">
            <button type="button" onclick="temporaryDescription=''; Swal.close()" class="min-w-[120px] rounded-[30px] border-2 border-mm-navy px-5 py-2 text-[15px] font-bold text-mm-navy hover:bg-gray-50">Cancel</button>
            <button type="button" onclick="submitEditSparepart()" class="min-w-[120px] rounded-[30px] bg-mm-navy px-5 py-2 text-[15px] font-bold text-white hover:bg-mm-hover-navy">Save</button>
          </div>
        `,
        customClass: { popup: '!rounded-[30px] !p-0 !overflow-hidden', htmlContainer: '!m-0 !p-0' }
      });
    }

    // C. MODAL TEXTAREA DESKRIPSI (Mendukung Alur Kembali)
    function openTextareaDescription(mode, encodedSp, currentDesc = "") {
      Swal.fire({
        title: '<span class="font-century text-[24px] font-bold text-black pt-6 block text-left px-8">Description</span>',
        html: `
          <div class="px-8 pb-4 pt-2 font-didact">
            <textarea id="modalDescArea" class="w-full border border-gray-300 rounded-xl p-4 text-[14px] h-48 resize-none focus:border-mm-navy outline-none" placeholder="Write comprehensive product details here...">${currentDesc}</textarea>
          </div>
        `,
        showConfirmButton: false,
        width: 500,
        background: '#ffffff',
        footer: `
          <div class="mb-6 flex justify-end gap-4 w-full px-8" style="font-family: 'Century Gothic';">
            <button type="button" onclick="handleDescBack('${mode}', ${encodedSp ? `'${encodedSp}'` : 'null'}, false)" class="rounded-[30px] border border-gray-400 px-6 py-1.5 text-[14px] text-gray-600 hover:bg-gray-50">Cancel</button>
            <button type="button" onclick="handleDescBack('${mode}', ${encodedSp ? `'${encodedSp}'` : 'null'}, true)" class="rounded-[30px] bg-mm-navy px-6 py-1.5 text-[14px] text-white hover:bg-mm-hover-navy">OK</button>
          </div>
        `,
        customClass: { popup: '!rounded-[20px] !p-0 !overflow-hidden', htmlContainer: '!m-0 !p-0' }
      });
    }

    // D. RUN ROUTING BALIK DESKRIPSI
    function handleDescBack(mode, encodedSp, shouldSave) {
      if (shouldSave) {
        temporaryDescription = document.getElementById('modalDescArea').value;
      }
      if (mode === 'edit' && encodedSp) {
        let originalSp = JSON.parse(window.atob(encodedSp));
        openEditSparepart(originalSp);
      } else {
        openAddSparepart();
      }
    }

    // E. MODAL SHOW FULL DETAIL DESKRIPSI
    function openDescriptionModal(sparepart, event) {
      Swal.fire({
        title: '<span class="font-century text-[26px] font-bold text-black pt-6 block text-left px-8">Description</span>',
        html: `
          <div class="px-8 pb-8 pt-2 font-didact text-left text-[14px] text-gray-700 leading-relaxed max-h-[320px] overflow-y-auto">
            <div class="font-bold text-black text-[16px] mb-2 font-century">${sparepart.name}</div>
            <p>${sparepart.description}</p>
          </div>
        `,
        showConfirmButton: false,
        showCloseButton: true,
        width: 550,
        background: '#ffffff',
        customClass: { popup: '!rounded-[20px] !p-0', htmlContainer: '!m-0 !p-0' }
      });
    }


// F. MODAL MANAGE SPAREPART CATEGORIES (Diperbarui dengan Tabel Dinamis dari Dummy Data)
    function openManageCategories() {
      Swal.fire({
        title: '<span class="font-century text-[32px] font-bold text-black pt-6 block">Manage Sparepart<br>Categories</span>',
        html: `
          <div class="text-left font-didact pt-2 px-8 pb-4 space-y-4">
            <div>
              <label class="block mb-1 text-[14px] text-gray-600">Add New Category</label>
              <div class="flex gap-2">
                <input type="text" id="newCategoryName" class="flex-1 h-[38px] border border-gray-400 rounded-lg px-3 outline-none focus:border-mm-navy text-[14px] bg-white"/>
                <button type="button" onclick="submitAddCategory()" class="bg-mm-navy hover:bg-mm-hover-navy text-white px-4 h-[38px] rounded-lg text-[14px] flex items-center gap-1 font-medium font-century shadow-sm">
                  <span>+</span> Add
                </button>
              </div>
            </div>

            <div class="border border-gray-200 rounded-xl overflow-hidden bg-white max-h-[160px] overflow-y-auto shadow-inner">
              <table class="w-full text-left border-collapse text-[13px]">
                <thead>
                  <tr class="bg-gray-100 text-gray-500 border-b border-gray-200">
                    <th class="px-4 py-2 font-xs uppercase font-century text-center w-24">ID</th>
                    <th class="px-4 py-2 font-xs uppercase font-century text-center">Category</th>
                    <th class="px-4 py-2 font-xs uppercase font-century text-center w-24">Action</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                  @foreach($categories as $cat)
                    {{-- Lewati 'All Spare Parts' agar tidak bisa diedit/dihapus karena merupakan filter master --}}
                    @if($cat['id'] !== 'SPC-1')
                    <tr>
                      <td class="px-4 py-2 font-century text-center text-gray-400">{{ $cat['id'] }}</td>
                      <td class="px-4 py-2 font-bold font-century text-center text-gray-900">{{ $cat['name'] }}</td>
                      <td class="px-4 py-2 text-center">
                        <div class="flex justify-center gap-2">
                          <button type="button" onclick="openEditCategory('{{ $cat['id'] }}', '{{ $cat['name'] }}')" class="text-blue-600 hover:text-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                          </button>
                          <button type="button" onclick="deleteCategory('{{ $cat['id'] }}', '{{ $cat['name'] }}')" class="text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                          </button>
                        </div>
                      </td>
                    </tr>
                    @endif
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        `,
        showConfirmButton: false,
        width: 410,
        background: '#ffffff',
        footer: `
          <div class="mb-8 flex items-center justify-center gap-6 w-full px-8" style="font-family: 'Century Gothic';">
            <button type="button" onclick="Swal.close()" class="min-w-[120px] rounded-[30px] border-2 border-mm-navy px-5 py-2 text-[15px] font-bold text-mm-navy hover:bg-gray-50">Cancel</button>
            <button type="button" onclick="showSuccessModal('Categories changes saved successfully.')" class="min-w-[120px] rounded-[30px] bg-mm-navy px-5 py-2 text-[15px] font-bold text-white hover:bg-mm-hover-navy">Save</button>
          </div>
        `,
        customClass: { popup: '!rounded-[30px] !p-0 !overflow-hidden', htmlContainer: '!m-0 !p-0' }
      });
    }

// Tambahan Fungsi untuk Handle Edit Nama Kategori
    function openEditCategory(id, currentName) {
      Swal.fire({
        title: '<span class="font-century text-[24px] font-bold text-black pt-6 block">Edit Category</span>',
        html: `
          <div class="text-left font-didact pt-2 px-8 pb-4">
            <label class="block mb-1 text-[14px] text-gray-600">Category Name (ID: ${id})</label>
            <input type="text" id="editCategoryName" value="${currentName}" class="w-full h-[38px] border border-gray-400 rounded-lg px-3 outline-none focus:border-mm-navy text-[14px] bg-white"/>
          </div>
        `,
        showConfirmButton: false,
        width: 360,
        background: '#ffffff',
        footer: `
          <div class="mb-6 flex items-center justify-center gap-4 w-full px-8" style="font-family: 'Century Gothic';">
            <button type="button" onclick="openManageCategories()" class="rounded-[30px] border border-gray-400 px-5 py-1.5 text-[14px] text-gray-600 hover:bg-gray-50">Back</button>
            <button type="button" onclick="showSuccessModal('Category has been updated successfully.');" class="rounded-[30px] bg-mm-navy px-5 py-1.5 text-[14px] text-white hover:bg-mm-hover-navy">Save</button>
          </div>
        `,
        customClass: { popup: '!rounded-[20px] !p-0 !overflow-hidden', htmlContainer: '!m-0 !p-0' }
      });
    }


    // G. MODAL TAMBAH SERVICE
    function openAddService() {
      Swal.fire({
        title: '<span class="font-century text-[32px] font-bold text-black pt-6 block">Add Service</span>',
        html: `
          <div class="space-y-4 text-[15px] text-black text-left font-didact pt-2 px-8 pb-4">
            <div>
              <label class="block mb-1 text-gray-600">Name</label>
              <input type="text" id="svName" class="w-full h-[42px] border border-gray-300 rounded-xl px-4 outline-none focus:border-mm-navy bg-white"/>
            </div>
            <div class="flex items-center justify-between gap-4">
              <div class="flex-1">
                <label class="block mb-1 text-gray-600">Price</label>
                <input type="number" id="svPrice" class="w-full h-[42px] border border-gray-300 rounded-xl px-4 outline-none focus:border-mm-navy bg-white" placeholder="Rp"/>
              </div>
              <div class="text-center pr-4">
                <label class="block mb-1 text-gray-600">Icon</label>
                <button type="button" class="text-gray-500 hover:text-mm-navy flex flex-col items-center mx-auto">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                </button>
              </div>
            </div>
          </div>
        `,
        showConfirmButton: false,
        width: 360,
        background: '#ffffff',
        footer: `
          <div class="mb-8 flex items-center justify-center gap-6 w-full px-8" style="font-family: 'Century Gothic';">
            <button type="button" onclick="Swal.close()" class="min-w-[110px] rounded-[30px] border-2 border-mm-navy px-5 py-2 text-[15px] font-bold text-mm-navy hover:bg-gray-50">Cancel</button>
            <button type="button" onclick="submitAddService()" class="min-w-[110px] rounded-[30px] bg-mm-navy px-5 py-2 text-[15px] font-bold text-white hover:bg-mm-hover-navy">Add</button>
          </div>
        `,
        customClass: { popup: '!rounded-[30px] !p-0 !overflow-hidden', htmlContainer: '!m-0 !p-0' }
      });
    }

    // H. MODAL EDIT SERVICE
    function openEditService(sv) {
      Swal.fire({
        title: '<span class="font-century text-[32px] font-bold text-black pt-6 block">Edit Service</span>',
        html: `
          <div class="space-y-4 text-[15px] text-black text-left font-didact pt-2 px-8 pb-4">
            <div>
              <label class="block mb-1 text-gray-600">Service Name</label>
              <input type="text" id="editSvName" value="${sv.name}" class="w-full h-[42px] border border-gray-300 rounded-xl px-4 outline-none focus:border-mm-navy bg-white"/>
            </div>
            <div class="flex items-center justify-between gap-4">
              <div class="flex-1">
                <label class="block mb-1 text-gray-600">Base Price</label>
                <input type="number" id="editSvPrice" value="${sv.price}" class="w-full h-[42px] border border-gray-300 rounded-xl px-4 outline-none focus:border-mm-navy bg-white"/>
              </div>
              <div class="text-center pr-4">
                <label class="block mb-1 text-gray-600">Icon</label>
                <div class="w-10 h-10 rounded-xl border flex items-center justify-center mx-auto bg-gray-50">
                  <img src="${sv.icon}" class="w-6 h-6 object-contain opacity-75"/>
                </div>
              </div>
            </div>
          </div>
        `,
        showConfirmButton: false,
        width: 360,
        background: '#ffffff',
        footer: `
          <div class="mb-8 flex items-center justify-center gap-6 w-full px-8" style="font-family: 'Century Gothic';">
            <button type="button" onclick="Swal.close()" class="min-w-[110px] rounded-[30px] border-2 border-mm-navy px-5 py-2 text-[15px] font-bold text-mm-navy hover:bg-gray-50">Cancel</button>
            <button type="button" onclick="submitEditService()" class="min-w-[110px] rounded-[30px] bg-mm-navy px-5 py-2 text-[15px] font-bold text-white hover:bg-mm-hover-navy">Save</button>
          </div>
        `,
        customClass: { popup: '!rounded-[30px] !p-0 !overflow-hidden', htmlContainer: '!m-0 !p-0' }
      });
    }

    // ================= ACTIONS LOGIC HANDLER =================

    function submitAddSparepart() {
      showSuccessModal("New sparepart item has been added successfully.");
    }

    function submitEditSparepart() {
      showSuccessModal("Sparepart details have been updated successfully.");
    }

    function submitAddService() {
      showSuccessModal("New service package has been created successfully.");
    }

    function submitEditService() {
      showSuccessModal("Service package details have been saved successfully.");
    }

    function submitAddCategory() {
      showSuccessModal("New sparepart category has been added.");
    }

    // Pemicu Fungsi Delete Menggunakan confirmDelete terpusat
    function deleteSparepart(id, name) {
      confirmDelete('Sparepart', `You will delete sparepart "${name}" (ID: ${id})`);
    }

    function deleteService(id, name) {
      confirmDelete('Service Pack', `You will delete service pack "${name}" (ID: ${id})`);
    }

    function deleteCategory(id, name) {
          // Menghitung jumlah produk di tabel yang memiliki data-category sesuai ID yang dihapus
          const productCount = document.querySelectorAll(`.sparepart-item[data-category="${id}"]`).length;
          
          const message = `You will delete category "${name}" (ID: ${id}). There are ${productCount} product(s) in this category that will be deleted.`;
          
          confirmDelete('Category', message);
        } 

    // ================= LAYOUT ENGINE CONTROLLER =================
    function adjustStock(amount) {
      const input = document.getElementById('stockInput');
      if (input) {
        let current = parseInt(input.value) || 0;
        let newValue = current + amount;
        if (newValue >= 0) input.value = newValue;
      }
    }

    function switchTab(tab) {
          activeTab = tab;
          const btnSp = document.getElementById('tab-sparepart');
          const btnSv = document.getElementById('tab-service');
          const contentSp = document.getElementById('content-sparepart');
          const contentSv = document.getElementById('content-service');
          const searchInput = document.getElementById('catalogSearch');

          if (searchInput) searchInput.value = ''; // Reset keyword pencarian
          searchCatalog();

          if (tab === 'sparepart') {
            btnSp.className = "pb-2 border-b-2 border-blue-600 text-blue-600 px-2 transition-all cursor-pointer";
            btnSv.className = "pb-2 border-b-2 border-transparent text-gray-400 px-2 hover:text-mm-navy transition-all cursor-pointer";
            contentSp.classList.remove('hidden');
            contentSp.classList.add('grid');
            contentSv.classList.add('hidden');
          } else {
            btnSv.className = "pb-2 border-b-2 border-blue-600 text-blue-600 px-2 transition-all cursor-pointer";
            btnSp.className = "pb-2 border-b-2 border-transparent text-gray-400 px-2 hover:text-mm-navy transition-all cursor-pointer";
            contentSv.classList.remove('hidden');
            contentSp.classList.add('hidden');
            contentSp.classList.remove('grid');
          }
        }

      function filterByCategory(catId, btnElement) {
            currentCategoryId = catId; // Simpan ID kategori yang dipilih ke state global
            
            // Mengatur style active/inactive class tombol kategori
            document.querySelectorAll('.category-row').forEach(btn => {
              btn.className = "category-row block w-full text-left px-4 py-3 text-[14px] text-gray-500 hover:bg-gray-50 hover:text-mm-navy transition-all font-century";
            });
            btnElement.className = "category-row block w-full text-left px-4 py-3 text-[14px] bg-gray-100 font-bold text-mm-navy transition-all font-century";

            // Jalankan mesin pencari katalog untuk menyaring data
            searchCatalog();
          }

          function searchCatalog() {
            const kw = document.getElementById('catalogSearch').value.toLowerCase();
            
            if (activeTab === 'sparepart') {
              document.querySelectorAll('.sparepart-item').forEach(row => {
                const name = row.querySelector('.sp-name').textContent.toLowerCase();
                const cat = row.getAttribute('data-category');
                
                // KONDISI UTAMA: Jika 'SPC-1' (All Spare Parts), maka kondisi kategori otomatis lolos (true)
                const matchCategory = (currentCategoryId === 'SPC-1' || cat === currentCategoryId);
                
                if (name.includes(kw) && matchCategory) {
                  row.style.display = '';
                } else {
                  row.style.display = 'none';
                }
              });
            } else {
              document.querySelectorAll('.service-item').forEach(row => {
                const name = row.querySelector('.sv-name').textContent.toLowerCase();
                row.style.display = name.includes(kw) ? '' : 'none';
              });
            }
          }

    function searchCatalog() {
          const kw = document.getElementById('catalogSearch').value.toLowerCase();
          
          if (activeTab === 'sparepart') {
            document.querySelectorAll('.sparepart-item').forEach(row => {
              const name = row.querySelector('.sp-name').textContent.toLowerCase();
              const cat = row.getAttribute('data-category');
              
              // PERBAIKAN: Jika currentCategoryId adalah 'SPC-1' (All), maka matchCategory otomatis true
              const matchCategory = (currentCategoryId === 'SPC-1' || cat === currentCategoryId);
              
              if (name.includes(kw) && matchCategory) {
                row.style.display = '';
              } else {
                row.style.display = 'none';
              }
            });
          } else {
            document.querySelectorAll('.service-item').forEach(row => {
              const name = row.querySelector('.sv-name').textContent.toLowerCase();
              row.style.display = name.includes(kw) ? '' : 'none';
            });
          }
        }
  </script>
</body>
</html>