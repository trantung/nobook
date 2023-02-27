<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="copyright" content="Brighter Gates AB" />
    <meta name="robots" content="index,follow" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title ?? '' }}</title>
    <!-- Favicon icon -->
{{--    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/admin/images/favicon32x32.png') }}">--}}
    <!-- Pignose Calender -->
    <link href="{{ asset('assets/admin/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <!-- Custom Stylesheet -->
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/js/toastr/css/toastr.min.css') }}" rel="stylesheet">
{{--    <link src="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.min.css" integrity="sha512-Yn5Z4XxNnXXE8Y+h/H1fwG/2qax2MxG9GeUOWL6CYDCSp4rTFwUpOZ1PS6JOuZaPBawASndfrlWYx8RGKgILhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('css')
</head>

<body>
@guest('admin')
    @yield('content')
@endguest

@auth('admin')
    <div id="main-wrapper">
        @include('admin.layouts.navbar')
        @include('admin.layouts.sidebar')
        <div class="content-body">
            @yield('breadcrumb')
            @yield('content')
        </div>
    </div>
@endauth

<script src="{{ asset('assets/admin/js/jquery-3.0.0.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/lodash.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/common/common.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/settings.js') }}"></script>
<script src="{{ asset('assets/admin/js/gleek.js') }}"></script>
<script src="{{ asset('assets/admin/js/styleSwitcher.js') }}"></script>

<!-- Chartjs -->
<script src="{{ asset('assets/admin/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Circle progress -->
<script src="{{ asset('assets/admin/plugins/circle-progress/circle-progress.min.js') }}"></script>
<!-- Datamap -->
<script src="{{ asset('assets/admin/plugins/d3v3/index.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/topojson/topojson.min.js') }}"></script>
{{--<script src="{{ asset('assets/admin/plugins/datamaps/datamaps.world.min.js') }}"></script>--}}
<!-- Morrisjs -->
<script src="{{ asset('assets/admin/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/morris/morris.min.js') }}"></script>
<!-- Pignose Calender -->
<script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
<!-- ChartistJS -->
<script src="{{ asset('assets/admin/plugins/chartist/js/chartist.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>

{{--<script src="{{ asset('assets/admin/js/dashboard/dashboard-1.js') }}"></script>--}}
<script src="{{ asset('assets/admin/js/jasny-bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/toastr/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/toastr/js/toastr.init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.min.js"></script>
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/main.js') }}"></script>
<script src="{{ asset('assets/admin/js/accounting.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    @if(Session::has('success'))
        toastr.success('{{ Session::get('success') }}', successTitle);
    @endif
    @if($errors->any())
        toastr.error('{{ $errors->first() }}', failTitle);
    @endif
</script>
<input hidden class="active-page" value="{{ $activePage ?? '' }}">
<script>
    $(document).ready(function () {
        let active = $('.active-page').val();
        if (active) {
            let menu = $("ul#menu a").filter(function() {
                return $(this).hasClass(active);
            }).addClass("active")
            .parent()
            .addClass("active");

            if (menu.is('li')) {
                menu.parent()
                .addClass("in")
                .parent()
                .addClass("active");
            }
        }
    });
</script>

<!--GG recaptcha-->
@include('partials.ggcaptcha')

@stack('js')
</body>

</html>
