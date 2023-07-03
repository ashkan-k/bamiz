@extends('layouts.admin-master')
@section('titlePage','مراکز')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('place::pages.dashboard.place.list-page' , [

    'titlePage' => 'مراکز',

    ])

@endsection
