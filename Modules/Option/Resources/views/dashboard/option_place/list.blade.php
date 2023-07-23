@extends('layouts.admin-master')
@section('titlePage','تشریفات')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('option::pages.dashboard.option-place.list-page' , [

    'titlePage' => 'تشریفات',

    ])

@endsection
