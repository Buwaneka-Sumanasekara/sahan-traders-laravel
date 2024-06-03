@extends('layout/main')


@section('title', 'Payment')

@section('content')

<div class="row justify-content-between" id="jsx-stripe-payment" data-pk_session="{{config("setup.stripe_key")}}" data-session_id="{{$sessionId}}">
   
</div>


@endsection
