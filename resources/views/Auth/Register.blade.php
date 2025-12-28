<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Magang Mania</title>
    <link href="{{ asset('amikom.png') }}" rel="icon">
    
    <!-- Libraries -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}" type="text/css">

    <!-- Config -->
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            },
            animation: {
              'float': 'float 6s ease-in-out infinite',
              'pulse-slow': 'pulse 8s cubic-bezier(0.4, 0, 0.6, 1) infinite',
            },
            keyframes: {
              float: {
                '0%, 100%': { transform: 'translateY(0)' },
                '50%': { transform: 'translateY(-20px)' },
              }
            },
            colors: {
              glass: 'rgba(255, 255, 255, 0.05)',
            }
          },
        },
      }
    </script>
  </head>
  <body class="min-h-screen bg-black text-zinc-100 flex flex-col items-center justify-center p-4 relative selection:bg-indigo-500/30 font-sans overflow-hidden">

    <!-- Background Ambience (Fixed to viewport) -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
      <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-indigo-600/20 rounded-full blur-[120px] animate-pulse-slow"></div>
      <div class="absolute bottom-[-20%] right-[-10%] w-[600px] h-[600px] bg-violet-600/10 rounded-full blur-[120px]"></div>
      <div class="absolute top-[40%] left-[50%] -translate-x-1/2 w-[800px] h-[400px] bg-indigo-500/5 rounded-full blur-[100px] animate-float"></div>
    </div>

    <!-- Main App Container -->
    <!-- Added origin-center and id for auto-scaling script -->
    <div id="main-app" class="relative w-full max-w-5xl flex flex-col items-center z-10 origin-center transition-transform duration-300">
      
      <!-- Stepper Indicator -->
      <div class="flex gap-3 mb-6 md:mb-8 z-40" id="dots-container">
        <!-- Dots injected by JS -->
      </div>

      <!-- 3D Card Stage 
           Reduced default height from 650px to 550px/600px to better fit standard laptops 
      -->
      <form id="wizardForm" class="relative w-full h-[550px] md:h-[600px] flex items-center justify-center perspective-container" action="{{ route('register-proses') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- STEP 1: ACCOUNT -->
        <div class="step-card" data-step="1">
          <div class="w-full h-full p-8 md:p-10 rounded-3xl border border-white/5 bg-zinc-900/80 backdrop-blur-xl shadow-2xl flex flex-col justify-between">
            <div class="space-y-6 md:space-y-8">
              <div class="text-center mb-4 md:mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Akun Saya</h2>
                <p class="text-zinc-500 text-sm md:text-base">Buat akun untuk memulai perjalanan Anda</p>
              </div>
              
              <div class="space-y-4 md:space-y-5">
                <div class="flex flex-col gap-2 w-full group">
                  <label class="text-sm font-medium text-zinc-400 ml-1 transition-colors group-focus-within:text-indigo-400">Email Address</label>
                  <input type="email" name="email" placeholder="nama@email.com" class="w-full px-4 py-3 md:py-3.5 rounded-xl bg-zinc-900/50 border border-zinc-800 text-zinc-100 placeholder-zinc-600 outline-none transition-all duration-300 focus:border-indigo-500/50 focus:bg-zinc-900 focus:ring-4 focus:ring-indigo-500/10 hover:border-zinc-700">
                </div>
                @error('email')
                  <small>{{ $message }}</small>
                @enderror
                <div class="flex flex-col gap-2 w-full group">
                  <label class="text-sm font-medium text-zinc-400 ml-1 transition-colors group-focus-within:text-indigo-400">Password</label>
                  <input type="password" name="password" placeholder="••••••••" class="w-full px-4 py-3 md:py-3.5 rounded-xl bg-zinc-900/50 border border-zinc-800 text-zinc-100 placeholder-zinc-600 outline-none transition-all duration-300 focus:border-indigo-500/50 focus:bg-zinc-900 focus:ring-4 focus:ring-indigo-500/10 hover:border-zinc-700">
                </div>
                @error('password')
                  <small>{{ $message }}</small>
                @enderror
              </div>
              
              <div class="mt-8 text-center">
                <p class="text-sm text-gray-500">
                  Sudah punya akun? 
                  <a 
                    href="{{ route('login') }}" 
                    class="font-semibold text-indigo-400 hover:text-indigo-300 transition-colors relative inline-block group"
                  >
                    LogIn disini
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-indigo-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                  </a>
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- STEP 2: PERSONAL -->
        <div class="step-card" data-step="2">
          <div class="w-full h-full p-8 md:p-10 rounded-3xl border border-white/5 bg-zinc-900/80 backdrop-blur-xl shadow-2xl flex flex-col justify-between">
            <div class="space-y-4 md:space-y-5">
              <div class="text-center mb-4 md:mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Data Pribadi</h2>
                <div class="w-12 h-1 bg-indigo-500 mx-auto rounded-full"></div>
              </div>

              <div class="flex flex-col gap-2 w-full group">
                <label class="text-sm font-medium text-zinc-400 ml-1 transition-colors group-focus-within:text-indigo-400">Nama Lengkap</label>
                <input type="text" name="nama" placeholder="John Doe" class="w-full px-4 py-3 md:py-3.5 rounded-xl bg-zinc-900/50 border border-zinc-800 text-zinc-100 placeholder-zinc-600 outline-none transition-all duration-300 focus:border-indigo-500/50 focus:bg-zinc-900 focus:ring-4 focus:ring-indigo-500/10 hover:border-zinc-700">
              </div>
              @error('nama')
                <small>{{ $message }}</small>
              @enderror
              <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-zinc-400 ml-1">Jenis Kelamin</label>
                <div class="flex gap-4">
                  <input type="hidden" name="jk" id="genderInput">
                  <button type="button" onclick="setGender('L')" id="btn-male" class="flex-1 py-3 md:py-3.5 px-4 rounded-xl border border-zinc-800 bg-zinc-900/50 text-zinc-500 transition-all duration-300 hover:border-zinc-700">
                    Laki-laki
                  </button>
                  <button type="button" onclick="setGender('P')" id="btn-female" class="flex-1 py-3 md:py-3.5 px-4 rounded-xl border border-zinc-800 bg-zinc-900/50 text-zinc-500 transition-all duration-300 hover:border-zinc-700">
                    Perempuan
                  </button>
                </div>
              </div>
              @error('jk')
                <small>{{ $message }}</small>
              @enderror

              <div class="flex flex-col gap-2 w-full group">
                <label class="text-sm font-medium text-zinc-400 ml-1 transition-colors group-focus-within:text-indigo-400">Tempat Lahir</label>
                <input type="text" name="tmpl" placeholder="Jakarta" class="w-full px-4 py-3 md:py-3.5 rounded-xl bg-zinc-900/50 border border-zinc-800 text-zinc-100 placeholder-zinc-600 outline-none transition-all duration-300 focus:border-indigo-500/50 focus:bg-zinc-900 focus:ring-4 focus:ring-indigo-500/10 hover:border-zinc-700">
              </div>
              @error('tmpl')
                <small>{{ $message }}</small>
              @enderror

              <div class="flex flex-col gap-2 w-full group">
                <label class="text-sm font-medium text-zinc-400 ml-1 transition-colors group-focus-within:text-indigo-400">Tanggal Lahir</label>
                <div class="relative">
                  <input type="date" name="tgll" class="w-full px-4 py-3 md:py-3.5 rounded-xl bg-zinc-900/50 border border-zinc-800 text-zinc-100 placeholder-zinc-600 outline-none transition-all duration-300 focus:border-indigo-500/50 focus:bg-zinc-900 focus:ring-4 focus:ring-indigo-500/10 hover:border-zinc-700">
                  <i data-lucide="calendar" class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-500 pointer-events-none w-5 h-5"></i>
                </div>
              </div>
              @error('tgll')
                <small>{{ $message }}</small>
              @enderror
            </div>
          </div>
        </div>

        <!-- STEP 3: CONTACT & FINISH -->
        <div class="step-card" data-step="3">
          <div class="w-full h-full p-8 md:p-10 rounded-3xl border border-white/5 bg-zinc-900/80 backdrop-blur-xl shadow-2xl flex flex-col justify-between">
            <div class="space-y-4 md:space-y-6 flex-grow flex flex-col">
              <div class="text-center mb-2 md:mb-4">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Detail Kontak</h2>
                <p class="text-zinc-500 text-sm md:text-base">Bagaimana kami bisa menghubungi Anda?</p>
              </div>

              <div class="space-y-4 md:space-y-5 flex-grow">
                <div class="flex flex-col gap-2 w-full group">
                  <label class="text-sm font-medium text-zinc-400 ml-1 transition-colors group-focus-within:text-indigo-400">Alamat Lengkap</label>
                  <input type="text" name="alamat" placeholder="Jl. Jendral Sudirman..." class="w-full px-4 py-3 md:py-3.5 rounded-xl bg-zinc-900/50 border border-zinc-800 text-zinc-100 placeholder-zinc-600 outline-none transition-all duration-300 focus:border-indigo-500/50 focus:bg-zinc-900 focus:ring-4 focus:ring-indigo-500/10 hover:border-zinc-700">
                </div>
                @error('alamat')
                  <small>{{ $message }}</small>
                @enderror

                <div class="grid grid-cols-2 gap-4">
                  <div class="flex flex-col gap-2 w-full group">
                    <label class="text-sm font-medium text-zinc-400 ml-1 transition-colors group-focus-within:text-indigo-400">Jenjang</label>
                    <div class="relative">
                      <select name="jenjang" class="w-full px-4 py-3 md:py-3.5 rounded-xl bg-zinc-900/50 border border-zinc-800 text-zinc-100 outline-none transition-all duration-300 focus:border-indigo-500/50 focus:bg-zinc-900 focus:ring-4 focus:ring-indigo-500/10 hover:border-zinc-700 appearance-none cursor-pointer">
                        <option value="" disabled selected class="bg-zinc-900 text-zinc-500">Pilih Jenjang</option>
                        <option value="smk" class="bg-zinc-900">SMK</option>
                        <option value="D3" class="bg-zinc-900">D3</option>
                        <option value="S1/D4" class="bg-zinc-900">S1</option>
                      </select>
                      <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-500 pointer-events-none w-5 h-5"></i>
                    </div>
                    @error('jenjang')
                      <small>{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="flex flex-col gap-2 w-full group">
                    <label class="text-sm font-medium text-zinc-400 ml-1 transition-colors group-focus-within:text-indigo-400">No. HP</label>
                    <input type="tel" name="no_tlp" placeholder="+62..." class="w-full px-4 py-3 md:py-3.5 rounded-xl bg-zinc-900/50 border border-zinc-800 text-zinc-100 placeholder-zinc-600 outline-none transition-all duration-300 focus:border-indigo-500/50 focus:bg-zinc-900 focus:ring-4 focus:ring-indigo-500/10 hover:border-zinc-700">
                  </div>
                </div>
                @error('no_tlp')
                  <small>{{ $message }}</small>
                @enderror

                <div class="flex flex-col gap-2">
                  <label class="text-sm font-medium text-zinc-400 ml-1">Dokumen Pendukung</label>
                  <div class="flex items-center gap-2">
                    <div class="relative flex-1">
                      <div class="w-full px-4 py-3 md:py-3.5 rounded-xl bg-zinc-900/50 border border-zinc-800 text-zinc-400 text-sm flex items-center gap-2 overflow-hidden">
                         <i data-lucide="file-text" class="w-4 h-4 min-w-[16px]"></i>
                         <span id="fileName" class="truncate">Belum ada file dipilih</span>
                      </div>
                    </div>
                    <label class="cursor-pointer px-4 py-3 md:py-3.5 bg-zinc-800 hover:bg-zinc-700 rounded-xl border border-zinc-700 transition-colors flex items-center gap-2 group">
                      <i data-lucide="upload" class="w-4 h-4 text-zinc-400 group-hover:text-zinc-200"></i>
                      <span class="text-sm font-medium text-zinc-300">Browse</span>
                      <input type="file" name="foto" class="hidden" onchange="handleFile(this)">
                    </label>
                  </div>
                </div>
                @error('foto')
                  <small>{{ $message }}</small>
                @enderror
              </div>

              <div class="pt-2">
                <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold shadow-lg shadow-indigo-900/20 transition-all duration-300 transform active:scale-[0.98] hover:shadow-indigo-500/20">
                  Submit Data
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>

      <!-- Navigation Controls -->
      <!-- Added z-50 to ensure it is above everything -->
      <div class="flex items-center gap-8 mt-6 md:mt-8 z-50 relative">
        <button id="prevBtn" onclick="changeStep(-1)" class="p-4 rounded-full border border-white/5 backdrop-blur-md transition-all duration-300 flex items-center justify-center shadow-lg bg-zinc-900/50 text-zinc-300 hover:bg-zinc-800 hover:text-white hover:scale-110">
          <i data-lucide="arrow-left" class="w-6 h-6"></i>
        </button>

        <span class="text-zinc-500 text-sm font-medium tracking-wide uppercase">
          Geser kiri atau kanan
        </span>

        <button id="nextBtn" onclick="changeStep(1)" class="p-4 rounded-full border border-white/5 transition-all duration-300 flex items-center justify-center shadow-lg shadow-indigo-500/20 text-white bg-gradient-to-br from-indigo-600 to-violet-700 hover:scale-110 hover:shadow-indigo-500/40">
          <i data-lucide="arrow-right" class="w-6 h-6"></i>
        </button>
      </div>

    </div>

    <!-- CORE LOGIC -->
    <script>
      // State
      let currentStep = 1;
      const totalSteps = 3;
      
      // Auto-scale to fit viewport logic
      function fitToViewport() {
        const app = document.getElementById('main-app');
        const height = window.innerHeight;
        // Target base height approx 750px (Form 600 + Dots 40 + Controls 100)
        // If smaller, scale down
        if (height < 820) {
          const scale = height / 850;
          // Clamp scale to not be too small (accessibility)
          const safeScale = Math.max(scale, 0.65);
          app.style.transform = `scale(${safeScale})`;
        } else {
          app.style.transform = 'scale(1)';
        }
      }

      window.addEventListener('resize', fitToViewport);

      // Init
      document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
        fitToViewport(); // Initial scale
        updateUI();
        
      });

      // Navigation Logic
      function changeStep(direction) {
        const newStep = currentStep + direction;
        if (newStep >= 1 && newStep <= totalSteps) {
          currentStep = newStep;
          updateUI();
        }
      }

      function goToStep(step) {
        currentStep = step;
        updateUI();
      }

      // 3D & UI Update Logic
      function updateUI() {
        const cards = document.querySelectorAll('.step-card');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const dotsContainer = document.getElementById('dots-container');

        // 1. Update Cards Transform
        cards.forEach(card => {
          const stepIndex = parseInt(card.getAttribute('data-step'));
          const distance = stepIndex - currentStep;
          
          let style = '';
          
          if (stepIndex === currentStep) {
            // Active
            style = `
              transform: translateX(0) rotateY(0deg);
              opacity: 1;
              z-index: 30;
              filter: blur(0px);
              pointer-events: auto;
            `;
          } else if (stepIndex < currentStep) {
            // Previous (Left)
            style = `
              transform: translateX(${distance * 120}%) scale(0.85) rotateY(15deg) rotateZ(-2deg);
              opacity: 0.4;
              z-index: ${20 + distance};
              filter: blur(2px);
              pointer-events: none;
            `;
          } else {
            // Next (Right/Stack)
            const scale = 1 - (distance * 0.05);
            const opacity = Math.max(0, 0.5 - (distance * 0.1));
            style = `
              transform: translateX(${distance * 60 + 20}px) translateY(${distance * 10}px) scale(${scale});
              opacity: ${opacity};
              z-index: ${20 - distance};
              filter: blur(1px);
              pointer-events: none;
            `;
          }
          
          card.style.cssText = style;
        });

        // 2. Update Dots
        dotsContainer.innerHTML = '';
        for(let i=1; i<=totalSteps; i++) {
          const isActive = i === currentStep;
          const btn = document.createElement('button');
          btn.onclick = () => goToStep(i);
          btn.className = `h-2 rounded-full transition-all duration-500 ${
            isActive 
            ? 'w-12 bg-indigo-500 shadow-[0_0_15px_rgba(99,102,241,0.5)]' 
            : 'w-2 bg-zinc-800 hover:bg-zinc-700'
          }`;
          dotsContainer.appendChild(btn);
        }

        // 3. Update Buttons
        if(currentStep === 1) {
          prevBtn.disabled = true;
          prevBtn.classList.add('opacity-50', 'cursor-not-allowed');
          prevBtn.classList.remove('hover:bg-zinc-800', 'hover:text-white', 'hover:scale-110');
        } else {
          prevBtn.disabled = false;
          prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
          prevBtn.classList.add('hover:bg-zinc-800', 'hover:text-white', 'hover:scale-110');
        }

        if(currentStep === totalSteps) {
          nextBtn.disabled = true;
          nextBtn.innerHTML = '<i data-lucide="check" class="w-6 h-6"></i>';
          nextBtn.classList.add('opacity-50', 'cursor-not-allowed', 'saturate-0');
          nextBtn.classList.remove('hover:scale-110');
        } else {
          nextBtn.disabled = false;
          nextBtn.innerHTML = '<i data-lucide="arrow-right" class="w-6 h-6"></i>';
          nextBtn.classList.remove('opacity-50', 'cursor-not-allowed', 'saturate-0');
          nextBtn.classList.add('hover:scale-110');
        }
        
        lucide.createIcons();
      }

      // Feature Logic
      function setGender(type) {
        document.getElementById('genderInput').value = type;
        const maleBtn = document.getElementById('btn-male');
        const femaleBtn = document.getElementById('btn-female');
        
        // Reset classes
        const baseClass = "flex-1 py-3 md:py-3.5 px-4 rounded-xl border border-zinc-800 bg-zinc-900/50 text-zinc-500 transition-all duration-300 hover:border-zinc-700";
        maleBtn.className = baseClass;
        femaleBtn.className = baseClass;

        if(type === 'L') {
          maleBtn.className = "flex-1 py-3 md:py-3.5 px-4 rounded-xl border transition-all duration-300 bg-indigo-600/20 border-indigo-500 text-indigo-200";
        } else {
          femaleBtn.className = "flex-1 py-3 md:py-3.5 px-4 rounded-xl border transition-all duration-300 bg-pink-600/20 border-pink-500 text-pink-200";
        }
      }

      function handleFile(input) {
        if(input.files && input.files[0]) {
          document.getElementById('fileName').textContent = input.files[0].name;
          document.getElementById('fileName').classList.remove('text-zinc-500');
          document.getElementById('fileName').classList.add('text-zinc-200');
        }
      }
    </script>
  </body>
</html>