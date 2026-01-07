    @extends('Layout.nav')
    @section('content')
        <!-- Main Content -->
        <main class="flex-grow pt-32 pb-20 px-6">
            <div class="max-w-7xl mx-auto">
                
                <!-- Hero Section -->
                <div class="flex flex-col items-center mb-20 text-center space-y-8 fade-in">
                    <h1 class="text-4xl md:text-6xl font-bold tracking-tight">
                        Temukan Karir <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Impianmu</span>
                    </h1>
                    <p class="text-gray-400 max-w-2xl text-lg">
                        Platform magang eksklusif untuk talenta digital masa depan.
                    </p>

                    <!-- Search Input -->
                    <div class="w-full max-w-2xl relative group">
                        <div class="absolute inset-0 bg-blue-500/20 blur-2xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative flex items-center bg-[#151515] border border-white/10 rounded-full pl-6 pr-2 py-2 shadow-2xl focus-within:border-blue-500/50 focus-within:ring-1 focus-within:ring-blue-500/50 transition-all">
                            <input type="text" id="searchInput" placeholder="Cari pekerjaan, perusahaan, atau keahlian..." class="flex-1 bg-transparent border-none focus:outline-none text-white placeholder-gray-500 h-12 text-lg">
                            <button class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-black hover:bg-gray-200 transition-colors">
                                <i data-lucide="search" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Filters Container (Hardcoded HTML) -->
                    <div class="flex flex-wrap justify-center gap-4 mt-8" id="filterContainer">
                        
                        <!-- Filter: Tipe -->
                        <div class="relative filter-dropdown" data-category="tipe">
                            <button onclick="toggleDropdown('tipe')" class="filter-btn flex items-center gap-2 px-6 py-2.5 rounded-full border transition-all duration-200 bg-transparent text-gray-400 border-white/20 hover:border-white/50 hover:text-white" id="btn-tipe">
                                <span class="text-sm">Tipe</span>
                                <span id="count-tipe" class="hidden flex items-center justify-center w-5 h-5 bg-blue-600 text-white text-[10px] rounded-full font-bold">0</span>
                                <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" id="icon-tipe"></i>
                            </button>
                            <div id="content-tipe" class="filter-dropdown-content absolute top-full left-0 mt-2 w-56 bg-[#1a1a1a] border border-white/10 rounded-xl shadow-2xl p-2 z-20">
                                <div class="flex flex-col gap-1">
                                    @foreach($types as $t)
                                    <label class="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-pointer hover:bg-white/5 transition-colors group">
                                        <input type="checkbox" value="{{ strtolower($t->nama) }}" class="peer hidden filter-checkbox" data-cat="tipe">
                                        <div class="w-4 h-4 rounded border border-gray-600 peer-checked:bg-blue-500 peer-checked:border-blue-500 flex items-center justify-center transition-colors">
                                            <i data-lucide="check" class="w-3 h-3 text-white hidden peer-checked:block"></i>
                                        </div>
                                        <span class="text-sm text-gray-400 peer-checked:text-white peer-checked:font-medium">{{ $t->nama }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Filter: Jenjang -->
                        <div class="relative filter-dropdown" data-category="jenjang">
                            <button onclick="toggleDropdown('jenjang')" class="filter-btn flex items-center gap-2 px-6 py-2.5 rounded-full border transition-all duration-200 bg-transparent text-gray-400 border-white/20 hover:border-white/50 hover:text-white" id="btn-jenjang">
                                <span class="text-sm">Jenjang</span>
                                <span id="count-jenjang" class="hidden flex items-center justify-center w-5 h-5 bg-blue-600 text-white text-[10px] rounded-full font-bold">0</span>
                                <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" id="icon-jenjang"></i>
                            </button>
                            <div id="content-jenjang" class="filter-dropdown-content absolute top-full left-0 mt-2 w-56 bg-[#1a1a1a] border border-white/10 rounded-xl shadow-2xl p-2 z-20">
                                <div class="flex flex-col gap-1">
                                    @foreach($jenjangs as $j)
                                    <label class="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-pointer hover:bg-white/5 transition-colors group">
                                        <input type="checkbox" value="{{ strtolower($j->nama) }}" class="peer hidden filter-checkbox" data-cat="jenjang">
                                        <div class="w-4 h-4 rounded border border-gray-600 peer-checked:bg-blue-500 peer-checked:border-blue-500 flex items-center justify-center transition-colors">
                                            <i data-lucide="check" class="w-3 h-3 text-white hidden peer-checked:block"></i>
                                        </div>
                                        <span class="text-sm text-gray-400 peer-checked:text-white peer-checked:font-medium">{{ $j->nama }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Filter: Keahlian -->
                        <div class="relative filter-dropdown" data-category="keahlian">
                            <button onclick="toggleDropdown('keahlian')" class="filter-btn flex items-center gap-2 px-6 py-2.5 rounded-full border transition-all duration-200 bg-transparent text-gray-400 border-white/20 hover:border-white/50 hover:text-white" id="btn-keahlian">
                                <span class="text-sm">Keahlian</span>
                                <span id="count-keahlian" class="hidden flex items-center justify-center w-5 h-5 bg-blue-600 text-white text-[10px] rounded-full font-bold">0</span>
                                <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" id="icon-keahlian"></i>
                            </button>
                            <div id="content-keahlian" class="filter-dropdown-content absolute top-full left-0 mt-2 w-56 bg-[#1a1a1a] border border-white/10 rounded-xl shadow-2xl p-2 z-20">
                                <div class="flex flex-col gap-1">
                                    @foreach($keahlians as $k)
                                    <label class="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-pointer hover:bg-white/5 transition-colors group">
                                        <input type="checkbox" value="{{ strtolower($k->nama) }}" class="peer hidden filter-checkbox" data-cat="keahlian">
                                        <div class="w-4 h-4 rounded border border-gray-600 peer-checked:bg-blue-500 peer-checked:border-blue-500 flex items-center justify-center transition-colors">
                                            <i data-lucide="check" class="w-3 h-3 text-white hidden peer-checked:block"></i>
                                        </div>
                                        <span class="text-sm text-gray-400 peer-checked:text-white peer-checked:font-medium">{{ $k->nama }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Active Filters Display -->
                    <div id="activeFilters" class="flex flex-wrap gap-2 justify-center mt-4 hidden">
                        <span class="text-xs text-gray-500 self-center mr-2">Filter Aktif:</span>
                        <div id="activeTagsContainer" class="flex flex-wrap gap-2"></div>
                        <button onclick="clearAllFilters()" class="text-xs text-gray-500 hover:text-white underline ml-2">Hapus Semua</button>
                    </div>
                </div>

                <!-- Job List Header -->
                <div class="mb-8 flex items-center justify-between">
                    <h2 class="text-2xl font-bold">Lowongan Terbaru</h2>
                    <span id="jobCount" class="text-gray-500 text-sm">{{ $count }} Lowongan ditemukan</span>
                </div>

                <!-- Job Grid (Hardcoded HTML) -->
                <div id="jobGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                    @foreach($lowongans as $l)
                    <a href="{{ route('lowonganShow', $l->id) }}" class="block job-card group relative bg-[#0f0f0f] border border-white/5 hover:border-blue-500/30 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)]"
                        data-title="{{ strtolower($l->job) }}" data-company="{{ strtolower($l->mitra?->nama) }}" data-tipe="{{ strtolower($l->type?->nama) }}" data-jenjang="{{ strtolower($l->jenjang?->nama) }}" data-keahlian="{{ strtolower($l->keahlian?->nama) }}">
                        <div class="flex justify-between items-start mb-4">
                            <div class="inline-flex items-center px-3 py-1 rounded-full border border-white/10 bg-white/5 text-sm font-medium text-gray-200 group-hover:border-blue-500/30 transition-colors">
                                {{ $l->job }}
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-8">
                            <span class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-[#1a1a1a] text-xs text-gray-400">
                                <i data-lucide="briefcase" class="w-3 h-3 text-blue-400"></i> {{ $l->type?->nama }}
                            </span>
                            <span class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-[#1a1a1a] text-xs text-gray-400">
                                <i data-lucide="code" class="w-3 h-3 text-purple-400"></i> {{ $l->keahlian?->nama }}
                            </span>
                            <span class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-[#1a1a1a] text-xs text-gray-400">
                                <i data-lucide="graduation-cap" class="w-3 h-3 text-green-400"></i> {{ $l->jenjang?->nama }}
                            </span>
                        </div>
                        <div class="flex items-center gap-4 mt-auto">
                            <div class="relative">
                                <img src="{{ Storage::disk('s3')->url($l->mitra?->foto) }}" alt="TechVision Corp" class="w-12 h-12 rounded-full object-cover border border-white/10 opacity-80 group-hover:opacity-100 transition-opacity">
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-[#0f0f0f]" title="Verified"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-semibold text-white truncate group-hover:text-blue-400 transition-colors">{{ $l->mitra?->nama }}</h4>
                                <div class="flex items-center gap-1.5 mt-0.5 text-xs text-gray-500 truncate">
                                    <i data-lucide="map-pin" class="w-3 h-3"></i> {{ $l->mitra?->alamat }}
                                </div>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-blue-500/0 to-blue-500/0 opacity-0 group-hover:opacity-5 group-hover:to-blue-500/10 rounded-2xl pointer-events-none transition-all duration-500"></div>
                    </a>
                    @endforeach
                </div>
                
                <!-- Empty State -->
                <div id="emptyState" class="hidden text-center py-20 bg-[#0f0f0f] rounded-2xl border border-white/5 border-dashed">
                    <div class="inline-block p-4 rounded-full bg-white/5 mb-4">
                        <i data-lucide="search-x" class="w-8 h-8 text-gray-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Tidak ditemukan</h3>
                    <p class="text-gray-400">Coba ubah kata kunci atau filter pencarian Anda.</p>
                </div>

            </div>
        </main>
    @endsection