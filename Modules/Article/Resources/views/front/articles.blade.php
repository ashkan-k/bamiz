@extends('layouts.front-master')

@section('titlePage')
    مقالات بامیز
@endsection

@section('content')
    <?php $title = isset($object) ? $object->name : "مقالات بامیز"; ?>
        @livewire('article::pages.front.articles-page', [
        'titlePage' => $title
    ])
@endsection
