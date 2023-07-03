@extends('layouts.admin-master')
@section('titlePage','نوع رزرو')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('reserve::pages.dashboard.reserve-type.list-page' , [

    'titlePage' => 'نوع رزرو',

    ])

@endsection
