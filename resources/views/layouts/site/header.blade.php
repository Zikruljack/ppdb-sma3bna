<nav class="navbar navbar-expand-lg classic transparent navbar-light">
    <div class="container flex-lg-row flex-nowrap align-items-center">
        <div class="navbar-brand w-100">
            <a href="/" class="d-flex align-items-center">
                <img class="logo-smantig me-2" src="{{ asset('assets/img/logo_smantig.png') }}"
                    alt="SMAN 3 Banda Aceh Logo" />
                <span class="h5 mb-0">SMAN 3 Banda Aceh</span>
            </a>
        </div>
        <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
            <div class="offcanvas-header d-lg-none">
                <a href="/"><img class="logo-smantig me-2" src="{{ asset('assets/img/logo_smantig.png') }}"
                        alt="" /></a>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login.ppdb') }}">Login SPMB</a></li>
                </ul>
                <!-- /.navbar-nav -->
                <div class="d-lg-none mt-auto pt-6 pb-6 order-4">
                    <a href="mailto:first.last@email.com" class="link-inverse">info@email.com</a>
                    <br /> 00 (123) 456 78 90 <br />
                    <nav class="nav social social-white mt-4">
                        <a href="#"><i class="uil uil-twitter"></i></a>
                        <a href="#"><i class="uil uil-facebook-f"></i></a>
                        <a href="#"><i class="uil uil-dribbble"></i></a>
                        <a href="#"><i class="uil uil-instagram"></i></a>
                        <a href="#"><i class="uil uil-youtube"></i></a>
                    </nav>
                    <!-- /.social -->
                </div>
                <!-- /offcanvas-nav-other -->
            </div>
            <!-- /.offcanvas-body -->
        </div>
        <!-- /.navbar-other -->
    </div>
    <!-- /.container -->
</nav>
<!-- /.navbar -->
