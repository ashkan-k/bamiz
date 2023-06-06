@extends('layouts.admin-master')
@section('titlePage','درخواست همکاری')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('cooperation::pages.dashboard.list-page' , [

    'titlePage' => 'درخواست همکاری',

    ])

@endsection
