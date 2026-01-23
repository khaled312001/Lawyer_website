@php
    $isDashboardPage = request()->routeIs('dashboard') || 
                       request()->routeIs('client.*') || 
                       request()->routeIs('client.messages.*') || 
                       request()->routeIs('client.meeting-history') || 
                       request()->routeIs('client.upcomming-meeting') || 
                       request()->routeIs('client.payment') ||
                       str_starts_with(request()->path(), 'client/');
@endphp

@if(!$isDashboardPage)
    @include('layouts.client.header')
@endif

@if($isDashboardPage)
    @include('client.client_header')
@endif

@yield('client-content')
@include('layouts.client.footer')
