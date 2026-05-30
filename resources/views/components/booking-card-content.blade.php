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
@endphp
<div class="space-y-6">
    <div class="flex justify-center">
        <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-mm-navy group-hover:bg-blue-100 group-hover:text-white transition-colors">
            {!! $getServiceIconLocal($booking['type']) !!}
        </div>
    </div>

    <div class="space-y-1">
        <p class="font-black text-mm-navy text-xl font-inter tracking-tight">{{ $booking['code'] }}</p>
        <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px]">{{ $booking['type'] }}</p>
    </div>
</div>

<div class="pt-4 border-t border-gray-50 flex flex-col items-center gap-3">
    @if($booking['status'] == 'pending')
        <div class="flex items-center gap-2 px-4 py-1.5 bg-gray-100 text-gray-500 rounded-full">
            <p class="text-[10px] font-black uppercase tracking-widest">Pending</p>
        </div>
        <button onclick="event.stopPropagation(); confirmCancel('{{ $booking['code'] }}')" 
                class="text-[10px] font-bold text-red-400 uppercase tracking-widest hover:text-red-600 transition-colors">
            Cancel Booking
        </button>
    @elseif($booking['status'] == 'waiting')
        <div class="flex flex-col items-center gap-1">
            <div class="flex items-center gap-2 px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full">
                <p class="text-[10px] font-black uppercase tracking-widest">In Queue</p>
            </div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest"><span class="text-mm-navy">{{ $booking['queue'] ?? 0 }}</span> Antrian Lagi</p>
        </div>
    @elseif($booking['status'] == 'processing')
        <div class="flex items-center gap-2 px-4 py-1.5 bg-yellow-50 text-yellow-600 rounded-full">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
            </span>
            <p class="text-[10px] font-black uppercase tracking-widest">Processing</p>
        </div>
    @elseif($booking['status'] == 'finished')
        <div class="flex items-center gap-2 px-4 py-1.5 bg-green-50 text-green-600 rounded-full">
            <p class="text-[10px] font-black uppercase tracking-widest">Finished</p>
        </div>
        <p class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em]">{{ explode(';', $booking['time'] ?? '')[0] }}</p>
    @elseif($booking['status'] == 'cancelled')
        <div class="flex items-center gap-2 px-4 py-1.5 bg-red-50 text-red-400 rounded-full">
            <p class="text-[10px] font-black uppercase tracking-widest">Cancelled</p>
        </div>
        <p class="text-[9px] font-bold text-gray-300 uppercase tracking-[0.2em]">{{ explode(';', $booking['time'] ?? '')[0] }}</p>
    @endif
</div>
