@extends('layouts.site.site')

@section('hero')
    <section class="wrapper image-wrapper bg-image bg-overlay text-white" data-image-src="./assets/img/photos/bg1.jpg">
        <div class="container pt-19 pt-md-21 pb-18 pb-md-20 text-center">
            <div class="row">
                <div class="col-md-10 col-lg-8 col-xl-7 col-xxl-6 mx-auto">
                    <h1 class="display-1 text-white mb-3">Our Services</h1>
                    <p class="lead fs-lg px-md-3 px-lg-7 px-xl-9 px-xxl-10">We are a creative company that focuses on
                        establishing long-term relationships with customers.</p>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
@endsection

@section('content')
    <section class="wrapper bg-light">
        <div class="container pt-14 pb-12 pt-md-16 pb-md-14">
            <div class="row gx-lg-8 gx-xl-12 gy-10 mb-lg-22 mb-xl-24 align-items-center">
                <div class="col-lg-7 order-lg-2">
                    <div class="row gx-md-5 gy-5">
                        <div class="col-md-5 offset-md-1 align-self-end">
                            <div class="card bg-pale-yellow">
                                <div class="card-body">
                                    <img src="./assets/img/icons/lineal/telephone-3.svg"
                                        class="svg-inject icon-svg icon-svg-md text-yellow mb-3" alt="" />
                                    <h4>24/7 Support</h4>
                                    <p class="mb-0">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta.
                                    </p>
                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.card -->
                        </div>
                        <!--/column -->
                        <div class="col-md-6 align-self-end">
                            <div class="card bg-pale-red">
                                <div class="card-body">
                                    <img src="./assets/img/icons/lineal/shield.svg"
                                        class="svg-inject icon-svg icon-svg-md text-red mb-3" alt="" />
                                    <h4>Secure Payments</h4>
                                    <p class="mb-0">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta.
                                    </p>
                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.card -->
                        </div>
                        <!--/column -->
                        <div class="col-md-5">
                            <div class="card bg-pale-leaf">
                                <div class="card-body">
                                    <img src="./assets/img/icons/lineal/cloud-computing-3.svg"
                                        class="svg-inject icon-svg icon-svg-md text-leaf mb-3" alt="" />
                                    <h4>Daily Updates</h4>
                                    <p class="mb-0">Nulla vitae elit libero, a pharetra augue.</p>
                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.card -->
                        </div>
                        <!--/column -->
                        <div class="col-md-6 align-self-start">
                            <div class="card bg-pale-primary">
                                <div class="card-body">
                                    <img src="./assets/img/icons/lineal/analytics.svg"
                                        class="svg-inject icon-svg icon-svg-md text-primary mb-3" alt="" />
                                    <h4>Market Research</h4>
                                    <p class="mb-0">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta
                                        gravida at eget.</p>
                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.card -->
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!--/column -->
                <div class="col-lg-5">
                    <h2 class="fs-15 text-uppercase text-muted mb-3">What We Do?</h2>
                    <h3 class="display-4 mb-5">The service we offer is specifically designed to meet your needs.</h3>
                    <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Maecenas sed diam eget risus
                        varius blandit sit amet non magna. Maecenas faucibus mollis interdum. Praesent commodo cursus magna,
                        vel scelerisque nisl consectetur et.</p>
                    <a href="#" class="btn btn-navy rounded-pill mt-3">More Details</a>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-soft-primary">
        <div class="container py-14 pt-md-16 pt-lg-0 pb-md-16">
            <div class="row text-center">
                <div class="col-lg-10 mx-auto">
                    <div class="mt-lg-n20 mt-xl-n22 position-relative">
                        <div class="shape bg-dot red rellax w-16 h-18" data-rellax-speed="1"
                            style="top: 1rem; left: -3.9rem;"></div>
                        <div class="shape rounded-circle bg-line primary rellax w-18 h-18" data-rellax-speed="1"
                            style="bottom: 2rem; right: -3rem;"></div>
                        <video poster="./assets/img/photos/movie.jpg" class="player" playsinline controls preload="none">
                            <source src="./assets/media/movie.mp4" type="video/mp4">
                            <source src="./assets/media/movie.webm" type="video/webm">
                        </video>
                    </div>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="row text-center">
                <div class="col-lg-9 mx-auto">
                    <h2 class="fs-15 text-uppercase text-muted mb-3 mt-12">Our Process</h2>
                    <h3 class="display-4 mb-0 text-center px-xl-10 px-xxl-15">Find out everything you need to know about
                        creating a business process model</h3>
                    <div class="row gx-lg-8 gx-xl-12 process-wrapper text-center mt-9">
                        <div class="col-md-4"> <img src="./assets/img/icons/lineal/light-bulb.svg"
                                class="svg-inject icon-svg icon-svg-md text-primary mb-3" alt="" />
                            <h4 class="mb-1">1. Concept</h4>
                            <p>Nulla vitae elit libero elit non porta gravida eget metus cras.</p>
                        </div>
                        <!--/column -->
                        <div class="col-md-4"> <img src="./assets/img/icons/lineal/settings-3.svg"
                                class="svg-inject icon-svg icon-svg-md text-red mb-3" alt="" />
                            <h4 class="mb-1">2. Prepare</h4>
                            <p>Nulla vitae elit libero elit non porta gravida eget metus cras.</p>
                        </div>
                        <!--/column -->
                        <div class="col-md-4"> <img src="./assets/img/icons/lineal/design.svg"
                                class="svg-inject icon-svg icon-svg-md text-leaf mb-3" alt="" />
                            <h4 class="mb-1">3. Retouch</h4>
                            <p>Nulla vitae elit libero elit non porta gravida eget metus cras.</p>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
            <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-16 align-items-center">
                <div class="col-lg-7">
                    <figure><img class="w-auto" src="./assets/img/illustrations/i8.png"
                            srcset="./assets/img/illustrations/i8@2x.png 2x" alt="" /></figure>
                </div>
                <!--/column -->
                <div class="col-lg-5">
                    <h3 class="display-4 mb-6 pe-xxl-6">We bring rapid solutions to make the life of our customers easier.
                    </h3>
                    <ul class="progress-list mt-3">
                        <li>
                            <p>Marketing</p>
                            <div class="progressbar line blue" data-value="100"></div>
                        </li>
                        <li>
                            <p>Strategy</p>
                            <div class="progressbar line yellow" data-value="80"></div>
                        </li>
                        <li>
                            <p>Development</p>
                            <div class="progressbar line orange" data-value="85"></div>
                        </li>
                        <li>
                            <p>Data Analysis</p>
                            <div class="progressbar line green" data-value="90"></div>
                        </li>
                    </ul>
                    <!-- /.progress-list -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
                <div class="col-lg-7 order-lg-2">
                    <figure><img class="w-auto" src="./assets/img/illustrations/i7.png"
                            srcset="./assets/img/illustrations/i7@2x.png 2x" alt="" /></figure>
                </div>
                <!--/column -->
                <div class="col-lg-5">
                    <h3 class="display-4 mb-5">We make your spending stress-free for you to have the perfect control.</h3>
                    <p class="mb-6">Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                        Cras justo odio, dapibus ac facilisis in, egestas eget quam. Praesent commodo cursus magna, vel
                        scelerisque nisl consectetur et.</p>
                    <div class="row gy-3">
                        <div class="col-xl-6">
                            <ul class="icon-list bullet-bg bullet-soft-primary mb-0">
                                <li><span><i class="uil uil-check"></i></span><span>Aenean quam ornare. Curabitur
                                        blandit.</span></li>
                                <li class="mt-3"><span><i class="uil uil-check"></i></span><span>Nullam quis risus eget
                                        urna mollis ornare.</span></li>
                            </ul>
                        </div>
                        <!--/column -->
                        <div class="col-xl-6">
                            <ul class="icon-list bullet-bg bullet-soft-primary mb-0">
                                <li><span><i class="uil uil-check"></i></span><span>Etiam porta euismod malesuada
                                        mollis.</span></li>
                                <li class="mt-3"><span><i class="uil uil-check"></i></span><span>Vivamus sagittis lacus
                                        vel augue rutrum.</span></li>
                            </ul>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper image-wrapper bg-auto no-overlay bg-image text-center bg-map"
        data-image-src="./assets/img/map.png">
        <div class="container pt-0 pb-14 pt-md-16 pb-md-18">
            <div class="row">
                <div class="col-lg-10 col-xl-9 col-xxl-8 mx-auto">
                    <h2 class="fs-15 text-uppercase text-muted mb-3">Join Our Community</h2>
                    <h3 class="display-4 mb-8 px-lg-12">We are trusted by over 5000+ clients. Join them now and grow your
                        business.</h3>
                </div>
                <!-- /.row -->
            </div>
            <!-- /column -->
            <div class="row">
                <div class="col-md-10 col-lg-9 col-xl-7 mx-auto">
                    <div class="row align-items-center counter-wrapper gy-4 gy-md-0">
                        <div class="col-md-4 text-center">
                            <h3 class="counter counter-lg text-primary">7518</h3>
                            <p>Completed Projects</p>
                        </div>
                        <!--/column -->
                        <div class="col-md-4 text-center">
                            <h3 class="counter counter-lg text-primary">5472</h3>
                            <p>Satisfied Customers</p>
                        </div>
                        <!--/column -->
                        <div class="col-md-4 text-center">
                            <h3 class="counter counter-lg text-primary">2184</h3>
                            <p>Expert Employees</p>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
@endsection
