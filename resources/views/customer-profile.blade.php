<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Motor - My Profile</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#e5e7eb] min-h-screen" style="font-family: 'Century Gothic', sans-serif;">

    @include('layouts.navbarcustomer')
    @include('layouts.modals')
    @include('layouts.modalcustomer')   

    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-1/3">
                <div class="bg-[#1f2937] rounded-3xl overflow-hidden shadow-xl text-white">
                    <div class="p-8 flex flex-col items-center text-center" style="
            background-image:
                linear-gradient(
                    rgba(0, 0, 0, 0.6),
                    rgba(0, 0, 0, 0.6)
                ),
                url('{{ asset('images/backgroundprofile.jpg') }}');
        ">
                        <div class="w-40 h-40 rounded-full border-4 border-white overflow-hidden mb-4 shadow-lg">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQDeJKgiu6uY5MC1KNtOQVfoez9go6GOmm8gw&s" alt="User Profile" class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-3xl font-bold tracking-wide mb-1 min-h-6">Suryanto</h2> 
                        <p class="text-base opacity-90 font-medium" style="font-family: 'Didact Gothic', sans-serif;">C0001</p>
                    </div>

                    <div class="p-8 space-y-6" style="font-family: 'Didact Gothic', sans-serif;">
                        <div class="space-y-4">

                            <div class="flex items-center gap-4">
                                <div class="text-[#0ea5e9] text-xl w-6 flex justify-center">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <p class="text-base leading-relaxed">
                                    suryanto@gmail.com
                                </p>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="text-[#0ea5e9] text-xl w-6 flex justify-center">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <p class="text-base leading-relaxed">
                                    Jalan Kemenangan No 17, Jakarta Barat
                                </p>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="text-[#0ea5e9] text-xl w-6 flex justify-center">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <p class="text-base leading-relaxed">
                                    +62 867 8443 4143
                                </p>
                            </div>

                        </div>

                        <div class="grid grid-cols-2 gap-4 pt-4">
                            <button type="button" onclick="editProfile()" class="bg-[#0a4f96] hover:bg-blue-800 text-white text-base font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 transition-all">
                                <i class="fa-solid fa-pen-to-square"></i> Edit Profile
                            </button>
                            <a href="{{route('login')}}" class="bg-[#b91c1c] hover:bg-red-800 text-white text-base font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 transition-all">
                                <i class="fa-solid fa-right-from-bracket"></i> Log Out
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-8 min-h-[500px]">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-3xl font-bold text-black">My Vehicle</h2>
                        <button onclick="addVehicle()" class="bg-[#0a4f96] hover:bg-blue-800 text-white text-sm font-bold py-2.5 px-6 rounded-lg flex items-center gap-2">
                            <span class="text-lg">+</span> Add New Vehicle
                        </button>
                    </div>

                    {{-- DUMMY DATA VEHICLES --}}
                    @php
                        $vehicles = [
                            [
                                'id' => 1,
                                'type' => 'car',
                                'name' => 'Wuling Eksion EV',
                                'plate' => 'B 2024 ABC',
                                'year' => '2024'
                            ],
                            [
                                'id' => 2,
                                'type' => 'motorcycle',
                                'name' => 'Honda Vario 150',
                                'plate' => 'B 2024 ABC',
                                'year' => '2024'
                            ],
                            [
                                'id' => 3,
                                'type' => 'truck',
                                'name' => 'Toyota Hilux',
                                'plate' => 'B 2024 ABC',
                                'year' => '2024'
                            ]
                        ];
                    @endphp

                    <script>
                        window.customerVehicles = @json($vehicles);
                    </script>

                    {{-- LOOP KENDARAAN --}}
                    <div class="space-y-4">
                        @if(isset($vehicles) && count($vehicles) > 0)
                            @foreach($vehicles as $vehicle)
                                <div class="flex items-center justify-between border border-gray-300 rounded-2xl p-5 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-6">
                                        <div class="text-[#eab308] text-4xl w-12 text-center">
                                            @if($vehicle['type'] == 'car')
                                                <i class="fa-solid fa-car-side"></i>
                                            @elseif($vehicle['type'] == 'motorcycle')
                                                <i class="fa-solid fa-motorcycle"></i>
                                            @elseif($vehicle['type']=='truck')
                                                <i class="fa-solid fa-truck"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="text-xl font-extrabold text-black">{{ $vehicle['name'] }}</h4>
                                            <div class="flex gap-4 text-sm text-gray-500 font-bold mt-1">
                                                <span>Plate Number: <span class="text-gray-400">{{ $vehicle['plate'] }}</span></span>
                                                <span>Production Year: <span class="text-gray-400">{{ $vehicle['year'] }}</span></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex gap-4 font-bold text-s">
                                        <button type="button" onclick="editVehicle({{ $vehicle['id'] }})" class="text-[#0a4f96] hover:underline">Edit</button>
                                        <button onclick="confirmDelete('Vehicle', 'Delete this vehicle?')" class="text-[#b91c1c] hover:underline">Delete</button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-20 text-gray-400 italic">
                                Belum ada kendaraan terdaftar.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </main>

    @include('layouts.footer')


</body>
</html>