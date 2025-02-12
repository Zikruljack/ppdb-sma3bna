@extends('layouts.site.site')

@section('hero')
    <section class="wrapper bg-soft-primary">
        <div class="container pt-10 pb-12 pt-md-14 pb-md-16 text-center">
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                    <h1 class="display-1 mb-3">Blocks - Team</h1>
                    <p class="lead px-xxl-10">Copy any custom block snippet below and paste it on your page to build your
                        website easily.</p>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
@endsection

@section('content')
    {{-- Kepala Sekolah --}}


    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
            <div class="row mb-3">
                <div class="col-md-10 col-lg-12 col-xl-10 col-xxl-9 mx-auto text-center">
                    <h2 class="fs-15 text-uppercase text-muted mb-3">Our Team</h2>
                    <h3 class="display-4 mb-7 px-lg-19 px-xl-18">Think unique and be innovative. Make a difference with
                        Sandbox.</h3>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="row grid-view gx-md-8 gx-xl-10 gy-8 gy-lg-0">
                <div class="col-md-6 col-lg-3">
                    <div class="position-relative">
                        <div class="shape rounded bg-soft-blue rellax d-md-block" data-rellax-speed="0"
                            style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0"></div>
                        <div class="card">
                            <figure class="card-img-top"><img class="img-fluid" src="./assets/img/avatars/t1.jpg"
                                    srcset="./assets/img/avatars/t1@2x.jpg 2x" alt="" /></figure>
                            <div class="card-body px-6 py-5">
                                <h4 class="mb-1">Coriss Ambady</h4>
                                <p class="mb-0">Financial Analyst</p>
                            </div>
                            <!--/.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /div -->
                </div>
                <!--/column -->
                <div class="col-md-6 col-lg-3">
                    <div class="position-relative">
                        <div class="shape rounded bg-soft-red rellax d-md-block" data-rellax-speed="0"
                            style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0"></div>
                        <div class="card">
                            <figure class="card-img-top"><img class="img-fluid" src="./assets/img/avatars/t2.jpg"
                                    srcset="./assets/img/avatars/t2@2x.jpg 2x" alt="" /></figure>
                            <div class="card-body px-6 py-5">
                                <h4 class="mb-1">Cory Zamora</h4>
                                <p class="mb-0">Marketing Specialist</p>
                            </div>
                            <!--/.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /div -->
                </div>
                <!--/column -->
                <div class="col-md-6 col-lg-3">
                    <div class="position-relative">
                        <div class="shape rounded bg-soft-green rellax d-md-block" data-rellax-speed="0"
                            style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0"></div>
                        <div class="card">
                            <figure class="card-img-top"><img class="img-fluid" src="./assets/img/avatars/t3.jpg"
                                    srcset="./assets/img/avatars/t3@2x.jpg 2x" alt="" /></figure>
                            <div class="card-body px-6 py-5">
                                <h4 class="mb-1">Nikolas Brooten</h4>
                                <p class="mb-0">Sales Manager</p>
                            </div>
                            <!--/.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /div -->
                </div>
                <!--/column -->
                <div class="col-md-6 col-lg-3">
                    <div class="position-relative">
                        <div class="shape rounded bg-soft-violet rellax d-md-block" data-rellax-speed="0"
                            style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0"></div>
                        <div class="card">
                            <figure class="card-img-top"><img class="img-fluid" src="./assets/img/avatars/t4.jpg"
                                    srcset="./assets/img/avatars/t4@2x.jpg 2x" alt="" /></figure>
                            <div class="card-body px-6 py-5">
                                <h4 class="mb-1">Jackie Sanders</h4>
                                <p class="mb-0">Investment Planner</p>
                            </div>
                            <!--/.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /div -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->

    {{-- guru --}}
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
            <div class="row mb-3">
                <div class="col-md-10 col-xl-9 col-xxl-7 mx-auto text-center">
                    <img src="./assets/img/icons/lineal/team.svg" class="svg-inject icon-svg icon-svg-md mb-4"
                        alt="" />
                    <h2 class="display-4 mb-3 px-lg-14">Save your time and money by choosing our professional team.</h2>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="position-relative">
                <div class="shape rounded-circle bg-soft-yellow rellax w-16 h-16" data-rellax-speed="1"
                    style="bottom: 0.5rem; right: -1.7rem;"></div>
                <div class="shape rounded-circle bg-line red rellax w-16 h-16" data-rellax-speed="1"
                    style="top: 0.5rem; left: -1.7rem;"></div>
                <div class="swiper-container dots-closer mb-6" data-margin="0" data-dots="true" data-items-xxl="4"
                    data-items-lg="3" data-items-md="2" data-items-xs="1">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="item-inner">
                                    <div class="card">
                                        <div class="card-body">
                                            <img class="rounded-circle w-15 mb-4" src="./assets/img/avatars/te1.jpg"
                                                srcset="./assets/img/avatars/te1@2x.jpg 2x" alt="" />
                                            <h4 class="mb-1">Coriss Ambady</h4>
                                            <div class="meta mb-2">Financial Analyst</div>
                                            <p class="mb-2">Fermentum massa justo sit amet risus morbi leo.</p>
                                            <nav class="nav social mb-0">
                                                <a href="#"><i class="uil uil-twitter"></i></a>
                                                <a href="#"><i class="uil uil-facebook-f"></i></a>
                                                <a href="#"><i class="uil uil-dribbble"></i></a>
                                            </nav>
                                            <!-- /.social -->
                                        </div>
                                        <!--/.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.item-inner -->
                            </div>
                            <!--/.swiper-slide -->
                            <div class="swiper-slide">
                                <div class="item-inner">
                                    <div class="card">
                                        <div class="card-body">
                                            <img class="rounded-circle w-15 mb-4" src="./assets/img/avatars/te2.jpg"
                                                srcset="./assets/img/avatars/te2@2x.jpg 2x" alt="" />
                                            <h4 class="mb-1">Cory Zamora</h4>
                                            <div class="meta mb-2">Marketing Specialist</div>
                                            <p class="mb-2">Fermentum massa justo sit amet risus morbi leo.</p>
                                            <nav class="nav social mb-0">
                                                <a href="#"><i class="uil uil-twitter"></i></a>
                                                <a href="#"><i class="uil uil-facebook-f"></i></a>
                                                <a href="#"><i class="uil uil-dribbble"></i></a>
                                            </nav>
                                            <!-- /.social -->
                                        </div>
                                        <!--/.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.item-inner -->
                            </div>
                            <!--/.swiper-slide -->
                            <div class="swiper-slide">
                                <div class="item-inner">
                                    <div class="card">
                                        <div class="card-body">
                                            <img class="rounded-circle w-15 mb-4" src="./assets/img/avatars/te3.jpg"
                                                srcset="./assets/img/avatars/te3@2x.jpg 2x" alt="" />
                                            <h4 class="mb-1">Nikolas Brooten</h4>
                                            <div class="meta mb-2">Sales Manager</div>
                                            <p class="mb-2">Fermentum massa justo sit amet risus morbi leo.</p>
                                            <nav class="nav social mb-0">
                                                <a href="#"><i class="uil uil-twitter"></i></a>
                                                <a href="#"><i class="uil uil-facebook-f"></i></a>
                                                <a href="#"><i class="uil uil-dribbble"></i></a>
                                            </nav>
                                            <!-- /.social -->
                                        </div>
                                        <!--/.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.item-inner -->
                            </div>
                            <!--/.swiper-slide -->
                            <div class="swiper-slide">
                                <div class="item-inner">
                                    <div class="card">
                                        <div class="card-body">
                                            <img class="rounded-circle w-15 mb-4" src="./assets/img/avatars/te4.jpg"
                                                srcset="./assets/img/avatars/te4@2x.jpg 2x" alt="" />
                                            <h4 class="mb-1">Jackie Sanders</h4>
                                            <div class="meta mb-2">Investment Planner</div>
                                            <p class="mb-2">Fermentum massa justo sit amet risus morbi leo.</p>
                                            <nav class="nav social mb-0">
                                                <a href="#"><i class="uil uil-twitter"></i></a>
                                                <a href="#"><i class="uil uil-facebook-f"></i></a>
                                                <a href="#"><i class="uil uil-dribbble"></i></a>
                                            </nav>
                                            <!-- /.social -->
                                        </div>
                                        <!--/.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.item-inner -->
                            </div>
                            <!--/.swiper-slide -->
                            <div class="swiper-slide">
                                <div class="item-inner">
                                    <div class="card">
                                        <div class="card-body">
                                            <img class="rounded-circle w-15 mb-4" src="./assets/img/avatars/te5.jpg"
                                                srcset="./assets/img/avatars/te5@2x.jpg 2x" alt="" />
                                            <h4 class="mb-1">Laura Widerski</h4>
                                            <div class="meta mb-2">Sales Specialist</div>
                                            <p class="mb-2">Fermentum massa justo sit amet risus morbi leo.</p>
                                            <nav class="nav social mb-0">
                                                <a href="#"><i class="uil uil-twitter"></i></a>
                                                <a href="#"><i class="uil uil-facebook-f"></i></a>
                                                <a href="#"><i class="uil uil-dribbble"></i></a>
                                            </nav>
                                            <!-- /.social -->
                                        </div>
                                        <!--/.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.item-inner -->
                            </div>
                            <!--/.swiper-slide -->
                            <div class="swiper-slide">
                                <div class="item-inner">
                                    <div class="card">
                                        <div class="card-body">
                                            <img class="rounded-circle w-15 mb-4" src="./assets/img/avatars/te6.jpg"
                                                srcset="./assets/img/avatars/te6@2x.jpg 2x" alt="" />
                                            <h4 class="mb-1">Tina Geller</h4>
                                            <div class="meta mb-2">Financial Analyst</div>
                                            <p class="mb-2">Fermentum massa justo sit amet risus morbi leo.</p>
                                            <nav class="nav social mb-0">
                                                <a href="#"><i class="uil uil-twitter"></i></a>
                                                <a href="#"><i class="uil uil-facebook-f"></i></a>
                                                <a href="#"><i class="uil uil-dribbble"></i></a>
                                            </nav>
                                            <!-- /.social -->
                                        </div>
                                        <!--/.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.item-inner -->
                            </div>
                            <!--/.swiper-slide -->
                        </div>
                        <!--/.swiper-wrapper -->
                    </div>
                    <!-- /.swiper -->
                </div>
                <!-- /.swiper-container -->
            </div>
            <!-- /.position-relative -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
@endsection
