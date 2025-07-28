<!-- Hero Section -->
<section class="hero-section" style="background-image: url('{{ asset('hero_bg_1.jpg') }}');">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <h3 class="hero-title">FOODIE RETRAT<br> <span class="hero-restaurant">RESTAURANT</span></h3>
            <p class="hero-subtitle">Welcome to our restaurant, where culinary artistry
                meets exceptional dining experiences. At, we strive to create a
                gastronomic haven that tantalizes your taste buds and leaves you with
            </p>
            <a href="#" class="explore-button">Explore Menu</a>
        </div>
    </div>
</section>

<!-- GSAP Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script>
// GSAP Animation
document.addEventListener('DOMContentLoaded', () => {
    gsap.from(".hero-title", {
        duration: 1.2,
        opacity: 0,
        y: 50,
        ease: "power3.out",
        delay: 0.3
    });

    gsap.from(".hero-subtitle", {
        duration: 1.2,
        opacity: 0,
        y: 50,
        ease: "power3.out",
        delay: 0.6
    });

    gsap.from(".explore-button", {
        duration: 1.2,
        opacity: 0,
        y: 50,
        ease: "power3.out",
        delay: 0.9
    });
});
</script>
