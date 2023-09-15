@extends('layout/main')


@section('title', 'Login')

@section('content')



<div class="row">
    <div class="col-md-6  d-flex align-items-center justify-content-center">

        <div class="px-5" style="width:100%">
            <h2>Log in</h2>
            <p>Log in to your account to continue.</p>

            <form action="action/login" method="POST">

                <x-organisms.alert type="danger" />

                {{ csrf_field() }}
                <div class="form-group mb-3">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" placeholder="Enter email" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password"
                        class="form-control">
                </div>
                <div class="form-group d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Log in</button>
                    <a href="/forgot-password" class="btn btn-outline-primary">Forgot password?</a>
                    <a href="/register" class="btn btn-secondary">Don't have an account?</a>
                </div>
            </form>
        </div>


    </div>
    <div class="col-md-6 bg-primary text-white text-center px-5 py-5 d-none d-md-block" style="min-height: 550px;">
        <h2>Welcome Back</h2>
        <h2>Osaka Sahan International Traders</h2>

        <p>
            Buckle up for a journey through spare part paradise.
            🚀 Log in and rev up your shopping experience with us!
        </p>

        <img src="img/logo-rev.png" alt="" width="200" />

    </div>

</div>

@endsection
