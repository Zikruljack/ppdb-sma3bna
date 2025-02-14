@extends('layouts.site.site')

@section('hero')
    <section class="wrapper bg-gradient-primary">
        <div class="container pt-10 pt-md-14 pb-8 text-center">
            <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
                <div class="col-lg-7">
                    <figure><img class="w-auto" src="{{ asset('assets/img/i22.png') }}"
                            srcset="{{ asset('assets/img/i22@2x.png') }} 2x" alt="" /></figure>
                </div>
                <!-- /column -->
                <div class="col-md-10 offset-md-1 offset-lg-0 col-lg-5 text-center text-lg-start">
                    <h1 class="display-1 mb-5 mx-md-n5 mx-lg-0">SEKOLAH SMA3 Banda Aceh</h1>
                    <p class="lead fs-lg mb-7">Lorem ipsum dolor sit amet. </p>
                    <span><a class="btn btn-primary rounded-pill me-2">SPMB</a></span>
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
        <div class="container py-14 py-md-16">
            <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
                <div class="col-lg-7 order-lg-2">
                    <figure><img class="w-auto" src="{{ asset('assets/img/logo_smantig.png') }}" alt="" /></figure>
                </div>
                <!--/column -->
                <div class="col-lg-5">
                    <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Why Choose Us?</h2>
                    <h3 class="display-5 mb-7">A few reasons why our valued customers choose us.</h3>
                    <div class="accordion accordion-wrapper" id="accordionExample">
                        <div class="card plain accordion-item">
                            <div class="card-header" id="headingOne">
                                <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne"> Professional Design </button>
                            </div>
                            <!--/.card-header -->
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="card-body">
                                    <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum
                                        massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum.
                                        Praesent commodo cursus magna, vel.</p>
                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.accordion-collapse -->
                        </div>
                        <!--/.accordion-item -->
                        <div class="card plain accordion-item">
                            <div class="card-header" id="headingTwo">
                                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo"> Top-Notch Support </button>
                            </div>
                            <!--/.card-header -->
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="card-body">
                                    <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum
                                        massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum.
                                        Praesent commodo cursus magna, vel.</p>
                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.accordion-collapse -->
                        </div>
                        <!--/.accordion-item -->
                        <div class="card plain accordion-item">
                            <div class="card-header" id="headingThree">
                                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree"> Header and Slider Options </button>
                            </div>
                            <!--/.card-header -->
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="card-body">
                                    <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum
                                        massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum.
                                        Praesent commodo cursus magna, vel.</p>
                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.accordion-collapse -->
                        </div>
                        <!--/.accordion-item -->
                    </div>
                    <!--/.accordion -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->



    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
            <div class="row align-items-center mb-10">
                <div class="col-md-8 col-lg-9 col-xl-8 col-xxl-7 pe-xl-20">
                    <h2 class="display-4 mb-0">Company news from our blog that got the most attention.</h2>
                </div>
                <!--/column -->
                <div class="col-md-4 col-lg-3 ms-md-auto text-md-end mt-5 mt-md-0">
                    <a href="#" class="btn btn-soft-primary rounded-pill mb-0">View All News</a>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="row gx-lg-8 gx-xl-11 gy-10 blog grid-view">
                <div class="col-lg-8">
                    <article class="post">
                        <div class="post-slider rounded mb-6">
                            <div class="swiper-container dots-over" data-margin="5" data-dots="true">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide"><img src="./assets/img/photos/b2.jpg" alt="" />
                                        </div>
                                        <div class="swiper-slide"><img src="./assets/img/photos/b3.jpg" alt="" />
                                        </div>
                                    </div>
                                    <!--/.swiper-wrapper -->
                                </div>
                                <!-- /.swiper -->
                            </div>
                            <!-- /.swiper-container -->
                        </div>
                        <!-- /.post-slider -->
                        <div class="post-header mb-5">
                            <div class="post-category text-line">
                                <a href="#" class="hover" rel="category">Ideas</a>
                            </div>
                            <!-- /.post-category -->
                            <h2 class="post-title mt-1 mb-4"><a class="link-dark" href="./blog-post.html">Fringilla Ligula
                                    Pharetra Amet</a></h2>
                            <ul class="post-meta mb-0">
                                <li class="post-date"><i class="uil uil-calendar-alt"></i><span>5 Jul 2022</span></li>
                                <li class="post-author"><a href="#"><i class="uil uil-user"></i><span>By
                                            Sandbox</span></a></li>
                                <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>3<span>
                                            Comments</span></a></li>
                            </ul>
                            <!-- /.post-meta -->
                        </div>
                        <!-- /.post-header -->
                        <div class="post-content">
                            <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Curabitur blandit tempus
                                porttitor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Maecenas
                                sed diam eget risus varius blandit sit amet non magna. Vivamus sagittis lacus vel augue
                                laoreet rutrum faucibus dolor auctor.</p>
                        </div>
                        <!-- /.post-content -->
                    </article>
                    <!-- /.post -->
                </div>
                <!-- /column -->
                <div class="col-lg-4">
                    <div class="row gy-10">
                        <div class="col-md-6 col-lg-12">
                            <article class="post">
                                <figure class="overlay overlay-1 hover-scale rounded mb-5"><a href="#"> <img
                                            src="./assets/img/photos/b1.jpg" alt="" /></a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Read More</h5>
                                    </figcaption>
                                </figure>
                                <div class="post-header">
                                    <div class="post-category text-line">
                                        <a href="#" class="hover" rel="category">Coding</a>
                                    </div>
                                    <!-- /.post-category -->
                                    <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark"
                                            href="./blog-post.html">Ligula tristique quis risus</a></h2>
                                </div>
                                <!-- /.post-header -->
                                <div class="post-footer">
                                    <ul class="post-meta">
                                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>14 Apr 2022</span>
                                        </li>
                                        <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>4</a>
                                        </li>
                                    </ul>
                                    <!-- /.post-meta -->
                                </div>
                                <!-- /.post-footer -->
                            </article>
                            <!-- /.post -->
                        </div>
                        <!-- /column -->
                        <div class="col-md-6 col-lg-12">
                            <article class="post">
                                <figure class="overlay overlay-1 hover-scale rounded mb-5"><a href="#"> <img
                                            src="./assets/img/photos/b4.jpg" alt="" /></a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Read More</h5>
                                    </figcaption>
                                </figure>
                                <div class="post-header">
                                    <div class="post-category text-line">
                                        <a href="#" class="hover" rel="category">Workspace</a>
                                    </div>
                                    <!-- /.post-category -->
                                    <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark"
                                            href="./blog-post.html">Nullam id dolor elit id nibh</a></h2>
                                </div>
                                <!-- /.post-header -->
                                <div class="post-footer">
                                    <ul class="post-meta">
                                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>29 Mar 2022</span>
                                        </li>
                                        <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>3</a>
                                        </li>
                                    </ul>
                                    <!-- /.post-meta -->
                                </div>
                                <!-- /.post-footer -->
                            </article>
                            <!-- /.post -->
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
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
            <div class="row">
                <div class="col-lg-9 col-xl-8 col-xxl-7 mx-auto mb-8">
                    <h2 class="fs-15 text-uppercase text-muted text-center mb-3">Our Projects</h2>
                    <h3 class="display-4 text-center">Check out some of our awesome projects with creative ideas and great
                        design.</h3>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="grid grid-view projects-masonry">
                <div class="row gx-md-8 gy-10 gy-md-13 isotope">
                    <div class="project item col-md-6 col-xl-4 product">
                        <figure class="lift rounded mb-6"><a href="./single-project.html"> <img
                                    src="./assets/img/photos/cs16.jpg" alt="" /></a></figure>
                        <div class="project-details d-flex justify-content-center flex-column">
                            <div class="post-header">
                                <div class="post-category text-line mb-3 text-purple">Cosmetic</div>
                                <h2 class="post-title h3">Cras Fermentum Sem</h2>
                            </div>
                            <!-- /.post-header -->
                        </div>
                        <!-- /.project-details -->
                    </div>
                    <!-- /.project -->
                    <div class="project item col-md-6 col-xl-4 workshop">
                        <figure class="lift rounded mb-6"><a href="./single-project2.html"> <img
                                    src="./assets/img/photos/cs17.jpg" alt="" /></a></figure>
                        <div class="project-details d-flex justify-content-center flex-column">
                            <div class="post-header">
                                <div class="post-category text-line mb-3 text-leaf">Coffee</div>
                                <h2 class="post-title h3">Mollis Ipsum Mattis</h2>
                            </div>
                            <!-- /.post-header -->
                        </div>
                        <!-- /.project-details -->
                    </div>
                    <!-- /.project -->
                    <div class="project item col-md-6 col-xl-4 still-life">
                        <figure class="lift rounded mb-6"><a href="./single-project3.html"> <img
                                    src="./assets/img/photos/cs18.jpg" alt="" /></a></figure>
                        <div class="project-details d-flex justify-content-center flex-column">
                            <div class="post-header">
                                <div class="post-category text-line mb-3 text-violet">Still Life</div>
                                <h2 class="post-title h3">Ipsum Ultricies Cursus</h2>
                            </div>
                            <!-- /.post-header -->
                        </div>
                        <!-- /.project-details -->
                    </div>
                    <!-- /.project -->
                    <div class="project item col-md-6 col-xl-4 product">
                        <figure class="lift rounded mb-6"><a href="./single-project2.html"> <img
                                    src="./assets/img/photos/cs20.jpg" alt="" /></a></figure>
                        <div class="project-details d-flex justify-content-center flex-column">
                            <div class="post-header">
                                <div class="post-category text-line mb-3 text-orange">Product</div>
                                <h2 class="post-title h3">Inceptos Euismod Egestas</h2>
                            </div>
                            <!-- /.post-header -->
                        </div>
                        <!-- /.project-details -->
                    </div>
                    <!-- /.project -->
                    <div class="project item col-md-6 col-xl-4 product">
                        <figure class="lift rounded mb-6"><a href="./single-project.html"> <img
                                    src="./assets/img/photos/cs19.jpg" alt="" /></a></figure>
                        <div class="project-details d-flex justify-content-center flex-column">
                            <div class="post-header">
                                <div class="post-category text-line mb-3 text-yellow">Product</div>
                                <h2 class="post-title h3">Sollicitudin Ornare Porta</h2>
                            </div>
                            <!-- /.post-header -->
                        </div>
                        <!-- /.project-details -->
                    </div>
                    <!-- /.project -->
                    <div class="project item col-md-6 col-xl-4 workshop">
                        <figure class="lift rounded mb-6"><a href="./single-project3.html"> <img
                                    src="./assets/img/photos/cs21.jpg" alt="" /></a></figure>
                        <div class="project-details d-flex justify-content-center flex-column">
                            <div class="post-header">
                                <div class="post-category text-line mb-3 text-green">Workshop</div>
                                <h2 class="post-title h3">Ipsum Mollis Vulputate</h2>
                            </div>
                            <!-- /.post-header -->
                        </div>
                        <!-- /.project-details -->
                    </div>
                    <!-- /.project -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.grid -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
@endsection
