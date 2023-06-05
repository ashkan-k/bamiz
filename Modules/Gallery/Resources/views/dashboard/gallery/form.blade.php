@extends('layouts.admin-master')

@if(isset($gallery))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن گالری')
@endif

@section('content')
    @if(isset($gallery))
        @livewire("gallery::pages.dashboard.form-page" , [

        'titlePage' => 'ویرایش گالری',
        'type' => 'edit',
        'item' => $gallery

        ])
    @else

        @livewire("gallery::pages.dashboard.form-page" , [

        'titlePage' => 'افزودن گالری جدید'

        ])
    @endif
@endsection
