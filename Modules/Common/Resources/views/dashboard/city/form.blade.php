@extends('layouts.admin-master')

@if(isset($city))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن شهر')
@endif

@section('content')
    @if(isset($city))
        @livewire("user::pages.dashboard.city.form-page" , [

        'titlePage' => 'ویرایش کابر',
        'type' => 'edit',
        'item' => $city

        ])
    @else

        @livewire("user::pages.dashboard.city.form-page" , [

        'titlePage' => 'افزودن شهر جدید'

        ])
    @endif
@endsection
