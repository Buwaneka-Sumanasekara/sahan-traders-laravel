<div class="container container-fluid">
    <div class="row">
        <div class="col-sm-12 clearfix">
            <div class="float-start">
                <p>Hi! Welcome to {{config('app.name')}}</p>
            </div>
            <div class="float-end">
                @guest

                <a class="btn btn-link link-primary" type="button" href="/login">Login</a>
                |
                <a class="btn btn-link link-primary" type="button" href="/register">Register</a>

                @else

                <div class="btn btn link-primary"> {{ Auth::user()->first_name }}</div>
                |
                <a class="btn btn-link link-primary" type="button" href="/logout">Logout</a>

                @endguest
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <a class="navbar-brand float-left" href="#">
                <img src="{{ asset('img/logo.png') }}" alt="" width="100" />
            </a>
        </div>
        <div class="col-md-8 col-sm-12 d-flex justify-content-end">
            <div class="d-flex align-self-center me-4">
                <button type="button" class="btn btn-outline-secondary position-relative rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag"
                        viewBox="0 0 16 16">
                        <path
                            d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                    </svg>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        99+
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </button>
            </div>
            <div class="d-flex flex-column justify-content-center">
                <div class="text-body-tertiary">
                    Shopping Cart
                </div>
                <div>
                    Rs. 0.00
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active"> <a class="nav-link" href="/">Home </a> </li>
                        <li class="nav-item"><a class="nav-link" href="/products"> Products </a></li>
                        <li class="nav-item"><a class="nav-link" href="/about"> About </a></li>
                        <li class="nav-item dropdown" id="myDropdown">
                            <a class="nav-link dropdown-toggle" href="/services" data-bs-toggle="dropdown"> Services
                            </a>
                            <ul class="dropdown-menu">

                                <li> <a class="dropdown-item" href="#"> Auction &raquo; </a>
                                    <ul class="submenu dropdown-menu">
                                        <li><a class="dropdown-item" href="/auction-bidding">Auction Bidding</a></li>
                                        <li><a class="dropdown-item" href="#">Auction Service Review</a></li>
                                        <li><a class="dropdown-item" href="#">Auction Related Costs</a></li>
                                        <li><a class="dropdown-item" href="#">Auction VIP Tips</a></li>
                                        <li><a class="dropdown-item" href="#">Auction Sheet</a></li>
                                        <li><a class="dropdown-item" href="#">Vehicle Auctions</a></li>
                                    </ul>
                                </li>
                                <li> <a class="dropdown-item" href="/warranty"> Warranty </a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </nav>
        </div>
    </div>
</div>


@guest

@else
@if(!Auth::user()->hasVerifiedEmail())

<x-organisms.not-verified-message />

@endif

@endguest

@if(!App::environment('production'))

<div class="alert alert-warning" role="alert">
    <i class="bi bi-exclamation-triangle-fill h4"></i><strong> Warning! </strong> This is a testing environment , Do not
    use real data.
</div>

@endif



<script>
    document.addEventListener("DOMContentLoaded", function () {
        // make it as accordion for smaller screens
        if (window.innerWidth < 992) {

            // close all inner dropdowns when parent is closed
            document.querySelectorAll('.navbar .dropdown').forEach(function (everydropdown) {
                everydropdown.addEventListener('hidden.bs.dropdown', function () {
                    // after dropdown is hidden, then find all submenus
                    this.querySelectorAll('.submenu').forEach(function (everysubmenu) {
                        // hide every submenu as well
                        everysubmenu.style.display = 'none';
                    });
                })
            });

            document.querySelectorAll('.dropdown-menu a').forEach(function (element) {
                element.addEventListener('click', function (e) {
                    let nextEl = this.nextElementSibling;
                    if (nextEl && nextEl.classList.contains('submenu')) {
                        // prevent opening link if link needs to open dropdown
                        e.preventDefault();
                        if (nextEl.style.display == 'block') {
                            nextEl.style.display = 'none';
                        } else {
                            nextEl.style.display = 'block';
                        }

                    }
                });
            })
        }
        // end if innerWidth
    });



    //change cart values
    window.addEventListener('load', function (event) {
        console.log("page loaded");
        header_cart_updateCartValues()
    });

    document.addEventListener('change_header_add_to_cart', function (event) {
        console.log(event);
        header_cart_updateCartValues()
    });
    function header_cart_updateCartValues() {
        console.log("changed cart values.......")
    }
</script>

<style>
    /* ============ desktop view ============ */
    @media all and (min-width: 992px) {
        .dropdown-menu li {
            position: relative;
        }

        .nav-item .submenu {
            display: none;
            position: absolute;
            left: 100%;
            top: -7px;
        }

        .nav-item .submenu-left {
            right: 100%;
            left: auto;
        }

        .dropdown-menu>li:hover {
            background-color: #f1f1f1
        }

        .dropdown-menu>li:hover>.submenu {
            display: block;
        }
    }

    /* ============ desktop view .end// ============ */

    /* ============ small devices ============ */
    @media (max-width: 991px) {
        .dropdown-menu .dropdown-menu {
            margin-left: 0.7rem;
            margin-right: 0.7rem;
            margin-bottom: .5rem;
        }
    }

    /* ============ small devices .end// ============ */
</style>
