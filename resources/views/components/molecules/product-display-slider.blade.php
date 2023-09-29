<div class="images" style="max-width:500px;min-height: 400px;">
    <div class="text-center pb-4"> <img id="main-image" class="img-fluid" src="" /> </div>
    <div class="thumbnail text-center">
        @foreach($prodImages as $productImage)
        <img class="img-thumbnail" onclick="change_image(this)" data-prod-img="{{$productImage->getMainPath()}}"
            src="{{$productImage->getThumbnailPath()}}" width="100">
        @endforeach
    </div>
</div>



<script>
    function change_image(image) {
        var container = document.getElementById("main-image");
        container.src = image.getAttribute("data-prod-img");
    }
    document.addEventListener("DOMContentLoaded", function (event) {
        var container = document.getElementById("main-image");
        container.src = "{{$prodImages[0]->getMainPath()}}";
    });
</script>
