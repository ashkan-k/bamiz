@extends('layouts.front-master')

@section('titlePage')
    کافه و رستوران و هتل های بامیز
@endsection

@section('content')
    @livewire('place::pages.front.places-page')
@endsection
