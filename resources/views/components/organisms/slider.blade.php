<div x-data="{ activeSlide: 0 }" x-init="initCarousel()">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($sliders as $slider)

            <div x-bind:class="{ 'carousel-item': true, 'active': activeSlide === {{$slider->order-1}} }">
                <img src="{{$slider->getImageUrl()}}" class="d-block w-100" alt="Slide 2">
            </div>
            @endforeach


            <!-- Add more slides as needed -->
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev"
            x-on:click="prevSlide()">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next"
            x-on:click="nextSlide()">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <style>
        .carousel-item {
            transition: transform 1s ease-in-out;
            /* Adjust the transition duration here (1s is one second) */
        }
    </style>

    <script>
        function initCarousel() {
            setInterval(() => {
                this.nextSlide();
            }, 2000);
        }

        document.addEventListener('alpine:init', () => {
            Alpine.data('activeSlide', 0);
            Alpine.data('prevSlide', () => {
                this.activeSlide = (this.activeSlide - 1 + 2) % 2;
            });
            Alpine.data('nextSlide', () => {
                this.activeSlide = (this.activeSlide + 1) % 2;
            });
        });
    </script>
</div>
