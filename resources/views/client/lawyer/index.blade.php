@extends('layouts.client.layout')
@section('title')
    <title>{{ seoSetting()->where('page_name', 'Lawyers')->first()?->seo_title ?? 'Lawyers | LawMent' }}</title>
@endsection
@section('meta')
    <meta name="description"
        content="{{ seoSetting()->where('page_name', 'Lawyers')->first()?->seo_description ?? 'Lawyers | LawMent' }}">
@endsection
@section('client-content')
@endsection
