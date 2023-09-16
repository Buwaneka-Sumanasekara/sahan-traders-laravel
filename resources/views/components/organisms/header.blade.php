<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="img/logo.png" alt="" width="100" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"> <a class="nav-link" href="/">Home </a> </li>
                <li class="nav-item"><a class="nav-link" href="/products"> Products </a></li>
                <li class="nav-item"><a class="nav-link" href="/about"> About </a></li>
                <li class="nav-item dropdown" id="myDropdown">
                    <a class="nav-link dropdown-toggle" href="/services" data-bs-toggle="dropdown"> Services </a>
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
        <div class="float-right">

            @guest

            <a class="btn btn-link link-primary" type="button" href="/login">Login</a>
            |
            <a class="btn btn-link link-primary" type="button" href="/register">Register</a>

            @else

            <div class="btn btn link-primary"> {{ Auth::user()->name }}</div>


            @endguest

        </div>
    </div>
</nav>

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
