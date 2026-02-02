@include('admin.layouts.header')

@include('admin.layouts.navbar')
@yield('styles')
@yield('content')
@yield('scripts')

 {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

@include('admin.layouts.footer')
