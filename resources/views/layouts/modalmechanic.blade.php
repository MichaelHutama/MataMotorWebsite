<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showMechanicProfile() {
        const modalHtml = `
            <div class="p-8 text-center" style="font-family: 'Didact Gothic', sans-serif;">
                <!-- Header -->
                <div class="mb-4">
                    <p class="text-xl text-gray-700">MEC-2</p>
                    <h2 class="text-5xl font-bold text-black mt-1">Mulyono</h2>
                </div>

                <hr class="border-gray-300 mb-6">

                <!-- Content -->
                <div class="space-y-6 text-left max-w-md mx-auto">
                    <div class="flex justify-between items-center px-2">
                        <span class="text-lg text-gray-800">Number</span>
                        <span class="text-lg font-bold text-black">+62 5343 655 3232</span>
                    </div>

                    <div class="flex justify-between items-center px-2">
                        <span class="text-lg text-gray-800">Status</span>
                        <span class="text-lg font-bold text-green-600">Active</span>
                    </div>

                    <div class="px-2">
                        <h4 class="text-xl font-bold text-[#15395c] mb-3">Specialization</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-4 py-1.5 border border-gray-400 rounded-full text-sm text-gray-700 bg-white">Oil and Filter Replacement</span>
                            <span class="px-4 py-1.5 border border-gray-400 rounded-full text-sm text-gray-700 bg-white">Machine Service</span>
                            <span class="px-4 py-1.5 border border-gray-400 rounded-full text-sm text-gray-700 bg-white">Air Conditioner Service</span>
                            <span class="px-4 py-1.5 border border-gray-400 rounded-full text-sm text-gray-700 bg-white">Wash and Detailing</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center px-2 pt-2">
                        <h4 class="text-xl font-bold text-[#15395c]">Rating Accumulation</h4>
                        <span class="text-lg font-bold text-gray-800">4,5 / 5</span>
                    </div>
                </div>

                <!-- Footer / Logout -->
                <div class="mt-10 flex justify-center">
                    <a href="{{ route('loginadminmechanic') }}" class="flex items-center gap-3 bg-[#710707] hover:bg-[#5a0505] text-white px-10 py-3 rounded-xl transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="text-xl font-bold">Log Out</span>
                    </a>
                </div>
            </div>
        `;

        Swal.fire({
            html: modalHtml,
            showConfirmButton: false,
            width: 550,
            padding: '1rem',
            background: '#ffffff',
            customClass: {
                popup: 'rounded-[40px]',
            },
            showCloseButton: true,
        });
    }
</script>