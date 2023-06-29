@extends('layouts.front-master')

<?php $title = isset($category) ? $category->title : "کافه و رستوران و هتل های بامیز"; ?>

@section('titlePage')
    {{ $title }}
@endsection

@section('content')
    <?php $category = isset($category) ? $category->id : null; ?>

    @livewire('place::pages.front.places-page', [
        'titlePage' => $title,
        'category' => $category,
    ])
@endsection
