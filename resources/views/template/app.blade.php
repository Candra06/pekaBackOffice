<!DOCTYPE html>
<html lang="en">

@include('template.head')

<body class="fix-header fix-sidebar card-no-border">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

    <div id="main-wrapper">
        @include('template.navbar')

        @include('template.sidebar')

        <div class="page-wrapper">

            @yield('content')

            <footer class="footer"> © 2023 PEKA Back Office </footer>

        </div>

    </div>

    @include('template.script')
</body>

</html>
