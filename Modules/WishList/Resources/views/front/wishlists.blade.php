@extends('layouts.front-master')

@section('titlePage')
    محبوب های من
@endsection

@section('content')
    @livewire('wishlist::pages.front.wishlist-page', [
        'titlePage' => 'محبوب های من',
    ])
@endsection
