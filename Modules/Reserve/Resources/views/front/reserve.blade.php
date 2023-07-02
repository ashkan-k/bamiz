@extends('layouts.front-master')

@section('titlePage')
    رزرو {{ $place->get_type() }} {{ $place->name }}
@endsection

@section('content')
    @livewire('reserve::pages.front.reserve-page', [
    'titlePage' => $place->title,
    'data' => $data,
    'place' => $place,
    ])
@endsection
