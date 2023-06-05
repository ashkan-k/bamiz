@extends('layouts.admin-master')

@if(isset($article))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن مقاله')
@endif

@section('content')
    @if(isset($article))
        @livewire("article::pages.dashboard.form-page" , [

        'titlePage' => 'ویرایش مقاله',
        'type' => 'edit',
        'item' => $article

        ])
    @else
        @livewire("article::pages.dashboard.form-page" , [

        'titlePage' => 'افزودن مقاله جدید'

        ])
    @endif
@endsection
