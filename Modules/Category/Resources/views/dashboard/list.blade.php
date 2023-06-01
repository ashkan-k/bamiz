@extends('layouts.admin-master')
@section('titlePage','دسته بندی ها')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('category::pages.dashboard.list-page' , [

    'titlePage' => 'دسته بندی ها',

    ])

@endsection
