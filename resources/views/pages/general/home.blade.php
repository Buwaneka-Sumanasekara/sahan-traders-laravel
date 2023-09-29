@extends('layout/main')


@section('title', 'Home')

@section('content')

<div class="row">
    <div class="col-md-12">
        <x-organisms.slider />
    </div>
</div>
<div class="row pt-4">
    <div class="col-md-12">
        <x-organisms.featured-products />
    </div>
</div>

@endsection
