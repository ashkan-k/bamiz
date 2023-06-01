@extends('layouts.admin-master')
@section('titlePage','استان ها')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('common::pages.dashboard.province.list-page' , [

    'titlePage' => 'استان ها',

    ])

@endsection
