@extends('layouts.admin-master')
@section('titlePage','تشریفات')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('option::pages.dashboard.list-page' , [

    'titlePage' => 'تشریفات',

    ])

@endsection
