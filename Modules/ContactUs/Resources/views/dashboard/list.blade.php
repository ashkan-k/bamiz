@extends('layouts.admin-master')
@section('titlePage','تماس با ما')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('contactus::pages.dashboard.list-page' , [

    'titlePage' => 'تماس با ما',

    ])

@endsection
