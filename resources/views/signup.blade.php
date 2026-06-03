<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Motor - Sign Up</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body, input, button, select, textarea {
      font-family: 'Didact Gothic', sans-serif !important;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

  <!-- Sign Up Card -->
  <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-10 relative">
    
    <!-- Logo -->
    <a href="{{ url('/') }}">
        <img class="h-18 w-auto md:h-20 mx-auto" src="{{ asset('images/logomatamotor.png') }}" alt="Mata Motor">
    </a>

    <!-- Form -->
    <form class="space-y-6 mt-6" action="{{ route('signup.submit') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div>
        <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
        <input type="file" id="profile_picture" name="profile_picture" accept="image/*"
          class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#15395c]/10 file:text-[#15395c] hover:file:bg-[#15395c]/20 border border-gray-300 rounded-md shadow-sm p-1 focus:ring-1 focus:ring-[#15395c] focus:border-[#15395c] focus:outline-none">
      </div>
      <div>
        <label for="fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name"
          class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-[#15395c] focus:border-[#15395c] focus:outline-none">
      </div>
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email"
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
      <div>
        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number"
          class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-[#15395c] focus:border-[#15395c] focus:outline-none">
      </div>
      <div>
        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
        <textarea id="address" name="address" rows="3" placeholder="Enter your address"
          class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-1 focus:ring-[#15395c] focus:border-[#15395c] focus:outline-none resize-none"></textarea>
      </div>

      <!-- Terms and Conditions -->
      <div class="flex items-start">
        <div class="flex items-center h-5">
          <input id="terms" type="checkbox" class="h-4 w-4 text-[#15395c] border-gray-300 rounded focus:ring-[#15395c]">
        </div>
        <div class="ml-3 text-sm">
          <label for="terms" class="text-gray-600">
            I agree to the 
            <a href="#" class="text-[#15395c] hover:underline hover:text-[#1c4974] font-medium">Terms and Conditions</a> 
            and 
            <a href="#" class="text-[#15395c] hover:underline hover:text-[#1c4974] font-medium">Privacy Policy</a>
          </label>
        </div>
      </div>

      <!-- Sign Up Button (smaller, centered, with border radius) -->
      <div class="flex flex-col items-center pt-4">
        <button type="submit"
          class="bg-[#15395c] text-white px-6 py-2 rounded-full border border-[#15395c] hover:bg-[#1c4974] hover:border-[#1c4974] transition">
          Sign Up
        </button>

        <!-- Sign In Link directly below -->
        <p class="mt-4 text-sm text-gray-600">
          Already have an account?
          <a href="{{ route('customer.login.page') }}" class="text-[#15395c] hover:underline hover:text-[#1c4974] font-medium">Sign In</a>
        </p>
      </div>
    </form>
  </div>

  @include('layouts.modals')

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

    document.querySelector('form').addEventListener('submit', function(e) {
      e.preventDefault();
      showSuccessModal('Sign Up Success!').then(() => {
        window.location.href = "{{ route('customer.login.page') }}";
      });
    });
  </script>
</body>
</html>