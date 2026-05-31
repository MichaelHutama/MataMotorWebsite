<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor - Admin & Mechanic Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body, input, button, select, textarea {
      font-family: 'Didact Gothic', sans-serif !important;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 min-h-screen flex items-center justify-center">

  <!-- Login Card -->
  <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-10 relative min-h-[530px]">
    

    <!-- Logo -->
    <a href="{{ url('/') }}">
        <img class="h-18 w-auto md:h-20 mx-auto" src="{{ asset('images/logomatamotor.png') }}" alt="Mata Motor">
    </a>

    <!-- Form -->
    <form class="space-y-8 mt-6" action="{{ url('/') }}" method="GET">
      <div>
        <label for="user_id" class="block text-sm font-medium text-gray-700">User ID</label>
        <input type="text" id="user_id" name="user_id" placeholder="Enter your User ID"
          class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-[#15395c] focus:border-[#15395c] focus:outline-none">
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <div class="relative mt-2">
          <input type="password" id="password" name="password" placeholder="Enter your password"
            class="block w-full px-4 py-2 pr-20 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-[#15395c] focus:border-[#15395c] focus:outline-none">
          <button type="button" id="toggle-password" aria-label="Toggle password visibility" class="absolute inset-y-0 right-3 my-auto inline-flex h-8 w-8 items-center justify-center text-[#15395c] hover:text-[#1c4974]" onclick="togglePasswordVisibility('password', 'toggle-password')">
            <svg data-icon-closed xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0 1 12 19c-5 0-9.27-3.11-11-7.5A11.96 11.96 0 0 1 5.06 5.06M9.88 4.24A9.94 9.94 0 0 1 12 4c5 0 9.27 3.11 11 7.5a11.9 11.9 0 0 1-4.18 5.14M3 3l18 18" />
            </svg>
            <svg data-icon-open xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Sign In Button -->
      <div class="flex flex-col items-center pt-4">
        @include('components.action-button', [
            'type' => 'submit',
            'text' => 'Sign In'

        ])
      </div>
    </form>
  </div>

  <script>
    function togglePasswordVisibility(inputId, buttonId) {
      const input = document.getElementById(inputId);
      const button = document.getElementById(buttonId);

      if (!input || !button) {
        return;
      }

      const isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      const closedIcon = button.querySelector('[data-icon-closed]');
      const openIcon = button.querySelector('[data-icon-open]');

      if (closedIcon && openIcon) {
        closedIcon.classList.toggle('hidden', !isHidden);
        openIcon.classList.toggle('hidden', isHidden);
      }
    }
  </script>

</body>
</html>