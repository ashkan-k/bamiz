@extends('layouts.admin-master')
@section('titlePage','میز های مراکز')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('place::pages.dashboard.table.list-page' , [

    'titlePage' => 'میز های مراکز',

    ])

@endsection
