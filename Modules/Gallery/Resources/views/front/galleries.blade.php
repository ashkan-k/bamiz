@extends('layouts.front-master')

@section('titlePage')
    گالری تصاویر مراکز بامیز
@endsection

@section('content')
    @livewire('gallery::pages.front.galleries-page', [
    'titlePage' => 'گالری تصاویر مراکز بامیز',
    ])
@endsection
