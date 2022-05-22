
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{__("Admin Login")}} - {{get_static_option('site_'.get_default_language().'_title')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('assets/uploads/site-favicon.'.get_static_option('site_favicon'))}}" type="image/png">
    <link rel="stylesheet" href="{{asset('assets/common/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/common/css/themify-icons.css')}}">
    <!-- others css -->
    <link rel="stylesheet" href="{{asset('assets/backend/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/responsive.css')}}">

         <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;400;500;600&family=Exo:wght@200&family=Roboto:wght@300&display=swap" rel="stylesheet"> 

 @if( get_default_language_direction() === 'rtl')

<style type="text/css">
  
    h1,h2,h3,h4,h5,h6,p,a,span
    {
          font-family: 'Cairo', sans-serif !important;

    }
    .form-gp label {
  position: absolute;
  right: 30px;
  top: 0;
  color: #b3b2b2;
  -webkit-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
}
</style>

    @endif
</head>

<body   @if( get_default_language_direction() === 'rtl') style="direction: rtl; text-align: right;font-family: 'Cairo', sans-serif !important;"    @endif>
    @yield('content')

    <!-- jquery latest version -->
    <script src="{{asset('assets/common/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/common/js/jquery-migrate-3.3.2.min.js')}}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{asset('assets/common/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/common/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.slicknav.min.js')}}"></script>

    <!-- others plugins -->
    <script src="{{asset('assets/backend/js/plugins.js')}}"></script>
    <script src="{{asset('assets/backend/js/scripts.js')}}"></script>
    @yield('scripts')
</body>
</html>
