@extends('layouts.admin-master')
@section('titlePage','نظرات')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('comment::pages.dashboard.list-page' , [

    'titlePage' => 'نظرات',

    ])

@endsection
