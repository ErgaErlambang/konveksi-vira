<nav id="navbar-main" class="navbar navbar-color-on-scroll navbar-expand-lg navbar-transparent py-2"
    color-on-scroll="300" id="sectionsNav">
    <div class="container">
        <a class="navbar-brand mr-lg-5" href="{{ route('home') }}">
            Clothes Convection
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global"
            aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{asset('assets/frontend/img/brand/blue.png')}}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav navbar-nav-hover align-items-lg-center ml-lg-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        About Us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Services
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-white">
                        <i class="ni ni-basket d-lg-none"></i>
                        <span class="nav-link-inner--text">Login</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
