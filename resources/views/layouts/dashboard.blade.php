<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.menu-head')
</head>

<body>
    @include('includes.menu-header')
    @include('includes.menu-sidebar')

    @yield('content')

    @include('includes.menu-footer')
    @include('includes.menu-scripts')

    @yield('page-js-script')
</body>

</html>
