@extends('layouts.admin-master')
@section('titlePage','تیکت')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('ticket::pages.dashboard.ticket.list-page' , [

    'titlePage' => 'تیکت',

    ])

@endsection
