<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Motor - Payment Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 'mm-navy': '#15395c' },
                    fontFamily: {
                        'didact': ['"Didact Gothic"', 'sans-serif'],
                        'inter': ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col font-didact items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-[40px] shadow-2xl shadow-blue-900/10 p-10 text-center space-y-8 border border-gray-100 flex flex-col items-center">
        <!-- Success Icon -->
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center animate-bounce">
            <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <div class="space-y-2">
            <h1 class="text-3xl font-black font-inter text-mm-navy tracking-tight uppercase">Payment Success!</h1>
            <p class="text-gray-400 font-medium">Your order has been confirmed and is being processed by our team.</p>
        </div>

        <div class="w-full pt-4 space-y-3">
            <a href="{{ url('/') }}" class="block w-full py-4 bg-mm-navy hover:bg-[#1c4974] text-white font-bold rounded-2xl shadow-lg transition-all text-sm tracking-widest font-inter uppercase">
                Back to Home
            </a>
            <button onclick="window.location.href = '{{ route("customer-history") }}'" class="block w-full py-4 bg-gray-200 hover:bg-gray-300 text-gray-500 font-bold rounded-2xl transition-all text-sm tracking-widest font-inter uppercase">
                Go To History
            </button>
        </div>
    </div>

</body>
</html>