@extends('layouts.admin-master')
@section('titlePage','منو ها')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('place::pages.dashboard.menu.list-page' , [

    'titlePage' => 'منو ها',

    ])

@endsection
