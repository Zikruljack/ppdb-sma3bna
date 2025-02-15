@extends('layouts.site.site')

@section('hero')
    <section class="wrapper bg-soft-primary">
        <div class="container pt-10 pb-19 pt-md-14 pb-md-22 text-center">
            <div class="row">
                <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                    <div class="post-header">
                        <div class="post-category text-line">
                            <a href="#" class="hover" rel="category">Identity</a>
                        </div>
                        <!-- /.post-category -->
                        <h1 class="display-1 mb-3">Commodo Dolor Bibendum Parturient Cursus Mollis</h1>
                        <p class="lead px-md-12 px-lg-12 px-xl-15 px-xxl-18">Integer posuere erat a ante venenatis dapibus
                            posuere. Maecenas faucibus mollis interdum.</p>
                    </div>
                    <!-- /.post-header -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
@endsection

@section('content')
    <section class="wrapper bg-light wrapper-border">
        <div class="container pb-14 pb-md-16">
            <div class="row">
                <div class="col-12">
                    <article class="mt-n21">
                        <figure class="rounded mb-8 mb-md-12"><img src="./assets/img/photos/pp1.jpg" alt="" />
                        </figure>
                        <div class="row">
                            <div class="col-lg-10 offset-lg-1">
                                <h2 class="display-6 mb-4">About the Project</h2>
                                <div class="row gx-0">
                                    <div class="col-md-9 text-justify">
                                        <p>Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus
                                            commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet
                                            risus. Integer posuere erat a ante venenatis. Etiam porta sem malesuada magna
                                            mollis euismod. Aenean lacinia bibendum.</p>
                                        <p>Donec id elit non mi porta gravida at eget metus. Cras mattis consectetur purus
                                            sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl
                                            consectetur et. Donec sed odio dui. Aenean eu leo quam. Pellentesque ornare sem
                                            lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis.
                                            Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                    </div>
                                    <!--/column -->
                                    <div class="col-md-2 ms-auto">
                                        <ul class="list-unstyled">
                                            <li>
                                                <h5 class="mb-1">Date</h5>
                                                <p>17 May 2018</p>
                                            </li>
                                            <li>
                                                <h5 class="mb-1">Client Name</h5>
                                                <p>Cool House</p>
                                            </li>
                                        </ul>
                                        <a href="#" class="more hover">See Project</a>
                                    </div>
                                    <!--/column -->
                                </div>
                                <!--/.row -->
                            </div>
                            <!-- /column -->
                        </div>
                        <!--/.row -->
                        <div class="row mt-5 gx-md-6 gy-6">
                            <div class="item col-md-6">
                                <figure class="hover-scale rounded cursor-dark"><a href="./assets/img/photos/pp2.jpg"
                                        data-glightbox data-gallery="project-1"><img src="./assets/img/photos/pp2.jpg"
                                            alt="" /></a></figure>
                            </div>
                            <!--/column -->
                            <div class="item col-md-6">
                                <figure class="hover-scale rounded cursor-dark"><a href="./assets/img/photos/pp3.jpg"
                                        data-glightbox data-gallery="project-1"><img src="./assets/img/photos/pp3.jpg"
                                            alt="" /></a></figure>
                            </div>
                            <!--/column -->
                            <div class="item col-md-6">
                                <figure class="hover-scale rounded cursor-dark"><a href="./assets/img/photos/pp4.jpg"
                                        data-glightbox data-gallery="project-1"><img src="./assets/img/photos/pp4.jpg"
                                            alt="" /></a></figure>
                            </div>
                            <!--/column -->
                            <div class="item col-md-6">
                                <figure class="hover-scale rounded cursor-dark"><a href="./assets/img/photos/pp5.jpg"
                                        data-glightbox data-gallery="project-1"><img src="./assets/img/photos/pp5.jpg"
                                            alt="" /></a></figure>
                            </div>
                            <!--/column -->
                        </div>
                        <!-- /.row -->
                        <div class="row mt-8 mt-md-12">
                            <div class="col-md-10 offset-md-1 text-justify">
                                <h2 class="mb-4">Quam Mollis Bibendum</h2>
                                <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Donec ullamcorper nulla
                                    non metus auctor fringilla. Cras mattis consectetur purus sit amet fermentum. Aenean
                                    lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Praesent
                                    commodo cursus magna, vel scelerisque nisl consectetur et. Donec id elit non mi porta
                                    gravida at eget metus. Donec id elit non mi porta gravida at eget metus. Cras mattis
                                    consectetur purus sit amet fermentum.</p>
                                <p>Aenean lacinia bibendum nulla sed consectetur. Duis mollis, est non commodo luctus, nisi
                                    erat porttitor ligula, eget lacinia odio sem nec elit. Maecenas faucibus mollis
                                    interdum. Maecenas sed diam eget risus varius blandit sit amet non magna. Morbi leo
                                    risus, porta ac consectetur ac, vestibulum at eros. Nulla vitae elit libero, a pharetra
                                    augue. Maecenas faucibus mollis interdum etiam porta.</p>
                            </div>
                            <!-- /column -->
                        </div>
                        <!-- /.row -->
                    </article>
                    <!-- /.project -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
@endsection
