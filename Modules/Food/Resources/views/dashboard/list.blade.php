@extends('layouts.admin-master')
@section('titlePage','غذا')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('food::pages.dashboard.list-page' , [

    'titlePage' => 'غذا',

    ])

@endsection
