@extends('layouts.admin-master')

@if(isset($city))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن شهر')
@endif

@section('content')
    @if(isset($city))
        @livewire("common::pages.dashboard.city.form-page" , [

        'titlePage' => 'ویرایش شهر',
        'type' => 'edit',
        'item' => $city

        ])
    @else

        @livewire("common::pages.dashboard.city.form-page" , [

        'titlePage' => 'افزودن شهر جدید'

        ])
    @endif
@endsection
