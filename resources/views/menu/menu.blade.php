<section class="menu-section">
    <div class="container">
        <div class="subtitle">Special Selection</div>
        <h2 class="title">Food Menu</h2>
        <div class="row">
            <div class="col-md-6" id="menuItemsLeft">
                <!-- Left menu items will be populated via AJAX -->
            </div>
            <div class="col-md-6" id="menuItemsRight">
                <!-- Right menu items will be populated via AJAX -->
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $.ajax({
        url: '{{ route('food.item.details') }}', // Updated to new route
        method: 'GET',
        beforeSend: function() {
            $('#menuItemsLeft').html('<p>Loading...</p>');
            $('#menuItemsRight').html('<p>Loading...</p>');
        },
        success: function(data) {
            console.log('Menu items:', data);
            let leftContainer = $('#menuItemsLeft');
            let rightContainer = $('#menuItemsRight');
            leftContainer.empty();
            rightContainer.empty();

            if (data && Array.isArray(data) && data.length > 0) {
                // Split items dynamically
                let midPoint = Math.ceil(data.length / 2); // Split evenly
                let leftItems = data.slice(0, midPoint);
                let rightItems = data.slice(midPoint);

                leftItems.forEach(function(item) {
                    let offerHtml = item.price ? `<p class="special-offer">${item.price}</p>` : '';
                    leftContainer.append(`
                        <div class="menu-item">
                            <div>
                                <h5>${item.name}</h5>
                                <p>${item.description}</p>
                            </div>
                            <span class="price">₹${parseFloat(item.price).toFixed(2)}</span>
                        </div>
                    `);
                });

                rightItems.forEach(function(item) {
                    let offerHtml = item.price ? `<p class="special-offer">${item.price}</p>` : '';
                    rightContainer.append(`
                        <div class="menu-item">
                            <div>
                                <h5>${item.name}</h5>
                                <p>${item.description}</p>
                            </div>
                            <span class="price">₹${parseFloat(item.price).toFixed(2)}</span>
                        </div>
                    `);
                });
            } else {
                leftContainer.append('<p>No menu items available.</p>');
                rightContainer.append('<p>No menu items available.</p>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching menu items:', status, error, xhr.responseText);
            $('#menuItemsLeft').html('<p>Error loading menu items. Please try again later.</p>');
            $('#menuItemsRight').html('<p>Error loading menu items. Please try again later.</p>');
        }
    });
});
</script>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f8f1e9;
        color: #333;
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

    .title {
        font-family: 'Baskervville', serif;
        font-size: 50px;
        font-weight: 400;
        margin-bottom: 40px;
        text-align: center;
        color: #FFD28D;
    }

    .menu-section {
        padding: 80px 0;
        background-color: #091E24;
    }

    .menu-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px solid #eee;
    }

    .menu-item h5 {
        font-size: 1.5rem;
        margin: 0;
        color: #fff;
    }

    .menu-item p {
        margin: 5px 0 0;
        color: #ccc;
        font-size: 1rem;
    }

    .menu-item .price {
        font-size: 1.2rem;
        font-weight: 600;
        color: #d4a373;
    }

    .special-offer {
        color: #28a745;
        font-style: italic;
    }

    #menuItemsLeft,
    #menuItemsRight {
        min-height: 200px;
    }

    @media (max-width: 768px) {
        #menuItemsRight {
            margin-top: 30px;
        }
    }
</style>
