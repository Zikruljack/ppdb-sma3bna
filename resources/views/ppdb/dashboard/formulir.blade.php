@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div id="stepper" class="bs-stepper">
            <div class="bs-stepper-header" role="tablist">
                @php
                    $steps = [
                        'ppdb.pendaftaran' => 'Data Diri',
                        'ppdb.formulir.rapor' => 'Isi Rapor',
                        'ppdb.formulir.berkas' => 'Upload Berkas',
                        'ppdb.resume' => 'Detail Keseluruhan',
                    ];
                    $currentRoute = Route::currentRouteName();
                    $completedSteps = session('completed_steps', []);
                @endphp

                @foreach ($steps as $route => $label)
                    <div class="step" data-target="{{ route($route) }}">
                        <a href="{{ route($route) }}"
                            class="step-trigger {{ $currentRoute == $route ? 'text-primary' : (in_array($route, $completedSteps) ? 'text-success' : '') }}">
                            <span class="bs-stepper-circle">{{ $loop->iteration }}</span>
                            <span class="bs-stepper-label">{{ $label }}</span>
                        </a>
                    </div>
                    @if (!$loop->last)
                        <div class="line"></div>
                    @endif
                @endforeach
            </div>
        </div>

        @yield('form-content')
    </div>
@endsection

@section('footer')
    <div class="footer-content ">
        <div class="float-right">
            <small>Version: {{ config('app.version', '1.0.0') }}</small>
        </div>
        <strong>
            {{ config('app.company_name', 'SPMB SMAN 3 Banda Aceh') }}
            <small>Dev by: ObongJ</small>
        </strong>
        <br>

    </div>
@endsection


@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `
                <ul style="text-align: left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: 'resolve',
                theme: 'bootstrap-5',
            });
        });
    </script>

    @yield('js-form')
@endsection
