<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="carousel-image-container">
                <img src="{{ asset('storage/images/foods/0001.jpg') }}" class="d-block w-100" alt="Food Image 1">
                {{-- <div class="carousel-text">
                    <h2>Manchurian Dish</h2>
                    <p>A delicious and spicy Indo-Chinese dish made with crispy vegetable or meat balls in a flavorful, tangy sauce. Served hot, it's a popular appetizer or snack.</p>
                </div> --}}
            </div>
        </div>
        <div class="carousel-item">
            <div class="carousel-image-container">
                <img src="{{ asset('storage/images/foods/pasta.jpg') }}" class="d-block w-100" alt="Food Image 2">
                {{-- <div class="carousel-text">
                    <h2>Pasta</h2>
                    <p>A classic Italian dish featuring boiled pasta tossed in a variety of rich sauces like marinara, Alfredo, or pesto. It's often served with fresh vegetables, meat, or cheese, making it a versatile and hearty meal.</p>
                </div> --}}
            </div>
        </div>
        <div class="carousel-item">
            <div class="carousel-image-container">
                <img src="{{ asset('storage/images/foods/0000.jpg') }}" class="d-block w-100" alt="Food Image 3">
                <div class="carousel-text">
                    <h2>Dosa</h2>
                    <p>A popular South Indian dish, dosa is a crispy, thin pancake made from fermented rice and lentil batter. Typically served with chutneys and sambar, it's a favorite breakfast or snack option.</p>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>
