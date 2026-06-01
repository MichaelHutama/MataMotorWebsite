<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>

<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: {
          'didact': ['"Didact Gothic"', 'sans-serif'],
        },
        colors: {
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
                <a href="{{ route('owner-home') }}">
                    <img class="h-9 w-auto md:h-12" src="{{ asset('images/logomatamotor.png') }}" alt="Mata Motor">
                </a>
            </div>

            <div class="hidden md:flex flex-1 justify-center space-x-10">
                <a href="{{ route('owner-catalog') }}" class="text-gray-900 hover:text-blue-600 px-3 py-2 text-lg font-medium transition duration-200">
                    Catalog
                </a>
                <a href="{{ route('owner-managebooking') }}" class="text-gray-900 hover:text-blue-600 px-3 py-2 text-lg font-medium transition duration-200">
                    Queue
                </a>
                <a href="{{ route('owner-transaction') }}" class="text-gray-900 hover:text-blue-600 px-3 py-2 text-lg font-medium transition duration-200">
                    Transaction
                </a>
                <a href="{{ route('owner-mechanic') }}" class="text-gray-900 hover:text-blue-600 px-3 py-2 text-lg font-medium transition duration-200">
                    Mechanic
                </a>
                <a href="#" class="text-gray-900 hover:text-blue-600 px-3 py-2 text-lg font-medium transition duration-200">
                    Report
                </a>
            </div>

            <div class="flex items-center gap-2 md:gap-4">
                {{-- Profile Section Removed as requested --}}
                
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
                    Catalog
                </a>
                <a href="{{ route('owner-home') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-600 transition duration-200">
                    Queue
                </a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-600 transition duration-200">
                    Transaction
                </a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-600 transition duration-200">
                    Mechanic
                </a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-600 transition duration-200">
                    Report
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