@extends('layouts.admin-master')

@if(isset($comment))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن نظر')
@endif

@section('content')
    @if(isset($comment))
        @livewire("comment::pages.dashboard.form-page" , [

        'titlePage' => 'ویرایش نظر',
        'type' => 'edit',
        'item' => $comment

        ])
    @else

        @livewire("comment::pages.dashboard.form-page" , [

        'titlePage' => 'افزودن نظر جدید'

        ])
    @endif
@endsection
