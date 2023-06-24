@extends('layouts.admin-master')
@section('titlePage','پروفایل کاربر')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    @livewire('dashboard::pages.profile-page' , [
    'titlePage' => 'پروفایل کاربر',
    ])

@endsection
