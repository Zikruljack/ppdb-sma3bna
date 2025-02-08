<header class="wrapper bg-light">
    <!-- Top Bar with Contact Info -->
    <div class="bg-primary text-white fw-bold py-1">
        <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="uil uil-location-pin-alt me-2"></i>
                <span>Jl. Pendidikan No. 123, Kota ABC</span>
            </div>
            <div class="d-flex align-items-center">
                <i class="uil uil-phone-volume me-2"></i>
                <span>(021) 1234-5678</span>
            </div>
            <div class="d-flex align-items-center">
                <i class="uil uil-envelope me-2"></i>
                <a href="mailto:info@sekolahabc.sch.id"
                    class="text-white text-decoration-none">info@sekolahabc.sch.id</a>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Sekolah ABC" class="img-fluid" style="max-height: 50px;">
            </a>

            <!-- Navbar Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Profil</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                            <li><a class="dropdown-item" href="#">Fasilitas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Prestasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">PPDB Online</a></li>

                </ul>

                <!-- Buttons for Dashboard & Login -->
                <div class="d-flex gap-2 ms-lg-3">
                    <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Pendaftaran</a>
                    <a href="{{ route('login') }}" class="btn btn-sm btn-danger">Login</a>
                </div>
            </div>
        </div>
    </nav>
</header>
