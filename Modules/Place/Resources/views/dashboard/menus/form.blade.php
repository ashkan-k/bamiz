@extends('layouts.admin-master')

@if(isset($gallery))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن منو')
@endif

@section('content')
    @if(isset($gallery))
        @livewire("place::pages.dashboard.menu.form-page" , [

        'titlePage' => 'ویرایش منو',
        'type' => 'edit',
        'item' => $gallery

        ])
    @else
        @livewire("place::pages.dashboard.menu.form-page" , [

        'titlePage' => 'افزودن منو جدید'

        ])
    @endif
@endsection
