@include('layouts.client.header')
@if(request()->routeIs('dashboard') || request()->routeIs('client.*') || request()->routeIs('client.messages.*') || request()->routeIs('client.meeting-history') || request()->routeIs('client.upcomming-meeting') || request()->routeIs('client.payment'))
    @include('client.dashboard_header')
@endif
@yield('client-content')
@include('layouts.client.footer')
