@extends('layouts.admin-master')
@section('titlePage','مراکز')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('place::pages.dashboard.list-page' , [

    'titlePage' => 'مراکز',

    ])

@endsection
