{{-- Mendefinisikan variabel/parameter yang akan diterima oleh component ini --}}
@props(['title', 'image'])

<div 
    class="relative bg-gray-800 h-64 flex items-center justify-center bg-cover bg-center" 
    style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset($image) }}');"
>
    {{-- Memanggil variabel teks --}}
    <div class="absolute inset-y-0 left-0 flex items-center w-full max-w-7xl mx-auto pl-12 sm:pl-20 md:pl-28 lg:pl-36">
        <h1 class="text-5xl sm:text-6xl md:text-7xl font-bold text-white tracking-tight drop-shadow-md" style="font-family: 'Century Gothic', sans-serif;">
            {{ $title }}
        </h1>
    </div>
</div>