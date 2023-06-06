@extends('layouts.admin-master')

@if(isset($setting))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن تنظیمات')
@endif

@section('content')
    @if(isset($setting))
        @livewire("setting::pages.dashboard.form-page" , [

        'titlePage' => 'ویرایش تنظیمات',
        'type' => 'edit',
        'item' => $setting

        ])
    @else
        @livewire("setting::pages.dashboard.form-page" , [

        'titlePage' => 'افزودن تنظیمات جدید'

        ])
    @endif
@endsection
