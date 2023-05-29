@extends('layouts.admin-master')
@section('titlePage','لیست علاقه مندی ها')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('dashboard::pages.dashboard' , [

    'titlePage' => 'لیست علاقه مندی ها کاربران',

    ])

@endsection
