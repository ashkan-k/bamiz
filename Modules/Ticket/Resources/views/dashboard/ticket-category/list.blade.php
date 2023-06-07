@extends('layouts.admin-master')
@section('titlePage','دسته بندی تیکت')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('ticket::pages.dashboard.ticket-category.list-page' , [

    'titlePage' => 'دسته بندی تیکت',

    ])

@endsection
