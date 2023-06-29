@extends('layouts.front-master')

@section('titlePage')
    مقاله ({{ $article->title ?: '---' }})
@endsection

@section('content')
        @livewire('article::pages.front.article-detail-page', [
        'titlePage' => $article->title,
        'object' => $article,
    ])
@endsection
