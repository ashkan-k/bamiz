@extends('layouts.admin-master')

@if(isset($province))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن استان')
@endif

@section('content')
    @if(isset($province))
        @livewire("common::pages.dashboard.province.form-page" , [

        'titlePage' => 'ویرایش کابر',
        'type' => 'edit',
        'item' => $province

        ])
    @else

        @livewire("common::pages.dashboard.province.form-page" , [

        'titlePage' => 'افزودن استان جدید'

        ])
    @endif
@endsection
