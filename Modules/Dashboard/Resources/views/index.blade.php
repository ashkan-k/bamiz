@extends('layouts.admin-master')
@section('titlePage','داشبورد')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('dashboard::pages.dashboard' , [

    'titlePage' => 'داشبورد',

    ])

@endsection
