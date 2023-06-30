@extends('layouts.admin-master')
@section('titlePage','زمان کاری ها')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('worktime::pages.dashboard.list-page' , [
    'titlePage' => 'زمان کاری ها'
    ])

@endsection
