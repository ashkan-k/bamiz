@extends('layouts.admin-master')
@section('titlePage','تراکنش ها')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('payment::pages.dashboard.list-page' , [

    'titlePage' => 'تراکنش ها',

    ])

@endsection
