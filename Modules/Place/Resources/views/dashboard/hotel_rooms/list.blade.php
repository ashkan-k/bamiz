@extends('layouts.admin-master')
@section('titlePage','اتاق های هتل')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('place::pages.dashboard.hotel-room.list-page' , [

    'titlePage' => 'اتاق های هتل',

    ])

@endsection
