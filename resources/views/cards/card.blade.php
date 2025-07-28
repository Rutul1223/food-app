<link href="https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&family=Roboto:wght@400&display=swap"
    rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
<style>
    .showcase-section {
        padding: 80px 0;
        background-color: #040D10;
    }

    .subtitle {
        font-family: 'Baskervville', serif;
        font-size: 15px;
        font-style: italic;
        font-weight: 400;
        margin-bottom: 20px;
        text-align: center;
        color: #FFD28D;
    }

    .swiper-navigation-wrapper {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
        position: relative;
        z-index: 10;
    }

    .swiper-navigation-wrapper .swiper-button-prev,
    .swiper-navigation-wrapper .swiper-button-next {
        position: static;
        /* Override Swiper default absolute positioning */
    }

    .title {
        font-family: 'Baskervville', serif;
        font-size: 50px;
        font-weight: 400;
        margin-bottom: 40px;
        text-align: center;
        color: #FFD28D;
    }

    .swiper-container {
        width: 100%;
        padding: 0 20px;
        position: relative;
        /* Ensure navigation buttons are positioned correctly */
    }

    .showcase-item {
        position: relative;
        margin-bottom: 30px;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .showcase-item img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .showcase-item:hover img {
        transform: scale(1.05);
    }

    .showcase-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 20px;
        text-align: center;
    }

    .showcase-content h5 {
        font-family: 'Baskervville', serif;
        font-size: 1.5rem;
        margin: 0;
        color: #FFD28D;
    }

    .showcase-content p {
        font-size: 1rem;
        color: #ccc;
        margin: 5px 0;
    }

    .showcase-content .price {
        font-size: 1.2rem;
        font-weight: 600;
        color: #d4a373;
    }

    .special-offer {
        color: #28a745;
        font-style: italic;
        font-size: 0.9rem;
    }

    .swiper-button-prev,
    .swiper-button-next {
        color: #FFD28D;
        background: rgba(0, 0, 0, 0.5);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        transition: background 0.3s ease;
        z-index: 10;
        /* Ensure buttons are above other elements */
    }

    .swiper-button-prev:hover,
    .swiper-button-next:hover {
        background: rgba(0, 0, 0, 0.8);
    }

    .swiper-button-prev::after,
    .swiper-button-next::after {
        font-size: 20px;
        color: #FFD28D;
    }

    @media (max-width: 768px) {
        .showcase-item img {
            height: 200px;
        }

        .showcase-content h5 {
            font-size: 1.2rem;
        }

        .showcase-content p {
            font-size: 0.9rem;
        }
    }
</style>
</head>

<body>
    <section class="showcase-section">
        <div class="container">
            <div class="subtitle">Food Items</div>
            <h2 class="title">Food Showcase</h2>
            <div class="swiper-container">
                <div class="swiper-wrapper" id="showcaseItems">
                    <!-- Slides will be populated via AJAX -->
                </div>
                <div class="swiper-navigation-wrapper">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('food.item.details') }}', // Same endpoint as menu section
                method: 'GET',
                beforeSend: function() {
                    $('#showcaseItems').html('<div class="swiper-slide"><p>Loading...</p></div>');
                },
                success: function(data) {
                    console.log('Showcase items:', data);
                    let showcaseContainer = $('#showcaseItems');
                    showcaseContainer.empty();

                    if (data && Array.isArray(data) && data.length > 0) {
                        data.forEach(function(item) {
                            let offerHtml = item.price ?
                                `<p class="special-offer">${item.price}</p>` : '';
                            showcaseContainer.append(`
                            <div class="swiper-slide">
                                <div class="showcase-item">
                                    <img src="${item.image}" alt="${item.name}">
                                    <div class="showcase-content">
                                        <h5>${item.name}</h5>
                                        <p>${item.description}</p>
                                        <p class="price">₹${parseFloat(item.price).toFixed(2)}</p>
                                    </div>
                                </div>
                            </div>
                        `);
                        });

                        // Initialize Swiper after appending slides
                        const swiper = new Swiper('.swiper-container', {
                            slidesPerView: 4,
                            spaceBetween: 30,
                            loop: true,
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                            breakpoints: {
                                320: {
                                    slidesPerView: 1,
                                    spaceBetween: 10,
                                },
                                576: {
                                    slidesPerView: 2,
                                    spaceBetween: 20,
                                },
                                768: {
                                    slidesPerView: 3,
                                    spaceBetween: 20,
                                },
                                992: {
                                    slidesPerView: 4,
                                    spaceBetween: 30,
                                },
                            },
                        });
                    } else {
                        showcaseContainer.append(
                            '<div class="swiper-slide"><p>No showcase items available.</p></div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching showcase items:', status, error, xhr.responseText);
                    $('#showcaseItems').html(
                        '<div class="swiper-slide"><p>Error loading showcase items. Please try again later.</p></div>'
                        );
                }
            });
        });
    </script>
