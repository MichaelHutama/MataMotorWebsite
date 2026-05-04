<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>

<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: {
          // Mendaftarkan font Didact Gothic
          'didact': ['"Didact Gothic"', 'sans-serif'],
        },
        colors: {
          // Warna biru yang biasanya ada di logo Mata Motor
          'mata-blue': '#0054A6', 
        }
      }
    }
  }
</script>



<nav class="bg-white border-b border-gray-200 shadow-sm font-didact">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 md:h-20 items-center justify-between gap-4">
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}">
                    <img class="h-9 w-auto md:h-12" src="{{ asset('images/logomatamotor.png') }}" alt="Mata Motor">
                </a>
            </div>

            <div class="hidden md:flex flex-1 justify-center space-x-10">
                <a href="#" class="text-gray-900 hover:text-blue-600 px-3 py-2 text-base font-medium transition duration-200">
                    Products
                </a>
                <a href="#" class="text-gray-900 hover:text-blue-600 px-3 py-2 text-base font-medium transition duration-200">
                    Cart
                </a>
                <a href="#" class="text-gray-900 hover:text-blue-600 px-3 py-2 text-base font-medium transition duration-200">
                    Booking
                </a>
                <a href="#" class="text-gray-900 hover:text-blue-600 px-3 py-2 text-base font-medium transition duration-200">
                    History
                </a>
                <a href="#" class="text-gray-900 hover:text-blue-600 px-3 py-2 text-base font-medium transition duration-200">
                    About Us
                </a>
            </div>

            <div class="flex items-center gap-2 md:gap-4">
                <a href="#" class="text-gray-900 hover:text-blue-600 transition duration-200">
                    <span class="sr-only">User Profile</span>
                    <svg class="h-9 w-9 md:h-11 md:w-11" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 4c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm0 14c-2.03 0-3.93-.8-5.38-2.14.28-1.55 2.87-2.86 5.38-2.86s5.1 1.31 5.38 2.86C15.93 19.2 14.03 20 12 20z" clip-rule="evenodd" />
                    </svg>
                </a>

                <button
                    id="mobile-menu-button"
                    type="button"
                    class="inline-flex md:hidden items-center justify-center rounded-md p-2 text-gray-900 hover:bg-gray-100 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    aria-controls="mobile-menu"
                    aria-expanded="false"
                >
                    <span class="sr-only">Open main menu</span>
                    <svg id="mobile-menu-icon-open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="mobile-menu-icon-close" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <div class="border-t border-gray-200 pt-3 space-y-1">
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-600 transition duration-200">
                    Products
                </a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-600 transition duration-200">
                    Cart
                </a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-600 transition duration-200">
                    Booking
                </a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-600 transition duration-200">
                    History
                </a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-600 transition duration-200">
                    About Us
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        const openIcon = document.getElementById('mobile-menu-icon-open');
        const closeIcon = document.getElementById('mobile-menu-icon-close');

        if (!button || !menu || !openIcon || !closeIcon) {
            return;
        }

        button.addEventListener('click', function () {
            const isOpen = !menu.classList.contains('hidden');

            menu.classList.toggle('hidden');
            button.setAttribute('aria-expanded', String(!isOpen));
            openIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    });
</script>