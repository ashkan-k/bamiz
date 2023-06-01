@extends('layouts.admin-master')
@section('titlePage','شهر ها')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('common::pages.dashboard.city.list-page' , [

    'titlePage' => 'شهر ها',

    ])

@endsection
