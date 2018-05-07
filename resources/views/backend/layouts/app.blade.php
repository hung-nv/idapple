<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="author"/>
    <meta name="_token" content="{!! csrf_token() !!}" />
    @include('backend.blocks.style-header')

    @yield('header')

    @include('backend.blocks.style-layouts')
    <link rel="shortcut icon" href="{{ asset('/admin/images/favicon.ico') }}"/>
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

@include('backend.blocks.header')

<div class="clearfix"></div>

<div class="page-container">

    @include('backend.blocks.sidebar')

    @yield('content')

{{--    @include('backend.blocks.quick-sidebar')--}}
</div>

<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2014 &copy; Administrator by hungnv234@gmail.com
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
@include('backend.blocks.js-core')

@yield('footer')

@include('backend.blocks.js-global-script')

@yield('page-script')

@include('backend.blocks.js-layouts')
</body>

</html>