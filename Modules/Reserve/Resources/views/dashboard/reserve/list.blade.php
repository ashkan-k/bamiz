@extends('layouts.admin-master')
@section('titlePage','رزرو')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('reserve::pages.dashboard.reserve.list-page' , [

    'titlePage' => 'رزرو',

    ])

@endsection
