@extends('layout/main')


@section('title', 'Product')

@section('content')

<div class="row">
    <div class="col">
        <x-molecules.product-display-bread-crumb :productId="$product_id" />
    </div>
</div>
<div class="row">
    <div class="col-md-5 col-sm-12">
        <x-molecules.product-display-slider :productId="$product_id" />
    </div>
    <div class="col-md-7 col-sm-12">
        <x-molecules.product-display-right :productId="$product_id" />
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <x-molecules.product-display-bottom-tab :productId="$product_id" />
    </div>
</div>


@endsection
