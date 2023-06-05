@extends('layouts.admin-master')
@section('titlePage','گالری ها')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('gallery::pages.dashboard.list-page' , [

    'titlePage' => 'گالری ها',

    ])

@endsection
