@extends('layouts.front-master')

@section('titlePage')
    پروفایل من
@endsection

@section('content')

    @livewire('front::pages.front.profile-page' , [

    'titlePage' => 'پروفایل من',

    ])

@endsection
