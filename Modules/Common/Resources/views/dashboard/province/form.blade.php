@extends('layouts.admin-master')

@if(isset($province))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن استان')
@endif

@section('content')
    @if(isset($province))
        @livewire("user::pages.dashboard.province.form-page" , [

        'titlePage' => 'ویرایش کابر',
        'type' => 'edit',
        'item' => $province

        ])
    @else

        @livewire("user::pages.dashboard.province.form-page" , [

        'titlePage' => 'افزودن استان جدید'

        ])
    @endif
@endsection
