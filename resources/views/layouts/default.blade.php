<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
</head>

<body>
    @yield('content')

    @unless(request()->is('login') || request()->is('register'))
        @include('includes.footer')
    @endunless
    @include('includes.footer-scripts')

    @yield('page-js-script')
</body>

</html>
