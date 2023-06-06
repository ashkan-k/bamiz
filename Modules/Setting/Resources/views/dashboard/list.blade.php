@extends('layouts.admin-master')
@section('titlePage','تنظیمات')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('setting::pages.dashboard.list-page' , [

    'titlePage' => 'تنظیمات',

    ])

@endsection
