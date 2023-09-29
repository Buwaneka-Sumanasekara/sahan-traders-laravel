<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($sliders as $slider)
        <li data-target="#carouselExampleIndicators" data-bs-slide-to="{{$slider->order-1}}" class="{{$slider->id==1?'active':''}}"></li>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($sliders as $slider)

        <div class="carousel-item @if($loop->first) active @endif">
            <img class="img-fluid" alt="{{ $slider->id }}" src="{{$slider->getImageUrl()}}">
            <div class="carousel-caption d-none d-md-block">
                @if($slider->title)
                <h5>{{$slider->title}}</h5>
                @endif
                @if($slider->subtitle)
                <p>{{$slider->subtitle}}</p>
                @endif

            </div>

        </div>
        @endforeach


    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
