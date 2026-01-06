<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Magang Mania</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Inter', 'sans-serif'],
            },
            animation: {
              'fade-in': 'fadeIn 0.5s ease-out',
              'slide-up': 'slideUp 0.5s ease-out',
              'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
              'gradient': 'gradient 3s ease infinite',
            },
            keyframes: {
              fadeIn: {
                '0%': { opacity: '0' },
                '100%': { opacity: '1' },
              },
              slideUp: {
                '0%': { transform: 'translateY(20px)', opacity: '0' },
                '100%': { transform: 'translateY(0)', opacity: '1' },
              },
              gradient: {
                '0%, 100%': { backgroundPosition: '0% 50%' },
                '50%': { backgroundPosition: '100% 50%' },
              }
            },
          },
        },
      }
    </script>
  </head>
  <body class="min-h-screen w-full flex items-center justify-center relative overflow-hidden bg-black selection:bg-indigo-500/30 selection:text-indigo-200">
    
    <!-- Dynamic Background Effects -->
    <div class="absolute inset-0 z-0 pointer-events-none">
      <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-indigo-900/20 rounded-full blur-[120px] animate-pulse-slow"></div>
      <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-purple-900/20 rounded-full blur-[120px] animate-pulse-slow" style="animation-delay: 1.5s;"></div>
      <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150 mix-blend-overlay"></div>
    </div>

    <!-- Main Card -->
    <div class="relative z-10 w-full max-w-md p-6 mx-4">
      
      <!-- Glassmorphism Container -->
      <div class="bg-zinc-900/40 backdrop-blur-xl border border-white/10 shadow-2xl rounded-3xl p-8 md:p-10 animate-slide-up ring-1 ring-white/5">
        
        <!-- Header Section -->
        <div class="flex flex-col items-center mb-10 text-center space-y-4">
          <div class="relative group cursor-default">
            <div class="absolute inset-0 bg-indigo-500 rounded-2xl blur-lg opacity-40 group-hover:opacity-60 transition-opacity duration-500"></div>
            <div class="relative bg-gradient-to-br from-indigo-500 to-purple-600 w-16 h-16 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-105 transition-transform duration-300 border border-white/20">
              <!-- LogIn Icon -->
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-white">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                <polyline points="10 17 15 12 10 7" />
                <line x1="15" x2="3" y1="12" y2="12" />
              </svg>
            </div>
          </div>
          
          <div class="space-y-2">
            <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white via-gray-200 to-gray-400 tracking-tight">
              Selamat Datang
            </h1>
            <p class="text-gray-400 text-sm font-medium">
              Silakan masuk untuk melanjutkan
            </p>
          </div>
        </div>

        <!-- Form Section -->
        <form id="loginForm" class="space-y-6" action="{{ route('login-proses') }}" method="POST">
          @csrf
          
          <!-- Email Field -->
          <div class="space-y-2 group input-container" id="container-email">
            <label for="email" class="text-sm font-medium transition-colors duration-300 text-gray-400" id="label-email">
              Email Address
            </label>
            <div class="relative">
              <div class="absolute left-3 top-1/2 -translate-y-1/2 transition-colors duration-300 text-gray-500 group-hover:text-gray-400" id="icon-email">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                  <rect width="20" height="16" x="2" y="4" rx="2" />
                  <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                </svg>
              </div>
              <input
                id="email"
                type="email"
                name="email"
                placeholder="nama@email.com"
                class="w-full bg-white/5 border border-white/10 text-sm rounded-xl py-3 pl-10 pr-4 outline-none transition-all duration-300 text-gray-100 placeholder-gray-600 hover:border-white/20 hover:bg-white/10 input-transition"
                required
              />
            </div>
                @error('email')
                  <small>{{ $message }}</small>
                @enderror
            </div>
          
          <!-- Password Field -->
          <div class="space-y-1">
            <div class="space-y-2 group input-container" id="container-password">
              <label for="password" class="text-sm font-medium transition-colors duration-300 text-gray-400" id="label-password">
                Password
              </label>
              <div class="relative">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 transition-colors duration-300 text-gray-500 group-hover:text-gray-400" id="icon-password">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                  </svg>
                </div>
                <input
                  id="password"
                  type="password"
                  name="password"
                  placeholder="••••••••"
                  class="w-full bg-white/5 border border-white/10 text-sm rounded-xl py-3 pl-10 pr-4 outline-none transition-all duration-300 text-gray-100 placeholder-gray-600 hover:border-white/20 hover:bg-white/10 input-transition"
                  required
                />
              </div>
                @error('password')
                  <small>{{ $message }}</small>
                @enderror
            </div>
          </div>

          <div class="mt-3">
            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>

            @error('g-recaptcha-response')
              <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <script src="https://www.google.com/recaptcha/api.js" async defer></script>

          <!-- Submit Button -->
          <button 
            type="submit"
            id="submitBtn"
            class="w-full relative group overflow-hidden rounded-xl bg-indigo-600 p-[1px] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-black disabled:opacity-70 disabled:cursor-not-allowed transition-all duration-300 transform active:scale-[0.98]"
          >
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500 animate-gradient"></div>
            <div class="relative h-full bg-gradient-to-br from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 rounded-xl px-6 py-3.5 flex items-center justify-center space-x-2 transition-all duration-200 border border-white/10 group-hover:border-transparent shadow-lg shadow-indigo-900/20">
              
              <!-- Content Normal -->
              <span id="btnText" class="flex items-center space-x-2">
                <span class="font-semibold text-white tracking-wide">Masuk Sekarang</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-white/80 group-hover:translate-x-1 transition-transform">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>

              <!-- Loader -->
              <div id="btnLoader" class="hidden">
                <div class="w-6 h-6 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
              </div>

            </div>
          </button>
        </form>

        <!-- Footer Section -->
        <div class="mt-8 text-center">
          <p class="text-sm text-gray-500">
            Belum punya akun? 
            <a 
              href="{{ route('register') }}" 
              class="font-semibold text-indigo-400 hover:text-indigo-300 transition-colors relative inline-block group"
            >
              Daftar disini
              <span class="absolute bottom-0 left-0 w-full h-0.5 bg-indigo-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
            </a>
          </p>
        </div>
      </div>
      
      <!-- Simple Footer Text -->
      <div class="mt-8 text-center opacity-40 hover:opacity-100 transition-opacity duration-500">
        <p class="text-xs text-gray-500">© 2025 davserv. All rights reserved Magang Mania.</p>
      </div>
    </div>

    <!-- Native JavaScript for Interactions -->
    <script src="{{ asset('assets/js/login.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if($message = Session::get('failed'))
        <script>
            swal("Error!", "{{ $message }}", "error");
        </script>
    @endif

    @if($message = Session::get('success'))
        <script>
            swal("Thanks!", "{{ $message }}", "success");
        </script>
    @endif
  </body>
</html>