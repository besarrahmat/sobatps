@extends('layouts.default')

@section('content')
    @include('includes.header')

    <!-- ======= Hero Section ======= -->
    @include('includes.landing-page.start')
    <!-- End Hero -->

    <main id="main">
        <!-- ======= Counts Section ======= -->
        @include('includes.landing-page.counts')
        <!-- End Counts Section -->

        <!-- ======= Map Section ======= -->
        @include('includes.landing-page.map')
        <!-- End Map Section -->

        <!-- ======= About Section ======= -->
        @include('includes.landing-page.about')
        <!-- End About Section -->

        <!-- ======= Services Section ======= -->
        @include('includes.landing-page.services')
        <!-- End Sevices Section -->

        <!-- ======= Gallery Section ======= -->
        @include('includes.landing-page.gallery')
        <!-- End Gallery Section -->

        <!-- ======= Contact Section ======= -->
        @include('includes.landing-page.contact')
        <!-- End Contact Section -->
    </main>
    <!-- End #main -->
@endsection

@section('page-js-script')
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.key') }}&callback=initMap" defer>
    </script>
@stop
