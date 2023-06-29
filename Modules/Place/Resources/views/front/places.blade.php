@extends('layouts.front-master')

@section('titlePage')
    کافه و رستوران و هتل های بامیز
@endsection

@section('content')
    <?php $title = isset($object) ? $object->name : "کافه و رستوران و هتل های بامیز"; ?>
    @livewire('place::pages.front.places-page', [
        'titlePage' => $title
    ])
@endsection
