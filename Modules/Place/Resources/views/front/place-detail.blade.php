@extends('layouts.front-master')

@section('titlePage')
    تور مجازی و رزرو میز مرکز {{ $place->name }}
@endsection

@section('content')
    @livewire('place::pages.front.place-detail-page', [
    'titlePage' => $place->title,
    'object' => $place,
    ])
@endsection
