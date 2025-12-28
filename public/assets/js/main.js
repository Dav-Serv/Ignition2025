// Initialize Icons
        lucide.createIcons();

        // --- Mobile Menu Logic ---
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        const mobileLinks = document.querySelectorAll('.mobile-link');

        function toggleMenu() {
            const isHidden = mobileMenu.classList.contains('hidden');
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                mobileMenu.classList.add('animate-fade-in-up');
            } else {
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                mobileMenu.classList.remove('animate-fade-in-up');
            }
        }

        menuBtn.addEventListener('click', toggleMenu);

        // Auto-close menu when a link is clicked
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (!mobileMenu.classList.contains('hidden')) {
                    toggleMenu();
                }
            });
        });


        // --- Slider Logic ---
        const track = document.getElementById('slider-track');
        const dots = document.querySelectorAll('.dot');
        const sliderContainer = document.getElementById('slider-container');
        let currentSlide = 0;
        const totalSlides = 3;
        let slideInterval;

        function updateSlider() {
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
            dots.forEach((dot, index) => {
                if(index === currentSlide) {
                    dot.classList.remove('w-2', 'bg-white/30');
                    dot.classList.add('w-8', 'bg-royal-blue', 'shadow-[0_0_10px_rgba(37,99,235,0.8)]');
                } else {
                    dot.classList.add('w-2', 'bg-white/30');
                    dot.classList.remove('w-8', 'bg-royal-blue', 'shadow-[0_0_10px_rgba(37,99,235,0.8)]');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateSlider();
        }

        window.goToSlide = function(index) {
            currentSlide = index;
            updateSlider();
        }

        document.getElementById('next-btn').addEventListener('click', nextSlide);
        document.getElementById('prev-btn').addEventListener('click', prevSlide);

        // Smart Slider: Pause on hover
        function startSlideShow() {
            slideInterval = setInterval(nextSlide, 5000);
        }
        
        function stopSlideShow() {
            clearInterval(slideInterval);
        }

        sliderContainer.addEventListener('mouseenter', stopSlideShow);
        sliderContainer.addEventListener('mouseleave', startSlideShow);
        
        // Start initially
        startSlideShow();


        // --- Scroll Reveal Animation ---
        const observerOptions = {
            threshold: 0.15,
            rootMargin: "0px"
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));


        // --- Modal Logic ---
        const modal = document.getElementById('login-modal');
        const modalBackdrop = document.getElementById('modal-backdrop');
        const modalPanel = document.getElementById('modal-panel');

        window.openModal = function() {
            modal.classList.remove('hidden');
            // Trigger reflow/animation
            setTimeout(() => {
                modalBackdrop.classList.remove('opacity-0');
                modalPanel.classList.remove('scale-95', 'opacity-0');
                modalPanel.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        window.closeModal = function() {
            modalBackdrop.classList.add('opacity-0');
            modalPanel.classList.remove('scale-100', 'opacity-100');
            modalPanel.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Close on backdrop click
        modalBackdrop.addEventListener('click', window.closeModal);

        // Handle Login Alert
        window.handleLogin = function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            // Mock login
            window.closeModal();
            setTimeout(() => {
                alert(`Login Berhasil!\nSelamat datang kembali, ${email}`);
            }, 300);
        }