@extends('layouts.site.site')

@section('content')
    <section class="wrapper bg-light">
        <div class="container pt-12 pt-md-14 pb-14 pb-md-16">
            <div class="row">
                <div class="col-lg-9 col-xl-8 mx-auto">
                </div>
                <div class="col-lg-8 col-xl-7 col-xxl-6 mx-auto text-center">
                    <h1 class="mb-3">
                        @switch($statusCode)
                            @case(403)
                                Access Denied
                            @break

                            @case(404)
                                Oops! Page Not Found.
                            @break

                            @case(419)
                                Page Expired
                            @break

                            @case(429)
                                Too Many Requests
                            @break

                            @case(500)
                                Server Error
                            @break

                            @case(503)
                                Service Unavailable
                            @break

                            @default
                                Something Went Wrong
                        @endswitch
                    </h1>
                    <p class="lead mb-7 px-md-12 px-lg-5 px-xl-7">
                        @switch($statusCode)
                            @case(403)
                                You do not have permission to access this page.
                            @break

                            @case(404)
                                The page you are looking for is not available or has been moved.
                            @break

                            @case(419)
                                Your session has expired. Please refresh and try again.
                            @break

                            @case(429)
                                You have made too many requests. Please slow down.
                            @break

                            @case(500)
                                Something went wrong on our server.
                            @break

                            @case(503)
                                The service is currently unavailable. Please try again later.
                            @break

                            @default
                                An unexpected error has occurred.
                        @endswitch
                    </p>
                    <a href="{{ route('landing.page') }}" class="btn btn-primary rounded-pill">Go to Homepage</a>
                </div>
            </div>
        </div>
    </section>
@endsection
