@extends('Layout.nav')
@section('content')
    <!-- Main Content -->
    <main class="flex-grow flex flex-col gap-12 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">
        
        <!-- Hero Slider Section -->
        <section id="home" class="w-full reveal active">
            <div id="slider-container" class="relative group w-full h-[400px] md:h-[500px] bg-charcoal rounded-3xl overflow-hidden shadow-2xl ring-1 ring-white/10 hover:ring-royal-blue/30 transition-all duration-500">
                
                <!-- Slides Container -->
                <div id="slider-track" class="flex transition-transform duration-700 ease-out h-full" style="transform: translateX(0%);">
                    
                    <!-- Slide 1 -->
                    <div class="min-w-full h-full relative">
                        <img src="{{ asset('assets/img/1.png') }}" alt="Slide 1" class="w-full h-full object-cover opacity-60 mix-blend-overlay" />
                        <!-- class="w-full h-full object-contain/cover opacity-60 mix-blend-overlay" -->
                        <div class="absolute inset-0 bg-gradient-to-t from-obsidian via-obsidian/50 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-8 md:p-16 w-full max-w-3xl">
                            <span class="inline-block px-3 py-1 mb-4 text-xs font-semibold tracking-wider text-white uppercase bg-royal-blue rounded-full shadow-[0_0_10px_rgba(37,99,235,0.5)]">
                                Featured
                            </span>
                            <h2 class="text-4xl md:text-6xl font-bold mb-4 text-white leading-tight">Inovasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-royal-blue to-ice-blue">Masa Depan</span></h2>
                            <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-xl">Temukan peluang karir di perusahaan teknologi terkemuka dengan ekosistem yang mendukung pertumbuhan.</p>
                            <a href="{{ route('lowongan') }}" class="px-8 py-3 bg-white text-black hover:bg-royal-blue hover:text-white rounded-xl transition-all duration-300 font-bold shadow-lg transform hover:-translate-y-1">
                                Lihat Lowongan
                            </a>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="min-w-full h-full relative">
                        <img src="{{ asset('assets/img/2.png') }}" alt="Slide 2" class="w-full h-full object-cover opacity-50 mix-blend-overlay" />
                        <div class="absolute inset-0 bg-gradient-to-t from-obsidian via-obsidian/50 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-8 md:p-16 w-full max-w-3xl">
                            <span class="inline-block px-3 py-1 mb-4 text-xs font-semibold tracking-wider text-white uppercase bg-royal-blue rounded-full shadow-[0_0_10px_rgba(37,99,235,0.5)]">
                                Partner
                            </span>
                            <h2 class="text-4xl md:text-6xl font-bold mb-4 text-white leading-tight">Kemitraan <span class="text-transparent bg-clip-text bg-gradient-to-r from-royal-blue to-ice-blue">Strategis</span></h2>
                            <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-xl">Bergabung bersama jaringan mitra profesional kami untuk memperluas jangkauan bisnis Anda.</p>
                            <a href="#contact" class="px-8 py-3 bg-transparent border border-white hover:border-royal-blue hover:bg-royal-blue text-white rounded-xl transition-all duration-300 font-bold">
                                Gabung Mitra
                            </a href="#contact">
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="min-w-full h-full relative">
                        <img src="{{ asset('assets/img/3.png') }}" alt="Slide 3" class="w-full h-full object-cover opacity-60 mix-blend-overlay" />
                        <div class="absolute inset-0 bg-gradient-to-t from-obsidian via-obsidian/50 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-8 md:p-16 w-full max-w-3xl">
                            <span class="inline-block px-3 py-1 mb-4 text-xs font-semibold tracking-wider text-white uppercase bg-royal-blue rounded-full shadow-[0_0_10px_rgba(37,99,235,0.5)]">
                                Tech
                            </span>
                            <h2 class="text-4xl md:text-6xl font-bold mb-4 text-white leading-tight">Solusi <span class="text-transparent bg-clip-text bg-gradient-to-r from-royal-blue to-ice-blue">Digital</span></h2>
                            <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-xl">Transformasi bisnis Anda ke era digital dengan teknologi mutakhir.</p>
                        </div>
                    </div>

                </div>

                <!-- Navigation Arrows -->
                <button id="prev-btn" class="absolute left-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-black/50 text-white backdrop-blur-md border border-white/10 hover:bg-royal-blue hover:border-royal-blue transition-all opacity-0 group-hover:opacity-100 transform -translate-x-4 group-hover:translate-x-0 cursor-pointer">
                    <i data-lucide="chevron-left" class="w-6 h-6"></i>
                </button>
                <button id="next-btn" class="absolute right-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-black/50 text-white backdrop-blur-md border border-white/10 hover:bg-royal-blue hover:border-royal-blue transition-all opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 cursor-pointer">
                    <i data-lucide="chevron-right" class="w-6 h-6"></i>
                </button>

                <!-- Indicators -->
                <div class="absolute bottom-6 right-8 flex space-x-2" id="slider-dots">
                    <div class="dot h-1.5 rounded-full transition-all duration-300 cursor-pointer w-8 bg-royal-blue shadow-[0_0_10px_rgba(37,99,235,0.8)]" onclick="goToSlide(0)"></div>
                    <div class="dot h-1.5 rounded-full transition-all duration-300 cursor-pointer w-2 bg-white/30 hover:bg-white" onclick="goToSlide(1)"></div>
                    <div class="dot h-1.5 rounded-full transition-all duration-300 cursor-pointer w-2 bg-white/30 hover:bg-white" onclick="goToSlide(2)"></div>
                </div>
            </div>
        </section>

        <!-- Content Section -->
        <section class="w-full">
            <div class="grid grid-cols-1 md:grid-cols-1 gap-8 w-full">
                
                <!-- Tentang Kami Card -->
                <div id="about" class="reveal group relative p-8 md:p-12 rounded-3xl bg-charcoal border border-white/5 hover:border-royal-blue/50 transition-all duration-500 overflow-hidden hover:shadow-[0_0_30px_rgba(37,99,235,0.1)]">
                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity duration-500 transform group-hover:scale-110">
                        <i data-lucide="info" class="w-[120px] h-[120px] text-royal-blue"></i>
                    </div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div>
                            <h3 class="text-3xl font-bold mb-4 text-white flex items-center gap-3">
                                Tentang Kami
                                <div class="h-2 w-2 rounded-full bg-royal-blue opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </h3>
                            <div class="w-12 h-1 bg-gradient-to-r from-royal-blue to-transparent mb-6 group-hover:w-full transition-all duration-700"></div>
                            <p class="text-mist text-lg leading-relaxed mb-8">
                                Kami adalah jembatan antara talenta terbaik dan perusahaan visioner. Dedikasi kami adalah menciptakan ekosistem kerja yang profesional, elegan, dan berdampak positif bagi pertumbuhan industri. <br>
                                <strong>Silahkan hubungi kontak di bawah bila ada keluhan atau ingin bergabung menjadi mitra.</strong>
                            </p>
                        </div>
                    </div>
                </div>

                <div id="contact" class="reveal group relative p-8 md:p-12 rounded-3xl bg-charcoal border border-white/5 hover:border-royal-blue/50 transition-all duration-500 overflow-hidden hover:shadow-[0_0_30px_rgba(37,99,235,0.1)]">

                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition duration-500">
                        <i data-lucide="mail" class="w-[120px] h-[120px] text-royal-blue"></i>
                    </div>

                    <h3 class="text-3xl font-bold mb-6 text-white text-center">Hubungi Kami</h3>

                    <form action="{{ route('kontakStore') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm text-neutral-400 mb-1">Nama</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full bg-black/40 border border-neutral-700 rounded-lg px-4 py-2 text-white">
                            @error('nama')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-neutral-400 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-black/40 border border-neutral-700 rounded-lg px-4 py-2 text-white">
                            @error('email')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-neutral-400 mb-1">Telephone</label>
                            <input type="no_tlp" name="no_tlp" value="{{ old('no_tlp') }}" class="w-full bg-black/40 border border-neutral-700 rounded-lg px-4 py-2 text-white">
                            @error('no_tlp')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm text-neutral-400 mb-1">Keperluan</label>
                            <textarea name="keperluan" rows="5" class="w-full bg-black/40 border border-neutral-700 rounded-lg px-4 py-2 text-white">{{ old('keperluan') }}</textarea>
                            @error('keperluan')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="">
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>

                            @error('g-recaptcha-response')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                        <div class="flex justify-end gap-3">
                            <button type="reset" class="px-6 py-2 rounded-lg bg-neutral-700">Reset</button>
                            <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600">Kirim</button>
                        </div>

                    </form>
                </div>

            </div>
        </section>

    </main>
@endsection