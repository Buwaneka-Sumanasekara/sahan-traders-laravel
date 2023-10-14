<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
            role="tab" aria-controls="nav-home" aria-selected="true">Description</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
            role="tab" aria-controls="nav-profile" aria-selected="false">Product Details</button>

    </div>
</nav>
<div class="tab-content py-4" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        <p>
            {{$product->note}}

            {!! $product->note_html !!}
        </p>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
        <div class="col-lg-5 col-sm-12">

            <div class="row mb-2">
                <div class="col-md-4 p-2  bg-primary-subtle">{{config("setup.product_group1_name")}}</div>
                <div class="col-md-8 p-2 bg-gray-100">{{$product->group1->name}}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 p-2  bg-primary-subtle">{{config("setup.product_group2_name")}}</div>
                <div class="col-md-8 p-2 bg-gray-100">{{$product->group2->name}}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 p-2  bg-primary-subtle">{{config("setup.product_group3_name")}}</div>
                <div class="col-md-8 p-2 bg-gray-100">{{$product->group3->name}}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 p-2  bg-primary-subtle">{{config("setup.product_group4_name")}}</div>
                <div class="col-md-8 p-2 bg-gray-100">{{$product->group4->name}}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 p-2  bg-primary-subtle">{{config("setup.product_group5_name")}}</div>
                <div class="col-md-8 p-2 bg-gray-100">{{$product->group5->name}}</div>
            </div>
        </div>
    </div>

</div>
