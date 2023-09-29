@extends('layout/main')


@section('title', 'Product')

@section('content')

<div class="row">
    <div class="col-6">
        <x-molecules.product-display-slider :productId="$product_id" />
    </div>
    <div class="col-6">

    </div>
</div>


@endsection
