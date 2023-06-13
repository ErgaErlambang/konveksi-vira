@extends('frontend.layouts.master')

@section('title', 'Home')

@push('styles')

@endpush

@section('content')

<div class="page-header page-header-small header-filter skew-separator skew-mini">
    <div class="page-header-image" style="background-image: url('{{asset('assets/frontend/img/kaos.jpg')}}');"></div>
    <div class="container pt-0">
        <div class="row">
            <div class="col-lg-6 col-md-7 mx-auto text-center">
                <h1 class="title text-white">See our latest collection!</h1>
            </div>
        </div>
    </div>
    <!-- SVG separator -->
    <div class="separator separator-bottom separator-skew">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
            xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</div>


<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card card-blog" data-header="pattern">
                    <a href="javascript:;">
                        <img class="img pattern rounded" src="{{asset('assets/frontend/img/ill/presentation_bg.png')}}">
                    </a>
                    <div class="card-body">
                        <h6 class="card-category text-danger">
                            <i class="ni ni-badge"></i> Wearing
                        </h6>
                        <h5 class="card-title ">
                            <a href="javascript:;" class="text-dark">Good Quality</a>
                        </h5>
                        <p class="card-description">
                            Yesterday, as Facebook launched its news reader app Paper, design-focused startup FiftyThree
                            called out Facebook...
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <img class="card-img-top" src="{{asset('assets/frontend/img/ill/linth3.svg')}}" alt="Image placeholder">
                    <div class="card-body">
                        <h6 class="card-category text-danger">
                            <i class="ni ni-badge"></i> Fashion
                        </h6>
                        <h5 class="card-title text-success">
                            <a href="javascript:;" class="text-dark">Best Price</a>
                        </h5>
                        <p class="card-text mt-4">Argon is a great free UI package based on Bootstrap 4 that includes
                            the most important components and features.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card card-blog" data-header="pattern">
                    <a href="javascript:;">
                        <img class="img pattern rounded" src="{{asset('assets/frontend/img/ill/p2.svg')}}">
                    </a>
                    <div class="card-body">
                        <h6 class="card-category text-danger">
                            <i class="ni ni-badge"></i> Fashion
                        </h6>
                        <h5 class="card-title">
                            <a href="javascript:;" class="text-dark">Responsive</a>
                        </h5>
                        <p class="card-description">
                            Trends may come and go, but wardrobe essentials are here to stay. Basic pieces tend to be
                            universal across.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto text-center">
                    <h3 class="desc my-5"> Fresh New <span class="text-font-weight text-danger">Collection</span></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="card card-product card-plain">
                                <div class="card-image">
                                    <a href="javascript:;">
                                        <img src="https://i0.wp.com/konfeksibaju.com/wp-content/uploads/2021/03/Mask-Group-11.png?fit=386%2C253&ssl=1" alt="..." />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card card-product card-plain">
                                <div class="card-image">
                                    <a href="javascript:;">
                                        <img src="https://i0.wp.com/konfeksibaju.com/wp-content/uploads/2021/03/Mask-Group-13.png?fit=385%2C253&ssl=1" alt="..." />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card card-product card-plain">
                                <div class="card-image">
                                    <a href="javascript:;">
                                        <img src="https://i0.wp.com/konfeksibaju.com/wp-content/uploads/2021/03/Mask-Group-12.png?fit=385%2C253&ssl=1" alt="..." />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card card-product card-plain">
                                <div class="card-image">
                                    <a href="javascript:;">
                                        <img src="https://i0.wp.com/konfeksibaju.com/wp-content/uploads/2021/03/Mask-Group-14.png?fit=386%2C253&ssl=1" alt="..." />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 ml-auto mr-auto mt-5 text-center">
                            <button rel="tooltip" class="btn btn-primary btn-round btn-simple">Load more</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- section -->
    <div class="container text-center">
        <div class="row mb-5">
            <div class="col-md-8 mx-auto">
                <h3 class="desc my-5"> <span class="text-font-weight text-danger"> We serve </span>various types</h3>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="card card-blog card-background" data-animation="zooming">
                    <div class="full-background" style="background-image: url('{{asset('assets/frontend/img/kaos2.jpg')}}')">
                    </div>
                    <a href="javascript:;">
                        <div class="card-body">
                            <div class="content-bottom">
                                <h5 class="card-title">Kaos</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-blog card-background" data-animation="zooming">
                    <div class="full-background" style="background-image: url('{{asset('assets/frontend/img/kemeja.jpg')}}')">
                    </div>
                    <a href="javascript:;">
                        <div class="card-body">
                            <div class="content-bottom">
                                <h5 class="card-title">Kemeja</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-blog card-background" data-animation="zooming">
                    <div class="full-background" style="background-image: url('{{asset('assets/frontend/img/jacket.png')}}')">
                    </div>
                    <a href="javascript:;">
                        <div class="card-body">
                            <div class="content-bottom">
                                <h5 class="card-title">Jaket</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-blog card-background" data-animation="zooming">
                    <div class="full-background" style="background-image: url('{{asset('assets/frontend/img/jaket.webp')}}')">
                    </div>
                    <a href="javascript:;">
                        <div class="card-body">
                            <div class="content-bottom">
                                <h5 class="card-title">Jaket</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="testimonials-1 bg-secondary py-5 skew-separator skew-top mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto text-center">
                    <h3 class="display-3">What Clients Say</h3>
                </div>
            </div>
            <div id="carousel-testimonials" class="carousel slide carousel-team">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <h3 class="card-title"> Sarah Smith</h3>
                                    <h3 class="text-primary">• • •</h3>
                                    <h4 class="lead">
                                        Take up one idea. Make that one idea your life - think of it, dream of it, live
                                        on that idea.
                                        Let the brain, muscles, nerves, every part of your body, be full of that idea,
                                        and just leave every other idea alone.
                                        This is the way to success. A single rose can be my garden... a single friend,
                                        my world.
                                    </h4>
                                    <a href="javascript:void(0)" class="btn btn-primary mt-3">Read more</a>
                                </div>
                                <div class="col-md-5 p-5 ml-auto">
                                    <div class="p-3">
                                        <img class="img-fluid rounded shadow transform-perspective-right"
                                            src="{{asset('assets/frontend/img/faces/fezbot.jpg')}}" alt="First slide">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <h3 class="card-title">Isaac Hunter </h3>
                                    <h3 class="text-info">• • •</h3>
                                    <h4 class="lead">
                                        Take up one idea. Make that one idea your life - think of it, dream of it, live
                                        on that idea.
                                        Let the brain, muscles, nerves, every part of your body, be full of that idea,
                                        and just leave every other idea alone.
                                        This is the way to success. A single rose can be my garden... a single friend,
                                        my world.
                                    </h4>
                                    <a href="javascript:void(0)" class="btn btn-info mt-3">Read more</a>
                                </div>
                                <div class="col-md-5 p-5 ml-auto">
                                    <div class="p-3">
                                        <img class="img-fluid rounded shadow transform-perspective-right"
                                            src="{{asset('assets/frontend/img/faces/brooke-cagle.jpg')}}" alt="First slide">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carousel-testimonials" role="button" data-slide="prev">
                    <i class="ni ni-bold-left"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-testimonials" role="button" data-slide="next">
                    <i class="ni ni-bold-right"></i>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush
