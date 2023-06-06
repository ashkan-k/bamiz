@extends('layouts.admin-master')
@section('titlePage','لیست علاقه مندی ها')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('wishlist::pages.dashboard.list-page' , [

    'titlePage' => 'لیست علاقه مندی ها',

    ])

@endsection
