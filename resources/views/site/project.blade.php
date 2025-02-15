@extends('layouts.site.site')

@section('hero')
    <section class="section-frame overflow-hidden">
        <div class="wrapper bg-gray">
            <div class="container py-13 py-md-17 text-center">
                <div class="row">
                    <div class="col-lg-10 col-xxl-8 mx-auto">
                        <h1 class="display-1 mb-1">Check out some of our awesome projects with creative ideas.</h1>
                    </div>
                    <!-- /column -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.wrapper -->
    </section>
@endsection
@section('content')
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
            <div class="row mt-6">
                <div class="col-xl-10 mx-auto">
                    <div class="projects-tiles">
                        <div class="project grid grid-view">
                            <div class="row g-6 isotope">
                                <div class="item col-md-6">
                                    <div class="project-details d-flex justify-content-center flex-column">
                                        <div class="post-header">
                                            <div class="post-category text-red mb-3">Ideas</div>
                                            <h2 class="post-title mb-3">Cras Fermentum Sem</h2>
                                        </div>
                                        <!-- /.post-header -->
                                        <div class="post-content">
                                            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia
                                                odio sem nec elit.</p>
                                            <a href="#" class="more hover link-red">See Project</a>
                                        </div>
                                        <!-- /.post-content -->
                                    </div>
                                    <!-- /.project-details -->
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Cursus Inceptos Sit</h5>'><a
                                            href="./assets/img/photos/cs1-full.jpg"
                                            data-glightbox="title: Cursus Inceptos Sit" data-gallery="project-1"> <img
                                                src="./assets/img/photos/cs1.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Ipsum Egestas Porta</h5>'><a
                                            href="./assets/img/photos/cs2-full.jpg"
                                            data-glightbox="title: Ipsum Egestas Porta" data-gallery="project-1"> <img
                                                src="./assets/img/photos/cs2.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Ultricies Cras Tortor</h5>'><a
                                            href="./assets/img/photos/cs3-full.jpg"
                                            data-glightbox="title: Ultricies Cras Tortor" data-gallery="project-1"> <img
                                                src="./assets/img/photos/cs3.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.project -->
                        <div class="project grid grid-view">
                            <div class="row g-6 isotope">
                                <div class="item col-md-6">
                                    <div class="project-details d-flex justify-content-center flex-column">
                                        <div class="post-header">
                                            <div class="post-category text-yellow mb-3">Concept</div>
                                            <h2 class="post-title mb-3">Vulputate Sollicitudin</h2>
                                        </div>
                                        <!-- /.post-header -->
                                        <div class="post-content">
                                            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia
                                                odio sem nec elit.</p>
                                            <a href="#" class="more hover link-yellow">See Project</a>
                                        </div>
                                        <!-- /.post-content -->
                                    </div>
                                    <!-- /.project-details -->
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Purus Tellus Magna</h5>'><a
                                            href="./assets/img/photos/cs4-full.jpg"
                                            data-glightbox="title: Purus Tellus Magna" data-gallery="project-2"> <img
                                                src="./assets/img/photos/cs4.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Fusce Ipsum Vestibulum</h5>'><a
                                            href="./assets/img/photos/cs5-full.jpg"
                                            data-glightbox="title: Fusce Ipsum Vestibulum" data-gallery="project-2"> <img
                                                src="./assets/img/photos/cs5.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Condimentum Parturient Ligula</h5>'><a
                                            href="./assets/img/photos/cs6-full.jpg"
                                            data-glightbox="title: Condimentum Parturient Ligula" data-gallery="project-2">
                                            <img src="./assets/img/photos/cs6.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.project -->
                        <div class="project grid grid-view">
                            <div class="row g-6 isotope">
                                <div class="item col-md-6">
                                    <div class="project-details d-flex justify-content-center flex-column">
                                        <div class="post-header">
                                            <div class="post-category text-green mb-3">Still Life</div>
                                            <h2 class="post-title mb-3">Vulputate Sollicitudin</h2>
                                        </div>
                                        <!-- /.post-header -->
                                        <div class="post-content">
                                            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia
                                                odio sem nec elit.</p>
                                            <a href="#" class="more hover link-green">See Project</a>
                                        </div>
                                        <!-- /.post-content -->
                                    </div>
                                    <!-- /.project-details -->
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Venenatis Amet Ipsum</h5>'><a
                                            href="./assets/img/photos/cs7-full.jpg"
                                            data-glightbox="title: Venenatis Amet Ipsum" data-gallery="project-3"> <img
                                                src="./assets/img/photos/cs7.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Quam Vehicula Condimentum</h5>'><a
                                            href="./assets/img/photos/cs8-full.jpg"
                                            data-glightbox="title: Quam Vehicula Condimentum" data-gallery="project-3">
                                            <img src="./assets/img/photos/cs8.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Commodo Fusce Dapibus</h5>'><a
                                            href="./assets/img/photos/cs9-full.jpg"
                                            data-glightbox="title: Commodo Fusce Dapibus" data-gallery="project-3"> <img
                                                src="./assets/img/photos/cs9.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.project -->
                        <div class="project grid grid-view">
                            <div class="row g-6 isotope">
                                <div class="item col-md-6">
                                    <div class="project-details d-flex justify-content-center flex-column">
                                        <div class="post-header">
                                            <div class="post-category text-leaf mb-3">Workshop</div>
                                            <h2 class="post-title mb-3">Ornare Commodo Mollis</h2>
                                        </div>
                                        <!-- /.post-header -->
                                        <div class="post-content">
                                            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia
                                                odio sem nec elit.</p>
                                            <a href="#" class="more hover link-leaf">See Project</a>
                                        </div>
                                        <!-- /.post-content -->
                                    </div>
                                    <!-- /.project-details -->
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Cras Ullamcorper Tellus</h5>'><a
                                            href="./assets/img/photos/cs10-full.jpg"
                                            data-glightbox="title: Cras Ullamcorper Tellus" data-gallery="project-4"> <img
                                                src="./assets/img/photos/cs10.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Quam Bibendum Ornare</h5>'><a
                                            href="./assets/img/photos/cs11-full.jpg"
                                            data-glightbox="title: Quam Bibendum Ornare" data-gallery="project-4"> <img
                                                src="./assets/img/photos/cs11.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Ullamcorper Etiam Malesuada</h5>'><a
                                            href="./assets/img/photos/cs12-full.jpg"
                                            data-glightbox="title: Ullamcorper Etiam Malesuada" data-gallery="project-4">
                                            <img src="./assets/img/photos/cs12.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.project -->
                        <div class="project grid grid-view">
                            <div class="row g-6 isotope">
                                <div class="item col-md-6">
                                    <div class="project-details d-flex justify-content-center flex-column">
                                        <div class="post-header">
                                            <div class="post-category text-orange mb-3">Tools & Toys</div>
                                            <h2 class="post-title mb-3">Porta Tortor Vulputate</h2>
                                        </div>
                                        <!-- /.post-header -->
                                        <div class="post-content">
                                            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia
                                                odio sem nec elit.</p>
                                            <a href="#" class="more hover link-orange">See Project</a>
                                        </div>
                                        <!-- /.post-content -->
                                    </div>
                                    <!-- /.project-details -->
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Aenean Dolor Tristique</h5>'><a
                                            href="./assets/img/photos/cs13-full.jpg"
                                            data-glightbox="title: Aenean Dolor Tristique" data-gallery="project-5"> <img
                                                src="./assets/img/photos/cs13.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Magna Ipsum Euismod</h5>'><a
                                            href="./assets/img/photos/cs14-full.jpg"
                                            data-glightbox="title: Magna Ipsum Euismod" data-gallery="project-5"> <img
                                                src="./assets/img/photos/cs14.jpg" alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                                <div class="item col-md-6">
                                    <figure class="itooltip itooltip-light hover-scale rounded"
                                        title='<h5 class="mb-0">Fusce Mollis</h5>'><a
                                            href="./assets/img/photos/cs15-full.jpg" data-glightbox="title: Fusce Mollis"
                                            data-gallery="project-5"> <img src="./assets/img/photos/cs15.jpg"
                                                alt="" /></a>
                                    </figure>
                                </div>
                                <!-- /.item -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.project -->
                    </div>
                    <!-- /.projects-tiles -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
@endsection
