@extends('layouts.admin-master')
@section('titlePage','کاربران')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('user::pages.dashboard.list-page' , [

    'titlePage' => 'کاربران',

    ])

@endsection
