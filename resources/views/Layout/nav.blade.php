<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Magang Mania</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @php use Illuminate\Support\Facades\Storage; @endphp
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Inter', 'sans-serif'],
            },
            colors: {
              obsidian: '#050505',   /* Darker Black */
              charcoal: '#121212',   /* Dark Grey Surface */
              pebble: '#1f1f1f',     /* Borders */
              mist: '#a3a3a3',       /* Text */
              snow: '#fafafa',       /* Headings */
              'royal-blue': '#2563eb', /* Primary Accent */
              'ice-blue': '#60a5fa',   /* Hover Accent */
            },
            animation: {
                'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
            },
            keyframes: {
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                }
            }
          }
        }
      }
    </script>
    <style>
/* ==============================
   GLOBAL RESET & LAYOUT
============================== */
.logo{
  height: 60px;
}

html, body {
  height: 100%;
}

body {
  margin: 0;
  background-color: #050505;
  color: #fafafa;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}

main {
  flex: 1;
}

/* ==============================
   SCROLLBAR (DARK MODE)
============================== */
::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}

::-webkit-scrollbar-track {
  background: transparent;
}

::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.15);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.3);
}

/* Hide scrollbar utility */
.no-scrollbar::-webkit-scrollbar {
  display: none;
}
.no-scrollbar {
  scrollbar-width: none;
}

/* ==============================
   GLASSMORPHISM
============================== */
.glass {
  background: rgba(18, 18, 18, 0.85);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
  border-radius: 12px;
}

/* ==============================
   TABLE STYLING
============================== */
table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
}

thead th {
  font-size: 0.75rem;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  color: #b3b3b3;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  padding: 14px 16px;
}

tbody td {
  padding: 14px 16px;
  font-size: 0.875rem;
}

tbody tr:not(:last-child) td {
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

tbody tr:hover {
  background: rgba(255, 255, 255, 0.03);
}

/* ==============================
   BADGE
============================== */
.badge {
  display: inline-flex;
  align-items: center;
  padding: 4px 10px;
  font-size: 0.75rem;
  font-weight: 500;
  border-radius: 9999px;
}

.badge-purple {
  background: rgba(168, 85, 247, 0.15);
  color: #c084fc;
  border: 1px solid rgba(168, 85, 247, 0.25);
}

.badge-green {
  background: rgba(34, 197, 94, 0.15);
  color: #4ade80;
  border: 1px solid rgba(34, 197, 94, 0.25);
}

/* ==============================
   BUTTON & ACTION ICON
============================== */
.btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 14px;
  border-radius: 10px;
  font-size: 0.875rem;
  font-weight: 500;
  cursor: pointer;
  border: none;
  transition: background 0.2s ease, transform 0.1s ease;
}

.btn-primary {
  background: #ffffff;
  color: #000000;
}

.btn-primary:hover {
  background: #e5e5e5;
}

.icon-btn {
  width: 36px;
  height: 36px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 10px;
  background: rgba(255, 255, 255, 0.05);
  transition: background 0.2s ease, transform 0.1s ease;
}

.icon-btn:hover {
  background: rgba(255, 255, 255, 0.12);
}

/* ==============================
   DROPDOWN
============================== */
.filter-dropdown-content {
  display: none;
  animation: fadeScale 0.15s ease-out;
}

.filter-dropdown-content.show {
  display: block;
}

/* ==============================
   MODAL TRANSITION
============================== */
.modal-enter {
  opacity: 0;
  transform: scale(0.95);
}

.modal-enter-active {
  opacity: 1;
  transform: scale(1);
  transition: opacity 200ms ease, transform 200ms ease;
}

.modal-exit {
  opacity: 0;
  transform: scale(0.95);
  transition: opacity 200ms ease, transform 200ms ease;
}

