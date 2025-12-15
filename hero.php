    <div class="hero-section">
        <div class="hero-content">
            <h1>EXPLORE OUR DRINKS</h1>
            
            <div class="carousel-wrapper">
                <button class="carousel-nav-btn prev-btn" onclick="moveSlide(-1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                
                <div class="carousel-track-container">
                    <div class="carousel-track" id="carouselTrack">
                        <!-- Slide 1 -->
                        <div class="carousel-slide">
                            <img src="images/cookiesncream.avif" alt="Frappe">
                            <div class="slide-label">
                                <h3>Frappe</h3>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="carousel-slide">
                            <img src="images/strawberry2.jpg" alt="Milkshake">
                            <div class="slide-label">
                                <h3>Milkshake</h3>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="carousel-slide active-slide">
                            <img src="images/americano2.jpg" alt="Classic">
                            <div class="slide-label">
                                <h3>Americano</h3>
                            </div>
                        </div>
                        <!-- Slide 4 -->
                        <div class="carousel-slide">
                            <img src="images/icedmocchaccino2.jpg" alt="Specials">
                            <div class="slide-label">
                                <h3>Iced Specials</h3>
                            </div>
                        </div>
                        <!-- Slide 5 -->
                        <div class="carousel-slide">
                            <img src="images/espresso.webp" alt="Espresso">
                            <div class="slide-label">
                                <h3>Espresso</h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button class="carousel-nav-btn next-btn" onclick="moveSlide(1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <div class="hero-cta">
                <a href="index.php?page=menu" class="btn-order-now">
                    <i class="fas fa-shopping-cart"></i> Order Now
                </a>
            </div>
 </div> <!-- End of hero-content -->
    </div> <!-- End of hero-section -->


<script>
    let currentSlide = 2; // Start at middle slide (Classic)
    const totalSlides = 5;
    
    function updateCarousel() {
        const track = document.getElementById('carouselTrack');
        const slides = document.querySelectorAll('.carousel-slide');
        const trackContainer = track.parentElement;
        
        // Get dimensions
        const slideWidth = slides[0].offsetWidth;
        const gap = 30;
        const containerWidth = trackContainer.offsetWidth;
        
        // Calculate offset to center the active slide
        const offset = (containerWidth / 2) - (slideWidth / 2) - (currentSlide * (slideWidth + gap));
        
        track.style.transform = `translateX(${offset}px)`;
    }
    
    function moveSlide(direction) {
        const slides = document.querySelectorAll('.carousel-slide');
        
        // Remove active class from current slide
        slides[currentSlide].classList.remove('active-slide');
        
        // Update current slide index
        currentSlide += direction;
        
        // Loop around if needed
        if (currentSlide < 0) {
            currentSlide = totalSlides - 1;
        } else if (currentSlide >= totalSlides) {
            currentSlide = 0;
        }
        
        // Add active class to new current slide
        slides[currentSlide].classList.add('active-slide');
        
        // Update carousel position
        updateCarousel();
    }
    
    // Auto-play carousel every 4 seconds
    let autoPlayInterval = setInterval(() => {
        moveSlide(1);
    }, 4000);
    
    // Reset interval when user manually navigates
    function resetAutoPlay() {
        clearInterval(autoPlayInterval);
        autoPlayInterval = setInterval(() => {
            moveSlide(1);
        }, 4000);
    }
    
    // Initialize carousel on page load
    window.addEventListener('load', function() {
        setTimeout(() => {
            updateCarousel();
        }, 100); // Small delay to ensure images are loaded
    });
    
    // Re-center on window resize
    window.addEventListener('resize', function() {
        updateCarousel();
    });
</script>            