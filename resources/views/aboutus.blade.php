<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Motor - About Us</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-white min-h-screen text-[#333333]" style="font-family: 'Arial', 'Didact Gothic', sans-serif;">

    @include('layouts.navbar')
    @include('layouts.modals')

    <!--HEADER-->
    <x-header 
        title="About Us" 
        image="images/backgroundaboutus.jpg" 
    />

    <main class="max-w-7xl mx-auto px-6 py-12 md:px-12 md:py-16">
        <div class="grid gap-12 lg:grid-cols-[340px_1fr] items-start">
            
            <!--INFO ALAMAT, KONTAK-->
            <div class="space-y-8 flex flex-col items-center lg:items-stretch">
                <div class="w-full max-w-[340px] overflow-hidden rounded-md shadow-sm">
                    <img src="{{ asset('images/Photo Auto Shop.png') }}" alt="Mata Motor Workshop Front" class="w-full h-auto object-cover">
                </div>

                <div class="text-center space-y-4 max-w-[340px] pt-2" style="font-family: 'Century Gothic', sans-serif;">
                    <a href="https://maps.app.goo.gl/ds5ZspX4TuabqkTM8" target="_blank" class="block text-[#0f3b71] hover:text-[#0b2b52] transition-colors font-bold text-base md:text-lg leading-snug">
                        <p>Komplek Mutiara Taman Palem</p>
                        <p>Blok H2 No.6,</p>
                        <p>Cengkareng Timur, Jakarta Barat</p>
                    </a>

                    <div class="space-y-3 pt-2 text-[#b58251] font-normal text-sm md:text-base flex flex-col items-center">
                        
                        <a href="tel:02156945311" class="flex items-center gap-4 justify-center w-full max-w-[220px] hover:opacity-80 transition-opacity">
                            <svg class="w-5 h-5 text-mata-blue group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="flex-1 text-left">(021) 56945311</span>
                        </a>
                        
                        <a href="https://wa.me/6281310575396" target="_blank" class="flex items-center gap-4 justify-center w-full max-w-[220px] hover:opacity-80 transition-opacity">
                            <svg class="w-5 h-5 text-green-500 group-hover:text-green-400 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.031 0C5.385 0 .004 5.38.004 12.025c0 2.127.553 4.202 1.602 6.03L0 24l6.113-1.603c1.765 1.002 3.753 1.53 5.918 1.53 6.643 0 12.022-5.38 12.022-12.026C24.053 5.38 18.674 0 12.031 0zm0 22.046c-1.803 0-3.568-.484-5.114-1.4l-.367-.217-3.8.997 1.018-3.705-.238-.38C2.557 15.65 2.016 13.868 2.016 12.025c0-5.522 4.498-10.016 10.015-10.016 5.518 0 10.012 4.494 10.012 10.016 0 5.523-4.494 10.021-10.012 10.021zm5.502-7.514c-.302-.15-1.785-.882-2.062-.982-.277-.101-.478-.152-.68.152-.202.303-.781.981-.958 1.183-.176.202-.353.227-.655.076-1.768-.887-3.053-1.92-4.234-3.522-.177-.253.18-.24.475-.828.1-.2.05-.376-.025-.527-.076-.152-.68-1.642-.932-2.25-.246-.593-.496-.512-.68-.522h-.578c-.201 0-.527.076-.803.38-.277.303-1.055 1.03-1.055 2.515 0 1.485 1.08 2.924 1.231 3.126.151.202 2.133 3.256 5.166 4.563 2.073.894 2.854.82 3.332.695.545-.143 1.785-.73 2.036-1.436.252-.707.252-1.313.177-1.436-.076-.126-.277-.202-.579-.353z"/>
                            </svg>
                            <span class="flex-1 text-left">0813 1057 5396</span>
                        </a>
                        <a href="https://instagram.com/mata_motor_palem" target="_blank" class="flex items-center gap-4 justify-center w-full max-w-[220px] hover:opacity-80 transition-opacity">
                            <svg class="w-5 h-5 text-pink-500 group-hover:text-pink-400 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.20 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                            <span class="flex-1 text-left">bengkel_mata_motor</span>
                        </a>
                        
                    </div>
                </div>
            </div>

            <!--INFO DESKRIPSI-->
            <section class="space-y-6 text-[#4a4a4a] text-[15px] md:text-base font-normal leading-relaxed tracking-wide pt-2 text-justify" style="font-family: 'Nanum Gothic', sans-serif;">
                <p>
                    Mata Motor Mutiara Taman Palem is a motorcycle repair and maintenance workshop located in the Mutiara Taman Palem area. The workshop focuses on providing reliable, affordable, and professional motorcycle services for daily riders, workers, students, and delivery drivers. With motorcycles being one of the most common modes of transportation, Mata Motor aims to become a trusted service center that customers can rely on for both routine maintenance and urgent repairs. The workshop is committed to ensuring that every motorcycle serviced is safe, efficient, and ready for daily use.
                </p>

                <p>
                    Mata Motor Mutiara Taman Palem offers a wide range of services including oil changes, brake repairs, tire replacements, engine tune-ups, battery replacement, and electrical troubleshooting. These services are designed to keep motorcycles in optimal condition and prevent unexpected breakdowns. The technicians are experienced in handling various motorcycle brands such as Honda, Yamaha, Suzuki, and Kawasaki, making the workshop accessible to a wide range of customers.
                </p>

                <p>
                    In addition to repair services, Mata Motor Mutiara Taman Palem offers routine maintenance services. Regular maintenance helps improve motorcycle performance, increase fuel efficiency, and extend engine lifespan. By encouraging preventive maintenance, the workshop helps customers avoid costly repairs and unexpected breakdowns in the future. Customer comfort is also considered important at Mata Motor. The workshop provides a comfortable waiting area where customers can relax while their motorcycles are being serviced. Friendly staff members assist customers, provide service updates, and answer any questions. This customer-oriented approach creates a pleasant service experience and encourages repeat customers.
                </p>

                <p>
                    Safety is always a top priority at Mata Motor Mutiara Taman Palem. Every service includes checking important components such as brakes, tires, lights, and engine performance. These safety checks help reduce risks and ensure motorcycles are road-worthy before leaving the workshop. Overall, Mata Motor Mutiara Taman Palem aims to become a reliable and customer-focused motorcycle workshop. With skilled technicians, quality spare parts, transparent service, and affordable pricing, the workshop continues to grow and serve the transportation needs of the community.
                </p>
            </section>
            
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>