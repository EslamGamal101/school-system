<!doctype html>
<html lang="en">

@include('theme.partials.head')

<body class="vertical  light @if (LaravelLocalization::getCurrentLocale()=='ar') rtl
    
@endif ">
    <div class="wrapper">
        @yield('content')

        @include('theme.partials.script')
</body>

</html>