/* ==============================
   ANIMATION UTILITIES
============================== */
.reveal {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.reveal.active {
  opacity: 1;
  transform: translateY(0);
}

.fade-in {
  animation: fadeInOp 0.5s ease-out;
}

/* ==============================
   KEYFRAMES
============================== */
@keyframes fadeScale {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

@keyframes fadeInOp {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>

  <script type="importmap">
{
  "imports": {
    "react": "https://esm.sh/react@^19.2.3",
    "react/": "https://esm.sh/react@^19.2.3/",
    "lucide-react": "https://esm.sh/lucide-react@^0.561.0"
  }
}
</script>
</head>
  <body class="min-h-screen bg-obsidian text-snow font-sans selection:bg-royal-blue selection:text-white flex flex-col overflow-x-hidden">
    
    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 bg-black/90 backdrop-blur border-b border-white/10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

          <!-- LEFT : Logo + User -->
          <div class="flex items-center gap-4">
            <img src="{{ asset('assets/img/magang3.png') }}" alt="Logo" class="w-[180px]">

            @auth
              <span class="ml-1 text-[11px] sm:text-xs font-medium text-gray-400">
                {{ Auth::user()->nama }} ({{ Auth::user()->role }})
              </span>
            @endauth

          </div>

          <!-- RIGHT : Desktop Menu + Auth -->
          <div class="hidden md:flex items-center gap-8">

            <!-- Menu -->
            <div class="flex items-center gap-6 text-sm font-medium">
              <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-blue-400 transition">Beranda</a>
              <a href="{{ route('lowongan') }}" class="text-gray-400 hover:text-blue-400 transition">Lowongan</a>

              @auth
                @if(Auth::user()->role === 'admin')
                  <a href="{{ route('user') }}" class="text-gray-400 hover:text-blue-400 transition">User</a>
                  <a href="{{ route('type') }}" class="text-gray-400 hover:text-blue-400 transition">Type</a>
                  <a href="{{ route('jenjang') }}" class="text-gray-400 hover:text-blue-400 transition">Jenjang</a>
                  <a href="{{ route('keahlian') }}" class="text-gray-400 hover:text-blue-400 transition">Keahlian</a>
                  <a href="{{ route('kontak') }}" class="text-gray-400 hover:text-blue-400 transition">Kontak</a>
                @endif

                @if(Auth::user()->role === 'mitra')
                  <a href="{{ route('mitra') }}" class="text-gray-400 hover:text-blue-400 transition">Mitra</a>
                @endif

                @if(in_array(Auth::user()->role, ['mitra', 'pengguna']))
                  <a href="{{ route('lamar') }}" class="text-gray-400 hover:text-blue-400 transition">Lamaran</a>
                @endif
              @endauth
            </div>

            <!-- Auth Button -->
            @auth
            <form action="{{ route('logout') }}" method="POST" class="shrink-0">
              @csrf
              <button type="submit"
                class="bg-white text-black hover:bg-blue-600 hover:text-white
                      px-5 py-2 rounded-full text-sm font-bold transition">
                Logout
              </button>
            </form>
            @else
            <a href="{{ route('register') }}"
              class="border border-white text-white px-5 py-2 rounded-full text-sm font-bold
                      hover:bg-white hover:text-black transition duration-200">
              Register
            </a>
            <a href="{{ route('login') }}"
              class="bg-white text-black hover:bg-blue-600 hover:text-white
                      px-5 py-2 rounded-full text-sm font-bold transition">
              Login
            </a>
            @endauth

          </div>

          <!-- MOBILE BUTTON -->
          <div class="md:hidden">
            <button id="mobile-menu-btn"
              class="p-2 rounded-md text-gray-300 hover:text-white hover:bg-white/10">
              ☰
            </button>
          </div>

        </div>
      </div>

      <!-- MOBILE MENU -->
      <div id="mobile-menu" class="hidden md:hidden bg-black border-t border-white/10">
        <div class="px-4 py-4 space-y-2 text-sm">
          <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded text-gray-300 hover:bg-white/10">Beranda</a>
          <a href="{{ route('lowongan') }}" class="block px-3 py-2 rounded text-gray-300 hover:bg-white/10">Lowongan</a>

          @auth
            @if(Auth::user()->role === 'admin')
              <a href="{{ route('user') }}" class="block px-3 py-2 rounded text-gray-300 hover:bg-white/10">User</a>
              <a href="{{ route('type') }}" class="block px-3 py-2 rounded text-gray-300 hover:bg-white/10">Type</a>
              <a href="{{ route('jenjang') }}" class="block px-3 py-2 rounded text-gray-300 hover:bg-white/10">Jenjang</a>
              <a href="{{ route('keahlian') }}" class="block px-3 py-2 rounded text-gray-300 hover:bg-white/10">Keahlian</a>
              <a href="{{ route('kontak') }}" class="block px-3 py-2 rounded text-gray-300 hover:bg-white/10">Kontak</a>
            @endif

            @if(Auth::user()->role === 'mitra')
              <a href="{{ route('mitra') }}" class="block px-3 py-2 rounded text-gray-300 hover:bg-white/10">Mitra</a>
            @endif

            @if(in_array(Auth::user()->role, ['mitra', 'pengguna']))
              <a href="{{ route('lamar') }}" class="block px-3 py-2 rounded text-gray-300 hover:bg-white/10">Lamaran</a>
            @endif
          @endauth

          @auth
          <form action="{{ route('logout') }}" method="POST" class="pt-3">
            @csrf
            <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700
                    text-white py-3 rounded-lg font-bold transition">
              Logout
            </button>
          </form>
          @else
          <a
              href="{{ route('register') }}"
              class="inline-flex justify-center items-center
                    w-full md:w-auto
                    px-5 py-2
                    rounded-full
                    border border-white
                    text-white font-semibold
                    bg-transparent
                    hover:bg-white hover:text-black
                    transition duration-200"
          >
              Register
          </a>

          <a href="{{ route('login') }}"
            class="block w-full text-center bg-blue-600 hover:bg-blue-700
                    text-white py-3 rounded-lg font-bold transition">
            Login
          </a>
          @endauth
        </div>
      </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="w-full border-t border-white/5 bg-charcoal/50 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-royal-blue rounded flex items-center justify-center">
                    <span class="text-white font-bold text-xs">L</span>
                </div>
                <p class="text-mist text-sm">
                    &copy; <script>document.write(new Date().getFullYear())</script> davserv. All rights reserved Magang Mania.
                </p>
            </div>
            <div class="flex space-x-6 text-sm text-mist">
                <a href="#" class="hover:text-royal-blue transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-royal-blue transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-royal-blue transition-colors">Cookie Settings</a>
            </div>
        </div>
    </footer>

    <!-- Native JavaScript Logic -->
     <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            
            // Search Input
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', applyFilters);

            // Checkboxes
            const checkboxes = document.querySelectorAll('.filter-checkbox');
            checkboxes.forEach(cb => {
                cb.addEventListener('change', () => {
                   applyFilters();
                   updateDropdownStyles();
                   updateActiveFilters();
                });
            });
            
            // Scroll Effect
            window.addEventListener('scroll', () => {
                const nav = document.getElementById('navbar');
                if(window.scrollY > 20) {
                    nav.classList.add('bg-[#050505]/80', 'backdrop-blur-md', 'py-4');
                    nav.classList.remove('bg-[#050505]', 'py-6');
                } else {
                    nav.classList.add('bg-[#050505]', 'py-6');
                    nav.classList.remove('bg-[#050505]/80', 'backdrop-blur-md', 'py-4');
                }
            });

            // Click Outside Dropdown
            document.addEventListener('click', (e) => {
                if(!e.target.closest('.filter-dropdown')) {
                    closeAllDropdowns();
                }
            });
        });

        function applyFilters() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const checkedBoxes = Array.from(document.querySelectorAll('.filter-checkbox:checked'));
            
            // Group checked values by category
            const activeFilters = {
                tipe: checkedBoxes.filter(cb => cb.dataset.cat === 'tipe').map(cb => cb.value),
                jenjang: checkedBoxes.filter(cb => cb.dataset.cat === 'jenjang').map(cb => cb.value),
                keahlian: checkedBoxes.filter(cb => cb.dataset.cat === 'keahlian').map(cb => cb.value)
            };

            const jobCards = document.querySelectorAll('.job-card');
            let visibleCount = 0;

            jobCards.forEach(card => {
                const title = card.dataset.title.toLowerCase();
                const company = card.dataset.company.toLowerCase();
                const type = card.dataset.tipe;
                const level = card.dataset.jenjang;
                const skill = card.dataset.keahlian;

                const matchSearch = title.includes(query) || company.includes(query);
                const matchType = activeFilters.tipe.length === 0 || activeFilters.tipe.includes(type);
                const matchLevel = activeFilters.jenjang.length === 0 || activeFilters.jenjang.includes(level);
                const matchSkill = activeFilters.keahlian.length === 0 || activeFilters.keahlian.includes(skill);

                if (matchSearch && matchType && matchLevel && matchSkill) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            document.getElementById('jobCount').textContent = `${visibleCount} Lowongan ditemukan`;
            const emptyState = document.getElementById('emptyState');
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }

        function toggleDropdown(id) {
            // Close others
            ['tipe', 'jenjang', 'keahlian'].forEach(cat => {
                if(cat !== id) {
                    document.getElementById(`content-${cat}`).classList.remove('show');
                    document.getElementById(`icon-${cat}`).classList.remove('rotate-180');
                }
            });

            const content = document.getElementById(`content-${id}`);
            const icon = document.getElementById(`icon-${id}`);
            content.classList.toggle('show');
            icon.classList.toggle('rotate-180');
        }

        function closeAllDropdowns() {
            ['tipe', 'jenjang', 'keahlian'].forEach(cat => {
                document.getElementById(`content-${cat}`).classList.remove('show');
                document.getElementById(`icon-${cat}`).classList.remove('rotate-180');
            });
        }

        function updateDropdownStyles() {
            ['tipe', 'jenjang', 'keahlian'].forEach(cat => {
                const count = document.querySelectorAll(`.filter-checkbox[data-cat="${cat}"]:checked`).length;
                const btn = document.getElementById(`btn-${cat}`);
                const badge = document.getElementById(`count-${cat}`);
                
                if (count > 0) {
                    btn.classList.add('bg-white', 'text-black', 'border-white', 'font-medium');
                    btn.classList.remove('bg-transparent', 'text-gray-400', 'border-white/20');
                    badge.classList.remove('hidden');
                    badge.textContent = count;
                } else {
                    btn.classList.remove('bg-white', 'text-black', 'border-white', 'font-medium');
                    btn.classList.add('bg-transparent', 'text-gray-400', 'border-white/20');
                    badge.classList.add('hidden');
                }
            });
        }

        function updateActiveFilters() {
            const container = document.getElementById('activeFilters');
            const tagsContainer = document.getElementById('activeTagsContainer');
            const checkedBoxes = Array.from(document.querySelectorAll('.filter-checkbox:checked'));

            if (checkedBoxes.length > 0) {
                container.classList.remove('hidden');
                tagsContainer.innerHTML = checkedBoxes.map(cb => `
                    <button onclick="uncheckFilter('${cb.value}')" class="text-xs flex items-center gap-1 px-2 py-1 rounded bg-blue-500/10 text-blue-400 border border-blue-500/20 hover:bg-blue-500/20 transition-colors">
                        ${cb.value} <span class="opacity-50">×</span>
                    </button>
                `).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function uncheckFilter(val) {
            const cb = Array.from(document.querySelectorAll('.filter-checkbox')).find(c => c.value === val);
            if (cb) {
                cb.checked = false;
                // Trigger change event manually
                cb.dispatchEvent(new Event('change'));
            }
        }

        function clearAllFilters() {
            document.querySelectorAll('.filter-checkbox').forEach(cb => {
                cb.checked = false;
                cb.dispatchEvent(new Event('change'));
            });
        }

        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }
    </script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

    @if ($errors->any())
    <script>
        swal("Error!", "{!! implode('\n', $errors->all()) !!}", "error");
    </script>
    @endif
  </body>
</html>