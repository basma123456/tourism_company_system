@include('admin.layouts.header')

@include('admin.layouts.navbar')

@yield('content')
 {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

@include('admin.layouts.footer')
