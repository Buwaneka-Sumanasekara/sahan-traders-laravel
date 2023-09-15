@extends('layout/main')


@section('title', 'REGISTER')

@section('content')

<div class="row">
    <div class="col-md-6  d-flex align-items-center justify-content-center">

        <div class="px-5" style="width:100%">
            <h2>Register</h2>
            <p>Register your account here</p>

            <form>
                <div class="form-group mb-3">
                    <label for="email">First Name</label>
                    <input type="text" id="fname" placeholder="Enter First Name" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="email">Last Name</label>
                    <input type="text" id="lname" placeholder="Enter Last Name" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email address</label>
                    <input type="email" id="email" placeholder="Enter email" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Enter password" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="password">Re-type Password</label>
                    <input type="password" id="password" placeholder="Enter password" class="form-control">
                </div>
                <div class="form-group d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>


    </div>
    <div class="col-md-6 bg-primary text-white text-center px-5 py-5 d-none d-md-block" style="min-height: 550px;">
        <h2>Welcome to</h2>
        <h2>Osaka Sahan International Traders</h2>

        <p>
            Buckle up for a journey through spare part paradise.
            🚀 Register and rev up your shopping experience with us!
        </p>

        <img src="img/logo-rev.png" alt="" width="200" />

    </div>

</div>

@endsection
