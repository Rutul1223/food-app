<section class="elegencia-opening-hours d-flex flex-column flex-md-row w-100">
    <div class="opening-hours-image flex-fill"></div>
    <div class="opening-hours-content flex-fill">
        <h2>Opening Hours</h2>
        <p class="opening-hours-subtitle">Lorem to our restaurant, where culinary artistry meets exceptional dining
            experiences. At, we strive to
            create a gastronomic haven that.</p>
        <div class="opening-hours-date">
            <p><strong>Sunday - Thursday:</strong> 11:30 AM - 11:00 PM</p>
            <div class="opening-hours-divider"></div>
            <p><strong>Friday & Saturday:</strong> 11:30 AM - 12:00 AM</p>
        </div>
        <div class="text-btn">
            <a href="#" class="text-btn1">Reservation</a>
        </div>
    </div>
</section>

<style>
    .elegencia-opening-hours {
        min-height: 500px;
    }

    .opening-hours-image {
        background: url('{{ asset('openingHour.jpg') }}') no-repeat center center;
        background-size: cover;
        min-height: 300px;
        min-width: 800px;
    }

    .opening-hours-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 40px;
        background-color: #091E24;
        color: #333;
        font-family: 'Roboto', sans-serif;
    }

    .opening-hours-content h2 {
        font-family: 'Baskervville';
        font-size: 50px;
        color: #ffd28d;
        margin-bottom: 20px;
    }

    .opening-hours-date {
        font-size: 1.1rem;
        margin: 10px 0;
        color: #ffffff;
    }

    .opening-hours-divider {
        width: 98%;
        height: 0.5px;
        opacity: 0.2;
        background: #FFD28D;
        margin: 10px 0px;
    }

    .opening-hours-subtitle {
        color: #C8C8C8;
    }
    .text-btn {
        margin-top: 20px;
        text-align: center;
    }
    .text-btn1 {
        text-decoration: none;
        color: #FFD28D;
        font-size: 1.1rem;
        border: 2px solid #FFD28D;
        padding: 10px 20px;
        border-radius: 5px;
    }
</style>

<!-- GSAP Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script>
// GSAP Animation
document.addEventListener('DOMContentLoaded', () => {
    gsap.from(".opening-hours-content h2", {
        duration: 1.2,
        opacity: 0,
        y: 50,
        ease: "power3.out",
        delay: 0.3
    });

    gsap.from(".opening-hours-subtitle", {
        duration: 1.2,
        opacity: 0,
        y: 50,
        ease: "power3.out",
        delay: 0.6
    });

    gsap.from(".opening-hours-date p", {
        duration: 1.2,
        opacity: 0,
        y: 50,
        ease: "power3.out",
        delay: 0.9,
        stagger: 0.2
    });

    gsap.from(".text-btn1", {
        duration: 1.2,
        opacity: 0,
        y: 50,
        ease: "power3.out",
        delay: 1.3
    });
});
</script>
