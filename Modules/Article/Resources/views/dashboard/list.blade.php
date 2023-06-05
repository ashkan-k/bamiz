@extends('layouts.admin-master')
@section('titlePage','مقاله ها')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('article::pages.dashboard.list-page' , [

    'titlePage' => 'مقاله ها',

    ])

@endsection
